<?php

namespace App\Http\Controllers\Api\V1\Validation\Conditions;

use App\Http\Controllers\Api\V1\Validation\Interfaces\Validation;

class ValidateRecipient implements Validation
{
    public function errorMessage(): string
    {
        return 'invalid_recipient';
    }

    public function rules(): array
    {
        return [
            'data.recipient.name' => 'required|string',
            'data.recipient.email' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'data.recipient.name' => $this->errorMessage(),
            'data.recipient.email' => $this->errorMessage(),
        ];
    }
}