<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrganisasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('list-organisasi', [OrganisasiController::class, 'index']);
Route::get('my-organisasi', [OrganisasiController::class, 'myOrganisasi'])->middleware('auth:api');
Route::post('daftar-organisasi', [OrganisasiController::class, 'daftar'])->middleware('auth:api');
Route::post('mundur-organisasi', [OrganisasiController::class, 'undur'])->middleware('auth:api');
