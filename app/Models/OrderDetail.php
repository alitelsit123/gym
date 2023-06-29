<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
      'product_id','quantity','sub_amount','order_id'
    ];
    public function product() {
      return $this->belongsTo('App\Models\Product','product_id');
    }
}
