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
// Route::get('/test', 'Test1Controller@index'); 
//Route::get('/abc', 'AbcController@FunctionName'); 
Route::get('/login', ['as'=>'login','uses'=>'Auth\LoginController@getLogin']); 
Route::post('/login', ['as'=>'login','uses'=>'Auth\LoginController@postLogin']); 
Route::get('/logout', ['as'=>'logout','uses'=>'Auth\LoginController@getlogout']); 

Route::get('/home', function () {
    return view('client.trangchu');
});
Route::get('/store', function () {
    return view('client.sanpham');
});

Route::middleware(['auth'])->group(function(){
   

    Route::get('/test', 'Test1Controller@index')->name('route_BackEnd_Uesr_Index');
    Route::match(['get','post'],'test1/add','Test1Controller@add')->name('route_BackEnd_Uesr_Add');

    Route::get('/danhmuc', 'DmController@index')->name('route_BackEnd_Danhmuc_Index');
    Route::match(['get','post'],'danhmuc/add','DmController@add')->name('route_BackEnd_Danhmuc_Add');

    Route::get('/sanpham', 'spController@index')->name('route_BackEnd_Sanpham_Index');
    Route::match(['get','post'],'sanpham/add','spController@add')->name('route_BackEnd_Sanpham_Add');
});