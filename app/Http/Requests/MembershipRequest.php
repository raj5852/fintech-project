<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipRequest extends FormRequest
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
            'is_lifetime'=>'required|integer',
            'total_month'=>'nullable|integer|min:1',
            'payment_method'=>'required|integer|min:1',
            'membership_id'=>['required','exists:memberships,id']
        ];
    }
}
