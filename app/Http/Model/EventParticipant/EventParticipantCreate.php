<?php

namespace App\Http\Model\EventParticipant;

class EventParticipantCreate extends EventParticipant
{
    public static function participateEvent($request){
        $arrInsert = array();
        $arrInsert['user_id'] = $request['user_id'];
        $arrInsert['event_id'] = $request['event_id'];
        $arrInsert['weight'] = $request['weight'];
        return self::create($arrInsert);
    }
}
