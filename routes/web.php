<?php

use App\Services\payment\PaymentService;
use App\Services\payment\PostPayPaymentService;
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



Route::get('/new-user-signup/{service}/{package}/{plan}', 'InvoiceController@invoice');
Route::get('/', 'InvoiceController@invoice');
Route::get('/string', 'UserController@string');
Route::post('register', 'UserController@register');
Route::post('payment', 'UserController@payment')->name('payment');

Route::get('/test', 'ProjectController@test');

Route::get('/website-keywords-list', 'SeoController@website_keywords_list');




