<?php

namespace App\Http\Controllers\EventParticipant;

use App\Http\Model\EventParticipant\EventParticipant;
use App\Http\Model\EventParticipant\EventParticipantCreate;
use App\Http\Model\UserParticipant\UserParticipantManage;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilityController;
use App\Http\Model\UserParticipant\UserParticipantRead;



class EventParticipantController extends Controller
{
    //
    // Held the current using API version for this Controller
    private static $API_VERSION = "1.0";
    private static $bias = 1.02;
    private static $weight = 1;

    /**
     * API for event participant
     */
    public function getEventParticipant(Request $request)
    {
        $errors = "";
        $status_code = 200;
        $status = "";
        $result = "";
        $user_id = $request->get('user_id');
        $event_id = $request->get('event_id');
        $user_id = 1;
        $event_id = 1;

        $public_access_key = $request->query('api_key');
        // Get android callback
        $android_callback = $request->query('caller');
        // If the Api Key is valid
        if (UtilityController::validateApiKey($public_access_key)) {
            /* Future enhance with the weightage measurement
             * Temporary assign all to default value
             */
            $request['weight'] = self::$weight;
            // Validate Event
            $intValidateStatus = EventParticipant::validateParticipantEvent($user_id, $event_id, $result, $error);
            // Done all Validation for user and event
            if ($intValidateStatus == 1) {
                //Temporary Event and User
                $request['user_id'] = 1;
                $request['event_id'] = 1;
                // Input into Event Spool
                EventParticipantCreate::participateEvent($request);
                UserParticipantManage::logUserParticipant($user_id);
                $status = true;
            }
        } else {
            // Access Denied detected
            $errors = "Access Denied";
            $status_code = HttpRequest::$ACCESS_DENIED_CODE;
            $status = false;
        }

        $arrResponse = array(
            'api_ver' => self::$API_VERSION,
            'caller' => $android_callback,
            'error' => $errors,
            'status_code' => $status_code,
            'status' => $status,
            'result' => $result
        );
        return $arrResponse;
    }

    // Function to identify the weightage of the
    private static function getUserEventWeight($user_id){
        $arrResult = UserParticipantRead::getCountParticipantEvent($user_id);
        // Apply Logic on the weight
        return $intCount;
    }


}
