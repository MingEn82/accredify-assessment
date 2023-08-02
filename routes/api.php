<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// api/v1
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    /**
     * Retrieves verification records from database
     * Returns an array of records with each record having the following params 
     * * id                     : unique id of record
     * * user_id                : id of user
     * * file_type              : file type submitted by user (currently only supports JSON)
     * * verification_result    : result of verification (allowed values are "verified", "invalid_recipient", "invalid_issuer", or "invalid_signature")
     * * created_at             : timestamp of when record was inserted for analysis purposes
     * * updated_at             : timestamp of when record was last updated for analysis purposes
    */
    Route::apiResource('results', ResultController::class);

    /**
     * API endpoint for users to submit their file (currently only supports JSON)
     * for validation
     * Returns a JSON object with the following params
     * {
     *   "data": {
     *      "issuer": [issuer name],
     *      "result": [verification status]
     *   }
     * }
     * Issuer name will be "null" if field is missing in submitted file
     * Verification Status allowed values are "verified", "invalid_recipient", "invalid_issuer", or "invalid_signature"
     */
    Route::post('validate', 'ResultController@validateForm');
});