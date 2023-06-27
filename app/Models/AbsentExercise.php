<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsentExercise extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id','trainer_member_id','packet_id','trainer_id','schedule_exercise_id'
    ];
}
