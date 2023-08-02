<?php

namespace App\Http\Controllers\Api\V1\Validation;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\Api\V1\Validation\Conditions\ValidateIssuer;
use App\Http\Controllers\Api\V1\Validation\Conditions\ValidateRecipient;
use App\Http\Controllers\Api\V1\Validation\Conditions\ValidateSignature;


class ValidationHandler
{
    protected $nextErrorMessage;

    /**
     * Get the post-validation error message that apply to the request.
     *
     */
    public function getNextErrorMessage(): string
    {
        return $this->nextErrorMessage;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     */
    public function rules(): array
    {
        // Initialise all condition classes
        $validateIssuer = new ValidateIssuer();
        $validateRecipient = new ValidateRecipient();
        $validateSignature = new ValidateSignature();

        return array_merge(
            $validateIssuer->rules(), 
            $validateRecipient->rules(), 
            $validateSignature->rules()
        );
    }

    /**
     * Get the validation messages that apply to the request.
     *
     */
    public function messages(): array
    {
        // Initialise all condition classes
        $validateIssuer = new ValidateIssuer();
        $validateRecipient = new ValidateRecipient();
        $validateSignature = new ValidateSignature();

        return array_merge(
            $validateIssuer->messages(), 
            $validateRecipient->messages(), 
            $validateSignature->messages()
        );
    }

    /**
     * Applies post-validation checking to request data.
     * Returns true if all post-validation checking succeed.
     * Returns false if post-validation fails. Sets $nextErrorMessage to the first error encountered.
     *
     */
    public function postValidation($data): bool
    {
        // Initialise all condition classes
        $validateIssuer = new ValidateIssuer();
        $validateRecipient = new ValidateRecipient();
        $validateSignature = new ValidateSignature();

        if (!$validateIssuer->postValidation($data))
        {
            $this->nextErrorMessage = $validateIssuer->errorMessage();
            return false;
        }

        if (!$validateSignature->postValidation($data))
        {
            $this->nextErrorMessage = $validateSignature->errorMessage();
            return false;
        }

        return true;
    }
}
