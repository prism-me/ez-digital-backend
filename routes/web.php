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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'InvoiceController@invoice');
Route::post('register', 'UserController@register');
Route::post('payment', 'UserController@payment')->name('payment');

