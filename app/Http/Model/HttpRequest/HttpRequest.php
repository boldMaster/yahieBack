<?php

namespace App\Http\Model\HttpRequest;

use Illuminate\Database\Eloquent\Model;

class HttpRequest extends Model
{
    protected static $strAccessKey = "abc123";
    private static $whiteListedIp = "203.233.152.161"; // honeyspear.com

    public static $ACCESS_DENIED_CODE = 403;
    public static $REQUEST_SUCCESS_CODE = 200;
    public static $VALIDATION_FAILED_CODE = 422;


    //
    /**
     * To Get the App Api Key
     * @return string
     */
    public function getAccessKey(){
        return self::$strAccessKey;
    }

    /**
     * Validate hashed Access Key
     * @param $hashedAccessKey
     * @return bool
     */
    public static function validateAccessKey($hashedAccessKey)
    {
        if(Hash::check(self::$strAccessKey,$hashedAccessKey))
            return true;
        else
            false;
    }

    public static function verifyAccessKey($inputKey) {
        if(self::$strAccessKey === $inputKey)
            return true;
        else
            return false;
    }

    /**
     *
     */
    public static function genAccessKey()
    {

    }
}
