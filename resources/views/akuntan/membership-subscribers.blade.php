@extends('akuntan.layout')

@section('body')
@php
$memberships = \App\Models\Membership::has('type')->whereMembership_type_id(request('id'))->whereStatus('approve')->get();
@endphp
<div class="card">
  <div class="card-body">
    <div class="">
      <h4>Membership Subscribers</h4>
      <div class="alert alert-info">
        <strong>Catatan</strong>
        <small style="display: block;">*Status akan terganti "kedaluarsa" jika durasi habis.</small>
      </div>
    </div>
    <!-- basic table -->
    <table class="table table-stripped mt-2">
      <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Tipe</th>
            <th scope="col">Kelas</th>
            <th scope="col">Durasi</th>
            <th scope="col">Berakhir</th>
            {{-- <th scope="col">#</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($memberships as $k => $row)
        <tr>
          <td>
            <div>{{$row->member->name}}</div>
          </td>
          <td>{{$row->type->name}}</td>
          <td>{{$row->type->class}}</td>
          <td>{{$row->duration}} {{$row->durationTypeLocal()}}</td>
          <td>
            @php
            $duration = null;
            if ($row->durationTypeLocal() == 'hari') {
              $duration = \Carbon\Carbon::parse($row->start_date)->addDays($row->duration);
            } else if($row->durationTypeLocal() == 'minggu') {
              $duration = \Carbon\Carbon::parse($row->start_date)->addWeeks($row->duration);
            } else {
              $duration = \Carbon\Carbon::parse($row->start_date)->addMonths($row->duration);
            }
            @endphp
            @if ($duration->format('Y-m-d-H-i-s') < \Carbon\Carbon::now()->format('Y-m-d-H-i-s'))
            <div class="badge bg-danger">Kedaluarsa</div>
            @else
            <div class="badge bg-secondary">{{$duration->locale('id')->diffForHumans()}}</div>
            @endif
          </td>
          {{-- <td>
          <a href="{{url('akuntan/membership/destroy_membership')}}?id={{$row->id}}" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Yakin ingin hapus ?');">
            Akhiri
          </a>
          </td> --}}
        </tr>
        @endforeach
      </tbody>
    </table>
    <!-- basic table -->
  </div>
</div>
@endsection
