@php
$memberships = \App\Models\TrainerMember::whereStatus('pending')->latest()->get();
@endphp
<!-- basic table -->
<table class="table table-stripped mt-2">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Paket</th>
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
    <tr>
      <th scope="row">{{$k+1}}</th>
      <th scope="row">{{$row->packet->title}}</th>
      <td>{{\Carbon\Carbon::parse($row->payment_date)->format('d, F Y')}}</td>
      <td>
        <img src="{{asset('storage/eot/'.$row->payment_eot)}}" alt="" srcset="" style="width:50px;height:auto;" />
      </td>
      <td>{{$row->member->name}}</td>
      <td>Rp. {{ number_format($row->packet->price) }}</td>
      <td>{{$row->duration}} Hari</td>
      <td><a href="{{url('akuntan/approved_payment_packet?id='.$row->id)}}" onclick="return confirm('Approve Transaksi ?')" class="btn btn-sm btn-success">Approve</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
<!-- basic table -->
