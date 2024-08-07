<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POCustomer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function rekanan()
    {
        return $this->belongsTo(Rekanan::class);
    }

    public function picCustomer()
    {
        return $this->belongsTo(PICCustomer::class);
    }
    public function orders()
{
    return $this->hasMany(Order::class, 'no_po', 'id');
}
}
