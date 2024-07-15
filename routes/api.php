<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Метод поиска по крайнему сроку и статусу
Route::get('tasks/search', [TaskController::class, 'search']);

// CRUD Task'a
Route::apiResource('tasks', TaskController::class);

