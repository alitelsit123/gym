<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
      'status','e_date','payment_date','payment_eot','gross_amount','user_id'
    ];
    public function details() {
      return $this->hasMany('App\Models\OrderDetail','order_id');
    }
}
