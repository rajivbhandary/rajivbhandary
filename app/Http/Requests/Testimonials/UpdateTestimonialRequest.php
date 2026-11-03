<?php

namespace App\Http\Requests\Testimonials;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'city' => 'required|min:2|max:255',
            'testimonial' => 'required|min:2',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ];
    }
}
