@php
$others = \App\Models\TransactionOther::when(request('range') && $startDate && $endDate, function($query) use ($startDate,$endDate) {
  $query->whereBetween('created_at',[$startDate,$endDate]);
})->latest()->get();
$memberships = \App\Models\Membership::when(request('range') && $startDate && $endDate, function($query) use ($startDate,$endDate) {
  $query->whereBetween('created_at',[$startDate,$endDate]);
})->has('type')->latest()->get();
$packets = \App\Models\Expense::when(request('range'), function($query) use ($startDate,$endDate) {
  $query->whereBetween('created_at',[$startDate,$endDate]);
})->get();
$order = \App\Models\Order::when(request('range'), function($query) use ($startDate,$endDate) {
  $query->whereDate('created_at', '>=',$startDate)->whereDate('created_at', '<=', $endDate);
})->get();
$merged = [];
foreach ($others as $row) {
  $row->in_type = 'plus';
  $row->ket = 'Pembelian '.$row->type;
  $row->type = 'other';
  $merged[] = $row;
}
foreach ($memberships as $row) {
  $row->in_type = 'plus';
  $row->name = $row->type->name;
  $row->ket = 'Pembelian paket membership';
  $row->gross_amount = $row->payment_total;
  $row->type = 'membership';
  $merged[] = $row;
}
foreach ($packets as $row) {
  $row->in_type = 'minus';
  $row->ket = 'Pengeluaran ('.$row->name.')';
  $row->type = 'expense';
  $merged[] = $row;
}
foreach ($order as $row) {
  $row->in_type = 'plus';
  $row->name = $row->details()->with(['product'])->get()->pluck('product')->pluck(['name']);
  $row->ket = 'Pembelian produk';
  $row->type = 'product';
  $merged[] = $row;
}
$total = 0;
@endphp
<script>
  $(document).ready(function() {
    $('.tos').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
  })
</script>
<!-- basic table -->
<table class="table table-stripped mt-2 tos">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Nama</th>
        <th scope="col">EOT</th>
        <th scope="col">Informasi</th>
        <th scope="col">Transaksi</th>
        <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($merged as $k => $row)
    @php
    $total = $total+(Str::ucfirst($row->type) == 'Membership' ? ($row->membershipType->price ?? 0):(Str::ucfirst($row->type) == 'Product' ? ($row->details()->sum('sub_amount') > 0 ? $row->details()->sum('sub_amount') ?? 0:0):0));
    @endphp
    {{-- @dd($row->toArray()) --}}
    <tr>
      <td scope="row">{{$k+1}}</td>
      <td>{{$row->created_at->format('d, F Y')}}</td>
      <td scope="row">
        @if ($row->type != 'membership')
        {{$row->user->name ?? $row->member->name ?? $row->name ?? 'admin'}}<br />
        @elseif($row->type == 'other')
        {{$row->name}}<br />

        @endif
        @if ($row->phone || ($row->user && $row->user->phone) || ($row->member && $row->member->phone))
        <div class="badge bg-secondary">
          {{$row->phone ?? $row->user->phone ?? $row->member->phone ?? ''}}
        </div>
        @endif
      </td>
      {{-- <td>{{\Carbon\Carbon::parse($row->payment_date)->format('d, F Y')}}</td> --}}
      <td>
        @if ($row->payment_type == 'tunai')
        <div class="badge bg-info">Bayar Tunai</div>
        @else
        <img src="{{asset('storage/eot/'.$row->payment_eot)}}" alt="" srcset="" style="width:50px;height:auto;" />
        @endif
      </td>
      <td>{{$row->ket}}</td>
      <td>
        @if ($row->type == 'expense')
        <div class="badge bg-info">Rp. {{number_format($row->gross_amount)}}</div>
        @endif
        @if ($row->type == 'membership')
        <div class="badge bg-info">{{$row->membershipType->name ?? 'Data dihapus'}}</div>
        <div class="badge bg-info">Rp. {{number_format($row->gross_amount)}}</div>
        @endif
        @if ($row->type == 'product' || ($row->type == 'other' && $row->details()->first() ))
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
