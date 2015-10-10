<?php

namespace App\Http\Controllers\Place;


use App\Http\Model\Places\Places;
use App\Http\Model\Places\Read;
use App\Http\Model\Ref\RefCategoryGroupRead;
use App\Http\Model\Ref\RefCategoryRead;
use App\Http\Model\Ref\RefCountryRead;
use App\Http\Model\Ref\RefStateRead;
use App\Http\Model\Ref\RefLocationRead;
use Illuminate\Http\Request;

use Carbon\Carbon;
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
    public function index()
    {
        //
        $jsonPlaces = Read::getAllPlacesByLatestUpdate();
        $arrPlaces = array();
        foreach ($jsonPlaces as $places) {
            $arrCategory = array_add($arrPlaces,$places['place_id'] , $places['place_desc'] , $places['place_desc']);
        }
        return view('places.list_places',compact('jsonPlaces','arrCategory','arrCountry','arrState','arrLocation'));
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

        return
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
        return redirect('public/admin/place/show');
    }

}
