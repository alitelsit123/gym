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
    return back()->with(['success' => 'Transaksi telah diterima.']);
  }
  public function approvedPaymentPacket() {
    $membership = TrainerMember::findOrFail(request('id'));
    $membership->status = 'approve';
    $membership->payment_approved = now();
    $membership->save();
    return back()->with(['success' => 'Transaksi telah diterima.']);
  }
  public function approvedPaymentProduct() {
    $membership = Order::findOrFail(request('id'));
    $membership->status = 'approve';
    $membership->payment_date = now();
    $membership->save();
    return back()->with(['success' => 'Transaksi telah diterima.']);
  }
}
