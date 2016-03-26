<?php

namespace App\Http\Model\Places;

class PlaceRead extends Places
{
    // Get all places by latest update
    public static function getAllPlacesByLatestUpdate()
    {
        //apply cache query 10 m
        $jsonPlaces = self::orderBy('created_at', 'desc')->get();
        $arrPlaces = array();
        foreach ($jsonPlaces as $places) {
            $arrPlaces = array_add($arrPlaces, $places['place_id'], $places['attributes']);
        }
        return $arrPlaces;
    }

    public function getFilteredPlace($arrParams){
        $jsonResult = self::where($arrParams)->get();

        $arrResult = array();
        foreach ($jsonResult as $result) {
            $arrResult = array_add($arrResult, $result['place_id'], $result['attributes']);
        }
        return $arrResult;
    }
	
	/**
	 * Function to get the list of filtered place, with ordering and limit
	 * @param 
	 * $query_params - The condition of the SQL query in Array
	 * $extra_info - The array that consists of extra info condition for the Query 
	 *		> order_by_column - The column name to order 
	 *		> order - ASC / DESC
	 * 		> offset - The starting point of the record 
	 * 		> limit - The number of record to get 
	 */
	public function getFilteredPlaceWithExtra($query_params,$extra_info){
		// Extract the extra condition
		$order_column = $extra_info['order_by_column'];
		$order = $extra_info['order'];
		$offset = $extra_info['offset'];
		$limit = $extra_info['limit'];
	
        $jsonResult = self::where($query_params)->orderBy($order_column,$order)->skip($offset)->take($limit)->get();

        $arrayResult = array();
        foreach ($jsonResult as $result) {
            $arrayResult[] = $result['attributes'];
        }
        return $arrResult;
    }
	
	/**
	 * Function to get the full information of a single place 
	 * @param 
	 * $place_id - The primary key of the place entry 
	 */
	public function getSinglePlaceInfoById($place_id){
		// Construct the query params 
		$query_params = array(
			'place_id'	=> $place_id,
		);
		
		// Set limit to one 
		$limit = 1;
		// Get result from database 
        $json_result = self::where($query_params)->take($limit)->get();
        $array_result = array();
		
        foreach ($json_result as $result){
            $array_result = $result['attributes'];
        }
        return $array_result;
    }
}
