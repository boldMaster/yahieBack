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
     * Custom function for Place Controller
     * Access validation 
	 * @param  Request  $request
	 * @return Array $access_info 
     */
	public function access_validation(Request $request) {
		// Set default status to true
		$status = true;
		// Default status code is 200
		$status_code = 200;
		// This array will store the list of error messages
		$errors = array();
	 
		// Get public access key and user access key from GET
		$public_access_key = $request->query('api_key');
		$user_access_key = $request->query('access_key');
		
		// Get android callback 
		$android_callback = $request->query('caller');
		
		// Define public access key 
		$predefined_public_key = 'abc123';
		
		// Check if the public access key is valid 
		if($public_access_key != $predefined_public_key)
		{
			// Set error message 
			$errors[] = "Access Denied";
		}
		
		// If there are any errors during validation, set the status code to 403 unauthorized access 
		if(!empty($errors))
		{
			// Set status code to 403
			$status_code = HttpRequest::$ACCESS_DENIED_CODE;
			// Set the status to false 
			$status = false;
		}
		
		// Finally, store all info into a single array 
		$access_info = array(
			'api_ver' 	  => self::$API_VERSION,
			'caller'	  => $android_callback,
			'error'		  => $errors,
			'status_code' => $status_code,
			'status'	  => $status,
		);
		
		return $access_info;
	}
	
    /**
     * @param Request $request
     * @return array
     */
    public function getPlaceApi(Request $request){
		// Get the parameter from GET 
		// Note: We do not need to sanitize the input due to laravel automatically sanitize it 
		$place_list = array();
		$errors = array();
		
		// Validate the access 
		$access_rtn = $this->access_validation($request);
		// Check if the access is valid 
		$status = $access_rtn['status'];
		if($status)
		{
			// Extract information 
			$criteria_encoded = $request->query('criteria');
			// Decode the JSON criteria to normal array 
			$criteria = json_decode($criteria_encoded,true);
			
			// Make sure the criteria is not empty 
			if(!empty($criteria))
			{
				// Extract information
				$country_id = $criteria['country'];
				$state_id = $criteria['state'];
				$category_group_id = $criteria['categoryGroup'];
				$category_id = $criteria['category'];
				$sub_category_id = $criteria['subCategory'];
			
				// Extract the required parameters and Set query condition
				$query_params = array(
					'country_id'		=> $country_id,
					'state_id' 			=> $state_id,
					'category_group_id' => $category_group_id,
					'category_id' 		=> $category_id,
					'sub_category_id' 	=> $sub_category_id,
				);

				// Calculate the offset 
				$page = $request->query('page');
				$limit = $request->query('num');
				$offset = ($page - 1) * $limit;
				
				// Set the extra query condition 
				$extra_params = array(
					'order_by_column'	=> 'place_id',
					'order'				=> 'ASC',
					'offset'			=> $offset,
					'limit'				=> $limit,
				);
				
				// Get the place list from database 
				$read = new PlaceRead();
				$place_list = $read->getFilteredPlaceWithExtra($query_params,$extra_params);
				$status = true;
			}
			else
			{
				$errors[] = "Invalid Criteria Object.";
			}
		}
		
		// Set return vars 
		$return_vars = array(
			'place_list' => $place_list,
			'errors'	 => $errors,
			'status'	 => $status,
		);
		
		// Set return vars 
		$access_rtn['status'] = $status;
		$access_rtn['return_vars'] = $return_vars;
		
        return $access_rtn;
    }
	
	/**
	 * Function that return the target place info 
     * @param Request $request
     * @return array
     */
    public function getPlaceInfoApi(Request $request){
        // Get the parameter from GET 
		// Note: We do not need to sanitize the input due to laravel automatically sanitize it 
		$errors = array();
		$place_info = array();
		
		// Validate the access 
		$access_rtn = $this->access_validation($request);
		// Check if the access is valid 
		$status = $access_rtn['status'];
		if($status)
		{
			// Extract information 
			$place_id = $request->query('place_id');
			
			// Get the place list from database 
			$read = new PlaceRead();
			$place_info = $read->getSinglePlaceInfoById($place_id);
			
			if(empty($place_info))
			{	
				$errors[] = "Invalid Place ID.";
				$status = false;
			}
		}
		
		// Set return vars 
		$return_vars = array(
			'place_info' => $place_info,
			'errors'	 => $errors,
			'status'	 => $status,
		);
		
		// Set return vars 
		$access_rtn['status'] = $status;
		$access_rtn['return_vars'] = $return_vars;
		
        return $access_rtn;
    }

}
