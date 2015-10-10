<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 9/5/2015
 * Time: 11:37 PM
 */

Route::post('user/resetPassword','Mail\MailController@resetPassword');

Route::get('android/v1/user/signin', [
    'as' => 'signin', 'uses' => 'User\UserController@signin'
]);