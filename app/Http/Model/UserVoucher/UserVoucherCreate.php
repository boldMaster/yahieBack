<?php

namespace App\Http\Model\UserVoucher;

class UserVoucherCreate extends UserVoucher
{
    //
    public static function insertUserVoucher($arrData){
        self::create($arrData);
    }
}
