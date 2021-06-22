<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at','id'];

    public function service(){
        return $this->belongsTo(Service::class,'service_id');
    }
}
