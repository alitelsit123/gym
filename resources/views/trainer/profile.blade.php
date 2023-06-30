@extends('trainer.layout')

@section('body')
<div class="card">
  <!-- card body -->
  <div class="card-body">
    <div class=" mb-6">
      <h4 class="mb-1">General Settings</h4>

    </div>
    {{-- <div class="row align-items-center mb-8">
      <div class="col-md-3 mb-3 mb-md-0">
        <h5 class="mb-0">Avatar</h5>
      </div>
      <div class="col-md-9">
          <div class="d-flex align-items-center mb-4">
              <div>
                  <img class="image  avatar avatar-lg rounded-circle" src="../assets/images/avatar/avatar-11.jpg" alt="Image">
                </div>

              <div class="file-upload btn btn-outline-white ms-4">
                <input type="file" class="file-input opacity-0">Upload Photo
              </div>
            </div>

      </div>
    </div> --}}
    <div>
      <form method="post" action="{{url('trainer/profile/update')}}">
        <!-- row -->

        <div class="mb-3 row">
          <label for="fullName" class="col-sm-4 col-form-label
              form-label">Nama</label>
          <div class="col-sm-4 mb-3 mb-lg-0">
            <input type="text" class="form-control" value="{{auth()->user()->name}}" placeholder="Nama" name="name" required="">
          </div>
        </div>

        <!-- row -->
        <div class="mb-3 row">
          <label for="email" class="col-sm-4 col-form-label
              form-label">Email</label>
          <div class="col-md-8 col-12">
            <input type="email" class="form-control" value="{{auth()->user()->email}}" placeholder="Email" id="email" required="" readonly>
          </div>
        </div>
        <!-- row -->
        <!-- row -->
        {{-- <div class="mb-3 row">
          <label for="email" class="col-sm-4 col-form-label
              form-label">Nama Bank</label>
          <div class="col-md-8 col-12">
            <input type="text" class="form-control" value="{{auth()->user()->bank_name}}" placeholder="" name="bank_name" required="">
          </div>
        </div> --}}
        <div class="mb-3 row">
          <label for="email" class="col-sm-4 col-form-label
              form-label">Info Rekening</label>
          <div class="col-md-8 col-12">
            <input type="text" class="form-control" value="{{auth()->user()->norek}}" placeholder="" name="norek" required="">
          </div>
        </div>
        <!-- row -->
        <div class="mb-3 row">
          <label for="phone" class="col-sm-4 col-form-label
              form-label">Nomor HP <span class="text-muted">(Optional)</span></label>
          <div class="col-md-8 col-12">
            <input type="text" class="form-control" placeholder="Phone" value="{{auth()->user()->phone}}" name="phone" required="">
          </div>
        </div>
        <!-- row -->
        <div class="mb-3 row">
          <label for="location" class="col-sm-4 col-form-label
              form-label">Jenis Kelamin</label>
          <div class="col-md-8 col-12">
            <select class="form-select" id="location" name="gender">
                <option selected="">-- Pilih Jenis Kelamin --</option>
                <option value="m" @if(auth()->user()->gender == 'm') selected @endif>Laki laki</option>
                <option value="f" @if(auth()->user()->gender == 'f') selected @endif>Perempuan</option>
              </select>
          </div>
        </div>
        <!-- row -->
        <div class="mb-3 row">
          <label for="addressLine" class="col-sm-4 col-form-label
              form-label">Alamat</label>


          <div class="col-md-8 col-12">
            <input type="text" class="form-control" value="{{auth()->user()->address}}" placeholder="Placeholder" name="address" required="">
          </div>
        </div>
          <div class="offset-md-4 col-md-8 mt-4">
            <button type="submit" class="btn btn-primary"> Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
