<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
  public function index() {
    return view('admin.user');
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'role' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8',
        'phone' => 'required',
        'gender' => 'required',
        'address' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->with('error', 'Gagal buat akun. Coba lagi.');
    }

    try {
        // Create a new user based on the validated data
        $user = new User();
        $user->name = $request->input('name');
        $user->role = $request->input('role');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        // Save the user
        $user->save();

        $user->code = strtoupper(mb_substr($request->input('role'), 0, 2)).$user->id;
        $user->save();

        return redirect()->back()->with('success', 'Akun berhasil dibuat!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal buat akun. Coba lagi.');
    }
  }
  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'role' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'gender' => 'required',
        'address' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->with('error', 'Gagal update akun. Coba lagi.');
    }
    $newUser = User::findOrFail($id);
    if (!$newUser) {
      return redirect()->back()->with('error', 'Gagal update akun. Coba lagi.');
    }
    try {
        // Create a new user based on the validated data
        $newUser->name = $request->input('name');
        $newUser->role = $request->input('role');
        $newUser->email = $request->input('email');
        $newUser->phone = $request->input('phone');
        $newUser->gender = $request->input('gender');
        $newUser->address = $request->input('address');
        // Save the user
        $newUser->save();

        if (!$newUser->code) {
          $newUser->code = strtoupper(mb_substr($request->input('role'), 0, 2)).$newUser->id;
          $newUser->save();
        }

        return redirect()->back()->with('success', 'Akun berhasil diupdate!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal update akun. Coba lagi.');
    }
  }
  public function destroy()
  {
    $id = request('id');
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->back()->with('success', 'Berhasil.');
  }
}
