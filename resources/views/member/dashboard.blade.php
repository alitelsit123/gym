@extends('member.layout')

@section('body')
  <div class="app-content-area">
    <div class="mx-n4"></div>
      @php
      $existingMembershipPending = \App\Models\Membership::whereUser_id(auth()->user()->id)->whereStatus('pending')->first();
      @endphp
      @if ($existingMembershipPending)
      <div class="alert alert-warning">Kamu ada pembayaran yg belum dibayar, dilunasi segera agar dicek oleh admin!</div>
      @endif
      <div class="bg-primary rounded-3">
        <div class="row mb-5 ">
          <div class="col-lg-12 col-md-12 col-12">
            <div class="p-6 d-lg-flex justify-content-between align-items-center ">
              <div class="d-md-flex align-items-center">
                <img src="../assets/images/avatar/avatar-3.jpg" alt="Image" class="rounded-circle avatar avatar-xl">
                <div class="ms-md-4 mt-3 mt-md-0 lh-1">
                  <h3 class="text-white mb-0">Hallo, {{auth()->user()->name}}</h3>
                  <small class="text-white">Selamat Pagi</small>
                </div>
              </div>
              <div class="d-none d-lg-block">
                {{-- <a href="#!" class="btn btn-white">What’s New!</a> --}}
              </div>
            </div>

          </div>
        </div>
      </div>
      <div>
        <h4 class="mb-3">Jadwal Nutrisi</h4>
        <div class="card">
          <div class="card-body">
            <table class="table table-stripped w-100">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Jam</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>sdklfj</td>
                  <td>sldkjf</td>
                  <td><button class="btn btn-success btn-sm">Tandai Sudah Dilakukan</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <h4 class="my-3 mt-4">Jadwal Latihan</h4>
        <div class="card">
          <div class="card-body">
            <table class="table table-stripped w-100">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Jam</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>sdklfj</td>
                  <td>sldkjf</td>
                  <td><button class="btn btn-success btn-sm">Absent</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
