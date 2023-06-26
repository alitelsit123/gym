@php
$packets = \App\Models\TrainerMember::whereMember_id(auth()->user()->id)->latest()->get();
@endphp
<!-- basic table -->
<table class="table table-stripped mt-2">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Tanggal Langganan</th>
        <th scope="col">Harga</th>
        <th scope="col">Durasi</th>
        <th scope="col">Status</th>
        <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($packets as $k => $row)
    <tr>
      <th scope="row">{{$k+1}}</th>
      <td>{{\Carbon\Carbon::parse($row->payment_date)->format('d, F Y')}}</td>
      <td>Rp. {{ number_format($row->packet->price) }}</td>
      <td>{{$row->duration}} {{$row->duration_type}}</td>
      <td>
        @if ($row->status == 'approve')
        <div class="badge bg-success">{{$row->status}}</div>
        @else
        <div class="badge bg-warning">{{$row->status}}</div>
        @endif
      </td>
      <td>
        @if ($row->status == 'pending')
        <div class="badge bg-warning">Menunggu verifikasi</div>
        @elseif($row->status == 'approve')
        <div class="badge bg-success">Terverifikasi</div>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<!-- basic table -->
