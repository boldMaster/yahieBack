<?php

namespace App\Http\Model\Vouchers;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    //
    protected $table = 'vouchers';
    public $timestamps = true;
    protected $fillable = array('event_id',
        'user_id',
        'public_key',
        'secret_key',
        'expired_at',
        'created_at');

    private function validateVoucher($user_id, $event_id, $strSecretKey, $publicKey)
    {
        // Get the voucher

    }
}
