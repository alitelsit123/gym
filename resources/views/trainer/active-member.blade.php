@extends('trainer.layout')

@section('body')
@php
$packets = \App\Models\Packet::all();
@endphp
<div class="container-fluid">
  <!-- javascript behavior vertical pills -->
  <div class="row">
    <div class="col-3">
      <div class="mb-2">
        <strong>PAKET SAYA</strong>
      </div>
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        @foreach ($packets as $k => $row)
        <a class="nav-link @if($k == 0) active @endif" id="v-pills-home-{{$row->id}}-tab" data-bs-toggle="pill" href="#v-pills-home-{{$row->id}}" role="tab" aria-controls="v-pills-home-{{$row->id}}" aria-selected="true">{{$row->title}}</a>
        @endforeach
      </div>
    </div>
    <div class="col-9">

      <div class="tab-content" id="v-pills-tabContent">
        @foreach ($packets as $k => $row)
        <div class="tab-pane fade @if($k == 0) show active @endif" id="v-pills-home-{{$row->id}}" role="tabpanel" aria-labelledby="v-pills-home-{{$row->id}}-tab">
          <div class="card">
            <div class="card-body">
              <table class="table table-stripped">
                <thead>
                  <tr>
                    <th>Member</th>
                    <th>Sisa</th>
                    <th>Nutrisi</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $members = \App\Models\TrainerMember::wherePacket_id($row->id)->whereStatus('approve')->get();
                  @endphp
                  @foreach ($members as $row)
                  <tr>
                    <td>{{$row->member->name}}</td>
                    <td>{{\Carbon\Carbon::parse($row->start_date ?? date('Y-m-d'))->addDays($row->duration)->diffInDays()}} Hari</td>
                    <td>
                      <!-- labels -->
                      <div class="progress mb-1">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                      </div>
                      <button class="btn btn-sm btn-primary mb-2">Lihat Jadwal Nutrisi</button>
                      <hr />
                      <!-- labels -->
                      <div class="progress mb-1">
                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                      </div>
                      <button class="btn btn-sm btn-primary">Lihat Jadwal Latihan</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
