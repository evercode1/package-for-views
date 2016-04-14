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

Route::any('api/widget', 'ApiController@widgetData');
Route::any('api/alpha-widget', 'ApiController@alphaWidgetData');
Route::any('api/widget-vue', 'ApiController@widgetVueData');





    Route::get('/', function () {


        return view('welcome');
    });

    Route::resource('widget', 'WidgetController');

    Route::resource('alpha-widget', 'AlphaWidgetController');



Route::auth();

Route::get('/home', 'HomeController@index');
