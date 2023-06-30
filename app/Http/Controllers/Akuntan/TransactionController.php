<?php

namespace App\Http\Controllers\Akuntan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Membership;
use App\Models\TrainerMember;
use App\Models\Order;

class TransactionController extends Controller
{
  public function index() {
    return view('akuntan.transaction');
  }
  public function approvedPayment() {
    $membership = Membership::findOrFail(request('id'));
    $membership->status = 'approve';
    $membership->payment_approved = now();
    $membership->save();
    if ($membership->payment_type == 'tunai') {
      $membership->payment_total = request('payment_total');
      $membership->payment_changes = request('payment_changes');
      $membership->save();
      return $this->invoice($membership,'Membership')->with(['success' => 'Transaksi telah diterima.']);
    }
    return back()->with(['success' => 'Transaksi telah diterima.']);
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
  public function approvedPaymentProduct() {
    $membership = Order::findOrFail(request('id'));
    $membership->status = 'approve';
    $membership->payment_date = now();
    $membership->save();
    if ($membership->payment_type == 'tunai') {
      $membership->payment_total = request('payment_total');
      $membership->payment_changes = request('payment_changes');
      $membership->save();
      return $this->invoice($membership,'Order')->with(['success' => 'Transaksi telah diterima.']);
    }
    return back()->with(['success' => 'Transaksi telah diterima.']);
  }
  public function invoice($model,$type) {
    return view('akuntan.invoice',compact('model','type'));
  }
}
