<?php
/**
 * Created by PhpStorm.
 * User: Ming
 * Date: 9/20/2015
 * Time: 11:52 AM
 */

namespace App\Http\Controllers;

use App\Http\Model\HttpRequest\HttpRequest;
use Carbon\Carbon;

class UtilityController extends Controller
{
    private static $systemTimeZone = 'Asia/Kuala_Lumpur';

    public static function getTimeStamp(){
        return Carbon::now(self::$systemTimeZone)->format('d-m-Y');
    }

    public static function getDbTimeStamp($blnTime = true){
        if($blnTime)
            return Carbon::now(self::$systemTimeZone)->format('Y-m-d H:i:s');
        else
            return Carbon::now(self::$systemTimeZone)->format('Y-m-d').' 00:00:00';
    }

    public static function getApiKey() {
        return HttpRequest::getAccessKey();
    }

    public static function validateApiKey($accessKey){
        return HttpRequest::verifyAccessKey($accessKey);
    }

    public static function inputDateToSQLDate($strInputDate){
        // Remove the , in the date
        $strInputDate = str_replace(',', '', $strInputDate);
        $arrInputDate = explode(' ', $strInputDate);
        $day = (int)$arrInputDate[0];
        $month = $request['month'] = self::convertMonthNameToInteger($arrInputDate[1]);
        $year = (int)$arrInputDate[2];
        return date('Y-m-d',mktime(0,0,0,$month,$day,$year));
    }

    public static function inputDateToTimeStamp($strInputDate){
        // Remove the , in the date
        $strInputDate = str_replace(',', '', $strInputDate);
        $arrInputDate = explode(' ', $strInputDate);
        $day = (int)$arrInputDate[0];
        $month = $request['month'] = self::convertMonthNameToInteger($arrInputDate[1]);
        $year = (int)$arrInputDate[2];
        return mktime(0,0,0,$month,$day,$year);
    }

    private static function convertMonthNameToInteger($strMonth)
    {
        switch ($strMonth) {
            case "January":
                return 1;
            case "February":
                return 2;
            case "March":
                return 3;
            case "April":
                return 4;
            case "May":
                return 5;
            case "June":
                return 6;
            case "July":
                return 7;
            case "August":
                return 8;
            case "September":
                return 9;
            case "October":
                return 10;
            case "November":
                return 11;
            case "December":
                return 12;
            default:
                return 1;
        }
    }

    public static function getAdvanceDayDate($intDayInAdvance, $blnTime = true)
    {
        if ($blnTime) {
            return Carbon::now(self::$systemTimeZone)->addDay($intDayInAdvance)->format('Y-m-d H:i:s');
        } else {
            return Carbon::now(self::$systemTimeZone)->addDay($intDayInAdvance)->format('Y-m-d').' 00:00:00';
        }
    }
}