<?php

namespace App\Http\Controllers\Akuntan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
  public function index() {
    return view('akuntan.profile');
  }
  public function update(Request $request) {
    // Validate the form data
    $validatedData = $request->validate([
      'name' => 'required',
      'phone' => 'required',
      'gender' => 'required',
      'address' => 'required',
    ]);

    // Update the user's data
    $user = auth()->user();
    $user->name = $request->input('name');
    $user->phone = $request->input('phone');
    $user->gender = $request->input('gender');
    $user->address = $request->input('address');
    $user->save();

    if (request()->image !== null && request()->hasFile('image')) {
      request()->validate([
        'image' => 'required|image', // Adjust the validation rules as needed
      ]);
      // Retrieve the uploaded file
      $uploadedImage = request()->file('image');

      // Generate a unique name for the file
      $imageName = time().'.'.$uploadedImage->extension();

      // Specify the storage disk where you want to store the image (e.g., "public")
      $disk = 'public';

      // Store the image in the specified disk and directory
      Storage::disk($disk)->putFileAs('/', $uploadedImage, '/profile/'.$imageName);
      $user->photo = $imageName;
      $user->save();
    }

    return back()->with(['success' => 'Berhasil update data']);
  }
}
