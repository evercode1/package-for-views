<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::any('api/alpha-widget', 'ApiController@alphaWidgetData');






    Route::get('/', function () {


        return view('welcome');
    });



    Route::resource('alpha-widget', 'AlphaWidgetController');



Route::auth();

Route::get('/home', 'HomeController@index');
Route::any('api/widget', 'ApiController@widgetData');
Route::any('api/widget-vue', 'ApiController@widgetVueData');
Route::resource('widget', 'WidgetController');
Route::any('api/widget', 'ApiController@widgetData');
Route::any('api/widget-vue', 'ApiController@widgetVueData');
Route::resource('widget', 'WidgetController');
Route::any('api/gadget', 'ApiController@gadgetData');
Route::any('api/gadget-vue', 'ApiController@gadgetVueData');
Route::resource('gadget', 'GadgetController');
Route::any('api/apple', 'ApiController@appleData');
Route::any('api/apple-vue', 'ApiController@appleVueData');
Route::resource('apple', 'AppleController');


// Api Routes

Route::any('api/grape', 'ApiController@grapeData');
Route::any('api/grape-vue', 'ApiController@grapeVueData');

// Grape Routes

Route::resource('grape', 'GrapeController');