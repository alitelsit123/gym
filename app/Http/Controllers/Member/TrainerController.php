<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Models\Packet;
use App\Models\TrainerMember;

class TrainerController extends Controller
{
  public function index() {
    return view('member.trainer');
  }
  public function storePayment() {
    $packet = Packet::findOrFail(request('packet_id'));
    $existingTrainerMemberPending = TrainerMember::whereMember_id(auth()->user()->id)->wherePacket_id($packet->id)->whereStatus('pending')->first();
    $existingTrainerMemberApprove = TrainerMember::whereMember_id(auth()->user()->id)->wherePacket_id($packet->id)->whereStatus('approve')->first();
    if ($existingTrainerMemberApprove) {
      return back()->with(['success' => 'Anda sudah berlangganan '.$packet->name.' silahkan pilih langganan lain.']);
    }
    if ($existingTrainerMemberPending) {
      $existingTrainerMemberPending->update([
        'duration' => $packet->duration,
        'payment_date' => now(),
        'start_date' => request('start_date'),
        'payment_approved' => null,
        'status' => 'pending',
        'member_id' => auth()->user()->id,
        'packet_id' => $packet->id,
        'trainer_id' => $packet->trainer_id
      ]);
    } else {
      $existingTrainerMemberPending = TrainerMember::create([
        'duration' => $packet->duration,
        'payment_date' => now(),
        'start_date' => request('start_date'),
        'payment_approved' => null,
        'status' => 'pending',
        'member_id' => auth()->user()->id,
        'packet_id' => $packet->id,
        'trainer_id' => $packet->trainer_id
      ]);
    }

    if (request()->payment_eot !== null && request()->hasFile('payment_eot')) {

      // Retrieve the uploaded file
      $uploadedImage = request()->file('payment_eot');

      // Generate a unique name for the file
      $imageName = time().'.'.$uploadedImage->extension();

      // Specify the storage disk where you want to store the image (e.g., "public")
      $disk = 'public';

      // Store the image in the specified disk and directory
      Storage::disk($disk)->putFileAs('/', $uploadedImage, '/eot/'.$imageName);
      $existingTrainerMemberPending->payment_eot = $imageName;
      $existingTrainerMemberPending->save();
    }

    return back()->with(['success' => 'Berhasil dikirim, tunggu dicek oleh admin.']);
  }
}
