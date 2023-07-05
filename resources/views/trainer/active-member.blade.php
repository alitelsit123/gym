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
        <a class="nav-link @if($k == 0) active @endif d-flex align-items-center justify-content-between" id="v-pills-home-{{$row->id}}-tab" data-bs-toggle="pill" href="#v-pills-home-{{$row->id}}" role="tab" aria-controls="v-pills-home-{{$row->id}}" aria-selected="true">
          <span>{{$row->title}}</span>
          <span class="badge bg-danger ml-auto">{{$row->trainerMembers()->whereStatus('approve')->count()}}</span>
        </a>
        @endforeach
      </div>
    </div>
    <div class="col-9">

      <div class="tab-content" id="v-pills-tabContent">
        @foreach ($packets as $k => $row)
        <div class="tab-pane fade @if($k == 0) show active @endif" id="v-pills-home-{{$row->id}}" role="tabpanel" aria-labelledby="v-pills-home-{{$row->id}}-tab">
          <div class="card">
            <div class="card-header"><h4 class="m-0">{{$row->title}}</h4></div>
            <div class="card-body">
              <table class="table table-stripped">
                <thead>
                  <tr>
                    <th>Member</th>
                    <th>Sisa</th>
                    <th>Jadwal</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $members = \App\Models\TrainerMember::wherePacket_id($row->id)->whereStatus('approve')->get();
                  @endphp
                  @foreach ($members as $row)
                  <tr>
                    <td>{{$row->member->name}}</td>
                    <td>
                      {{\Carbon\Carbon::parse($row->start_date ?? date('Y-m-d'))->addDays($row->duration)->diffInDays()}} Hari
                      <br />
                      <span @if(($row->packet->meet_count - $row->absent()->count()) <= 0) style="color:red;" @endif>Pertemuan {{$row->packet->meet_count - $row->absent()->count()}}x</span>
                    </td>
                    <td>
                      @if (($row->packet->meet_count - $row->absent()->count()) <= 0)
                      <a class="btn btn-sm btn-danger" href="{{url('trainer/member/destroy_member/'.$row->id)}}" onclick="return confirm('Yakin ingin menyelesaikan latihan ?')">Selesai latihan</a>
                      @else
                      <a class="btn btn-sm btn-primary mb-2" target="_blank" href="{{url('trainer/member/schedule-nutrition/'.$row->id)}}">Lihat Jadwal Nutrisi</a>
                      <hr />
                      <a class="btn btn-sm btn-primary mb-2" target="_blank" href="{{url('trainer/member/schedule-exercise/'.$row->id)}}">Lihat Jadwal Latihan</a>
                      @endif
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
