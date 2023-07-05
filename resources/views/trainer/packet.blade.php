@extends('trainer.layout')

@section('body')
@php
$packets = \App\Models\Packet::get();
@endphp
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Manage Paket Saya</h4>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-2">
        Tambah Paket
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('trainer/packet/store')}}" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Judul Paket</label>
                      <input type="text" id="" name="title" class="form-control" placeholder="Nama Paket">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Gambar</label>
                      <input type="file" id="" name="image" class="form-control" accept="image/*" placeholder="Nama Paket">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Keterangan</label>
                      <textarea name="description" id="" rows="3" class="form-control w-100"></textarea>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Harga paket</label>
                      <input type="number" id="" name="price" class="form-control" placeholder="">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Durasi (hari)</label>
                      <input type="number" id="" name="duration" class="form-control" placeholder="" />
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Jumlah Pertemuan</label>
                      <input type="number" id="" name="meet_count" class="form-control" placeholder="" />
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
            <th scope="col">Nama Paket</th>
            <th scope="col">Harga</th>
            <th scope="col">Gambar</th>
            <th scope="col">Keterangan</th>
            <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($packets as $k => $row)
        <tr>
          <th scope="row">{{$row->code}}</th>
          <td>
            <div>{{$row->title}}</div>
          </td>
          <td>Rp. {{number_format($row->price)}} <br /><div class="badge bg-info">{{$row->duration}} Hari</div><div class="badge bg-info">Pertemuan {{$row->meet_count}}x</div></td>
          <td>
            <img src="{{asset('storage/packet/'.$row->image)}}" alt="" srcset="" style="width:70px;height:auto;" />
          </td>
          <td>{{$row->description}}</td>
          <td>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-sm btn-block" data-bs-toggle="modal" data-bs-target="#exampleModalu-{{$row->id}}">
              Update
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalu-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Update Paket</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="{{url('trainer/packet/update/'.$row->id)}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Judul Paket</label>
                            <input type="text" id="" name="title" value="{{$row->title}}" class="form-control" placeholder="Nama Paket">
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Gambar</label>
                            <input type="file" id="" name="image" class="form-control" accept="image/*" placeholder="">
                            <small>Kosongkan jika tidak update gambar.</small>
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Keterangan</label>
                            <textarea name="description" id="" rows="3" class="form-control w-100">{{$row->description}}</textarea>
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Harga paket</label>
                            <input type="number" id="" name="price" class="form-control" placeholder="" value="{{$row->price}}">
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Durasi (hari)</label>
                            <input type="number" id="" name="duration" class="form-control" placeholder="" value="{{$row->duration}}" />
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Jumlah Pertemuan</label>
                            <input type="number" id="" name="meet_count" value="{{$row->meet_count}}" class="form-control" placeholder="" />
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
          <a href="{{url('trainer/packet/destroy')}}?id={{$row->id}}" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Yakin ingin hapus ?');">
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
