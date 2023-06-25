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
}
