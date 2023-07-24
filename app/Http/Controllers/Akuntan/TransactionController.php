<?php

namespace App\Http\Controllers\Akuntan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Models\Membership;
use App\Models\TrainerMember;
use App\Models\Order;
use App\Models\TransactionOther;
use App\Models\TransactionOtherDetail;

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
      $membership->decrementProduct();
      return $this->invoice($membership,'Order')->with(['success' => 'Transaksi telah diterima.']);
    }
    $membership->decrementProduct();
    $membership->user->notify(new \App\Notifications\ProductNotification(['model' => 'Order', 'target' => $membership],'Transaksi produk #'.$membership->id.' sudah diverifikasi'));
    return back()->with(['success' => 'Transaksi telah diterima.']);
  }
  public function invoice($model,$type) {
    return view('akuntan.invoice',compact('model','type'));
  }
  public function invoiceOther($model,$type) {
    return view('invoice-other',compact('model','type'));
  }
  public function storeTxManual() {
    $tx = new TransactionOther;
    $tx->name = request('name');
    $tx->phone = request('phone');
    $tx->type = request('type');
    $tx->payment_type = request('payment_type');
    if (request('type') == 'membership') {
      $tx->membership_type_id = request('membership_type');
    }
    $tx->payment_type = request('payment_type');
    if (request()->payment_eot !== null && request()->hasFile('payment_eot')) {
      request()->validate([
        'payment_eot' => 'required|image', // Adjust the validation rules as needed
      ]);
      // Retrieve the uploaded file
      $uploadedImage = request()->file('payment_eot');

      // Generate a unique name for the file
      $imageName = time().'.'.$uploadedImage->extension();

      // Specify the storage disk where you want to store the image (e.g., "public")
      $disk = 'public';

      // Store the image in the specified disk and directory
      Storage::disk($disk)->putFileAs('/', $uploadedImage, '/eot/'.$imageName);
      $tx->payment_eot = $imageName;
    }

    $tx->save();

    if (request('type') == 'product') {
      foreach (request('product') as $key => $value) {
        if (request('product')[$key] !== null) {
          $product = \App\Models\Product::find(request('product')[$key]);
          TransactionOtherDetail::create([
            'quantity' => request('quantity')[$key],'sub_amount' => request('quantity')[$key] * $product->price,'product_id' => $product->id,'order_id' => $tx->id
          ]);
        }
      }
      $tx->gross_amount = $tx->details()->sum('sub_amount');
    }
    return back()->with(['success' => 'Berhasil disimpan.']);
  }
  public function approvedPaymentOther() {
    $membership = TransactionOther::findOrFail(request('id'));
    $membership->status = 'approve';
    $membership->payment_approved = now();
    $membership->save();
    if ($membership->payment_type == 'tunai') {
      $membership->gross_amount = request('payment_total');
      $membership->payment_changes = request('payment_changes');
      $membership->save();
      $membership->decrementProduct();
      return $this->invoiceOther($membership,$membership->type)->with(['success' => 'Transaksi telah diterima.']);
    }
    $membership->decrementProduct();
    // $membership->user->notify(new \App\Notifications\ProductNotification(['model' => 'Membership', 'target' => $membership],'Transaksi #'.$membership->id.' sudah diverifikasi anda telah berlangganan '.$membership->type->name));
    return back()->with(['success' => 'Transaksi telah diterima.']);
  }
}
