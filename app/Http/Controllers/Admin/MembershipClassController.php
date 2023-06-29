<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MembershipClass;

class MembershipClassController extends Controller
{
  public function index() {
    return view('admin.class');
  }

  public function create()
  {
      return view('membership_types.create');
  }

  public function store(Request $request)
  {
      $validatedData = $request->validate([
          'name' => 'required',
      ]);

      MembershipClass::create($validatedData);
      return redirect()->back()->with('success', 'Berhasil.');
  }

  public function edit(MembershipClass $membershipType)
  {
      return view('membership_types.edit', compact('membershipType'));
  }

  public function update(Request $request, $id)
  {
      $validatedData = $request->validate([
          'name' => 'required',
      ]);
      // dd($validatedData);
      $membershipTypes = MembershipClass::findOrFail($id);
      MembershipClass::whereId($id)->update($validatedData);
      return redirect()->back()->with('success', 'Berhasil update.');
  }

  public function destroy()
  {
    $id = request('id');
    $membershipType = MembershipClass::findOrFail($id);
    $membershipType->delete();
    return redirect()->back()->with('success', 'Berhasil.');
  }
}
