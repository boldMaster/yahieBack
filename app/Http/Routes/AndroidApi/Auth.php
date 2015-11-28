<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 11/10/2015
 * Time: 1:56 PM
 */

Route::get('android/v1/auth/forgot', [
    'as' => 'forgot', 'uses' => 'Auth\PasswordController@postEmailApi'
]);