<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/faculties', 'BackEnd\FacultyController@listApi');
Route::get('/faculties/{id}', 'BackEnd\FacultyController@findApi');
Route::post('/faculties', 'BackEnd\FacultyController@createApi');
Route::match( ['put', 'patch'], '/faculties/{id}/edit', 'BackEnd\FacultyController@editApi');
Route::delete('/faculties/{id}', 'BackEnd\FacultyController@deleteApi');
