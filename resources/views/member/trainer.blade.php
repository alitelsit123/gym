@extends('member.layout')

@section('body')
@php
$packets = \App\Models\Packet::whereHas('trainer', function($query) {
  $query->whereRole('trainer');
})->get();
@endphp
<div class="app-content-area">
  <div class="container-fluid">
    <h4 class="mb-3">Sewa Paket</h4>
    <div class="row">
      @foreach ($packets as $row)
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-centerjustify-content-between">
              <div>
                <h4 class="mb-0"><a href="#!" class="text-inherit font-weight-bold">Paket {{$row->title}}</a></h4>
              </div>
            </div>
            <hr />
            <div class="card bg-primary text-white">
              <div class="card-body">
                <div>Trainer: {{$row->trainer->name}}</div>
                <div>
                  @foreach ($row->trainer->specialists as $rowBadge)
                  <span class="badge bg-info">{{$rowBadge->name}}</span>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="mt-3">
              <p class="mb-0">{{Str::limit($row->description, 50, '...')}}</p>
            </div>
          </div>
          <div class="card-footer p-2">
            <div class="row">
              <div class="col-6">
                <small style="display: block;">Harga Paket: </small>
                <strong>Rp. {{number_format($row->price)}},-</strong>
              </div>
              <div class="col-6">
                <button class="btn btn-success w-100">Langganan</button>
              </div>
            </div>
          </div>
        </div>

      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
