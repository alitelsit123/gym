@extends('admin.layout')

@section('body')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Transaksi</h4>
    </div>
    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="member-tab" data-bs-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">Produk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="trainer-tab" data-bs-toggle="tab" href="#trainer" role="tab" aria-controls="trainer" aria-selected="false">Membership</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="beban-tab" data-bs-toggle="tab" href="#beban" role="tab" aria-controls="beban" aria-selected="false">Beban Pengeluaran</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
        @include('admin.history.table-product')
      </div>
      <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab">
        @include('admin.history.table-membership')
      </div>
      <div class="tab-pane fade" id="beban" role="tabpanel" aria-labelledby="beban-tab">
        @include('admin.history.table-packet')
      </div>
    </div>
  </div>
</div>
@endsection
