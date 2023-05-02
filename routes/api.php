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
Route::post('admin/register','App\Http\Controllers\adminController@store');
Route::post('company/register','App\Http\Controllers\adminController@registerCompany');
Route::post('user/login','App\Http\Controllers\adminController@login');
Route::post('profile/create','App\Http\Controllers\profileController@create');

Route::post('services/create','App\Http\Controllers\adminController@createServices');
Route::post('country/create','App\Http\Controllers\locationController@createCountry');
Route::post('state/create','App\Http\Controllers\locationController@createState');
Route::post('city/create','App\Http\Controllers\locationController@createCity');


Route::prefix('admin')->middleware(['auth:api','isAdmin'])->group(function(){
    Route::post('group/create','App\Http\Controllers\adminController@createGroup');
Route::post('posttype/create','App\Http\Controllers\adminController@createPostType');

});
