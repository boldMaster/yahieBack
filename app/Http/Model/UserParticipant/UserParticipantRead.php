<?php

namespace App\Http\Model\UserParticipant;

class UserParticipantRead extends UserParticipant
{
    //
    public static function getCountParticipantEvent($user_id){
        return self::select('event_participant')->where('user_id', 1)->get();
    }

}
