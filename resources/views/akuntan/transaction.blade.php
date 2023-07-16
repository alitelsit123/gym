@extends('akuntan.layout')

@section('body')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Butuh Konfirmasi</h4>
      <button type="button" class="btn btn-primary btn-open-modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Manual Transaksi</button>
    </div>
    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
      {{-- <li class="nav-item">
        <a class="nav-link active" id="member-tab" data-bs-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">Paket</a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link active" id="trainer-tab" data-bs-toggle="tab" href="#trainer" role="tab" aria-controls="trainer" aria-selected="false">Membership</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="product-tab" data-bs-toggle="tab" href="#product" role="tab" aria-controls="product" aria-selected="false">Produk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="other-tab" data-bs-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false">Other</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      {{-- <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
        @include('akuntan.history.table-packet')
      </div> --}}
      <div class="tab-pane fade show active" id="trainer" role="tabpanel" aria-labelledby="trainer-tab">
        @include('akuntan.history.table-membership')
      </div>
      <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
        @include('akuntan.history.table-product')
      </div>
      <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
        @include('akuntan.history.table-other')
      </div>
    </div>

    <div class="d-flex align-items-center justify-content-between mt-4">
      <h4>Semua Transaksi</h4>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="{{url('akuntan/store_tx_manual')}}" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-body">
                <div class="modal-title"><h4>Transaksi Lain Lain <strong></strong></h4></div>
                <hr />
                <div class="form-group mb-3">
                  <label for="" class="mb-1">Nama</label>
                  <input type="text" name="name" id="" class="form-control" required />
                </div>
                <div class="form-group mb-3">
                  <label for="" class="mb-1">Nomor HP</label>
                  <input type="text" name="phone" id="" class="form-control" required />
                </div>
                <div class="form-group mb-3 ">
                  <label for="" class="mb-1">Tipe Transaksi</label>
                  <select name="type" id="" class="form-control select-type" required>
                    <option value="">-- Pilih Tipe Transaksi --</option>
                    <option value="membership">Membership</option>
                    <option value="product">Produk</option>
                    {{-- <option value="packet">Paket Trainer</option> --}}
                  </select>
                </div>
                <script>
                  $(document).ready(function() {
                    $('.select-type').change(function() {
                      $('.t-membership').hide()
                      $('.t-packet').hide()
                      $('.t-product').hide()

                      $(`.t-${$(this).val()}`).show()
                    })
                    $('.btn-add-p').click(function() {
                      $('.pp').append($('.clone').html())
                    })
                  })
                </script>
                <div class="t-membership" style="display: none;">
                  <div class="form-group mb-3">
                    <label for="" class="mb-1">Tipe Membership</label>
                    <select name="membership_type" id="" class="form-control select">
                      <option value="">-- Pilih Tipe Membership --</option>
                      @foreach (\App\Models\MembershipType::all() as $rowMembership)
                      <option value="{{$rowMembership->id}}">{{$rowMembership->name}} - {{$rowMembership->class}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="t-packet" style="display: none;">
                  <div class="form-group mb-3">
                    <label for="" class="mb-1">Paket</label>
                    <select name="packet" id="" class="form-control select">
                      <option value="">-- Pilih Paket --</option>
                      @foreach (\App\Models\Packet::all() as $rowPacket)
                      <option value="{{$rowPacket->id}}">{{$rowPacket->title}} - {{$rowPacket->trainer->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="t-product" style="display: none;">
                  <div class="clone" style="display: none;">
                    <div class="form-group mb-3">
                      <label for="" class="mb-1">Produk</label>
                      <select name="product[]" id="" class="form-control select">
                        <option value="">-- Pilih Produk --</option>
                        @foreach (\App\Models\Product::all() as $rowProduct)
                        <option value="{{$rowProduct->id}}">{{$rowProduct->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group mb-3">
                      <label for="" class="mb-1">Kuantitas</label>
                      <input type="text" name="quantity[]" id="" class="form-control" />
                    </div>
                  </div>
                  <hr />
                  <div class="pp"></div>
                  <hr />
                  <button type="button" class="btn btn-primary btn-sm mb-3 btn-add-p">Tambah Produk</button>

                </div>
                <div class="alert alert-info eot-body">
                  <strong>Perhatian!</strong><br />
                  <p>
                    <strong>Transfer ke rekening {{config('app.norek.bni')}} lalu upload bukti ke sini.</strong>
                  </p>
                </div>
                <div class="form-group mb-3 ">
                  <label for="" class="mb-1">Tipe Pembayaran</label>
                  <select name="payment_type" id="" class="form-control select-p" required>
                    <option value="">-- Pilih Tipe Pembayaran --</option>
                    <option value="transfer">Transfer</option>
                    <option value="tunai">Tunai</option>
                  </select>
                </div>
                <div class="form-group mb-3 eot-body" style="display: none;">
                  <label for="" class="mb-1">Bukti Transfer</label>
                  <input type="file" name="payment_eot" id="" class="form-control" />
                </div>
                {{-- <div class="form-group">
                  <label for="" class="mb-1 typename-"></label>
                  <input type="number" name="duration" class="form-control" id="" required />
                </div> --}}
                <script>
                  $(document).ready(function() {
                    $('.select-p').change(function() {
                      console.log('test')
                      if ($(this).val() == 'transfer') {
                        $('.eot-body').show()
                      } else {
                        $('.eot-body').hide()
                      }
                    })
                  })
                </script>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="memberall-tab" data-bs-toggle="tab" href="#memberall" role="tab" aria-controls="memberall" aria-selected="true">Produk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="trainerall-tab" data-bs-toggle="tab" href="#trainerall" role="tab" aria-controls="trainerall" aria-selected="false">Membership</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="otherall-tab" data-bs-toggle="tab" href="#otherall" role="tab" aria-controls="otherall" aria-selected="false">Other</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="memberall" role="tabpanel" aria-labelledby="memberall-tab">
        @include('akuntan.historyall.table-product')
      </div>
      <div class="tab-pane fade" id="trainerall" role="tabpanel" aria-labelledby="trainerall-tab">
        @include('akuntan.historyall.table-membership')
      </div>
      <div class="tab-pane fade" id="otherall" role="tabpanel" aria-labelledby="otherall-tab">
        @include('akuntan.history.table-other', ['status' => 'approve'])
      </div>
    </div>

  </div>
</div>
@endsection
