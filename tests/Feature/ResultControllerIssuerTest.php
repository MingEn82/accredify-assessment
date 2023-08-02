<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ResultControllerIssuerTest extends TestCase
{
    public function testPostInvalidJsonWithMissingIssuerName_expectHttpOkAndInvalidIssuerStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/missing_issuer_name.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'missing_issuer_name.json', 'application/json', null, true);

        // Make the POST request
        $response = $this->postJson('/api/v1/validate', ['file' => $file]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "issuer",
                "result",
            ],
        ]);
        $response->assertJson([
            "data" => [
                "issuer" => "null",
                "result" => "invalid_issuer",
            ],
        ]);
    }

    public function testPostInvalidJsonWithMissingIssuerIdentityProof_expectHttpOkAndInvalidIssuerStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/missing_issuer_identityProof.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'missing_issuer_identityProof.json', 'application/json', null, true);

        // Make the POST request
        $response = $this->postJson('/api/v1/validate', ['file' => $file]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "issuer",
                "result",
            ],
        ]);
        $response->assertJson([
            "data" => [
                "issuer" => "Accredify",
                "result" => "invalid_issuer",
            ],
        ]);
    }

    public function testPostInvalidJsonWithMissingIssuer_expectHttpOkAndInvalidIssuerStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/missing_issuer.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'missing_issuer.json', 'application/json', null, true);

        // Make the POST request
        $response = $this->postJson('/api/v1/validate', ['file' => $file]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "issuer",
                "result",
            ],
        ]);
        $response->assertJson([
            "data" => [
                "issuer" => "null",
                "result" => "invalid_issuer",
            ],
        ]);
    }

    public function testPostInvalidJsonWithInvalidIssuerIdentityProofKey_expectHttpOkAndInvalidIssuerStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/invalid_issuer_identityProof_key.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'invalid_issuer_identityProof_key.json', 'application/json', null, true);

        // Make the POST request
        $response = $this->postJson('/api/v1/validate', ['file' => $file]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "issuer",
                "result",
            ],
        ]);
        $response->assertJson([
            "data" => [
                "issuer" => "Accredify",
                "result" => "invalid_issuer",
            ],
        ]);
    }

    public function testPostInvalidJsonWithInvalidIssuerDns_expectHttpOkAndInvalidIssuerStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/invalid_issuer_dns.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'invalid_issuer_dns.json', 'application/json', null, true);

        // Make the POST request
        $response = $this->postJson('/api/v1/validate', ['file' => $file]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "data" => [
                "issuer",
                "result",
            ],
        ]);
        $response->assertJson([
            "data" => [
                "issuer" => "Accredify",
                "result" => "invalid_issuer",
            ],
        ]);
    }
}
