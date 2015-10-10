<?php

namespace App\Http\Model\Places;



class Read extends Places
{
    //
    public function getAllPlacesByLatestUpdate(){
        return self::getAll()->orderBy('created_at','desc');
    }
}
