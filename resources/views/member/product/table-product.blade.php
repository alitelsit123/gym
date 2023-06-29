@php
$categories = \App\Models\Product::groupBy('category')->select('category')->get();
$order = \App\Models\Order::whereStatus('cart')->whereUser_id(auth()->id())->first();
@endphp
<style>
  .flex-scroll-x {
    white-space: nowrap!important;
    flex-wrap: nowrap!important;
  }
  #style-2::-webkit-scrollbar-track
  {
    /* -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); */
    border-radius: 12px;
    background-color: #F5F5F5;
  }

  #style-2::-webkit-scrollbar
  {
    height: 3px!important;
    background-color: #F5F5F5;
  }

  #style-2::-webkit-scrollbar-thumb
  {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #624bff;
  }
</style>
<div class="p-4 pb-0">
  <ul class="nav nav-pills flex-scroll-x pb-3" style="overflow-x: auto;display:flex!important;" id="style-2">
    @foreach ($categories as $k => $row)
    <li class="nav-item">
      <a class="nav-link @if($k == 0) active @endif" data-bs-toggle="pill" href="#{{str_replace(' ','-',$row->category)}}" role="tab" aria-current="page">{{ucwords($row->category)}}</a>
    </li>
    @endforeach
  </ul>
</div>
<div class="tab-content p-4" id="pills-tabContent">
  @foreach ($categories as $k => $rowCategory)
  <div class="tab-pane fade @if($k === 0) show active @endif" id="{{str_replace(' ', '-',$rowCategory->category)}}" role="tabpanel" aria-labelledby="{{str_replace(' ', '-',$rowCategory->category)}}-tab">
    <div class="table-responsive table-card">
      <table class="table table-centered text-nowrap mb-0">
        <thead class="table-light">
          <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php
          $products = \App\Models\Product::where('category',$rowCategory->category)->get();
          @endphp
          @foreach ($products as $row)
          <tr>
            <td>
              <img src="{{asset('storage/product/'.$row->image)}}" alt="" srcset="" style="width: 100px;height: auto;"> <br />
            </td>
            <td><strong>{{$row->name}}</strong></td>
            <td>Rp. {{number_format($row->price)}}</td>
            <td>
              @if (!$order || ($order && $order->details()->whereProduct_id($row->id)->first() === null))
              <form action="{{url('member/product/add_cart/'.$row->id)}}" method="post">
                <button type="submit" href="" class="btn btn-primary btn-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="" style="width: 18px;height:18px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg>
                  <span>Keranjang</span>
                </button>
              </form>
              @else
              <strong>Sudah di keranjang</strong>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endforeach
</div>
