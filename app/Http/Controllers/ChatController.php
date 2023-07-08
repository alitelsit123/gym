<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Events\SendChatEvent;

use App\Models\Chat;
use App\Models\ChatSession;

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

    $session = \App\Models\ChatSession::whereHas('chats',function($query) {
      $query->where(function($query) {
        $query->where('sender_id',request('receiver_id'))->where('receiver_id',request('sender_id'));
      })->orWhere(function($query) {
        $query->where('sender_id',request('sender_id'))->where('receiver_id',request('receiver_id'));
      });
    })->first();

    if (!$session) {
      $session = ChatSession::create([]);
    }
    $chat = Chat::create([
      'sender_id' => $request->sender_id,
      'receiver_id' => $request->receiver_id,
      'text' => $request->text,
      'chat_session_id' => $session->id
    ]);

    $chat->load('session');
    $chat->load('receiver');
    $chat->load('sender');

    SendChatEvent::dispatch($chat);

    return response()->json(['message' => 'ok']);
  }
  public function destroy($id)
  {
    $id = request('id');
    $membershipType = ChatSession::findOrFail($id);
    $membershipType->delete();
    return redirect()->back()->with('success', 'Berhasil hapus data.');
  }
}
