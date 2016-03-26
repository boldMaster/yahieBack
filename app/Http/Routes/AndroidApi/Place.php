<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 11/10/2015
 * Time: 1:56 PM
 */
Route::get('android/v1/place/filter', [
    'as' => 'filterResult', 'uses' => 'Place\PlaceController@getPlaceApi'
]);

Route::get('android/v1/place/getinfo', [
    'as' => 'getPlaceInformation', 'uses' => 'Place\PlaceController@getPlaceInfoApi'
]);