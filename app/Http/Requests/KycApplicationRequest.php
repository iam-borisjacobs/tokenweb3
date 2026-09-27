<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class KycApplicationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $userId = Auth::id();

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('kycs', 'email')->ignore($userId, 'user_id'),
            ],
            'phone_number' => 'required|string|max:50',
            'dob' => 'required|string|max:50',
            'social_media' => 'nullable|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'document_type' => 'required|string|max:100',
            'frontimg' => 'required|file|mimes:jpeg,png,jpg,webp,pdf,heic,heif|max:25600',
            'backimg' => 'required|file|mimes:jpeg,png,jpg,webp,pdf,heic,heif|max:25600',
        ];
    }

    /**
     * Custom message for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'frontimg.required' => 'Please upload the front side of your identification document.',
            'frontimg.uploaded' => 'The front document could not be uploaded. Please ensure the file is valid and under 25MB.',
            'frontimg.mimes' => 'The front document must be an image (JPEG, PNG, WEBP) or PDF.',
            'frontimg.max' => 'The front document must not exceed 25MB.',
            'backimg.required' => 'Please upload the back side of your identification document.',
            'backimg.uploaded' => 'The back document could not be uploaded. Please ensure the file is valid and under 25MB.',
            'backimg.mimes' => 'The back document must be an image (JPEG, PNG, WEBP) or PDF.',
            'backimg.max' => 'The back document must not exceed 25MB.',
            'email.unique' => 'This email address is already associated with another KYC submission.',
        ];
    }
}
