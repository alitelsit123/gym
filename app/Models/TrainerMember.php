<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainerMember extends Model
{
    use HasFactory;
    protected $fillable = [
      'duration', 'payment_date','payment_eot','payment_approved','status','member_id','packet_id','trainer_id','start_date','payment_type','payment_total','payment_changes'
    ];
    public function packet() {
      return $this->belongsTo('App\Models\Packet', 'packet_id');
    }
    public function member() {
      return $this->belongsTo('App\Models\User', 'member_id');
    }
    public function user() {
      return $this->belongsTo('App\Models\User', 'member_id');
    }
}
