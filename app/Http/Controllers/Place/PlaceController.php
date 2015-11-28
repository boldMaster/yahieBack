<?php

namespace App\Http\Controllers\Place;

use App\Http\Model\Places\Places;
use App\Http\Model\Places\PlaceRead;
use App\Http\Model\Ref\RefCategoryGroupRead;
use App\Http\Model\Ref\RefCategoryRead;
use App\Http\Model\Ref\RefCountryRead;
use App\Http\Model\Ref\RefStateRead;
use App\Http\Model\Ref\RefLocationRead;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Http\Controllers\UtilityController;
use App\Http\Model\HttpRequest\HttpRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPlace;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    // Held the current using API version for this Controller
    private static $API_VERSION = "1.0";

    public function index()
    {
        $arrPlaces = PlaceRead::getAllPlacesByLatestUpdate();
        return view('places.index',compact('arrPlaces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     *
     */
    public function addPlace()
    {
        // Get Category Group
        $arrCategoryGroup = RefCategoryGroupRead::getCategoryGroupInArray();
        //Get Category
        $arrCategory = RefCategoryRead::getCategoryInArray();
        //Get Avaiable Country
        $arrCountry = RefCountryRead::getCountryInArray();
        //Get Avaiable State
        $arrState = RefStateRead::getStateInArray();
        //Get Avaiable Location
        $arrLocation = RefLocationRead::getLocationInArray();

        return view('places.add_places',compact('arrCategoryGroup','arrCategory','arrCountry','arrState','arrLocation'));
    }

    /**
     * @param Requests\AddPlace $request
     */
    public function insertPlace(AddPlace $request) {
        $request['created_at'] = Carbon::now()->timestamp;
        Places::create($request->all());
        return redirect('/flink/public/admin/place/index');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getPlaceApi(Request $request){
        $errors = "";
        $status_code = "";
        $status = "";
        $result ="";

        $public_access_key = $request->query('api_key');
        // Get android callback
        $android_callback = $request->query('caller');
        //exp json input "{"category_group_id": 2,"state_id": 7,"category_id": 20101}"
        $jsonParams = $request->query('jsonParam');
        $arrParams = json_decode($jsonParams,true);
        // If the Api Key is valid
        if(UtilityController::validateApiKey($public_access_key)) {
            $read = new PlaceRead();
            $result = $read->getFilteredPlace($arrParams);
        }
        else {
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
