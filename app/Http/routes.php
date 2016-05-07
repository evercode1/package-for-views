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


    Route::get('/', function () {


        return view('welcome');
    });



Route::auth();

Route::get('/home', 'HomeController@index');


// Api Routes

Route::any('api/widget', 'ApiController@widgetData');
Route::any('api/widget-vue', 'ApiController@widgetVueData');

// Widget Routes

Route::resource('widget', 'WidgetController');
// Api Routes

Route::any('api/auth-widget', 'ApiController@authWidgetData');
Route::any('api/auth-widget-vue', 'ApiController@authWidgetVueData');

// AuthWidget Routes

Route::resource('auth-widget', 'AuthWidgetController');