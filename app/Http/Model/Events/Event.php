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
        'amount_per_voucher',
        'start_date',
        'end_date',
        'redeem_duration',
        'updated_at',
        'created_at');

    // Genearate Public Key
    public static function genPublicKey()
    {
        $bytes = openssl_random_pseudo_bytes(2);
        $hex   = bin2hex($bytes);
        return $hex;
    }




}
