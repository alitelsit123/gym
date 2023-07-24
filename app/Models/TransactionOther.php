<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOther extends Model
{
    use HasFactory;
    protected $fillable = [
      'name','phone','duration','payment_date','payment_eot','payment_approved','status','gross_amount','member_id','packet_id','trainer_id','membership_type_id','payment_changes','type'
    ];
    public function membershipType() {
      return $this->belongsTo('App\Models\MembershipType', 'membership_type_id');
    }
    public function details() {
      return $this->hasMany('App\Models\TransactionOtherDetail', 'order_id');
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
