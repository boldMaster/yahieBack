<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 11/10/2015
 * Time: 1:56 PM
 */
Route::get('android/v1/user/signin', [
    'as' => 'signin', 'uses' => 'User\UserController@signin'
]);