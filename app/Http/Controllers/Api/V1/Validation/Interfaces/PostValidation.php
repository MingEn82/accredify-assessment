<?php

namespace App\Http\Controllers\Api\V1\Validation\Interfaces;

interface PostValidation 
{
    public function postValidation($data): bool;
}