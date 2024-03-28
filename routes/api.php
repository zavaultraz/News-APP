<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Route9s
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::post('/updatePassword', [\App\Http\Controllers\API\AuthController::class, 'UpdatePassword']);
    Route::post('/updateProfile', [\App\Http\Controllers\API\AuthController::class, 'updateProfile']);
    Route::post('/storeProfile', [\App\Http\Controllers\API\AuthController::class, 'storeProfile']);
});
// routes for admin
Route::group(
    ['middleware' => ['auth:sanctum', 'admin']],
    function () {
        Route::post('/category/create', [\App\Http\Controllers\API\CategoryController::class, 'store']);
        Route::post('/category/update/{id}', [\App\Http\Controllers\API\CategoryController::class, 'update']);
        Route::delete('/category/destroy/{id}', [\App\Http\Controllers\API\CategoryController::class, 'destroy']);
        //route news
        Route::post('/news/create', [\App\Http\Controllers\API\NewsController::class, 'store']);
        Route::delete('/news/destroy/{id}', [\App\Http\Controllers\API\NewsController::class, 'destroy']);
        Route::post('/news/update/{id}', [\App\Http\Controllers\API\NewsController::class, 'update']);

    }
);

Route::get('/allUsers', [\App\Http\Controllers\API\AuthController::class, 'allUsers']);

Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);

// get data news

Route::get('/allNews', [\App\Http\Controllers\API\NewsController::class, 'index']);

//get data news by id

Route::get('/news/{id}', [\App\Http\Controllers\API\NewsController::class, 'show']);

//get category

Route::get('/allCategory', [\App\Http\Controllers\API\CategoryController::class, 'index']);


Route::get('/category/{id}', [\App\Http\Controllers\API\CategoryController::class, 'show']);

//get carousel
Route::get('/Carousel', [\App\Http\Controllers\API\FrontEndController::class, 'index']);
