<?php

namespace App\Http\Controllers\Akuntan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Membership;
use App\Models\TrainerMember;

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
}
