<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'room_number'   => $this->isMethod('post') ? 'required|string|unique:rooms,room_number,' . $this->room : 'nullable|string', // Unique room number
            'room_type'     => 'required', // Must exist in room_types table
            'description'   => 'nullable|string',
            'price_per_night' => 'required|numeric|min:0', // Minimum price 0
            'capacity'      => 'required|numeric|min:1', // At least 1 guest
            'bed_type'      => 'required', // Optional
            'status'        => 'required|in:Available,Booked,Under Maintenance', // Valid statuses
            'images.*'      => $this->isMethod('post') ? 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120' : 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Images required for store, optional for update
        ];
    }
}
