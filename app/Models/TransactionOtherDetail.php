<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOtherDetail extends Model
{
    use HasFactory;
    protected $fillable = [
      'quantity','sub_amount','product_id','order_id'
    ];
    public function product() {
      return $this->belongsTo('App\Models\Product','product_id');
    }
}
