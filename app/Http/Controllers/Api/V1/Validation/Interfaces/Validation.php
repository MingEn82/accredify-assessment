<?php

namespace App\Http\Controllers\Api\V1\Validation\Interfaces;

interface Validation 
{
    public function rules(): array;
    public function messages(): array;
}