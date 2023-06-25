@extends('admin.layout')

@section('body')
@php
$memberships = \App\Models\MembershipType::get();
@endphp
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Manage Jenis Anggota</h4>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-2">
        Tambah Jenis Member
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Jenis Membership</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('admin/membership/store')}}" method="post">
                  <div class="modal-body">
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Tipe</label>
                      <input type="text" id="" name="name" class="form-control" placeholder="Nama Tipe">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Harga Harian</label>
                      <input type="number" id="" name="price_daily" class="form-control" placeholder="">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Harga Mingguan</label>
                      <input type="number" id="" name="price_weekly" class="form-control" placeholder="">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Harga Bulanan</label>
                      <input type="number" id="" name="price_monthly" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                      <label class="form-label" for="">Keterangan</label>
                      <textarea name="description" id="" style="width:100%" class="form-control" rows="3"></textarea>
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
            <th scope="col">Jenis Member</th>
            <th scope="col">Harga</th>
            <th scope="col">Keterangan</th>
            <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($memberships as $k => $row)
        <tr>
          <th scope="row">{{$k+1}}</th>
          <td>{{$row->name}}</td>
          <td>
            <div class="badge bg-info">Rp. {{number_format($row->price_daily)}} / Hari</div><br />
            <div class="badge bg-info">Rp. {{number_format($row->price_weekly)}} / Minggu</div><br />
            <div class="badge bg-info">Rp. {{number_format($row->price_monthly)}} / Bulan</div>
          </td>
          <td>{{$row->description}}</td>
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
                          <h5 class="modal-title" id="exampleModalLabel">Update Jenis Membership</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="{{url('admin/membership/update/'.$row->id)}}" method="post">
                        <div class="modal-body">
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Tipe</label>
                            <input type="text" id="" name="name" class="form-control" value="{{$row->name}}" placeholder="Nama Tipe">
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Harga Harian</label>
                            <input type="number" id="" name="price_daily" class="form-control" value="{{$row->price_daily}}" placeholder="">
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Harga Mingguan</label>
                            <input type="number" id="" name="price_weekly" class="form-control" value="{{$row->price_weekly}}" placeholder="">
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Harga Bulanan</label>
                            <input type="number" id="" name="price_monthly" class="form-control" value="{{$row->price_monthly}}" placeholder="">
                          </div>
                          <div class="form-group">
                            <label class="form-label" for="">Keterangan</label>
                            <textarea name="description" id="" style="width:100%" class="form-control" rows="3">{{$row->description}}</textarea>
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
          <a href="{{url('admin/membership/destroy')}}?id={{$row->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus ?');">
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
