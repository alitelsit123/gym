<!DOCTYPE html>
<html>
<head>
    <title>Print Section</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" media='screen,print'>
    <script src="{{url('/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <style>
      .membership-card {
  text-align: center;
  padding: 20px;
  background-color: #3f51b5;
  color: #fff;
  margin: 0 auto;
  border-radius: 10px;
}

.title {
  font-size: 24px;
  margin-bottom: 20px;
}

.basic-info p {
  margin: 5px;
}

.membership-info,
.packet-info {
  margin-top: 20px;
}

.section-title {
  font-size: 18px;
  margin-bottom: 10px;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

table th,
table td {
  padding: 8px;
  text-align: left;
}

table th {
  background-color: #283593;
}

table td {
  background-color: #5c6bc0;
}

table th,
table td {
  color: #fff;
}

table tr:nth-child(even) {
  background-color: #3949ab;
}

    </style>
</head>
<body>
  <div class="membership-card">
    <h3 class="title">MAHESA GYM AND FITNESS</h3>
    <table>
      <thead>
        <tr>
          <td></td>
          <td></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            @if (auth()->user()->photo)
            <img alt="avatar" src="data:image/png;base64,{{base64_encode(file_get_contents(public_path('storage/profile/'.auth()->user()->photo)))}}" class="rounded-circle" style="width: 60px;height: 60px;" />
            @else
            <img alt="avatar" src="data:image/png;base64,{{base64_encode('https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png')}}" class="rounded-circle avatar-xl" style="width: 60px;height: 60px;" />
            @endif
          </td>
          <td class="basic-info" style="text-align: right;">
            <p><strong>Name</strong> {{auth()->user()->name}}</p>
            <p><strong>Phone</strong> {{auth()->user()->phone}}</p>
            <p><strong>Gender</strong> {{auth()->user()->gender == 'm' ? 'Laki laki':'Perempuan'}}</p>
            <p><strong>Address</strong> {{auth()->user()->address}}</p>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="membership-info">
      <h4 class="section-title">Membership Information</h4>
      <table>
        <tr>
          <th>Tipe</th>
          <th>Kelas</th>
          <th>Durasi</th>
        </tr>
        @foreach (auth()->user()->memberships()->has('type')->whereStatus('approve')->get() as $row)
        <tr>
          <td>{{$row->type->name ?? ''}}</td>
          <td>{{$row->type->class}}</td>
          <td>{{$row->duration}} {{$row->durationTypeLocal()}}</td>
        </tr>
        @endforeach
      </table>
    </div>
    <div class="packet-info">
      <h4 class="section-title">Packet Information</h4>
      <table>
        <tr>
          <th>Paket</th>
          <th>Trainer</th>
          <th>Durasi</th>
          <th>Jumlah Pertemuan</th>
        </tr>
        @foreach (auth()->user()->packetMembers()->has('packet')->whereStatus('approve')->get() as $row)
        <tr>
          <td>{{$row->packet->title}}</td>
          <td>{{$row->packet->trainer->name}}</td>
          <td>{{$row->duration}}</td>
          <td>{{$row->packet->meet_count}}x</td>
        </tr>
        @endforeach
      </table>
    </div>
  </div>

</body>
<script>
// window.onfocus = function () { window.close(); }
$(document).ready(function () {
  // window.print()
})
</script>
</html>
