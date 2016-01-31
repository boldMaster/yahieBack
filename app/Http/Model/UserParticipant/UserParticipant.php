<?php

namespace App\Http\Model\UserParticipant;

use Illuminate\Database\Eloquent\Model;

class UserParticipant extends Model
{
    //
    protected $table = 'user_participant';
    protected $primaryKey = 'user_id';
    public $timestamps = true;
    protected $fillable = array('user_id',
        'event_participant',
        'updated_at',
        'created_at',);
}
