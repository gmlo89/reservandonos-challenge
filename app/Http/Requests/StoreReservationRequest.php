<?php

namespace App\Http\Requests;

use App\Models\Place;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReservationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'required', 'max:255'],
            'lastName' => ['string', 'required', 'max:255'],
            'date' => ['required', 'after:today'],
            'time' => ['required'],
            'placeId' => ['required', Rule::exists(Place::class, 'id')],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => strSanatize($this->name ?? ''),
            'lastName' => strSanatize($this->lastName ?? ''),
        ]);
    }
}
