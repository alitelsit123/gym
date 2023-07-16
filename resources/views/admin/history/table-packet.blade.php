@php
$packets = \App\Models\Expense::when(request('range'), function($query) use ($startDate,$endDate) {
  $query->whereBetween('created_at',[$startDate,$endDate]);
})->get();
$total = 0;

@endphp
<!-- basic table -->
<table class="table table-stripped mt-2">
  <thead>
    <tr>
        {{-- <th scope="col">#</th> --}}
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
    $total = $total+$row->gross_amount
    @endphp
    <tr>
      {{-- <th scope="row">{{$row->code}}</th> --}}
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
    <tr>
      <td>
        Total Pengeluaran: <strong>Rp. {{number_format($total)}}</strong>
      </td>
    </tr>
  </tbody>
</table>
