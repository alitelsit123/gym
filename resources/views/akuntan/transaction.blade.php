@extends('akuntan.layout')

@section('body')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Butuh Konfirmasi</h4>
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
    </div>

    <div class="d-flex align-items-center justify-content-between mt-4">
      <h4>Semua Transaksi</h4>
    </div>
    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="memberall-tab" data-bs-toggle="tab" href="#memberall" role="tab" aria-controls="memberall" aria-selected="true">Produk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="trainerall-tab" data-bs-toggle="tab" href="#trainerall" role="tab" aria-controls="trainerall" aria-selected="false">Membership</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="memberall" role="tabpanel" aria-labelledby="memberall-tab">
        @include('akuntan.historyall.table-product')
      </div>
      <div class="tab-pane fade" id="trainerall" role="tabpanel" aria-labelledby="trainerall-tab">
        @include('akuntan.historyall.table-membership')
      </div>
    </div>

  </div>
</div>
@endsection
