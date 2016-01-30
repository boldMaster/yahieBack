<?php

namespace App\Http\Model\EventParticipant;


class EventParticipantRead extends EventParticipant
{
    //
    public static function validateUser($user_id,$event_id){
        return self::where('user_id','=',$user_id)
            ->where('event_id','=',$event_id)->count();
    }

    public static function getParticipantUser($event_id){
        return self::where('event_id','=',$event_id)->get();
    }
}
