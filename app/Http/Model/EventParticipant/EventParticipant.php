<?php

namespace App\Http\Model\EventParticipant;

use Illuminate\Database\Eloquent\Model;
use App\Http\Model\Events\EventRead;
use App\Http\Controllers\UtilityController;

class EventParticipant extends Model
{
    //
    protected $table = 'event_participant';
    public $timestamps = true;
    private static $SUCCESS_INPUT = 1;
    private static $ERROR_DUPLICATED = 2;
    private static $OTHER_ERRORS = 3;
    protected $fillable = array('event_id',
        'user_id',
        'weight',
        'updated_at',
        'created_at');

    /**
     * @param $user_id
     * @param $event_id
     * @param $result
     * @param $errors
     */
    public static function validateParticipantEvent($user_id, $event_id, &$result, &$errors){
        $intEventCount = EventRead::validateEvent($event_id);
        if ($intEventCount > 0) {
            $intValidate = self::validateUser($user_id, $event_id);
            // Validate is user participant before
            switch ($intValidate) {
                // Validated
                case 1 :
                    $result = "Success";
                    return 1;
                // Duplicated
                case 2 :
                    $result = "Duplicate";
                    $errors = "Duplicate";
                    return 2;
                // Errors
                case 3 :
                    $result = "Error Occurs";
                    $errors = "Error Occurs";
                    return 3;
            }
        } // No such Event Found
        else {
            $result = "Invalid Event";
            $errors = "Invalid Event";
        }
    }

    private static function validateUser($user_id, $event_id){
        $intCountParticipant = EventParticipantRead::validateUser($user_id, $event_id);
        // Do not found user from this event.
        if($intCountParticipant == 0 )
            return 1;
        // Found user from this event
        else if($intCountParticipant > 0)
            return 2;
        // Else do not return valid count, error occurs
        else
            return 3;
    }
}
