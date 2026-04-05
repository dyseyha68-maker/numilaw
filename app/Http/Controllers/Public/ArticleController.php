<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\HeroSettings;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()
            ->with(['author', 'category', 'tags'])
            ->latest('published_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $locale = app()->getLocale();
            $query->where(function ($q) use ($search, $locale) {
                $q->where("title_{$locale}", 'like', "%{$search}%")
                  ->orWhere("content_{$locale}", 'like', "%{$search}%")
                  ->orWhere("excerpt_{$locale}", 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }

        if ($request->filter === 'featured') {
            $query->featured();
        }

        $articles = $query->paginate(12)->withQueryString();

        $featuredArticles = Article::published()
            ->featured()
            ->with(['author', 'category'])
            ->latest('published_at')
            ->take(3)
            ->get();

        $categories = Category::active()
            ->whereHas('articles', function ($q) {
                $q->published();
            })
            ->withCount(['articles' => function ($q) {
                $q->published();
            }])
            ->get();

        $tags = Tag::active()
            ->whereHas('articles', function ($q) {
                $q->published();
            })
            ->withCount(['articles' => function ($q) {
                $q->published();
            }])
            ->get();

        $totalArticles = Article::published()->count();

        $heroImage = HeroSettings::getImageForPage('articles') ?? HeroSettings::getDefaultImage('articles');

        return view('public.articles.index', compact(
            'articles',
            'featuredArticles',
            'categories',
            'tags',
            'totalArticles',
            'heroImage'
        ));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->published()
            ->with(['author', 'category', 'tags'])
            ->firstOrFail();

        $article->incrementViews();

        $relatedArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->where(function ($q) use ($article) {
                $q->where('category_id', $article->category_id)
                  ->orWhereHas('tags', function ($tq) use ($article) {
                      $tq->whereIn('tags.id', $article->tags->pluck('id'));
                  });
            })
            ->with(['author', 'category'])
            ->latest('published_at')
            ->take(4)
            ->get();

        $latestArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->with(['author', 'category'])
            ->latest('published_at')
            ->take(5)
            ->get();

        $previousArticle = Article::published()
            ->where('published_at', '<', $article->published_at)
            ->orderBy('published_at', 'desc')
            ->first();

        $nextArticle = Article::published()
            ->where('published_at', '>', $article->published_at)
            ->orderBy('published_at', 'asc')
            ->first();

        $heroImage = HeroSettings::getImageForPage('articles') ?? HeroSettings::getDefaultImage('articles');

        return view('public.articles.show', compact(
            'article',
            'relatedArticles',
            'latestArticles',
            'previousArticle',
            'nextArticle',
            'heroImage'
        ));
    }
}
