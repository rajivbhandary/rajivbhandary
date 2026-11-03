<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'seo_description' => 'max:255',
            'seo_keywords' => 'max:2000',
            'seo_og_title' => 'max:255',
            'seo_og_description' => 'max:255',
        ];
    }
}
