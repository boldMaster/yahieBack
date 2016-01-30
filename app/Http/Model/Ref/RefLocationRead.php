<?php

namespace App\Http\Model\Ref;

class RefLocationRead extends RefLocation
{
    //
    public static function getLocationInArray($intStateCode = null){
        //If got specific state, filter by state
        if($intStateCode != null){
            $jsonLocation = self::select('location_id','location_desc')->where('state_code',$intStateCode)->get();
        }else{
            $jsonLocation = self::all();
        }

        $arrLocation = array();
        foreach ($jsonLocation as $location) {
            $arrLocation = array_add($arrLocation,$location['location_id'],$location['location_desc']);
        }
        return $arrLocation;
    }
}
