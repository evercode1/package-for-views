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

Route::any('api/big-widget', 'ApiController@bigWidgetData');
Route::any('api/big-widget-vue', 'ApiController@bigWidgetVueData');

// BigWidget Routes

Route::resource('big-widget', 'BigWidgetController');
// Api Routes


// Api Routes

Route::any('api/orange', 'ApiController@orangeData');
Route::any('api/orange-vue', 'ApiController@orangeVueData');

// Orange Routes

Route::resource('orange', 'OrangeController');
// Api Routes

Route::any('api/orange', 'ApiController@orangeData');
Route::any('api/orange-vue', 'ApiController@orangeVueData');

// Orange Routes

Route::resource('orange', 'OrangeController');
// Api Routes

Route::any('api/big-orange', 'ApiController@bigOrangeData');
Route::any('api/big-orange-vue', 'ApiController@bigOrangeVueData');

// BigOrange Routes

Route::resource('big-orange', 'BigOrangeController');