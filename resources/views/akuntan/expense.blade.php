@extends('akuntan.layout')

@section('body')
@php
$packets = \App\Models\Expense::get();
@endphp
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Beban</h4>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-2">
        Tambah Beban
      </button>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Beban</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{url('akuntan/beban/store')}}" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Nama</label>
                      <input type="text" id="" name="name" class="form-control" placeholder="" required />
                    </div>
                    {{-- <div class="form-group mb-3">
                      <label class="form-label" for="">Bukti <small><i>Kosongkan jika tidak ada</i></small></label>
                      <input type="file" id="" name="image" class="form-control" accept="image/*" placeholder="">
                    </div> --}}
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Keterangan</label>
                      <textarea name="description" id="" rows="3" class="form-control w-100"></textarea>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Harga satuan</label>
                      <input type="number" id="" name="price" class="form-control payment_totalm" placeholder="" value="0" required>
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Jumlah</label>
                      <input type="number" id="" name="quantity" class="form-control payment_totalq" placeholder="" value="0" required />
                    </div>
                    <div class="form-group mb-3">
                      <label class="form-label" for="">Total</label>
                      <input type="text" id="" name="gross_amount_t" class="form-control kembalim" placeholder="" value="0" required>
                    </div>
                    <div class="form-group mb-3" style="display: none;">
                      <label class="form-label" for="">Total</label>
                      <input type="number" id="" name="gross_amount" class="form-control kembalig" placeholder="" value="0" required>
                    </div>
                  </div>
                  <script>
                    $(document).ready(function() {
                      $('.payment_totalm').keyup(function() {
                        $('.kembalim').val(`Rp ${($(this).val() * $('.payment_totalq').val()).toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`)
                        $('.kembalig').val(`${$(this).val() * $('.payment_totalm').val()}`)
                      })
                      $('.payment_totalq').keyup(function() {
                        $('.kembalig').val(`${$(this).val() * $('.payment_totalm').val()}`)
                        $('.kembalim').val(`Rp ${($(this).val() * $('.payment_totalm').val()).toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`)
                      })
                    })
                    </script>
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
            {{-- <th scope="col">#</th> --}}
            <th scope="col">Nama</th>
            {{-- <th scope="col">Eot</th> --}}
            <th scope="col">Harga satuan</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Total</th>
            <th scope="col">Keterangan</th>
            <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($packets as $k => $row)
        <tr>
          {{-- <th scope="row">{{$row->code}}</th> --}}
          <td>
            <div>{{$row->name}}</div>
          </td>
          {{-- <td>
            <img src="{{asset('storage/expense/'.$row->payment_eot)}}" alt="" srcset="" style="width:70px;height:auto;" />
          </td> --}}
          <td>Rp. {{number_format($row->price)}}</td>
          <td>{{number_format($row->quantity)}}</td>
          <td>Rp. {{number_format($row->gross_amount)}}</td>

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
                      <form action="{{url('akuntan/beban/update/'.$row->id)}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Nama</label>
                            <input type="text" id="" name="name" class="form-control" placeholder="" value="{{$row->name}}" required />
                          </div>
                          {{-- <div class="form-group mb-3">
                            <label class="form-label" for="">Bukti <small><i>Kosongkan jika tidak ada</i></small></label>
                            <input type="file" id="" name="image" class="form-control" accept="image/*" placeholder="">
                          </div> --}}
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Keterangan</label>
                            <textarea name="description" id="" rows="3" class="form-control w-100">{{$row->description}}</textarea>
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Harga satuan</label>
                            <input type="number" id="" name="price" class="form-control payment_totalm{{$row->id}}" placeholder="" value="{{$row->price ?? 0}}" required>
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Jumlah</label>
                            <input type="number" id="" name="quantity" class="form-control payment_totalq{{$row->id}}" placeholder="" value="{{$row->quantity ?? 0}}" required />
                          </div>
                          <div class="form-group mb-3">
                            <label class="form-label" for="">Total</label>
                            <input type="text" id="" name="gross_amount_t" class="form-control kembalim{{$row->id}}" placeholder="" value="Rp. {{number_format($row->gross_amount ?? 0)}}" required>
                          </div>
                          <div class="form-group mb-3" style="display: none;">
                            <label class="form-label" for="">Total</label>
                            <input type="number" id="" name="gross_amount" class="form-control kembalig{{$row->id}}" placeholder="" value="{{$row->gross_amount ?? 0}}" required>
                          </div>
                        </div>
                        <script>
                          $(document).ready(function() {
                            $('.payment_totalm{{$row->id}}').keyup(function() {
                              $('.kembalim{{$row->id}}').val(`Rp ${($(this).val() * $('.payment_totalq{{$row->id}}').val()).toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`)
                              $('.kembalig{{$row->id}}').val(`${$(this).val() * $('.payment_totalm{{$row->id}}').val()}`)
                            })
                            $('.payment_totalq{{$row->id}}').keyup(function() {
                              $('.kembalig{{$row->id}}').val(`${$(this).val() * $('.payment_totalm{{$row->id}}').val()}`)
                              $('.kembalim{{$row->id}}').val(`Rp ${($(this).val() * $('.payment_totalm{{$row->id}}').val()).toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`)
                            })
                          })
                          </script>
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
          <a href="{{url('akuntan/beban/destroy')}}?id={{$row->id}}" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Yakin ingin hapus ?');">
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
