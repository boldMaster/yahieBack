<?php

namespace App\Http\Model\UserParticipant;

class UserParticipantManage extends UserParticipant
{
    //
    public static function logUserParticipant($intUserId)
    {
        $blnFound = (self::where('user_id', '=', $intUserId)->count() > 0 ? true : false);
        if ($blnFound)
            self::updateUserParticipant($intUserId);
        else
            self::insertUserParticipant($intUserId);

    }

    // Insert new user that contribute in the Event Module
    private static function insertUserParticipant($intUserId)
    {
        $inputData = array();
        $inputData['user_id'] = $intUserId;
        $inputData['event_participant'] = 1;
        self::create($inputData);
    }

    // Increase the count of user participate in events
    private static function updateUserParticipant($intUserId)
    {
        self::where('user_id', '=', $intUserId)
            ->increment('event_participant', 1);
    }

    public static function resetCount($intUserId)
    {
        $row = self::find($intUserId);
        $row->event_participant = 0;
        $row->save();
    }
}
