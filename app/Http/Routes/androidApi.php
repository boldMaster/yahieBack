<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 9/27/2015
 * Time: 12:33 AM
 */

Route::get('android/v1/auth/forgot', [
    'as' => 'forgot', 'uses' => 'Auth\PasswordController@postEmailApi'
]);