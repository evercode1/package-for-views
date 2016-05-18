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

Route::resource('test', 'TestController@index');


// Api Routes

Route::any('api/widget', 'ApiController@widgetData');
Route::any('api/widget-vue', 'ApiController@widgetVueData');

// Widget Routes

Route::resource('widget', 'WidgetController');
// Api Routes

Route::any('api/gadget', 'ApiController@gadgetData');
Route::any('api/gadget-vue', 'ApiController@gadgetVueData');

// Gadget Routes

Route::resource('gadget', 'GadgetController');// Api Routes

Route::any('api/blue', 'ApiController@blueData');
Route::any('api/blue-vue', 'ApiController@blueVueData');

// Api Routes

Route::any('api/blue', 'ApiController@blueData');
Route::any('api/blue-vue', 'ApiController@blueVueData');

// Blue Routes with slug

Route::get('blue/create', ['as' => 'blue.create', 'uses' => 'BlueController@create']);

Route::get('blue/{id}-{slug?}', ['as' => 'blue.show', 'uses' => 'BlueController@show']);

Route::resource('blue', 'BlueController', ['except' => ['show', 'create']]);// Api Routes

Route::any('api/little-red', 'ApiController@littleRedData');
Route::any('api/little-red-vue', 'ApiController@littleRedVueData');

// LittleRed Routes with slug

Route::get('little-red/create', ['as' => 'little-red.create', 'uses' => 'LittleRedController@create']);

Route::get('little-red/{id}-{slug?}', ['as' => 'little-red.show', 'uses' => 'LittleRedController@show']);

Route::resource('little-red', 'LittleRedController', ['except' => ['show', 'create']]);