<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 9/20/2015
 * Time: 11:52 AM
 */

namespace App\Http\Controllers;

use App\Http\Model\HttpRequest\HttpRequest;

class UtilityController extends Controller
{
    public static function getTimeStamp(){

    }

    public static function getApiKey() {
        return HttpRequest::getAccessKey();
    }

    public static function validateApiKey($accessKey){
        return HttpRequest::verifyAccessKey($accessKey);
    }
}