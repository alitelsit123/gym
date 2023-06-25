<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TrainerSpecialis;

class SpecialistController extends Controller
{
  public function index() {
    return view('trainer.specialist');
  }
  public function store(Request $request)
  {
      $validatedData = $request->validate([
          'name' => 'required',
          'user_id' => 'required'
      ]);

      TrainerSpecialis::create($validatedData);
      return redirect()->back()->with('success', 'Berhasil.');
  }
  public function update(Request $request,$id)
  {
      $validatedData = $request->validate([
          'name' => 'required',
          'user_id' => 'required'
      ]);

      TrainerSpecialis::whereId($id)->update($validatedData);
      return redirect()->back()->with('success', 'Berhasil.');
  }
  public function destroy()
  {
    $id = request('id');
    $membershipType = TrainerSpecialis::findOrFail($id);
    $membershipType->delete();
    return redirect()->back()->with('success', 'Berhasil.');
  }
}
