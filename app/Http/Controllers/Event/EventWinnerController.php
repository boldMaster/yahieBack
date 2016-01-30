<?php

namespace App\Http\Controllers\Event;

use App\Http\Model\Events\EventRead;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\EventParticipant\EventParticipantRead;

class EventWinnerController extends Controller
{
    public function getEventWinners($intEventId)
    {
        if (empty($intEventId)) $intEventId = 1;
        //Get all partipant from Event
        $arrParticipants = EventParticipantRead::getParticipantUser($intEventId);
        $eventData = EventRead::getEventDetail($intEventId);
        $intWinnerAmounts = $eventData[0]['total_winner'];
        $arrWinners =self::getRandomWinner($intWinnerAmounts, $arrParticipants);
        // Voucher will be created for the winner
        foreach ($arrWinners as $winner) {
            // Generate public key and private key
                //    function()
            // Create voucher
                // Set voucher expired date with the Event Set duration
                //    create voucher with all the detail
            // Insert Log into User Voucher tabler for quick references (voucher id, user_id,created_date

            // Reset Count for user Participant count to 0
        }
    }

    public static function getRandomWinners($intWinnerAmounts, $arrParticipants)
    {
        $arrRandomResults = array();
        $arrWinners = array();
        //Loop user to get random number * weight to alter result possibility
        foreach ($arrParticipants as $keys => $values) {
            $intResult = rand(1, 1000) * $values['weight'];
            $arrRandomResult[$values['user_id']] = $intResult;
        }
        //Sort Result
        arsort($arrRandomResults, SORT_NUMERIC);
        $intCount = 0;

        // Get only the limited winner amount set by the events
        foreach ($arrRandomResults as $keys => $values) {
            if ($intCount < $intWinnerAmounts) {
                $arrWinner[0] = $keys;
                $intCount++;
            }
        }
        return $arrWinners;
    }
}

