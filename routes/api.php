<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/projects/featured','ApiController@getFeaturedProjects');
Route::get('/projects','ApiController@getProjects');
Route::get('/project/{id}','ApiController@ShowProject');
Route::get('/testimonials','ApiController@getTestimonials');
Route::get('/newsandevents','ApiController@getNewsAndEvents');
Route::get('/newsandevent/{id}','ApiController@getSingleNewsEvent');
Route::post('/request_callback','ApiController@postRequestCallBack');
Route::get('/videos','ApiController@getVideos');
Route::get('/photos','ApiController@getPhotos');
Route::get('/photo/{id}','ApiController@getSinglePhoto');
Route::post('/send_testimonial','ApiController@SaveTestimonial');
Route::get('/filter-masters','ApiController@getFilterMasters');

Route::post('sendmail','ApiController@sendMail');