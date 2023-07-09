@php
$order = \App\Models\Order::where('status', '<>', 'cart')->whereUser_id(auth()->id())->get();
@endphp
<table class="table table-centered text-nowrap mb-0">
  <thead class="table-light">
    <tr>
      <th>#</th>
      <th>Produk</th>
      <th>Jumlah</th>
      <th>Total Harga</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($order as $row)
      <tr>
        <td>#{{$row->id}}</td>
        <td style="width:300px;">
          <div class="d-flex items-center">
            @forelse ($row->details()->take(2)->get() as $rowDetail)
            <div>
              <div class="d-flex flex-column" style="margin-right:1rem;">
                <img src="{{asset('storage/product/'.$rowDetail->product->image)}}" alt="" srcset="" style="width: 50px;height: auto;" />
                <div>{{Str::limit($rowDetail->product->name,50,'...')}} x{{$rowDetail->quantity}}</div>
              </div>
            </div>
            @empty
            (Produk dihapus)
            @endforelse
          </div>
          @if ($row->details->count() > 2)
          <button type="button" class="btn btn-sm btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$row->id}}" style="display: block;">+ {{$row->details->count() - 2}} Produk</button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-stripped">
                        @foreach ($row->details()->skip(2)->take($row->details->count() - 2)->get() as $rowDetail)
                          <tr>
                            <td>
                              <img src="{{asset('storage/product/'.$rowDetail->product->image)}}" alt="" srcset="" style="width: 100px;height: auto;"> <br />
                            </td>
                            <td>
                              <strong>{{$rowDetail->product->name}}</strong>
                              <div>Rp. {{number_format($rowDetail->sub_amount)}}</div>
                              <div>Jumlah {{$rowDetail->quantity}}</div>
                            </td>
                          </tr>
                        @endforeach
                      </table>
                    </div>
                </div>
            </div>
          </div>
          @endif
        </td>
        <td>{{$row->details()->sum('quantity')}}</td>
        <td>Rp. {{number_format($row->details()->sum('sub_amount'))}}</td>
        <td>
          @if ($row->status == 'pending')
          <div class="badge bg-warning">Menunggu verifikasi</div>
          @else
          <div class="badge bg-success">{{$row->status}}</div>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
