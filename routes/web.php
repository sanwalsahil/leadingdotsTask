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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>['auth','can:onlyTeacher']],function(){
    Route::get('/teacherMain','BaseController@teacherDashboard');

    Route::get('/addMeeting','BaseController@addMeeting');
    Route::post('/createMeeting','BaseController@createMeeting');
});

Route::group(['middleware'=>'auth'],function(){
    Route::get('/parentMain','BaseController@parentDashboard');
});
