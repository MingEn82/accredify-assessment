<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;


class ResultControllerTest extends TestCase
{
    public function testResultsIndex_expectHttpOkAndValidJsonStructure(): void
    {
        $response = $this->get('/api/v1/results');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => [
                'id',
                'user_id',
                'file_type',
                'verification_result',
                'created_at',
                'updated_at',
            ],
        ]);
    }

    public function testPostValidJson_expectHttpOkAndVerifiedStatus(): void
    {
        // Path to the json file
        $pathToFile = base_path('tests/jsonFiles/valid.json');

        // Create an UploadedFile instance for the file
        $file = new UploadedFile($pathToFile, 'valid.json', 'application/json', null, true);

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
                "result" => "verified",
            ],
        ]);
    }
}
