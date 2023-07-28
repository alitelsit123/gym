<?php

namespace App\Http\Controllers\Akuntan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Product;

class ProductController extends Controller
{
  public function index() {
    return view('akuntan.product');
  }
  public function store(Request $request)
  {
    $validatedData = $request->validate([
          'name' => 'required',
          'price' => 'required',
          'stock' => 'required',
          'category' => 'required',
      ]);
      $existingPacket = Product::whereName($request->name)->first();

      if (!$existingPacket) {
        $packet = Product::create([
          'name' => $request->name,
          'category' => $request->category,
          'price' => $request->price,
          'stock' => $request->stock,
          'description' => $request->description,
          'status' => 'tersedia',
        ]);
        $packet->save();
        $existingPacket = $packet;

      } else {
        return redirect()->back()->with('error', 'Produk sudah ada, Hanya bisa mengupdate!');
      }

      if ($existingPacket->stock > 0) {
        $existingPacket->status = 'tersedia';
      } else {
        $existingPacket->status = 'habis';
      }
      $existingPacket->save();

      if (!empty($packet) && $request->image !== null) {
        // Validate the request
        $request->validate([
          'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);

        // Retrieve the uploaded file
        $uploadedImage = $request->file('image');

        // Generate a unique name for the file
        $imageName = time().'.'.$uploadedImage->extension();

        // Specify the storage disk where you want to store the image (e.g., "public")
        $disk = 'public';

        // Store the image in the specified disk and directory
        Storage::disk($disk)->putFileAs('/', $uploadedImage, '/product/'.$imageName);
        $packet->image = $imageName;
        $packet->save();
      }

      return redirect()->back()->with('success', 'Berhasil tambah produk.');
  }
  public function update(Request $request,$id)
  {
      $validatedData = $request->validate([
          'name' => 'required',
          'category' => 'required',
          'price' => 'required',
          'stock' => 'required',
          'status' => 'required',
      ]);
      $existingPacket = Product::findOrFail($id);

      if ($existingPacket) {
        Product::whereId($id)->update([
          'name' => $request->name,
          'category' => $request->category,
          'price' => $request->price,
          'stock' => $request->stock,
          'description' => $request->description,
          'status' => $request->status
        ]);
        $existingPacket->save();
      }
      if ($existingPacket->stock > 0) {
        $existingPacket->status = 'tersedia';
      } else {
        $existingPacket->status = 'habis';
      }
      $existingPacket->save();
      if (!empty($existingPacket) && $request->image !== null && $request->hasFile('image')) {
        // Validate the request
        $request->validate([
          'image' => 'required|image', // Adjust the validation rules as needed
        ]);

        // Retrieve the uploaded file
        $uploadedImage = $request->file('image');

        // Generate a unique name for the file
        $imageName = time().'.'.$uploadedImage->extension();

        // Specify the storage disk where you want to store the image (e.g., "public")
        $disk = 'public';

        // Store the image in the specified disk and directory
        Storage::disk($disk)->putFileAs('/', $uploadedImage, '/product/'.$imageName);
        $existingPacket->image = $imageName;
        $existingPacket->save();
      }

      return redirect()->back()->with('success', 'Berhasil update paket.');
  }
  public function destroy()
  {
    $id = request('id');
    $membershipType = Product::findOrFail($id);
    $membershipType->delete();
    return redirect()->back()->with('success', 'Berhasil.');
  }
}
