<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class SearchAvailabilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city' => ['required', 'string', 'max:255'],
            'checkin_date' => ['required', 'date'],
            'checkout_date' => ['required', 'date', 'after:checkin_date'],
            'guests' => ['required', 'integer', 'min:1'],
        ];
    }
}
