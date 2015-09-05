<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 8/31/2015
 * Time: 12:06 PM
 */

Route::post('mail/resetPassword','Mail/MailController@resetPassword');
Route::post('mail/send','Mail/MailController@send');
// Test sending
Route::get('mail/send','Mail/MailController@send');