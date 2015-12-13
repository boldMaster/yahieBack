<?php

namespace App\Http\Model\EventParticipant;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    //
    protected $table = 'event_participant';
    public $timestamps = true;
    protected $fillable = array('event_id',
        'user_id',
        'weight',
        'updated_at',
        'created_at');
}
