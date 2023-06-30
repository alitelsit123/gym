@extends('member.layout')

@section('body')
@php
$memberships = \App\Models\MembershipType::get();
$order = \App\Models\Order::whereStatus('cart')->whereUser_id(auth()->id())->first();
$productsCount = \App\Models\Product::get()->count();
@endphp
<div class="app-content-area">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <h4 class="mb-3">TOKO</h4>
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active d-flex align-items-center justify-content-between" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
            <span>Produk</span>
            <span class="badge bg-danger ml-auto">{{$productsCount}}</span>
          </a>
          <a class="nav-link d-flex align-items-center justify-content-between" id="v-pills-home-keranjang-tab" data-bs-toggle="pill" href="#v-pills-home-keranjang" role="tab" aria-controls="v-pills-home-keranjang" aria-selected="true">
            <span>Keranjang</span>
            <span class="badge bg-danger ml-auto">{{$order ? $order->details()->count(): 0}}</span>
          </a>
        </div>
      </div>

      <div class="col-md-9">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <div class="card p-0">
              <div class="card-body p-0">
                @include('member.product.table-product')
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="v-pills-home-keranjang" role="tabpanel" aria-labelledby="v-pills-home-keranjang-tab">
            <div class="card">
              <div class="card-header">
                <h4 class="mb-0">Keranjang</h4>

              </div>

                <div class="card-body w-100">
                  <div class="table-responsive table-card">
                    <form action="{{url('member/product/update_cart')}}" method="post" class="cartform">
                      @include('member.product.table-cart')
                    </form>
                  </div>
                </div>
                @php
                $order = \App\Models\Order::whereStatus('cart')->whereUser_id(auth()->id())->first();
                @endphp
                @if ($order)
                <div class="card-footer justify-content-between d-flex">
                  <button type="submit" class="btn btn-outline-primary btn-update">Update</button>
                  {{-- <a href="{{url('member/product/pay')}}" class="btn btn-primary">Bayar</a> --}}
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-2">Bayar</button>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <form action="{{url('member/product/pay')}}" class="eot" enctype="multipart/form-data" method="post" >
                        <div class="modal-content">
                            <div class="modal-body">
                              <div class="alert alert-info">
                                <strong>Perhatian!</strong><br />
                                <p>
                                  <strong>Transfer ke rekening {{config('app.norek.bni')}} lalu upload bukti ke sini.</strong>
                                </p>
                              </div>
                              <div class="form-group mb-3 ">
                                <label for="" class="mb-1">Tipe Pembayaran</label>
                                <select name="payment_type" id="" class="form-control" required>
                                  <option value="">-- Pilih Tipe Pembayaran --</option>
                                  <option value="transfer">Transfer</option>
                                  <option value="tunai">Tunai</option>
                                </select>
                              </div>
                              <div class="form-group mb-3 eot-body" style="display: none;">
                                <label for="" class="mb-1">Bukti Transfer</label>
                                <input type="file" name="image" id="" class="form-control" />
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary btn-submit-pay">Simpan</button>
                            </div>
                        </div>
                      </form>
                      <script>
                        $(document).ready(function() {
                          $('select[name="payment_type"]').change(function() {
                            if ($(this).val() == 'transfer') {
                              $('.eot-body').show()
                            } else {
                              $('.eot-body').hide()
                            }
                          })
                        })
                      </script>
                      <script>
                      $(document).ready(function() {
                        $('.btn-update').click(function() {
                          $('form.cartform').submit()
                        })
                      })
                      </script>
                    </div>
                  </div>
                </div>
                @endif

            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
@endsection
