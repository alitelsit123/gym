<a class="btn btn-light btn-icon rounded-circle indicator
indicator-primary text-muted position-relative"
  style="background: transparent;border:none;"
  href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown"
  aria-haspopup="true" aria-expanded="false">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:1.3rem;">
    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
  </svg>
  @if (auth()->user()->unreadNotifications()->count() > 0)
  <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-danger" style="top:2%!important;">
    {{auth()->user()->unreadNotifications()->count()}}
    <span class="visually-hidden">unread messages</span>
  </span>
  @endif
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
  <div>
    <div
      class="border-bottom px-3 pt-2 pb-3 d-flex
justify-content-between align-items-center">
      <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
      <a href="#" class="text-muted"
      style="background: transparent;border:none;"
      >
        <a href="{{url('notification/'.auth()->user()->id)}}" class="btn btn-sm btn-secondary">
          Tandai sudah dibaca
        </a>
      </a>
    </div>
    <!-- List group -->
    <ul class="list-group list-group-flush notification-list-scroll">
      @foreach (auth()->user()->unreadNotifications()->latest()->take(5)->get() as $rowNotification)
      <!-- List group item -->
      <li class="list-group-item bg-light">


        <a href="#" class="text-muted">
          {{-- <h5 class=" mb-1">Rishi Chopra</h5> --}}
          <p class="mb-2">
            {{$rowNotification->data['text']}}
          </p>
          <small style="display: block;width:100%;text-align:right;">{{$rowNotification->created_at->locale('id')->diffForHumans()}}</small>
        </a>
      </li>
      @endforeach
    </ul>
    <div class="border-top px-3 py-2 text-center">
      <a href="#notifications-2" data-bs-toggle="modal" class="text-inherit fw-semi-bold">
        Lihat Semua Notifikasi
      </a>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="notifications-2" tabindex="-1" role="dialog" aria-labelledby="notificationsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="notificationsLabel">Semua Notifikasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <!-- List group -->
              <ul class="list-group list-group-flush notification-list-scroll">
                @foreach (auth()->user()->notifications as $rowNotification)
                <!-- List group item -->
                <li class="list-group-item bg-light">


                  <a href="#" class="text-muted">
                    {{-- <h5 class=" mb-1">Rishi Chopra</h5> --}}
                    <p class="mb-2">
                      {{$rowNotification->data['text']}}
                    </p>
                    <small style="display: block;width:100%;text-align:right;">{{$rowNotification->created_at->locale('id')->diffForHumans()}}</small>
                  </a>
                </li>
                @endforeach
              </ul>
          </div>
      </div>
  </div>
</div>
