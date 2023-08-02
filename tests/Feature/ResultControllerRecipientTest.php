<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ResultControllerRecipientTest extends TestCase
{
    public function testPostInvalidJsonWithMissingRecipientName_expectHttpOkAndInvalidRecipientStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/missing_recipient_name.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'missing_recipient_name.json', 'application/json', null, true);

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
                "result" => "invalid_recipient",
            ],
        ]);
    }

    public function testPostInvalidJsonWithMissingRecipientEmail_expectHttpOkAndInvalidRecipientStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/missing_recipient_email.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'missing_recipient_email.json', 'application/json', null, true);

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
                "result" => "invalid_recipient",
            ],
        ]);
    }

    public function testPostInvalidJsonWithMissingRecipient_expectHttpOkAndInvalidRecipientStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/missing_recipient.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'missing_recipient.json', 'application/json', null, true);

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
                "result" => "invalid_recipient",
            ],
        ]);
    }
}
