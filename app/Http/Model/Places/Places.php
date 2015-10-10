<?php

namespace App\Http\Model\Places;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    //Set the table name
    protected $table = 'places';
    public $timestamps = true;
    protected $fillable = array('username',
                                'place_title',
                                'place_desc',
                                'place_address',
                                'contact',
                                'category_group_id',
                                'category_id',
                                'map_longitude',
                                'map_latitude',
                                'location_id',
                                'state_id',
                                'country_id',
                                'picture_path',
                                'premium_flag',
                                'admin_id',
                                'created_at');
}
