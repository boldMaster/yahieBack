<?php

namespace App\Http\Model\Ref;

class RefCountryRead extends RefCountry
{
    //
    public static function getCountryInArray(){
        $jsonCountry = self::all();
        $arrCountry = array();
        foreach ($jsonCountry as $country) {
            $arrCountry = array_add($arrCountry,$country['country_code'],$country['category_name']);
        }
        return $arrCountry;
    }
}
