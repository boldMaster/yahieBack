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

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

require 'Routes/Mail.php';
require 'Routes/User.php';
require 'Routes/Admin.php';
require 'Routes/Event.php';

require 'Routes/Ref.php';

// Mobile Http Request Routes
require 'Routes/androidApi.php';
/*
// Display all SQL executed in Eloquent
Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});
*/
