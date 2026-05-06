<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'hotel_id' => ['required', 'integer', 'exists:hotels,id'],
            'name' => ['required', 'string', 'max:255'],
            'price_per_night' => ['required', 'numeric', 'min:0'],
            'max_occupancy' => ['required', 'integer', 'min:1'],
            'available_rooms' => ['required', 'integer', 'min:0'],
        ];
    }
}
