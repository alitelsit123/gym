<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Models\Membership;
use App\Models\MembershipType;

class MembershipController extends Controller
{
  public function index() {
    return view('member.membership');
  }
  public function storePayment() {
    request()->validate([
      'duration' => ['required']
    ]);
    request()->validate([
      'payment_eot' => 'required|image', // Adjust the validation rules as needed
    ]);
    $type = MembershipType::findOrFail(request('type_id'));

    if ($type) {
      $existingMembershipPending = Membership::whereUser_id(auth()->user()->id)->where('membership_type_id', $type->id)->whereStatus('pending')->first();
      $existingMembershipApproved = Membership::whereUser_id(auth()->user()->id)->where('membership_type_id', $type->id)->whereStatus('approve')->first();
      if ($existingMembershipApproved) {
        return back()->with(['success' => 'Anda sudah berlangganan '.$type->name.' silahkan pilih langganan lain.']);
      }

      if ($existingMembershipPending) {
        $existingMembershipPending->update([
          'status' => 'pending',
          'start_date' => request('start_date'),
          'duration' => request('duration'),
          'duration_type' => request('type'),
          'payment_approved' => null,
          'payment_date' => now(),
          'membership_type_id' => $type->id,
          'user_id' => auth()->user()->id
        ]);
        $membership = $existingMembershipPending;
      } else {
        $membership = Membership::create([
          'status' => 'pending',
          'start_date' => request('start_date'),
          'duration' => request('duration'),
          'duration_type' => request('type'),
          'payment_approved' => null,
          'payment_date' => now(),
          'membership_type_id' => $type->id,
          'user_id' => auth()->user()->id
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
        $membership->payment_eot = $imageName;
        $membership->save();
      }

    }
    return back()->with(['success' => 'Berhasil dikirim, tunggu dicek oleh admin.']);
  }
}
