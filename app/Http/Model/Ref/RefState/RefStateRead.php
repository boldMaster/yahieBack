<?php

namespace App\Http\Model\Ref;

class RefStateRead extends RefState
{
    //
    public static function getStateInArray(){
        $jsonState = self::all();
        $arrState = array();
        foreach ($jsonState as $state) {
            $arrState = array_add($arrState,$state['state_code'],$state['state_name']);
        }
        return $arrState;
    }
}
