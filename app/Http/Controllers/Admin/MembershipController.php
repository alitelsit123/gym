<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MembershipType;

class MembershipController extends Controller
{
  public function index() {
    return view('admin.membership');
  }
  public function subscribers() {
    return view('admin.membership-subscribers');
  }

  public function create()
  {
      return view('membership_types.create');
  }

  public function store(Request $request)
  {
      $validatedData = $request->validate([
          'name' => 'required',
          'price_daily' => 'required|numeric',
          'price_weekly' => 'required|numeric',
          'price_monthly' => 'required|numeric',
          'description' => 'nullable',
          'class' => 'required',
      ]);

      MembershipType::create($validatedData);
      return redirect()->back()->with('success', 'Berhasil.');
  }

  public function edit(MembershipType $membershipType)
  {
      return view('membership_types.edit', compact('membershipType'));
  }

  public function update(Request $request, $id)
  {
      $validatedData = $request->validate([
          'name' => 'required',
          'price_daily' => 'required|numeric',
          'price_weekly' => 'required|numeric',
          'price_monthly' => 'required|numeric',
          'description' => 'nullable',
          'class' => 'required',
      ]);
      // dd($validatedData);
      $membershipTypes = MembershipType::findOrFail($id);
      MembershipType::whereId($id)->update($validatedData);
      return redirect()->back()->with('success', 'Berhasil update.');
  }

  public function destroy()
  {
    $id = request('id');
    $membershipType = MembershipType::findOrFail($id);
    $membershipType->delete();
    return redirect()->back()->with('success', 'Berhasil.');
  }
}
