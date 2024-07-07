<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
