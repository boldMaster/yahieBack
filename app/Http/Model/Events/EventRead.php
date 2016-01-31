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
}
