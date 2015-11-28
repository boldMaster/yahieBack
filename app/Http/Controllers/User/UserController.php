<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class UserController extends Controller
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
	
	/**
     * Custom function for User Controller
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
     * Custom function for User Controller
     *
	 * @param  Request  $request
     */
	 public function signin(Request $request)
	 {
		// Get the parameter from GET 
		// Note: We do not need to sanitize the input due to laravel automatically sanitize it 
		$return_vars = array(
			'status' => false,
		);
		
		// Validate the access 
		$access_rtn = $this->access_validation($request);
		
		// If the access is valid, we will proceed to check the email and password
		$status = $access_rtn['status'];
		if($status)
		{
			// Validate sign in credential 
			$return_vars = $this->signin_validation($request);
		}
		
		// Set return vars 
		$access_rtn['return_vars'] = $return_vars;
		
		return $access_rtn;
	 }
	 
	 /**
     * Custom function for User Controller
     * Validate if the user is exists in database and password is valid
	 * @param  Request  $request
     */
	 public function signin_validation(Request $request)
	 {
		// This is the error message list
		$errors = array();
		$status = true;
		$user_info = false;
	 
		// Get the required parameter from $GET
		$email = $request->query('email');
		$pass  = $request->query('pass');
		
		// Check if the email and password field is empty 
		$email_size = strlen($email);
		$pass_size = strlen($pass);
		if($email_size < 1)
		{
			$errors[] = "The email field cannot be empty.";
			$status = false;
		}		
		else if($pass_size < 1)
		{
			$errors[] = "The password field cannot be empty.";
			$status = false;
		}
		
		// When we reach here, we will only proceed if there are no errors 
		if($status)
		{
			// Check if the user is exists in database
			$user = DB::table('users')->where('email',$email)->where('password',$pass)->first();
					
			// Set error message if we unable to get the user information
			if(!$user)
			{
				$errors[] = "Invalid user credentials.";
				$status = false;
			}
			else
			{
				$user_info = array(
					'first_name' => $user->first_name,
					'last_name'	 => $user->last_name,
				);
			}
		}
		
		// Set return output 
		$output = array(
			'status' 	=> $status,
			'errors'	=> $errors,
			'user_info'	=> $user_info,
		);
		
		return $output;
	 }
}
