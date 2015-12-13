<?php

namespace App\Http\Model\EventParticipant2;

use Illuminate\Database\Eloquent\Model;

class EventParticipant2 extends Model
{
    //
    //Set the table name
    protected $table = 'event_participant_2';
    public $timestamps = true;
    protected $fillable = array('event_id',
        'user_id',
        'weight',
        'updated_at',
        'created_at');
}
