<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Events\SendChatEvent;

use App\Models\Chat;

class ChatController extends Controller
{
  public function index() {
    return view('chat');
  }

  public function send(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'sender_id' => ['required'],
      'receiver_id' => ['required'],
      'text' => ['required']
    ]);
    if ($validator->fails()) {
      return response()->json(['error' => 'Error!']);
    }

    $chat = Chat::create([
      'sender_id' => $request->sender_id,
      'receiver_id' => $request->receiver_id,
      'text' => $request->text,
    ]);
    SendChatEvent::dispatch($chat);

    return response()->json(['message' => 'ok']);
  }
}
