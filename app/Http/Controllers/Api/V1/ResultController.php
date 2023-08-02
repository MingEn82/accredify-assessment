<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Result;
use App\Http\Controllers\Api\V1\Validation\ValidationHandler;
use App\Http\Controllers\Controller;


class ResultController extends Controller
{
    private function saveToDb(string $userId, string $fileType, string $verificationResult): void 
    {
        $newResult = new Result;
        $newResult->user_id = $userId;
        $newResult->file_type = $fileType;
        $newResult->verification_result = $verificationResult;
        $newResult->save();
    }

    private function generateResponseArray(string $issuer, string $result): array
    {
        return [
            "data" => [
                "issuer" => $issuer, 
                "result" => $result
            ]
        ];
    }

    public function validateForm(Request $request) 
    {
        $validationHandler = new ValidationHandler();

        // Frontend sends a file with name 'file'
        if ($request->hasFile('file'))
        {
            $path = $request->file('file')->store('temp');
            $content = Storage::get($path);
            $data = json_decode($content, true);
        }
        // Frontend sends a json payload in request
        else
        {
            $data = $request->all();
        }

        $userId = $data['data']['id'] ?? null;
        // null is in string in order to be parsed to json format for response
        $issuer = $data['data']['issuer']['name'] ?? "null";
        
        $validator = Validator::make(
            $data,
            $validationHandler->rules(),
            $validationHandler->messages()
        );
        $validated = $validator->validated();
        
        $result;
        if ($validator->fails()) 
        {
            $result = $validator->errors()->first();
        }
        else if (!$validationHandler->postValidation($data))
        {
            $result = $validationHandler->getNextErrorMessage();
        }
        else
        {
            $result = "verified";
        }

        $this->saveToDb($userId, "JSON", $result);
        return response()->json($this->generateResponseArray($issuer, $result), 200);
    }

    public function index() 
    {
        $users = Result::all();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = Result::findOrFail($id);
        return response()->json($user);
    }
}
