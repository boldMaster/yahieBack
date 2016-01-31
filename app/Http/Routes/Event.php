<?php

Route::get('event/add','Event\EventController@getAddEvent');
Route::post('event/add','Event\EventController@postAddEvent');

Route::post('event/index','Event\EventController@eventIndex');

Route::get('event/result/{intEventId}','Event\EventWinnerController@getEventWinners');

Route::get('event/genKey','Event\EventWinnerController@getRandomKey');