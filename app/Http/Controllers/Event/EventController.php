<?php

namespace App\Http\Controllers\Event;

use App\Events\Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\HttpRequest\HttpRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilityController;
use App\Http\Model\Events\EventCreate;
use App\Http\Model\Events\EventRead;
use App\Http\Requests\AddEvent;

class EventController extends Controller
{
    // Held the current using API version for this Controller
    private static $API_VERSION = "1.0";

    public function getAddEvent(){
        return view('events.add_event',compact('arrCategoryGroup','arrCategory','arrCountry','arrState','arrLocation'));
    }

    public function postAddEvent(AddEvent $request)
    {
        $request['start_date'] = UtilityController::inputDateToSQLDate($request->get('start_date'));
        $request['end_date'] = UtilityController::inputDateToSQLDate($request->get('end_date'));
        EventCreate::create($request->all());
        return redirect('/event/index');
    }

    public function getEditEvent(){

    }

    public function postEditEvent(){

    }

    public function eventIndex(){

    }

    public function getEventWinner(){

    }

    public function getEvent(Request $request){
        $errors = "";
        $status_code = 200;
        $status = "";
        $result = "";

        $public_access_key = $request->query('api_key');
        // Get android callback
        $android_callback = $request->query('caller');
        // If the Api Key is valid
        if (UtilityController::validateApiKey($public_access_key)) {
            $result = EventRead::getEvent();
            if(empty($result)){
                $result = "";
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

    public function getNextEvent(Request $request){
        $errors = "";
        $status_code = 200;
        $status = true;
        $result = "";

        $public_access_key = $request->query('api_key');
        // Get android callback
        $android_callback = $request->query('caller');
        // If the Api Key is valid
        if (UtilityController::validateApiKey($public_access_key)) {
            $result = EventRead::getNextEvent();
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
}
