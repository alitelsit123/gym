<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class BroadcastController extends Controller
{
  public function index() {
    return view('brodcast');
  }
  public function store() {
    User::findOrFail(request('id'))->notify(new \App\Notifications\ProductNotification(['model' => 'User', 'target' => auth()->user()],request('text')));
    return back()->with(['success' => 'Berhasil dikirim.']);
  }
  public function storeType() {
    $users = User::whereRole(request('type'))->get();
    foreach ($users as $row) {
      $row->notify(new \App\Notifications\ProductNotification(['model' => 'User', 'target' => auth()->user()],request('text')));
    }
    return back()->with(['success' => 'Berhasil dikirim.']);
  }
}
