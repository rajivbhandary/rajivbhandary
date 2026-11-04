<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class CreateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:255|unique:blogs',
            'excerpt' => 'required|min:2|max:255',
            'body' => 'required|min:2',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'tag_id.*' => 'exists:tags,id',
            'published' => 'after_or_equal:today',
            'seo_description' => 'max:255',
            'seo_keywords' => 'max:2000',
            'seo_og_title' => 'max:255',
            'seo_og_description' => 'max:255',
        ];
    }
}
