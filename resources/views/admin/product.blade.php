@extends('admin.layout')

@section('body')
@php
$products = \App\Models\Product::get();
@endphp
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Manage Toko</h4>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-2">
        Tambah Produk
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('admin/product/store')}}" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Judul Produk</label>
                      <input type="text" id="" name="name" class="form-control" placeholder="Nama Produk">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Kategori</label>
                      <input type="text" id="" name="category" class="form-control" placeholder="Kategori Produk">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Gambar</label>
                      <input type="file" id="" name="image" class="form-control" accept="image/*" placeholder="Nama Paket">
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Stok</label>
                      <input type="number" id="" name="stock" class="form-control" placeholder="Stok" />
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Keterangan</label>
                      <textarea name="description" id="" rows="3" class="form-control w-100"></textarea>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Harga</label>
                      <input type="number" id="" name="price" class="form-control" placeholder="">
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
            <th scope="col">Kode</th>
            <th scope="col">Produk</th>
            <th scope="col">Harga</th>
            <th scope="col">Gambar</th>
            <th scope="col">Stok</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Status</th>
            <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $k => $row)
        <tr>
          <td>{{'P-'.strtoupper(Str::limit($row->name,2,'')).'0'.$row->id}}</td>
          <td>
            <div>{{$row->name}}<br /><div class="badge bg-info">{{$row->category}}</div></div>
          </td>
          <td>Rp. {{number_format($row->price)}}</td>
          <td>
            <img src="{{asset('storage/product/'.$row->image)}}" alt="" srcset="" style="width:70px;height:auto;" />
          </td>
          <td>{{$row->stock}}</td>
          <td>{{$row->description}}</td>
          <td>{{$row->status}}</td>
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
                          <h5 class="modal-title" id="exampleModalLabel">Update Produk</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="{{url('admin/product/update/'.$row->id)}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Judul Produk</label>
                            <input type="text" id="" name="name" value="{{$row->name}}" class="form-control" placeholder="Nama Produk">
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Kategori</label>
                            <input type="text" id="" name="category" value="{{$row->category}}" class="form-control" placeholder="Kategori Produk">
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Gambar</label>
                            <input type="file" id="" name="image" class="form-control" accept="image/*" placeholder="">
                            <small>Kosongkan jika tidak update gambar.</small>
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Stok</label>
                            <input type="number" id="" name="stock" class="form-control" value="{{$row->stock}}" placeholder="Stok" />
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
                            <label class="form-label" for="">Status</label>
                            <select name="status" id="" class="form-control">
                              <option value="">-- Pilih Status --</option>
                              @foreach (['tersedia','habis'] as $rowStatus)
                              <option value="{{$rowStatus}}" @if($rowStatus == $row->status) selected @endif>{{$rowStatus}}</option>
                              @endforeach
                            </select>
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
          <a href="{{url('admin/product/destroy')}}?id={{$row->id}}" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Yakin ingin hapus ?');">
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
