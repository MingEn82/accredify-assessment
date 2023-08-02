<?php

namespace App\Http\Controllers\Api\V1\Validation\Conditions;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Api\V1\Validation\Interfaces\Validation;
use App\Http\Controllers\Api\V1\Validation\Interfaces\PostValidation;

class ValidateIssuer implements Validation, PostValidation
{
    public function errorMessage(): string
    {
        return 'invalid_issuer';
    }

    public function rules(): array
    {
        return [
            'data.issuer.name' => 'required|string',
            'data.issuer.identityProof.type' => 'required|string',
            'data.issuer.identityProof.key' => 'required|string',
            'data.issuer.identityProof.location' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'data.issuer.name' => $this->errorMessage(),
            'data.issuer.identityProof.type' => $this->errorMessage(),
            'data.issuer.identityProof.key' => $this->errorMessage(),
            'data.issuer.identityProof.location' => $this->errorMessage(),
        ];
    }

    public function postValidation($data): bool
    {
        // Extracting key from request data
        // We insert the expected prefix (p=) and postfix (;) to the key
        // Data is assumed to be already validated
        $identityProof = $data['data']['issuer']['identityProof'];
        $location = $identityProof['location'];
        $key = "p=".$identityProof['key'].";";

        // Retrieve DNS TXT record
        $dnsLookupUrl = "https://dns.google/resolve?name={$location}&type=TXT";
        $response = Http::get($dnsLookupUrl);
        $dnsRecords = $response->json();

        // Retrieve data from DNS TXT record
        $retrievedAnswer = $dnsRecords['Answer'] ?? null;
        $firstRetrievedAnswer = $retrievedAnswer[0] ?? null;
        $retrievedData = $firstRetrievedAnswer['data'] ?? null;

        // Check if key is inside retrieved data
        return str_contains($retrievedData, $key);
    }
}