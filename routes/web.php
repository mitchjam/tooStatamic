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
    return view('wordpress.create');
});

Route::post('convert/wordpress', 'WordpressConversionController@store')->name('convert.wordpress');

Route::post('contact', 'InquiryController@store')->name('inquire');
