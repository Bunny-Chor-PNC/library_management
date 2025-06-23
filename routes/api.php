<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\LibrarianController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\MemberController;
use App\Http\Controllers\Api\V1\BookController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function () {
    Route::apiResources([
        'librarians' => LibrarianController::class,
        'categories' => CategoryController::class,
        'members' =>  MemberController::class,
        'books' => BookController::class
    ]);
});
