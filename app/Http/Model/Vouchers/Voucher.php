<?php

namespace App\Http\Model\Vouchers;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    //
    protected $table = 'vouchers';
    public $timestamps = true;
    protected $primaryKey = 'voucher_id';
    protected $fillable = array('event_id',
        'user_id',
        'public_key',
        'secret_key',
        'expired_at',
        'created_at');

    public static function genSecretKey($intVoucher, $intUserId)
    {
        if (empty($intVoucher)) $intVoucher = 11223;
        if (empty($intUserId)) $intUserId = 11234234;
        $str2 = time().$intVoucher.$intUserId;
        return md5($str2);
    }

    private function validateVoucher($user_id, $event_id, $strSecretKey, $publicKey)
    {
        // Get the voucher

    }
}
