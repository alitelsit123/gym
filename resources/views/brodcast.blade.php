@extends(auth()->user()->role.'.layout')

@section('body')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Transaksi</h4>
    </div>
    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
      {{-- <li class="nav-item">
        <a class="nav-link active" id="member-tab" data-bs-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">Paket</a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link active" id="single-tab" data-bs-toggle="tab" href="#single" role="tab" aria-controls="single" aria-selected="false">Individu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="member-tab" data-bs-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="false">Semua Member</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="trainer-tab" data-bs-toggle="tab" href="#trainer" role="tab" aria-controls="trainer" aria-selected="false">Semua Trainer</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="admin-tab" data-bs-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Semua Admin</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      {{-- <div class="tab-pane fade show active" id="member" role="tabpanel" aria-labelledby="member-tab">
        @include('akuntan.history.table-packet')
      </div> --}}
      <div class="tab-pane fade show active" id="single" role="tabpanel" aria-labelledby="single-tab">
        @include('broadcast.single')
      </div>
      @foreach (['member','trainer','admin'] as $item)
      <div class="tab-pane fade" id="{{$item}}" role="tabpanel" aria-labelledby="{{$item}}-tab">
        @include('broadcast.type', ['type' => $item])
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
