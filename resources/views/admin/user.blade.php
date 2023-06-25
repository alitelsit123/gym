@extends('admin.layout')

@section('body')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Manage Akun</h4>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-2">
        Tambah Akun
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('admin/user/store')}}" method="post">
                  <div class="modal-body">
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Nama Lengkap</label>
                      <input type="text" id="" name="name" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Hak Akses</label>
                      <select name="role" id="" class="form-control">
                        <option value=""></option>
                        <option value="admin">Admin</option>
                        <option value="trainer">Trainer</option>
                        <option value="akuntan">Akuntan</option>
                        <option value="member">Member</option>
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Email</label>
                      <input type="text" id="" name="email" class="form-control" placeholder="">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Password</label>
                      <input type="password" id="" name="password" class="form-control" placeholder="">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Nomor HP</label>
                      <input type="text" id="" name="phone" class="form-control" placeholder="">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Jenis Kelamin</label>
                      <select name="gender" id="" class="form-control">
                        <option value=""></option>
                        <option value="m">Laki laki</option>
                        <option value="f">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Alamat</label>
                      <textarea name="address" id="" rows="3" class="form-control w-100"></textarea>
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
     <!-- javascript behaviour -->
    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="member-tab" data-bs-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">Member</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="trainer-tab" data-bs-toggle="tab" href="#trainer" role="tab" aria-controls="trainer" aria-selected="false">Trainer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="akuntan-tab" data-bs-toggle="tab" href="#akuntan" role="tab" aria-controls="akuntan" aria-selected="false">Akuntan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="admin-tab" data-bs-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
        @include('admin.user.table-member')
      </div>
      <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab">
        @include('admin.user.table-trainer')
      </div>
      <div class="tab-pane fade" id="akuntan" role="tabpanel" aria-labelledby="akuntan-tab">
        @include('admin.user.table-akuntan')
      </div>
      <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
        @include('admin.user.table-admin')
      </div>
    </div>
  </div>
</div>
@endsection
