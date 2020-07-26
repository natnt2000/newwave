<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'BackEnd', 'prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('faculties', 'FacultyController')->except(['show']);
    Route::resource('subjects', 'SubjectController')->except(['show']);
    Route::resource('students', 'StudentController')->except(['show']);
});

Auth::routes();


