<?php

namespace App\Http\Controllers\Akuntan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Expense;

class ExpenseController extends Controller
{
  public function index() {
    return view('akuntan.expense');
  }
  public function store(Request $request)
  {
    $validatedData = $request->validate([
          'name' => 'required',
          'quantity' => 'required',
          'price' => 'required',
          'gross_amount' => 'required',
          'description' => 'nullable',
      ]);

      $packet = Expense::create($validatedData);
      $packet->save();

      // if (!empty($packet) && $request->image !== null) {
      //   // Validate the request
      //   $request->validate([
      //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
      //   ]);

      //   // Retrieve the uploaded file
      //   $uploadedImage = $request->file('image');

      //   // Generate a unique name for the file
      //   $imageName = time().'.'.$uploadedImage->extension();

      //   // Specify the storage disk where you want to store the image (e.g., "public")
      //   $disk = 'public';

      //   // Store the image in the specified disk and directory
      //   Storage::disk($disk)->putFileAs('/', $uploadedImage, '/packet/'.$imageName);
      //   $packet->image = $imageName;
      //   $packet->save();
      // }

      return redirect()->back()->with('success', 'Beban ditambah.');
  }
  public function update(Request $request,$id)
  {
    $validatedData = $request->validate([
          'name' => 'required',
          'quantity' => 'required',
          'price' => 'required',
          'gross_amount' => 'required',
          'description' => 'nullable',
      ]);

      $packet = Expense::whereId($id)->update($validatedData);

      // if (!empty($packet) && $request->image !== null) {
      //   // Validate the request
      //   $request->validate([
      //     'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
      //   ]);

      //   // Retrieve the uploaded file
      //   $uploadedImage = $request->file('image');

      //   // Generate a unique name for the file
      //   $imageName = time().'.'.$uploadedImage->extension();

      //   // Specify the storage disk where you want to store the image (e.g., "public")
      //   $disk = 'public';

      //   // Store the image in the specified disk and directory
      //   Storage::disk($disk)->putFileAs('/', $uploadedImage, '/packet/'.$imageName);
      //   $packet->image = $imageName;
      //   $packet->save();
      // }

      return redirect()->back()->with('success', 'Beban diupdate.');
  }
  public function destroy()
  {
    $id = request('id');
    $membershipType = Expense::findOrFail($id);
    $membershipType->delete();
    return redirect()->back()->with('success', 'Berhasil.');
  }
}
