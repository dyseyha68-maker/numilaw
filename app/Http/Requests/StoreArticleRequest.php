<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        $authorized = $user && ($user->isAdmin() || $user->isFaculty());

        if (! $authorized) {
            \Illuminate\Support\Facades\Log::error('Article creation not authorized for user: '.($user ? $user->email : 'no user'));
        }

        return $authorized;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        \Illuminate\Support\Facades\Log::info('StoreArticleRequest validation rules being applied');
        \Illuminate\Support\Facades\Log::info('Request input: ', $this->all());

        return [
            'title_en' => 'required|string|max:255|unique:articles,title_en',
            'title_km' => 'required|string|max:255|unique:articles,title_km',
            'content_en' => 'required|string|min:10',
            'content_km' => 'required|string|min:10',
            'excerpt_en' => 'nullable|string|max:160',
            'excerpt_km' => 'nullable|string|max:160',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'category_id' => 'nullable|exists:categories,id',
            'published_at' => 'nullable|date',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'title_en.required' => 'The English title is required.',
            'title_km.required' => 'The Khmer title is required.',
            'content_en.required' => 'The English content is required.',
            'content_km.required' => 'The Khmer content is required.',
            'content_en.min' => 'The English content must be at least 10 characters.',
            'content_km.min' => 'The Khmer content must be at least 10 characters.',
            'featured_image.image' => 'The featured image must be a valid image file.',
            'featured_image.max' => 'The featured image may not be larger than 5MB.',
            'published_at.after_or_equal' => 'The publish date must be today or in the future.',
        ];
    }
}
