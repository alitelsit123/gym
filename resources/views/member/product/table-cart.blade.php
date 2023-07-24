@php
$order = \App\Models\Order::whereStatus('cart')->whereUser_id(auth()->id())->first();
@endphp
<table class="table table-centered text-nowrap mb-0">
  <thead class="table-light">
    <tr>

      <th>Gambar</th>
      <th>Produk</th>
      <th>Sub Harga</th>
      <th style="width: 200px;">Jumlah</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @if ($order)
      @foreach ($order->details as $row)
        <tr @if(in_array($row->id, $cantCheckoutIds)) style="background-color:rgba(255, 0, 0, 0.248);" @endif>
          <td>
            <img src="{{asset('storage/product/'.$row->product->image)}}" alt="" srcset="" style="width: 100px;height: auto;"> <br />
          </td>
          <td><strong>{{$row->product->name}}</strong></td>
          <td>Rp. {{number_format($row->product->price)}}</td>
          <td style="width: 200px;">
            <input type="number" name="quantity[{{$row->id}}]" id="" class="form-control" value="{{$row->quantity}}" />
            <div><i>Sisa {{$row->product->stock ?? 0}}</i></div>
          </td>
          <td>
            <a href="{{url('member/product/delete_cart/'.$row->id)}}" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip" data-template="trashOne">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon-xs"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
              <div id="trashOne" class="d-none">
                <span>Delete</span>
              </div>
            </a>
          </td>
        </tr>
      @endforeach
      <tr>
        <tr>
          <td colspan="3"></td>
          <td colspan="2" class="text-right d-flex align-items-end justify-content-end w-100">
            <strong class="ml-auto">Total: Rp. {{number_format($order->details()->sum('sub_amount') )}}</strong>
          </td>
        </tr>
      </tr>
    @else
    <tr>
      <td colspan="5">Belum ada produk di keranjang</td>
    </tr>
    @endif
  </tbody>
</table>
