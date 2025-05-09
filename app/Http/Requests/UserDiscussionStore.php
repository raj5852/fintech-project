<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDiscussionStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'discussion_id'=>['required','exists:discussions,id']
        ];
    }
}
