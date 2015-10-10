<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 9/14/2015
 * Time: 10:43 PM
 */
Route::get('admin/place/','Place\PlaceController@index');
Route::post('admin/place/insert','Place\PlaceController@insertPlace');
Route::get('admin/place/insert','Place\PlaceController@addPlace');
Route::get('admin/place/{id}','Place\PlaceController@show');
Route::get('admin/place/index','Place\PlaceController@index');
