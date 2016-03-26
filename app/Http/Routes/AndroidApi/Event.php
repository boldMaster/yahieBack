<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 1/2/2016
 * Time: 2:28 PM
 */
Route::get('android/v1/event/participant','EventParticipant\EventParticipantController@getEventParticipant');
Route::get('android/v1/event/getNextEvent','Event\EventController@getNextEvent');
Route::get('android/v1/event/getEvent','Event\EventController@getEvent');


