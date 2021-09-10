<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarModelController;
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

Route::get('/brands', [BrandController::class, 'getPaginatedBrands']);
Route::post('/create-brand', [BrandController::class, 'createBrand']);
Route::post('/update-brand/{id}', [BrandController::class, 'updateBrand']);
Route::post('/search-brand', [BrandController::class, 'searchBrand']);
Route::post('/delete-brand/{brand}', [BrandController::class, 'sendConfirmationToDeleteBrand'])->middleware('admin');
// Verify deleting of the brand via email
Route::get('/email/confirm-brand-deleting/{id}/{token}', [BrandController::class, 'deleteBrandConfirmed']);


Route::get('/{brand}/models', [CarModelController::class, 'getBrandModels']);
Route::post('/{brand}/create-model', [CarModelController::class, 'createBrandModel']);
Route::post('/{brand}/update-model/{id}', [CarModelController::class, 'updateBrandModel']);
