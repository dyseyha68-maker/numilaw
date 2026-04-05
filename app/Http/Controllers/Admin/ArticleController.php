<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['author', 'category', 'tags']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title_en', 'LIKE', "%{$search}%")
                    ->orWhere('title_km', 'LIKE', "%{$search}%")
                    ->orWhere('content_en', 'LIKE', "%{$search}%")
                    ->orWhere('content_km', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by author
        if ($request->filled('author_id')) {
            $query->where('author_id', $request->author_id);
        }

        // Filter by featured
        if ($request->filled('is_featured')) {
            $query->where('is_featured', $request->boolean('is_featured'));
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sort by
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $articles = $query->paginate(15)->withQueryString();

        // Get filter data
        $categories = Category::active()->orderBy('name_en')->get();
        $authors = DB::table('users')->where('role', 'admin')->orWhere('role', 'faculty')->get();

        return view('admin.articles.index', compact('articles', 'categories', 'authors'));
    }

    public function create()
    {
        $categories = Category::active()->orderBy('name_en')->get();
        $tags = Tag::active()->orderBy('name_en')->get();
        $projects = Project::orderBy('name_en')->get();

        return view('admin.articles.create', compact('categories', 'tags', 'projects'));
    }

    public function store(StoreArticleRequest $request)
    {
        Log::info('Article store method called');
        Log::info('Request data: ', $request->all());

        try {
            DB::beginTransaction();

            $validated = $request->validated();
            Log::info('Validated data: ', $validated);

            // Generate unique slug
            $slug = Str::slug($validated['title_en']);
            $originalSlug = $slug;
            $counter = 1;

            while (Article::where('slug', $slug)->exists()) {
                $slug = $originalSlug.'-'.$counter;
                $counter++;
            }

            $validated['slug'] = $slug;
            $validated['author_id'] = Auth::id();
            $validated['views'] = 0;

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $filename = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('images/articles');
                if (! file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $image->move($destinationPath, $filename);

                $validated['featured_image'] = 'articles/'.$filename;
            }

            // Handle gallery images upload
            $galleryImages = [];
            if ($request->hasFile('gallery_images')) {
                $galleryFiles = $request->file('gallery_images');
                $galleryPath = public_path('images/articles/gallery');

                if (! file_exists($galleryPath)) {
                    mkdir($galleryPath, 0755, true);
                }
                foreach ($galleryFiles as $file) {
                    if ($file->isValid()) {
                        $filename = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
                        $file->move($galleryPath, $filename);
                        $galleryImages[] = 'articles/gallery/'.$filename;
                    }
                }
            }
            if (! empty($galleryImages)) {
                $validated['gallery_images'] = $galleryImages;
            }

            // Set published date if publishing
            if ($validated['status'] === 'published' && empty($validated['published_at'])) {
                $validated['published_at'] = now();
            }

            // Generate SEO meta
            if (empty($validated['excerpt_en'])) {
                $validated['excerpt_en'] = Str::limit(strip_tags($validated['content_en']), 160);
            }
            if (empty($validated['excerpt_km'])) {
                $validated['excerpt_km'] = Str::limit(strip_tags($validated['content_km']), 160);
            }

            $article = Article::create($validated);

            // Handle tags
            if (! empty($validated['tags'])) {
                $article->tags()->attach($validated['tags']);
            }

            DB::commit();

            Log::info('Article created successfully with ID: '.$article->id);

            return redirect()->route('admin.articles.index')
                ->with('success', 'Article created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error creating article: '.$e->getMessage());
            Log::error('Exception trace: ', $e->getTrace());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating article: '.$e->getMessage());
        }
    }

    public function show(Article $article)
    {
        $article->load(['author', 'category', 'tags']);

        // Get related articles
        $relatedArticles = Article::where('id', '!=', $article->id)
            ->where('status', 'published')
            ->where(function ($query) use ($article) {
                $query->where('category_id', $article->category_id)
                    ->orWhereHas('tags', function ($q) use ($article) {
                        $q->whereIn('tag_id', $article->tags->pluck('id'));
                    });
            })
            ->limit(5)
            ->get();

        // Article statistics
        $stats = [
            'views' => $article->views,
            'word_count_en' => str_word_count(strip_tags($article->content_en)),
            'word_count_km' => str_word_count(strip_tags($article->content_km)),
            'reading_time_en' => ceil(str_word_count(strip_tags($article->content_en)) / 200),
            'reading_time_km' => ceil(str_word_count(strip_tags($article->content_km)) / 200),
        ];

        return view('admin.articles.show', compact('article', 'relatedArticles', 'stats'));
    }

    public function edit(Article $article)
    {
        $categories = Category::active()->orderBy('name_en')->get();
        $tags = Tag::active()->orderBy('name_en')->get();
        $projects = Project::orderBy('name_en')->get();

        $article->load(['tags']);

        return view('admin.articles.edit', compact('article', 'categories', 'tags', 'projects'));
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validated();

            // Generate unique slug if title changed
            if ($validated['title_en'] !== $article->title_en) {
                $slug = Str::slug($validated['title_en']);
                $originalSlug = $slug;
                $counter = 1;

                while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                    $slug = $originalSlug.'-'.$counter;
                    $counter++;
                }

                $validated['slug'] = $slug;
            }

            // Handle featured image update
            if ($request->hasFile('featured_image')) {
                $image = $request->file('featured_image');
                $filename = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('images/articles');

                if (! is_dir($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $filename);
                $validated['featured_image'] = 'articles/'.$filename;
            }

            // Handle image removal
            if ($request->has('remove_image') && $request->boolean('remove_image')) {
                $validated['featured_image'] = null;
            }

            // Handle gallery images
            $galleryImages = [];
            if ($request->hasFile('gallery_images')) {
                $galleryFiles = $request->file('gallery_images');
                $galleryPath = public_path('images/articles/gallery');
                if (! file_exists($galleryPath)) {
                    mkdir($galleryPath, 0755, true);
                }
                foreach ($galleryFiles as $file) {
                    if ($file->isValid()) {
                        $filename = time().'_'.Str::random(10).'.'.$file->getClientOriginalExtension();
                        $file->move($galleryPath, $filename);
                        $galleryImages[] = 'articles/gallery/'.$filename;
                    }
                }
            }

            // Handle removed gallery images
            $existingGallery = $article->getRawOriginal('gallery_images') ?? [];
            if (is_string($existingGallery)) {
                $existingGallery = json_decode($existingGallery, true) ?? [];
            }
            $removedImages = $request->input('remove_gallery_images', []);
            if (is_string($removedImages)) {
                $removedImages = json_decode($removedImages, true) ?? [];
            }

            // Delete the actual image files
            foreach ($removedImages as $removedImage) {
                $filePath = public_path('images/'.$removedImage);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $remainingGallery = array_diff($existingGallery, $removedImages);
            $validated['gallery_images'] = array_merge($remainingGallery, $galleryImages);

            // Set published date if status changed to published
            if ($validated['status'] === 'published' && $article->status !== 'published' && ! $validated['published_at']) {
                $validated['published_at'] = now();
            }

            // Update SEO meta if empty
            if (empty($validated['excerpt_en'])) {
                $validated['excerpt_en'] = Str::limit(strip_tags($validated['content_en']), 160);
            }
            if (empty($validated['excerpt_km'])) {
                $validated['excerpt_km'] = Str::limit(strip_tags($validated['content_km']), 160);
            }

            $article->update($validated);

            Log::info('After update - gallery_images in DB: '.json_encode($article->getRawOriginal('gallery_images')));

            // Handle tags
            if (isset($validated['tags'])) {
                $article->tags()->sync($validated['tags']);
            }

            DB::commit();

            return redirect()->route('admin.articles.index')
                ->with('success', 'Article updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating article: '.$e->getMessage());
        }
    }

    public function destroy(Article $article)
    {
        try {
            // Delete featured image
            if ($article->featured_image) {
                $imagePath = public_path('images/'.$article->featured_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Delete gallery images
            $galleryImages = $article->gallery_images ?? [];
            foreach ($galleryImages as $galleryImage) {
                $galleryPath = public_path('images/'.$galleryImage);
                if (file_exists($galleryPath)) {
                    unlink($galleryPath);
                }
            }

            // Detach tags and delete article
            $article->tags()->detach();
            $article->delete();

            return redirect()->route('admin.articles.index')
                ->with('success', 'Article deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin.articles.index')
                ->with('error', 'Error deleting article: '.$e->getMessage());
        }
    }

    // Additional methods for advanced functionality

    public function publish(Article $article)
    {
        $article->update([
            'status' => 'published',
            'published_at' => $article->published_at ?: now(),
        ]);

        return redirect()->back()
            ->with('success', 'Article published successfully.');
    }

    public function unpublish(Article $article)
    {
        $article->update([
            'status' => 'draft',
        ]);

        return redirect()->back()
            ->with('success', 'Article unpublished successfully.');
    }

    public function toggleFeatured(Article $article)
    {
        $article->update([
            'is_featured' => ! $article->is_featured,
        ]);

        $status = $article->is_featured ? 'featured' : 'unfeatured';

        return redirect()->back()
            ->with('success', "Article {$status} successfully.");
    }

    public function duplicate(Article $article)
    {
        try {
            $newArticle = $article->replicate();
            $newArticle->title_en = $article->title_en.' (Copy)';
            $newArticle->title_km = $article->title_km.' (ចម្លង)';
            $newArticle->slug = Str::slug($newArticle->title_en).'-'.time();
            $newArticle->status = 'draft';
            $newArticle->published_at = null;
            $newArticle->views = 0;
            $newArticle->author_id = Auth::id();
            $newArticle->save();

            // Copy tags
            $newArticle->tags()->attach($article->tags->pluck('id'));

            return redirect()->route('admin.articles.edit', $newArticle)
                ->with('success', 'Article duplicated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error duplicating article: '.$e->getMessage());
        }
    }

    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $articleIds = $request->article_ids;

        if (empty($articleIds)) {
            return redirect()->back()
                ->with('error', 'Please select at least one article.');
        }

        try {
            switch ($action) {
                case 'delete':
                    Article::whereIn('id', $articleIds)->each(function ($article) {
                        if ($article->featured_image) {
                            $imagePath = public_path('images/'.$article->featured_image);
                            if (file_exists($imagePath)) {
                                unlink($imagePath);
                            }
                        }
                        $article->tags()->detach();
                        $article->delete();
                    });
                    $message = 'Selected articles deleted successfully.';
                    break;

                case 'publish':
                    Article::whereIn('id', $articleIds)->update([
                        'status' => 'published',
                        'published_at' => now(),
                    ]);
                    $message = 'Selected articles published successfully.';
                    break;

                case 'unpublish':
                    Article::whereIn('id', $articleIds)->update(['status' => 'draft']);
                    $message = 'Selected articles unpublished successfully.';
                    break;

                case 'feature':
                    Article::whereIn('id', $articleIds)->update(['is_featured' => true]);
                    $message = 'Selected articles featured successfully.';
                    break;

                case 'unfeature':
                    Article::whereIn('id', $articleIds)->update(['is_featured' => false]);
                    $message = 'Selected articles unfeatured successfully.';
                    break;

                default:
                    throw new \Exception('Invalid action');
            }

            return redirect()->back()
                ->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error performing bulk action: '.$e->getMessage());
        }
    }

    public function preview(Article $article)
    {
        $article->load(['author', 'category', 'tags']);

        return view('admin.articles.preview', compact('article'));
    }

    // Helper method for generating thumbnails
    private function generateThumbnail($image, $path)
    {
        try {
            // This would require intervention/image package
            // For now, we'll just copy the original
            // In a real implementation, you'd resize and optimize

            if (! Storage::disk('public')->exists('thumbnails')) {
                Storage::disk('public')->makeDirectory('thumbnails');
            }

            // Copy original to thumbnails directory (placeholder for actual thumbnail generation)
            Storage::disk('public')->copy($path, 'thumbnails/'.basename($path));

        } catch (\Exception $e) {
            // Log error but don't fail the upload
            Log::error('Thumbnail generation failed: '.$e->getMessage());
        }
    }
}
