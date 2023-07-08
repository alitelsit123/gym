<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleNutrition extends Model
{
    use HasFactory;

    protected $fillable = [
      'daym','description','type','user_id','trainer_member_id','packet_id'
    ];
    public function member() {
      return $this->belongsTo('App\Models\TrainerMember', 'trainer_member_id');
    }
}
