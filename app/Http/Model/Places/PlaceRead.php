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
}
