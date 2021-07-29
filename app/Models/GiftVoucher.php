<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftVoucher extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at','id'];
    public  function member(){
        return $this->belongsTo(Member::class,'gift_for','id');
    }
}
