@extends('admin.layout')

@section('body')
  <div class="app-content-area">
    <div class="bg-primary pt-10 pb-21 mt-n6 mx-n4"></div>
    <div class="container-fluid mt-n22 ">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <!-- Page header -->
          <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="mb-2 mb-lg-0">
              <h3 class="mb-0  text-white">Gym's Dashboard</h3>
            </div>
            <div>
              {{-- <a href="#!" class="btn btn-white">Create New Project</a> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
          <!-- card -->
          <div class="card h-100 card-lift">
            <!-- card body -->
            <div class="card-body">
              <!-- heading -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <h4 class="mb-0">Akun</h4>
                </div>
                <div class="icon-shape icon-md bg-primary-soft text-primary rounded-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-briefcase">
                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2">
                    </rect>
                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                  </svg>
                </div>
              </div>
              <!-- project number -->
              <div class="lh-1">
                @php
                $account = \App\Models\User::count();
                @endphp
                <h1 class=" mb-1 fw-bold">{{$account}}</h1>
                {{-- <p class="mb-0"><span class="text-dark me-2">{{$account}}</span></p> --}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-12 mb-5">
          <!-- card -->
          <div class="card h-100 card-lift">
            <!-- card body -->
            <div class="card-body">
              <!-- heading -->
              <div class="d-flex justify-content-between align-items-center
      mb-3">
                <div>
                  <h4 class="mb-0">Transaksi Berhasil</h4>
                </div>
                <div class="icon-shape icon-md bg-primary-soft text-primary
        rounded-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-list">
                    <line x1="8" y1="6" x2="21" y2="6"></line>
                    <line x1="8" y1="12" x2="21" y2="12"></line>
                    <line x1="8" y1="18" x2="21" y2="18"></line>
                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                  </svg>
                </div>
              </div>
              <!-- project number -->
              <div class="lh-1">
                @php
                $packets = \App\Models\TrainerMember::has('packet')->whereStatus('approve')->get();
                $totalPacket = 0;
                foreach ($packets as $row) {
                  $totalPacket += $row->packet->price;
                }
                $totalMembership = 0;
                $memberships = \App\Models\Membership::has('type')->whereStatus('approve')->get();
                foreach ($memberships as $row) {
                  $totalMembership += $row->type->{'price_'.$row->duration_type};
                }
                @endphp
                <h1 class="  mb-1 fw-bold">Rp. <span>{{number_format($totalPacket+$totalMembership)}}</span></h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
