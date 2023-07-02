@extends('trainer.layout')

@section('body')
  <div class="app-content-area">
    <div class="bg-primary pt-10 pb-21 mt-n6 mx-n4"></div>
    <div class="container-fluid mt-n22 ">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <!-- Page header -->
          <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="mb-2 mb-lg-0">
              <h3 class="mb-0  text-white">Trainer Dashboard</h3>
            </div>
            <div>
              {{-- <a href="#!" class="btn btn-white">Create New Project</a> --}}
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5" style="cursor:pointer;" onclick="document.location.href='{{url('trainer/member')}}'">
          <!-- card -->
          <div class="card h-100 card-lift">
            <!-- card body -->
            <div class="card-body">
              <!-- heading -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                  <h4 class="mb-0">Member</h4>
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
                <h1 class=" mb-1 fw-bold">{{auth()->user()->trainerMembers()->count()}}</h1>
                <p class="mb-0"><span class="text-dark me-2">{{auth()->user()->trainerMembers()->whereStatus('approve')->count()}}</span>Aktif</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5" style="cursor:pointer;" onclick="document.location.href='{{url('trainer/packet')}}'">
          <!-- card -->
          <div class="card h-100 card-lift">
            <!-- card body -->
            <div class="card-body">
              <!-- heading -->
              <div class="d-flex justify-content-between align-items-center
      mb-3">
                <div>
                  <h4 class="mb-0">Paket</h4>
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
                <h1 class="  mb-1 fw-bold">{{auth()->user()->trainerPackets()->count()}}</h1>
              </div>
            </div>
          </div>
        </div>
        {{-- <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
          <!-- card -->
          <div class="card h-100 card-lift">
            <!-- card body -->
            <div class="card-body">
              <!-- heading -->
              <div class="d-flex justify-content-between align-items-center
      mb-3">
                <div>
                  <h4 class="mb-0">Teams</h4>
                </div>
                <div class="icon-shape icon-md bg-primary-soft text-primary
        rounded-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-users">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                  </svg>
                </div>
              </div>
              <!-- project number -->
              <div class="lh-1">
                <h1 class="  mb-1 fw-bold">12</h1>
                <p class="mb-0"><span class="text-dark me-2">1</span>Completed</p>
              </div>
            </div>
          </div>

        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
          <!-- card -->
          <div class="card h-100 card-lift">
            <!-- card body -->
            <div class="card-body">
              <!-- heading -->
              <div class="d-flex justify-content-between align-items-center
      mb-3">
                <div>
                  <h4 class="mb-0">Productivity</h4>
                </div>
                <div class="icon-shape icon-md bg-primary-soft text-primary
        rounded-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-target">
                    <circle cx="12" cy="12" r="10"></circle>
                    <circle cx="12" cy="12" r="6"></circle>
                    <circle cx="12" cy="12" r="2"></circle>
                  </svg>
                </div>
              </div>
              <!-- project number -->
              <div class="lh-1">
                <h1 class="  mb-1 fw-bold">76%</h1>
                <p class="mb-0"><span class="text-success me-2">5%</span>Completed</p>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
  </div>
@endsection
