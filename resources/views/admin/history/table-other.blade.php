@php
$others = \App\Models\TransactionOther::when(request('range') && $startDate && $endDate, function($query) use ($startDate,$endDate) {
  $query->whereBetween('created_at',[$startDate,$endDate]);
})->latest()->get();
$total = 0;
@endphp
<script>
  $(document).ready(function() {
    $('.to').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
  })
</script>
<!-- basic table -->
<table class="table table-stripped mt-2 to">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Nama</th>
        <th scope="col">Nomor HP</th>
        <th scope="col">EOT</th>
        <th scope="col">Jenis</th>
        <th scope="col">Informasi</th>
        <th scope="col">Transaksi</th>
        <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($others as $k => $row)
    @php
    $total = $total+(Str::ucfirst($row->type) == 'Membership' ? ($row->membershipType->price ?? 'Data dihapus'):(Str::ucfirst($row->type) == 'Product' ? ($row->details()->sum('sub_amount') > 0 ? $row->details()->sum('sub_amount') ?? 0:0):0));
    @endphp
    {{-- @dd($row->toArray()) --}}
    <tr>
      <th scope="row">{{$k+1}}</th>
      <th>{{$row->created_at->format('d, F Y')}}</th>
      <th scope="row">{{$row->name}}</th>
      <th scope="row">{{$row->phone}}</th>
      {{-- <td>{{\Carbon\Carbon::parse($row->payment_date)->format('d, F Y')}}</td> --}}
      <td>
        @if ($row->payment_type == 'tunai')
        <div class="badge bg-info">Bayar Tunai</div>
        @else
        <img src="{{asset('storage/eot/'.$row->payment_eot)}}" alt="" srcset="" style="width:50px;height:auto;" />
        @endif
      </td>
      <td>{{$row->type}}</td>
      <td>
        @if ($row->type == 'membership')
        <div class="badge bg-info">{{$row->membershipType->name}}</div>
        @endif
        @if ($row->type == 'product')
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
          @if ($row->details->count() > 0)
          <div class="badge bg-info">Rp {{number_format($row->details()->sum('sub_amount'))}}</div>
          @endif


        @endif
      </td>
      <td>

      </td>
      <td>
        @if ($row->status == 'approve')
        Sudah lunas
        @else
        Belum Lunas
        @endif
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
<!-- basic table -->
<table>
  <tr>
    <td colspan="8">
      Total Pendapatan: <strong>Rp. {{number_format($total)}}</strong>
    </td>
  </tr>
</table>
