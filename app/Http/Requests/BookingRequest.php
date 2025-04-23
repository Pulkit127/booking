<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'guest_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'required|string|max:15',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'number_of_guests' => 'required|integer|min:1|max:10',
            'payment_status' => 'required|in:Pending,Paid,Failed',
            'booking_status' => 'required|in:Pending,Confirmed,Checked-in,Checked-out,Cancelled',
            'notes' => 'nullable|string|max:1000',
        ];
    }
}
