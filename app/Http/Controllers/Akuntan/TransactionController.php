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
    $membership->user->notify(new \App\Notifications\ProductNotification(['model' => 'Membership', 'target' => $membership],'Transaksi #'.$membership->id.' sudah diverifikasi anda telah berlangganan '.$membership->type->name));
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
    $membership->user->notify(new \App\Notifications\ProductNotification(['model' => 'TrainerMember', 'target' => $membership],'Transaksi #'.$membership->code.' sudah diverifikasi anda telah berlangganan '.$membership->packet->title));
    $membership->packet->trainer->notify(new \App\Notifications\ProductNotification(['model' => 'TrainerMember', 'target' => $membership],$membership->user->name.' telah bergabung ke kelas '.$membership->packet->title));
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
    $membership->user->notify(new \App\Notifications\ProductNotification(['model' => 'Order', 'target' => $membership],'Transaksi produk #'.$membership->id.' sudah diverifikasi'));
    return back()->with(['success' => 'Transaksi telah diterima.']);
  }
  public function invoice($model,$type) {
    return view('akuntan.invoice',compact('model','type'));
  }
}
