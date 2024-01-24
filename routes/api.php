<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ApartmentTypeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RmsClientController;
use App\Http\Controllers\AreaApartmentCombinationController;
use App\Http\Controllers\FormHandleController;
use App\Http\Controllers\RMSAreaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectHighlightController;
use App\Services\CacheService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



#flush cache

Route::get('clear-cache', function () {

    return (new CacheService())->flushCache();
});


Route::group(['prefix' => 'auth'], function ($router) {

    #Login
    Route::post('login', 'UserController@login');

    #Todo
    Route::get('services', 'ServiceController@index');
    Route::post('services', 'ServiceController@store')->middleware('auth:sanctum');
    Route::get('services/{route}', 'ServiceController@show');
    Route::delete('services/{route}', 'ServiceController@destroy')->middleware('auth:sanctum');

    #Project
    Route::post('/create-project', 'ProjectController@create_project')->middleware('auth:sanctum');
    Route::post('/get-search-engines', 'ProjectController@get_search_engines')->middleware('auth:sanctum');
    Route::post('/add-search-engine', 'ProjectController@add_search_engine')->middleware('auth:sanctum');

    #SEO
    Route::get('/website-keywords-list', 'SeoController@website_keywords_list')->middleware('auth:sanctum');
    Route::get('/website-summary-statistics', 'SeoController@website_summary_statistics')->middleware('auth:sanctum');
    Route::get('/keyword-statistics', 'SeoController@keyword_statistics')->middleware('auth:sanctum');


});

Route::fallback(function () {
    return response()->json(['message' => 'Invalid Route'], 400);
});
