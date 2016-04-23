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


// Api Routes

Route::any('api/big-drum', 'ApiController@bigDrumData');
Route::any('api/big-drum-vue', 'ApiController@bigDrumVueData');

// BigDrum Routes

Route::resource('big-drum', 'BigDrumController');


// Api Routes

Route::any('api/black-hammer', 'ApiController@blackHammerData');
Route::any('api/black-hammer-vue', 'ApiController@blackHammerVueData');

// BlackHammer Routes

Route::resource('black-hammer', 'BlackHammerController');