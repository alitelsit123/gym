<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packet extends Model
{
    use HasFactory;

    protected $fillable = [
      'code','title','description','image','price','trainer_id','duration'
    ];

    public function trainer() {
      return $this->belongsTo('App\Models\User', 'trainer_id');
    }
    public function members() {
      return $this->belongsToMany('App\Models\User', 'trainer_members', 'packet_id', 'user_id')->withTimestamps()->withPivot(['duration', 'payment_date','payment_eot','payment_approved','status','start_date']);
    }
    public function trainerMembers() {
      return $this->hasMany('App\Models\TrainerMember', 'packet_id');
    }
}
