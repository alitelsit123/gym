@extends('trainer.layout')

@section('body')
@php
$specialist = \App\Models\TrainerSpecialis::get();
@endphp
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Manage Bidang Saya</h4>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-2">
        Tambah Bidang
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Bidang Saya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('trainer/specialist/store')}}" method="post">
                  <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                  <div class="modal-body">
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Nama</label>
                      <input type="text" id="" name="name" class="form-control" placeholder="Nama Bidang">
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
            <th scope="col">#</th>
            <th scope="col">Nama Bidang</th>
            <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($specialist as $k => $row)
        <tr>
          <th scope="row">{{$k+1}}</th>
          <td>{{$row->name}}</td>
          <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalu-{{$row->id}}">
              Update
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalu-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update Bidang</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="{{url('trainer/specialist/update/'.$row->id)}}" method="post">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                        <div class="modal-body">
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Nama</label>
                            <input type="text" id="" name="name" class="form-control" value="{{$row->name}}" placeholder="Nama Bidang">
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
          <a href="{{url('trainer/specialist/destroy')}}?id={{$row->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus ?');">
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
