<?php

namespace App\Http\Controllers\Api\V1\Validation\Conditions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\V1\Validation\Interfaces\Validation;
use App\Http\Controllers\Api\V1\Validation\Interfaces\PostValidation;

use Illuminate\Support\Facades\Log;

class ValidateSignature implements Validation, PostValidation
{
    public function errorMessage(): string
    {
        return 'invalid_signature';
    }

    public function rules(): array
    {
        return [
            'signature.targetHash' => 'required|string',
            'data.id' => 'required|string',
            'data.name' => 'required|string',
            'data.issued' => 'required|date_format:Y-m-d\TH:i:sP',
        ];
    }

    public function messages(): array
    {
        return [
            'signature.targetHash' => $this->errorMessage(),
            'data.id' => $this->errorMessage(),
            'data.name' => $this->errorMessage(),
            'data.issued' => $this->errorMessage(),
        ];
    }

    public function postValidation($data): bool
    {
        // retrieves all required information to calculate the hash
        // Creates an array with the key value pairs
        $properties = [
            "id" => $data['data']['id'], // id
            "name" => $data['data']['name'], // name
            "recipient.name" => $data['data']['recipient']['name'], // recipient name
            "recipient.email" => $data['data']['recipient']['email'], // recipient email
            "issuer.name" => $data['data']['issuer']['name'], // issuer name
            "issuer.identityProof.type" => $data['data']['issuer']['identityProof']['type'], // issuer identify proof type
            "issuer.identityProof.key" => $data['data']['issuer']['identityProof']['key'], // issuer identify proof key
            "issuer.identityProof.location" => $data['data']['issuer']['identityProof']['location'], // issuer identify proof location
            "issued" => $data['data']['issued'], // date issued
        ];

        // Encodes key value pair to format {key:value}
        // Calculates hash using SHA256
        $hashes = collect($properties)
            ->map(function (string $value, string $key) {
                $postbody = array();
                $postbody[$key] = $value;
                $jpb = json_encode($postbody);
                return hash('SHA256', $jpb);
            })
            ->sort()
            ->values();

        // Encodes hashes array to json string
        $calculatedHash = hash('SHA256', json_encode($hashes));
        $submittedHash = $data['signature']['targetHash'];

        return $calculatedHash === $submittedHash;
    }
}