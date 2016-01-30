<?php

namespace App\Http\Model\UserParticipant;

class UserParticipantManage extends UserParticipant
{
    //
    public static function logUserParticipant($user_id){
        $blnFound = (self::where('user_id', '=' , $user_id)->count() > 0?true:false);
        if($blnFound)
            self::updateUserParticipant($user_id);
        else
            self::insertUserParticipant($user_id);

    }
    // Insert new user that contribute in the Event Module
    private static function insertUserParticipant($user_id){
        $inputData= array();
        $inputData['user_id'] = $user_id;
        $inputData['event_participant'] = 1;
        self::create($inputData);
    }
    // Increase the count of user participate in events
    private static function updateUserParticipant($user_id){
        self::where('user_id','=',$user_id)
              ->increment('event_participant',1);
    }
}
