@extends('trainer.layout')

@section('body')
@php
$schedule = \App\Models\ScheduleExercise::whereTrainer_member_id($member->id)->get();
@endphp
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Manage Jadwal Latihan {{$member->member->name}}</h4>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-2">
        Tambah Jadwal
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('trainer/member/store_exercise')}}" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="trainer_member_id" value="{{$member->id}}" />
                  <input type="hidden" name="user_id" value="{{$member->member_id}}" />
                  <input type="hidden" name="packet_id" value="{{$member->packet_id}}" />
                  <div class="modal-body">
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Hari</label>
                      <select name="daym" id="" class="form-control">
                        <option value="">-- Pilih Hari --</option>
                        @foreach (['minggu','senin','selasa','rabu','kamis','jumat','sabtu'] as $i => $rowD)
                        <option value="{{$i}}">{{$rowD}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Keterangan</label>
                      <textarea name="description" id="" rows="3" class="form-control w-100"></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    <!-- basic table -->
    <table class="table table-stripped mt-2">
      <thead>
        <tr>
            <th scope="col">Hari</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jadwal Minggu ini</th>
            <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($schedule as $k => $row)
        @php
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        // dd($startOfWeek->locale('id')->isoFormat('dddd'));
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek();
        @endphp
        <tr>
          <th scope="row">
            {{$startOfWeek->subDays(1)->addDays($row->daym)->locale('id')->isoFormat('dddd')}}
          </th>
          <td>{{$row->description}}</td>
          @php
          $startOfWeek = \Carbon\Carbon::now()->startOfWeek()->subDays(1);
          $dIso = $startOfWeek->addDays($row->daym == 0 ? 7:$row->daym)->locale('id');
          @endphp
          <td>{{$dIso->isoFormat('DD, MMMM YYYY')}}</td>
          <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$row->id}}">
              Update
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{$row->id}}" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update Jadwal</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="{{url('trainer/member/update_exercise')}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="schedule_id" value="{{$row->id}}" />
                        <div class="modal-body">
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Hari</label>
                            <select name="daym" id="" class="form-control">
                              <option value="">-- Pilih Hari --</option>
                              @foreach (['minggu','senin','selasa','rabu','kamis','jumat','sabtu'] as $i => $rowD)
                              <option value="{{$i}}" @if($row->daym == $i) selected @endif>{{$rowD}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Keterangan</label>
                            <textarea name="description" id="" rows="3" class="form-control w-100">{{$row->description  }}</textarea>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                  </div>
              </div>
            </div>
          </div>
          <!-- Button trigger modal -->
          <a href="{{url('trainer/member/destroy_exercise')}}?id={{$row->id}}" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Yakin ingin hapus ?');">
            Hapus
          </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <!-- basic table -->
  </div>
</div>
@endsection
