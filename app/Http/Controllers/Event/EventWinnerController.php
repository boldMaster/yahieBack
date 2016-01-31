<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\UtilityController;
use App\Http\Model\Events\Event;
use App\Http\Model\Events\EventRead;
use App\Http\Model\UserParticipant\UserParticipantManage;
use App\Http\Model\UserVoucher\UserVoucherCreate;
use App\Http\Model\Vouchers\VoucherCreate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\EventParticipant\EventParticipantRead;

class EventWinnerController extends Controller
{
    public function getEventWinners($intEventId)
    {
        if (empty($intEventId)) $intEventId = 1;
        $intEventId = (int)$intEventId;
        //Get all partipant from Event
        $arrParticipants = EventParticipantRead::getParticipantUser($intEventId);
        $eventData = EventRead::getEventDetail($intEventId)[0];
        $intWinnerAmounts = $eventData['total_winner'];
        $arrWinners =self::getRandomWinners($intWinnerAmounts, $arrParticipants);
        // Get Voucher Public key
        $strPublicKey = Event::genPublicKey();
        // Voucher will be created for the winner
        foreach ($arrWinners as $winnerId) {
            $arrVoucherData = array();
            $arrUserVoucher = array();
            // Create voucher
            // Set voucher expired date with the Event Set duration
            $arrVoucherData['event_id'] = $intEventId;
            $arrVoucherData['user_id'] = $winnerId;
            $arrVoucherData['public_key'] = $strPublicKey;
            $arrVoucherData['expired_at'] = self::getExpiredDate($eventData['redeem_duration']);
            // Create voucher with all the detail
            $intVoucherId = VoucherCreate::createVouchers($arrVoucherData);
            // Insert Log into User Voucher table for quick references (voucher id, user_id,created_date
            $arrUserVoucher['user_id'] = $winnerId;
            $arrUserVoucher['voucher_id'] = $intVoucherId;
            UserVoucherCreate::insertUserVoucher($arrUserVoucher);
            // Reset Count for user Participant count to 0
            UserParticipantManage::resetCount($winnerId);
        }
    }

    public static function getRandomWinners($intWinnerAmounts, $arrParticipants)
    {
        $arrRandomResults = array();
        $arrWinners = array();
        //Loop user to get random number * weight to alter result possibility
        foreach ($arrParticipants as $keys => $values) {
            $intResult = rand(1, 1000) * $values['weight'];
            $arrRandomResults[$values['user_id']] = $intResult;
        }
        //Sort Result
        arsort($arrRandomResults, SORT_NUMERIC);
        $intCount = 0;

        // Get only the limited winner amount set by the events
        foreach ($arrRandomResults as $keys => $values) {
            if ($intCount < $intWinnerAmounts) {
                $arrWinners[0] = $keys;
                $intCount++;
            }
        }
        return $arrWinners;
    }

    public static function getExpiredDate($duration)
    {
        return UtilityController::getAdvanceDayDate($duration, false);
    }

    // Testing function
    public function getRandomKey (){
        UtilityController::getAdvanceDayDate(10);
    }
}

