<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
      'sender_id','receiver_id','text','chat_session_id'
    ];
    public function sender() {
      return $this->belongsTo('App\Models\User','sender_id');
    }
    public function receiver() {
      return $this->belongsTo('App\Models\User','receiver_id');
    }
    public function session() {
      return $this->belongsTo('App\Models\ChatSession','chat_session_id');
    }
}
