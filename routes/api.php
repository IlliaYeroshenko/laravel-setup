<?php

use App\Http\Controllers\ExternalApiController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;

Route::apiResource('projects', ProjectController::class);

Route::apiResource('tasks', TaskController::class);

Route::apiResource(
    'tasks.comments',
    CommentController::class
)->shallow();

Route::get(
    'external-tasks',
    [ExternalApiController::class, 'index']
);

Route::get(
    'external-tasks/{id}',
    [ExternalApiController::class, 'show']
);

Route::post(
    'external-tasks/export',
    [ExternalApiController::class, 'export']
);
