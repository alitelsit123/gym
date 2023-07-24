<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
      'status','e_date','payment_date','payment_eot','gross_amount','user_id','payment_type','payment_total','payment_changes'
    ];
    public function details() {
      return $this->hasMany('App\Models\OrderDetail','order_id')->has('product');
    }
    public function user() {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function decrementProduct() {
      foreach ($this->details()->has('product')->get() as $row) {
        $product = $row->product;
        $product->stock = $product->stock-$row->quantity;
        if ($product->stock > 0) {
          $product->status = 'tersedia';
        } else {
          $product->status = 'habis';
        }
        $product->save();
      }
    }
}
