<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return response()->json(['message' => 'To online naquele modelo']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/empresas', [EmpresaController::class, 'index']);
    Route::post('/empresas', [EmpresaController::class, 'store']);
    Route::get('/empresas/{id}', [EmpresaController::class, 'show']);
    Route::put('/empresas/{id}', [EmpresaController::class, 'update']);
    Route::delete('/empresas/{id}', [EmpresaController::class, 'destroy']);
});

// teste