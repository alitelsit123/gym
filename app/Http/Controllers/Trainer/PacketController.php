<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Packet;

class PacketController extends Controller
{
  public function index() {
    return view('trainer.packet');
  }
  public function store(Request $request)
  {
    $validatedData = $request->validate([
          'title' => 'required',
          'price' => 'required',
          'duration' => 'required',
      ]);
      $existingPacket = Packet::whereTitle($request->title)->whereTrainer_id(auth()->user()->id)->first();

      if (!$existingPacket) {
        $packet = Packet::create([
          'title' => $request->title,
          'price' => $request->price,
          'description' => $request->description,
          'duration' => $request->duration,
          'trainer_id' => auth()->user()->id
        ]);
        $packet->code = 'PK-'.strtoupper(uniqid());
        $packet->save();
      } else {
        return redirect()->back()->with('error', 'Paket sudah ada, Hanya bisa mengupdate!');
      }

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
        Storage::disk($disk)->putFileAs('/', $uploadedImage, '/packet/'.$imageName);
        $packet->image = $imageName;
        $packet->save();
      }

      return redirect()->back()->with('success', 'Berhasil membuat paket.');
  }
  public function update(Request $request,$id)
  {
    $validatedData = $request->validate([
          'title' => 'required',
          'price' => 'required',
          'duration' => 'required',
      ]);
      $existingPacket = Packet::findOrFail($id);

      if ($existingPacket) {
        Packet::whereId($id)->update([
          'title' => $request->title,
          'price' => $request->price,
          'description' => $request->description,
          'duration' => $request->duration,
          'trainer_id' => auth()->user()->id
        ]);
        if (!$existingPacket->code) {
          $existingPacket->code = 'PK-'.strtoupper(uniqid());
        }
        $existingPacket->save();
      }

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
        Storage::disk($disk)->putFileAs('/', $uploadedImage, '/packet/'.$imageName);
        $existingPacket->image = $imageName;
        if (!$existingPacket->code) {
          $existingPacket->code = 'PK-'.strtoupper(uniqid());
        }
        $existingPacket->save();
      }

      return redirect()->back()->with('success', 'Berhasil update paket.');
  }
  public function destroy()
  {
    $id = request('id');
    $membershipType = Packet::findOrFail($id);
    $membershipType->delete();
    return redirect()->back()->with('success', 'Berhasil.');
  }

}
