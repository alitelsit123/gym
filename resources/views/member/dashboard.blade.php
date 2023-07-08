@extends('member.layout')

@section('body')
  <div class="app-content-area">
    <div class="mx-n4"></div>
      @php
      $existingMembershipPending = \App\Models\Membership::whereUser_id(auth()->user()->id)->whereStatus('pending')->first();
      @endphp
      @if ($existingMembershipPending)
      {{-- <div class="alert alert-warning"></div> --}}
      @endif
      <div class="bg-primary rounded-3">
        <div class="row mb-5 ">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="p-6 d-lg-flex justify-content-between align-items-center ">
              <div class="d-md-flex align-items-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" alt="Image" class="rounded-circle bg-light avatar avatar-xl">
                <div class="ms-md-4 mt-3 mt-md-0 lh-1">
                  <h3 class="text-white mb-0">Hallo, {{auth()->user()->name}}</h3>
                  <small class="text-white">Selamat Pagi</small>
                </div>
              </div>
              <div class="d-none d-lg-block">
                {{-- <a href="#!" class="btn btn-white">What’s New!</a> --}}
              </div>
            </div>

          </div>
        </div>
      </div>
      <div>
        <h4 class="mb-3">Membership</h4>
        @php
        $userMemberships = auth()->user()->memberships()->has('type')->whereStatus('approve')->get();
        @endphp
        <div class="row mb-4">
          @foreach ($userMemberships as $row)
          <div class="col-md-4">
            <div class="card bg-primary card-outlined">
              <div class="card-body">
                <h4 class="btn-block font-weight-bold text-white"><strong>{{$row->type->name}}</strong> {{$row->type->class}}</h4>
                @php
                $duration = null;
                if ($row->durationTypeLocal() == 'hari') {
                  $duration = \Carbon\Carbon::parse($row->start_date)->addDays($row->duration);
                } else if($row->durationTypeLocal() == 'minggu') {
                  $duration = \Carbon\Carbon::parse($row->start_date)->addWeeks($row->duration);
                } else {
                  $duration = \Carbon\Carbon::parse($row->start_date)->addMonths($row->duration);
                }
                if ($duration->format('Y-m-d-H-i-s') < \Carbon\Carbon::now()->format('Y-m-d-H-i-s')) {
                  $row->status = 'expired';
                  $row->save();
                }
                @endphp
                <small class="d-block text-white" style="font-style: italic;">*Berakhir {{$duration->locale('id')->diffForHumans()}}</small>
              </div>
            </div>
          </div>
          @endforeach
          @if ($userMemberships->count() == 0)
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                Belum langganan membership
              </div>
            </div>
          </div>
          @endif
        </div>
        @php
        $currentDay = \Carbon\Carbon::now()->dayOfWeek;
        $nutritions = \App\Models\ScheduleNutrition::whereUser_id(auth()->id())->get();
        @endphp
        <h4 class="mb-3">Jadwal Nutrisi</h4>
        <div class="row">
          @forelse ($nutritions as $row)
          <div class="col-md-4">
            @php
            $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
            @endphp
            <div class="card w-100">
              <div style="position:relative;">
                <img style="width:100%;height:auto;opacity:.2" src="https://s30386.pcdn.co/wp-content/uploads/2020/02/p1bm5844cb6oacnd1std183s12gt6.jpg.optimal.jpg" class="rounded" alt="...">
                <h3 class="p-2 text-center" style="position:absolute;width:100%;height:100%;left:0;top:0;display:flex;align-items:center;justify-content:center;">
                  <strong>
                    {{$startOfWeek->subDays(1)->addDays($row->daym)->locale('id')->isoFormat('dddd')}}</h5>
                  </strong>
                </h3>
              </div>
              <div class="card-body">
                <small>{!!str_replace("\r\n", '<hr />', $row->description)!!}</small>
              </div>
            </div>
          </div>
          @empty
          <div class="card">
            <div class="card-body">Belum ada Jadwal</div>
          </div>
          @endforelse
        </div>

        <h4 class="my-3 mt-4">Jadwal Latihan</h4>
        @php
        $currentDay = \Carbon\Carbon::now()->dayOfWeek;
        $exercises = \App\Models\ScheduleExercise::has('packet')->whereUser_id(auth()->id())->get();
        $daysEx = [];
        @endphp
        <div class="card">
          <div class="card-body">
            <table class="table table-stripped w-100">
              <thead>
                <tr>
                  <th>#Paket</th>
                  <th>Hari</th>
                  <th>Latihan</th>
                  <th style="width: 150px;">#</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($exercises as $row)
                @php
                $startOfWeek = \Carbon\Carbon::now()->startOfWeek()->subDays(1);
                $dIso = $startOfWeek->addDays($row->daym == 0 ? 7:$row->daym)->locale('id')->isoFormat('dddd');
                @endphp
                <tr>
                  <td>{{$row->packet->title}}</td>
                  <td>{{$dIso}}</td>
                  @php
                  $daysEx[] = $dIso;
                  @endphp
                  <td>{{$row->description}}</td>
                  <td>
                    @php
                    $currentWeekAlreadyAbsent = \App\Models\AbsentExercise::whereUser_id(auth()->id())->whereSchedule_exercise_id($row->id)->where(function($query) {
                      $query->whereDay('created_at',\Carbon\Carbon::now()->day)->whereMonth('created_at',\Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year);
                    })->first();
                    @endphp
                    @if (!$currentWeekAlreadyAbsent)
                    <form action="{{url('member/absent_exercise')}}" method="post" class="e-absent-{{$row->id}}">
                      <input type="hidden" name="user_id" value="{{auth()->id()}}" />
                      <input type="hidden" name="trainer_id" value="{{$row->packet->id}}" />
                      <input type="hidden" name="trainer_member_id" value="{{$row->trainer_member_id}}" />
                      <input type="hidden" name="packet_id" value="{{$row->packet_id}}" />
                      <input type="hidden" name="schedule_exercise_id" value="{{$row->id}}" />
                      <button type="submit" class="btn btn-primary btn-sm">Absent</button>
                    </form>
                    @else
                    <div class="badge bg-success">Sudah Absent</div>
                    @endif
                  </td>
                </tr>
                <script>
                  $(document).ready(function() {
                    $('.e-absent-{{$row->id}}').submit(function(e) {
                      e.preventDefault();
                      const currentForm = $(this)
                      Swal.fire({
                        title: 'Konfirmasi ?',
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Absent',
                      }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                          const cloned = currentForm.clone().css('display','none')
                          $('body').append(cloned)
                          cloned.submit()
                          cloned.remove()
                        }
                      })
                    })
                  })
                </script>
                @empty
                <tr colspan="4">
                  <td>Belum ada latihan</td>
                </tr>
                @endforelse
                @if ($exercises->count() > 0)
                <tr>
                  <td colspan="4">
                    <div class="alert alert-info">
                      <strong>Selain hari {{ucfirst(implode(', ', $daysEx))}} silahkan latihan sendiri.</strong>
                    </div>
                  </td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
