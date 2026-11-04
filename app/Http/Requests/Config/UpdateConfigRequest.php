<?php

namespace App\Http\Requests\Config;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigRequest extends FormRequest
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
            'default_seo_author' => 'required|min:2|max:255',
            'default_seo_description' => 'required|min:2|max:255',
            'default_seo_keywords' => 'required|min:2|max:2000',
            'default_seo_og_title' => 'required|min:2|max:255',
            'default_seo_og_description' => 'required|min:2|max:255',
            'contact_phone' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+()\-\s]{10,20}$/'],
            'contact_whatsapp' => ['nullable', 'string', 'max:20', 'regex:/^[0-9+()\-\s]{10,20}$/'],
            'contact_email' => ['nullable', 'email:rfc,filter', 'max:255'],
        ];
    }
}
