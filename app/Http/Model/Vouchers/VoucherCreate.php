<?php

namespace App\Http\Model\Vouchers;

use Illuminate\Support\Facades\DB;

class VoucherCreate extends Voucher
{
    //
    public static function createVouchers($arrData){
        // Transaction to insert a single voucher
        // Automatic commit while succes, rollback while failure
        return DB::transaction(function($arrData) use($arrData){
            $newVoucher = self::create($arrData);
            $strSecretKey = self::genSecretKey($newVoucher['voucher_id'], $arrData['user_id']);
            $newVoucher->secret_key = $strSecretKey;
            $newVoucher->save();
            return $newVoucher['voucher_id'];
        });
    }
}
