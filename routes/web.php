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
// Route::get('/test', 'usersController@index'); 
//Route::get('/abc', 'AbcController@FunctionName'); 
Route::get('/login', ['as'=>'login','uses'=>'Auth\LoginController@getLogin']); 
Route::post('/login', ['as'=>'login','uses'=>'Auth\LoginController@postLogin']); 
Route::get('/logout', ['as'=>'logout','uses'=>'Auth\LoginController@getlogout']); 
Route::get('/signup',['as'=>'signup','uses'=>'Auth\LoginController@getSignup']);
Route::post('/signup',['as'=>'signup','uses'=>'Auth\LoginController@postSignup']);
// Route::get('/ct', function () {
//     return view('client.ct_sp');
// });

Route::middleware(['auth'])->group(function(){
    // route client
    Route::get('/', 'HomeController@showsp');
    Route::get('san-pham/{id}', 'CtspController@detailSp')->name('route_Fe_Ctsp');
    Route::get('/store', 'HomeController@shopsp');
    Route::get('danh-muc/{id}', 'HomeController@product_dm')->name('route_Fe_dmsp');
    // Route::get('/check-out', 'CheckoutController@index');
    Route::get('/search', 'HomeController@search')->name('route_tim_kiem');
    Route::post('add-cart' ,'CartController@addCart')->name('add-cart');
        //endclient
    //route Admin 
    Route::get('/nguoidung', 'UsersController@index')->name('route_BackEnd_Uesr_Index');
    Route::match(['get','post'],'users/add','UsersController@add')->name('route_BackEnd_Uesr_Add');
    Route::get('nguoidung/detail/{id}', 'UsersController@detailNd')->name('route_BackEnd_Uesr_detail');
    Route::post('nguoidung/update/{id}', 'UsersController@updateNd')->name('route_BackEnd_Uesr_update');
    Route::get('/nguoidung/delete/{id}', 'UsersController@destroy')->name('route_BackEnd_Uesr_del');

    Route::get('/danhmuc', 'DmController@index')->name('route_BackEnd_Danhmuc_Index');
    Route::match(['get','post'],'danhmuc/add','DmController@add')->name('route_BackEnd_Danhmuc_Add');
    Route::get('/danhmuc/delete/{id}', 'DmController@destroy')->name('route_BackEnd_Danhmuc_del');
    Route::get('danhmuc/sanpham/{id}', 'DmController@product_dm')->name('route_BackEnd_Danhmuc_dmsp');
    Route::get('danhmuc/detail/{id}', 'DmController@detailDm')->name('route_BackEnd_Danhmuc_detail');
    Route::post('danhmuc/update/{id}', 'DmController@updateDm')->name('route_BackEnd_Danhmuc_update');

    Route::get('/banner', 'BannerContrller@index')->name('route_BackEnd_Banner_Index');
    Route::match(['get','post'],'banner/add','BannerContrller@add')->name('route_BackEnd_Banner_Add');
    Route::get('banner/detail/{id}', 'BannerContrller@detailBaner')->name('route_BackEnd_Banner_detail');
    Route::post('banner/update/{id}', 'BannerContrller@updatebanner')->name('route_BackEnd_Banner_update');
    Route::get('/banner/delete/{id}', 'BannerContrller@destroy')->name('route_BackEnd_Banner_del');

    Route::get('/sanpham', 'spController@index')->name('route_BackEnd_Sanpham_Index');
    Route::match(['get','post'],'sanpham/add','spController@add')->name('route_BackEnd_Sanpham_Add');
    Route::get('sanpham/detail/{id}', 'spController@detailSp')->name('route_BackEnd_Sanpham_detail');
    Route::post('sanpham/update/{id}', 'spController@updateSp')->name('route_BackEnd_Sanpham_update');
    Route::get('/sanpham/delete/{id}', 'spController@destroy')->name('route_BackEnd_Sanpham_del');
    
});
 
