<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ResultControllerSignatureTest extends TestCase
{
    public function testPostInvalidJsonWithInvalidSignatureId_expectHttpOkAndInvalidSignatureStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/invalid_signature_id.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'invalid_signature_id.json', 'application/json', null, true);

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
                "result" => "invalid_signature",
            ],
        ]);
    }

    public function testPostInvalidJsonWithInvalidSignatureIssuedDate_expectHttpOkAndInvalidSignatureStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/invalid_signature_issued_date.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'invalid_signature_issued_date.json', 'application/json', null, true);

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
                "result" => "invalid_signature",
            ],
        ]);
    }

    public function testPostInvalidJsonWithInvalidIssuerIdentityProofType_expectHttpOkAndInvalidSignatureStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/invalid_signature_issuer_identityProof_type.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'invalid_signature_issuer_identityProof_type.json', 'application/json', null, true);

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
                "result" => "invalid_signature",
            ],
        ]);
    }

    public function testPostInvalidJsonWithInvalidIssuerName_expectHttpOkAndInvalidSignatureStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/invalid_signature_issuer_name.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'invalid_signature_issuer_name.json', 'application/json', null, true);

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
                "issuer" => "Not_Accredify",
                "result" => "invalid_signature",
            ],
        ]);
    }

    public function testPostInvalidJsonWithInvalidRecipientEmail_expectHttpOkAndInvalidSignatureStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/invalid_signature_recipient_email.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'invalid_signature_recipient_email.json', 'application/json', null, true);

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
                "result" => "invalid_signature",
            ],
        ]);
    }

    public function testPostInvalidJsonWithInvalidRecipientName_expectHttpOkAndInvalidSignatureStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/invalid_signature_recipient_name.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'invalid_signature_recipient_name.json', 'application/json', null, true);

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
                "result" => "invalid_signature",
            ],
        ]);
    }
}
