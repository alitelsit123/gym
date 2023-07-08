<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatSession extends Model
{
    use HasFactory;
    public function chats() {
      return $this->hasMany('App\Models\Chat','chat_session_id');
    }
}
