@php
$startDate = null;
$endDate = null;
if (request('range')) {
  $startDate = explode(' - ', request('range'))[0] ?? null;
  $startDate = \Carbon\Carbon::create(explode('/',$startDate)[2],explode('/',$startDate)[0],explode('/',$startDate)[1])->format('Y-m-d');
  $endDate = explode(' - ', request('range'))[1] ?? null;
  $endDate = \Carbon\Carbon::create(explode('/',$endDate)[2],explode('/',$endDate)[0],explode('/',$endDate)[1])->format('Y-m-d');
} else {
  $startDate = null;
  $endDate = null;
}
$totallc;
@endphp
<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 50%;
            margin: auto;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h4 style="padding-bottom:1rem;margin:auto;text-align:center;">
      TRANSAKSI MEMBERSHIP
    </h4>
    @php
    $memberships = \App\Models\Membership::when(request('range') && $startDate && $endDate, function($query) use ($startDate,$endDate) {
      $query->whereBetween('created_at',[$startDate,$endDate]);
    })->has('type')->latest()->get();
    $total = 0;
    @endphp
    <script>
      $(document).ready(function() {
        $('.tm').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
        });
      })
    </script>
    <!-- basic table -->
    <table class="table table-stripped mt-2 tm">
      <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tipe Membership</th>
            <th scope="col">Tanggal Langganan</th>
            <th scope="col">EOT</th>
            <th scope="col">Nama Membership</th>
            <th scope="col">Harga</th>
            <th scope="col">Durasi</th>
            <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($memberships as $k => $row)
        @php
        $total = $total+$row->type->price
        @endphp
        <tr>
          <th scope="row">{{$k+1}}</th>
          <th scope="row">{{$row->type->name}}</th>
          <td>{{\Carbon\Carbon::parse($row->payment_date)->format('d, F Y')}}</td>
          <td>
            <img src="{{asset('storage/eot/'.$row->payment_eot)}}" alt="" srcset="" style="width:50px;height:auto;" />
          </td>
          <td>{{$row->member->name}}</td>
          <td>Rp. {{ number_format($row->type->price) }}</td>
          <td>{{$row->duration}} {{$row->durationTypeLocal()}}</td>
          <td>
            @if ($row->status == 'approve')
            <div class="badge bg-success">{{$row->status}}</div>
            @else
            <div class="badge bg-warning">{{$row->status}}</div>
            @endif
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>

    <h4 style="padding-bottom:1rem;margin:auto;text-align:center;">
      TRANSAKSI PRODUK
    </h4>

    @php
    $order = \App\Models\Order::when(request('range'), function($query) use ($startDate,$endDate) {
      $query->whereDate('created_at', '>=',$startDate)->whereDate('created_at', '<=', $endDate);
    })->get();

    // \App\Models\Order::query()->update(['status' => 'pending']);
    @endphp
    <script>
      $(document).ready(function() {
        $('.tpp').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
        });
      })
    </script>
    <table class="table table-centered text-nowrap mb-0 tpp">
      <thead class="table-light">
        <tr>
          <th style="width:150px;">#</th>
          <th>Tanggal</th>
          <th>Produk</th>
          <th>Jumlah</th>
          <th>Total Harga</th>
          <th>Info</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($order as $row)
        @php
        $total = $total+$row->gross_amount
        @endphp
          <tr>
            <td style="width:150px;">#{{$row->id}}</td>
            <td>{{$row->created_at->format('d, F Y')}}</td>
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
              <div class="mb-1">
                <small style="display: block;">Tipe Pembayaran</small>
                <div class="badge bg-info">{{$row->payment_type ?? 'transfer'}}</div>
              </div>
              @if ($row->payment_type == 'tunai')
                @if ($row->status == 'approve')
                <div class="mb-1">
                  <small style="display: block;">Total Bayar</small>
                  <div class="badge bg-info">Rp. {{number_format($row->payment_total)}}</div>
                  <small style="display: block;">Kembalian</small>
                  <div class="badge bg-info">Rp. {{number_format($row->payment_changes)}}</div>
                </div>
                @else
                <div class="badge bg-warning">Belum Bayar</div>
                @endif
              @else
                @if ($row->payment_eot && $row->status == 'approve')
                <div class="mb-1">
                  <small style="display: block;">Eot</small>
                  <img src="{{asset('storage/product_payment/'.$row->payment_eot)}}" alt="" srcset="" style="width:50px;height:auto;" />
                </div>
                @else
                <div class="mb-1">
                  <div class="badge bg-warning  ">{{'Belum dikonfirmasi'}}</div>
                </div>
                @endif
              @endif
            </td>
            <td>
              @if ($row->status == 'approve')
              <div class="badge bg-success">{{$row->status}}</div>
              @else
              <div class="badge bg-warning">{{$row->status}}</div>
              @endif
            </td>

          </tr>
        @endforeach

      </tbody>
    </table>
    <h4 style="padding-bottom:1rem;margin:auto;text-align:center;">
      TRANSAKSI LAIN LAIN
    </h4>
    @php
    $others = \App\Models\TransactionOther::when(request('range') && $startDate && $endDate, function($query) use ($startDate,$endDate) {
      $query->whereBetween('created_at',[$startDate,$endDate]);
    })->latest()->get();
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
        $total = $total+(Str::ucfirst($row->type) == 'Membership' ? ($row->membershipType->price ?? 0):(Str::ucfirst($row->type) == 'Product' ? ($row->details()->sum('sub_amount') > 0 ? $row->details()->sum('sub_amount') ?? 0:0):0));
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
            <div class="badge bg-info">{{$row->membershipType->name ?? 'Data dihapus'}}</div>
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

    <h4 style="padding-bottom:1rem;margin:auto;text-align:center;">
      PENGELUARAN
    </h4>

    @php
    $packets = \App\Models\Expense::when(request('range'), function($query) use ($startDate,$endDate) {
      $query->whereBetween('created_at',[$startDate,$endDate]);
    })->get();
    $totalMin = 0;

    @endphp
    <script>
      $(document).ready(function() {
        $('.tp').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
        });
      })
    </script>
    <!-- basic table -->
    <table class="table table-stripped mt-2 tp">
      <thead>
        <tr>
            <th scope="col">Tanggal</th>
            <th scope="col">Nama</th>
            {{-- <th scope="col">Eot</th> --}}
            <th scope="col">Harga satuan</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
            <th scope="col">Keterangan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($packets as $k => $row)
        @php
        $totalMin = $totalMin+$row->gross_amount
        @endphp
        <tr>
          <th scope="row">{{$row->created_at->format('d, F Y')}}</th>
          <td>
            <div>{{$row->name}}</div>
          </td>
          {{-- <td>
            <img src="{{asset('storage/expense/'.$row->payment_eot)}}" alt="" srcset="" style="width:70px;height:auto;" />
          </td> --}}
          <td>Rp. {{number_format($row->price)}}</td>
          <td>{{number_format($row->quantity)}}</td>
          <td>Rp. {{number_format($row->gross_amount)}}</td>

          <td>{{$row->description}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <table>
      <tr>
        <td colspan="8">
          Total Pengeluaran: <strong>Rp. {{number_format($totalMin)}}</strong>
        </td>
      </tr>
      <tr>
        <td colspan="8">
          Total Pendapatan: <strong>Rp. {{number_format($total)}}</strong>
        </td>
      </tr>
    </table>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    window.print()
  })
</script>

</body>
</html>
