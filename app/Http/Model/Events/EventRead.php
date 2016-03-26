<?php

namespace App\Http\Model\Events;

use App\Http\Controllers\UtilityController;
class EventRead extends Event
{
    //
    public static function validateEvent($event_id){
        $currentDate = UtilityController::getDbTimeStamp();
        return self::where('event_id' ,'=', $event_id)
                ->where('end_date','>', $currentDate)
                ->where('start_date','<', $currentDate)
                ->count();
    }

    public static function getEventDetail($intEventId){
        return self::where('event_id' ,'=', $intEventId)->get();
    }

    public static function getCurrentEvent(){
        $strCurrentDate = UtilityController::getDbTimeStamp(true);
        return self::where('start_date','<=', $strCurrentDate)
                     ->where('end_date', '>=' , $strCurrentDate)->first();
    }

    public static function getCurrentEventEndDate(){
        $strCurrentDate = UtilityController::getDbTimeStamp(true);
        return self::select('end_date')
            ->where('start_date','<=', $strCurrentDate)
            ->where('end_date', '>=' , $strCurrentDate)->first();
    }

    public static function getNextComingEvent(){
        $strCurrentEndDate = self::getCurrentEventEndDate()['end_date'];
        if (empty($strCurrentEndDate)) {
            $strCurrentDate = UtilityController::getDbTimeStamp(true);
            return self::where('start_date', '>=', $strCurrentDate)->orderBy('start_date', 'asc')->first();
        } else {
            return self::where('start_date', '>=', $strCurrentEndDate)->orderBy('start_date', 'asc')->first();
        }
    }
}
