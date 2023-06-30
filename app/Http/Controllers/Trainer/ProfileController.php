<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
  public function index() {
    return view('trainer.profile');
  }
  public function update(Request $request) {
    // Validate the form data
    $validatedData = $request->validate([
      'name' => 'required',
      'phone' => 'required',
      'gender' => 'required',
      'address' => 'required',
      'norek' => 'required',
    ]);

    // Update the user's data
    $user = auth()->user();
    $user->name = $request->input('name');
    $user->phone = $request->input('phone');
    $user->gender = $request->input('gender');
    $user->address = $request->input('address');
    $user->norek = $request->input('norek');
    $user->save();

    return back()->with(['success' => 'Berhasil update data']);
  }
}
