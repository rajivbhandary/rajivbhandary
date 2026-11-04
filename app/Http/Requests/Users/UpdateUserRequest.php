<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => "required|string|email|max:255|unique:users,email,{$this->user->id}",
            'phone_number' => "required|unique:users,phone_number,{$this->user->id}",
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'facebook_id' => 'max:255',
            'instagram_id' => 'max:255',
            'twitter_id' => 'max:255',
            'linked_in_id' => 'max:255',
            'behance_id' => 'max:255',
            'youtube_id' => 'max:255',
        ];
    }
}
