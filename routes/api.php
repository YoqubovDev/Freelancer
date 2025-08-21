<?php

/**
 * @OA\Get(
 *     path="/api/hello",
 *     summary="Hello World",
 *     tags={"Test"},
 *     @OA\Response(
 *         response=200,
 *         description="Successful response"
 *     )
 * )
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);
});
