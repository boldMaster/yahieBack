<?php

namespace App\Http\Controllers\Ref;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Ref\RefCategoryRead;
use DB;

class RefCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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

    public function getCategoryByCategoryGroup($category_group_id)
    {
        return RefCategoryRead::getCategoryInArrayByCategoryGroup($category_group_id);
    }
	
	/**
     * Custom function for RefCategory Controller
     * Access validation 
	 * @param  Request  $request
	 * @return Array $access_info 
     */
	public function access_validation(Request $request)
	{
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
			$status_code = 403;
			// Set the status to false 
			$status = false;
		}
		
		// Finally, store all info into a single array 
		$access_info = array(
			'api_ver' 	  => '1.0',
			'caller'	  => $android_callback,
			'error'		  => $errors,
			'status_code' => $status_code,
			'status'	  => $status,
		);
		
		return $access_info;
	}
	
	/**
	 * @author 
	 * Written by Zi Yang 
	 * @desc
	 * This is a function to retrieve the full list of available category, included category group and sub category as well
	 */
	public function getCategoryInfoList(Request $request)
	{
		// Get the parameter from GET 
		// Note: We do not need to sanitize the input due to laravel automatically sanitize it 
		$return_vars = array(
			'status' => false,
		);
		
		// Validate the access 
		$access_rtn = $this->access_validation($request);
		
		$status = $access_rtn['status'];
		if($status)
		{
			// We will get the category list from database 
			$return_vars['category_group_list'] = $this->getCategoryGroupList();
			$return_vars['category_list'] = $this->getCategoryList();
			$return_vars['sub_category_list'] = $this->getSubCategoryList();
			
			$return_vars['status'] = true;
		}
		else
		{
			$return_vars['status'] = false;
		}
		
		// Set return vars 
		$access_rtn['return_vars'] = $return_vars;
		
		return $access_rtn;
	}
	
	public function getCategoryGroupList() 
	{
		return DB::table('ref_category_group')->select('category_group_id','category_group_desc')->get();
	}
	
	public function getCategoryList() 
	{
		return DB::table('ref_category')->select('category_id','category_group_id','category_desc')->get();
	}
	
	public function getSubCategoryList() 
	{
		return DB::table('ref_sub_category')->select('sub_category_id','category_id','category_group_id','sub_category_desc')->get();
	}
}
