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

    public static function genSecretKey($intVoucher, $intUserId)
    {
        if (empty($intVoucher)) $intVoucher = 11223;
        if (empty($intUserId)) $intUserId = 11234234;
        $str2 = time().$intVoucher.$intUserId;
        return md5($str2);
    }
    // Genearate Public Key
    public static function genPublicKey()
    {

    }




}
