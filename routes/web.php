<?php

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

Route::prefix('api')->group(function (){
    Route::get('/categories','Backend\CategoryController@apiIndex');
    Route::post('/categories/attribute','Backend\CategoryController@apiIndexAttribute');
});

Route::prefix('admin')->group(function (){
    Route::get('/','Backend\MainController@mainPage');
    Route::resource('categories','Backend\CategoryController');
    Route::get('/categories/{id}/settings','Backend\CategoryController@indexSetting')->name('categories.indexSetting');
    Route::post('/categories/{id}/settings','Backend\CategoryController@saveSetting');
    Route::resource('attributes-group','Backend\AttributeGroupController');
    Route::resource('attributes-value','Backend\AttributeValueController');
    Route::resource('brands','Backend\BrandController');
    Route::resource('photos','Backend\PhotoController');
    Route::post('photos/upload','Backend\PhotoController@upload')->name('photos.upload');
    Route::resource('products','Backend\ProductController');

});
