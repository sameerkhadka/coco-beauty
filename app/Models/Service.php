<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at','id'];
    public function items(){
        return $this->hasMany(Item::class,'service_id');
    }
}
