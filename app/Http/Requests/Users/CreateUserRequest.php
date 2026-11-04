<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|unique:users',
            'role' => 'required',
            'facebook_id' => 'max:255',
            'instagram_id' => 'max:255',
            'twitter_id' => 'max:255',
            'linked_in_id' => 'max:255',
            'behance_id' => 'max:255',
            'youtube_id' => 'max:255',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }
}
