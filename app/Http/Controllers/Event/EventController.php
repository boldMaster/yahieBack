<?php

namespace App\Http\Controllers\Event;

use App\Events\Event;
use App\Http\Model\UserParticipant\UserParticipant;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UtilityController;
use App\Http\Model\Events\Event as EventModel;
use App\Http\Model\Events\EventCreate;
use App\Http\Requests\AddEvent;

class EventController extends Controller
{
    //
    public function getAddEvent(){
        return view('events.add_event',compact('arrCategoryGroup','arrCategory','arrCountry','arrState','arrLocation'));
    }

    public function postAddEvent(AddEvent $request){
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

    public function genKeyword(){
        EventModel::genSecretKey();
    }
}
