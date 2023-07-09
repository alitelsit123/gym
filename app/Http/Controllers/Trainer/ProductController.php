<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class ProductController extends Controller
{
  public function index() {
    return view('trainer.product');
  }
  public function addCart(Request $request, $product_id) {
    $product = Product::findOrFail($product_id);
    $order = Order::whereUser_id(auth()->id())->whereStatus('cart')->first();
    if (!$order) {
      $order = Order::create([
        'user_id' => auth()->id(),
        'status' => 'cart',
        'e_date' => null,
        'payment_date' => null,
        'payment_eot' => null,
        'gross_amount' => 0
      ]);
      $order->details()->create([
        'quantity' => 1,
        'sub_amount' => $product->price,
        'product_id' => $product->id
      ]);
    } else {
      $detail = $order->details()->whereProduct_id($product->id)->first();
      if (!$detail) {
        $order->details()->create([
          'quantity' => 1,
          'sub_amount' => $product->price,
          'product_id' => $product->id
        ]);
      }
    }

    return back()->with(['success' => 'Produk ditambah.']);
  }
  public function updateCart() {
    foreach (request('quantity') as $id => $quantity) {
      $d = OrderDetail::findOrFail($id);
      OrderDetail::whereId($id)->update(['quantity' => $quantity,'sub_amount' => $quantity * $d->product->price]);
    }
    return back()->with(['success' => 'Keranjang diupdate.']);
  }
  public function pay(Request $request) {
    $order = \App\Models\Order::whereStatus('cart')->whereUser_id(auth()->id())->first();
    if ($order && $request->image !== null && $request->hasFile('image')) {
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
      Storage::disk($disk)->putFileAs('/', $uploadedImage, '/product_payment/'.$imageName);
      $order->payment_eot = $imageName;
    }
    $order->e_date = now();
    $order->gross_amount = $order->details()->sum('sub_amount');
    $order->status = 'pending';
    $order->payment_type = $request->payment_type;
    $order->save();
    foreach (\App\Models\User::whereRole('akuntan')->get() as $rowAkuntan) {
      $rowAkuntan->notify(new \App\Notifications\ProductNotification(['model' => 'Order', 'target' => $order],'Transaksi produk baru #'.$order->id));
    }
    return back()->with(['success' => 'Pembayaran berhasil, tunggu di konfirmasi.']);
  }
  public function deleteCart($id) {
    OrderDetail::whereId($id)->delete();
    return back();
  }
}
