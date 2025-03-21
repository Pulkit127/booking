<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'display_name'    => 'required|string|max:50',
            'name'            => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'email'           => $this->isMethod('post') ? 'required|email|unique:users,email,' . $this->user : 'required|email', // Unique email
            'phone_no'        => $this->isMethod('post') ? 'required|digits:10|unique:users,phone_no,' . $this->user : 'required|digits:10',
            'dob'             => 'nullable|date|before:today',
            'gender'          => 'required|in:Male,Female,Other',
            'address'         => 'nullable|string|max:255',
            'nationality'     => 'nullable|string|max:50',
        ];
    }
}
