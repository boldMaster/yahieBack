<?php

namespace App\Http\Model\Events;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $table = 'events';
    public $timestamps = true;
    protected $fillable = array('place_id',
        'advertiser_id',
        'status',
        'total_amount',
        'total_winner',
        'start_date',
        'end_date',
        'duration',
        'updated_at',
        'created_at');
}
