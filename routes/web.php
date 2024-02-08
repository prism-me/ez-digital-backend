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



// Route::get('/new-user-signup/{service}/{package}/{plan}', 'InvoiceController@invoice');
Route::get('/{service?}/{sub?}/{package?}/{plan?}', 'InvoiceController@invoice');
Route::get('/string', 'UserController@string');
Route::post('register', 'UserController@register');
Route::get('intent', 'UserController@get_intent')->name('intent');
Route::post('payment', 'UserController@payment')->name('payment');

Route::get('/password', 'UserController@password');

Route::get('/website-keywords-list', 'SeoController@website_keywords_list');
Route::get('/website-summary-statistics', 'SeoController@website_summary_statistics');
Route::get('/keyword-statistics', 'SeoController@keyword_statistics');




