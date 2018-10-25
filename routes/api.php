<?php

use Illuminate\Http\Request;
$api = app('Dingo\Api\Routing\Router');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api->version('v1', function($api){
  
  $api->get('helper','App\Http\Controllers\LocationController@helper');
  $api->get('index','App\Http\Controllers\LocationController@index');
   $api->get('show/{id}','App\Http\Controllers\LocationController@show');
  $api->post('store','App\Http\Controllers\LocationController@store');
  $api->post('search','App\Http\Controllers\LocationController@search');
  
  // Notification
  $api->post('notification/filter','App\Http\Controllers\NotificationController@filter');
  $api->resource('notification','App\Http\Controllers\NotificationController');
});
