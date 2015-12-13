<?php

namespace App\Http\Model\UserVoucher;

use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{
    //
    protected $table = 'user_vouchers';
    public $timestamps = true;
    protected $fillable = array('user_id',
        'voucher_id',
        'created_at');
}
