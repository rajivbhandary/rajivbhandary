<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
            'title' => "required|min:2|max:255|unique:blogs,title,{$this->blog->id}",
            'excerpt' => 'required|min:2|max:255',
            'body' => 'required|min:2',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'tag_id.*' => 'exists:tags,id',
            'published' => 'after_or_equal:today',
            'seo_description' => 'max:255',
            'seo_keywords' => 'max:2000',
            'seo_og_title' => 'max:255',
            'seo_og_description' => 'max:255',
        ];
    }
}
