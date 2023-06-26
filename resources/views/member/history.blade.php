@extends('member.layout')

@section('body')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Riwayat Transaksi</h4>
    </div>
    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="member-tab" data-bs-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">Paket</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="trainer-tab" data-bs-toggle="tab" href="#trainer" role="tab" aria-controls="trainer" aria-selected="false">Membership</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
        @include('member.history.table-packet')
      </div>
      <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab">
        @include('member.history.table-membership')
      </div>
    </div>
  </div>
</div>
@endsection
