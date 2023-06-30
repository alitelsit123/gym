<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TrainerMember;

class TransactionController extends Controller
{
  public function index() {
    return view('trainer.transaction');
  }
  public function approvedPaymentPacket() {
    $membership = TrainerMember::findOrFail(request('id'));
    $membership->status = 'approve';
    $membership->payment_approved = now();
    $membership->save();
    if ($membership->payment_type == 'tunai') {
      $membership->payment_total = request('payment_total');
      $membership->payment_changes = request('payment_changes');
      $membership->save();
      return $this->invoice($membership,'TrainerMember')->with(['success' => 'Transaksi telah diterima.']);
    }
    return back()->with(['success' => 'Transaksi telah diterima.']);
  }
  public function invoice($model,$type) {
    return view('trainer.invoice',compact('model','type'));
  }
}
