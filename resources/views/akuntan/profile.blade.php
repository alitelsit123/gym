@extends('akuntan.layout')

@section('body')
<form method="post" action="{{url('akuntan/profile/update')}}" enctype="multipart/form-data">

<div class="card">
  <!-- card body -->
  <div class="card-body">
    <div class=" mb-6">
      <h4 class="mb-1">General Settings</h4>

    </div>
    <div class="row align-items-center mb-8">
      <div class="col-md-3 mb-3 mb-md-0">
        <h5 class="mb-0">Foto</h5>
      </div>
      <div class="col-md-9">
          <div class="d-flex align-items-center mb-4">
            <div>
              @if (auth()->user()->photo)
              <img class="image  avatar avatar-lg rounded-circle" src="{{asset('storage/profile/'.auth()->user()->photo)}}" alt="Image">
              @else
              <img class="image  avatar avatar-lg rounded-circle" src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" alt="Image">
              @endif
            </div>

            <div class="file-upload btn btn-outline-white ms-4 ctr" style="width: 100%;">
              <small style="text-align: right;display:block;" class="ml-4 w-100 text-right img-name">Upload Photo</small>
            </div>
            <input type="file" class="file-input opacity-0" name="image" style="display: none;">
          </div>
          {{-- <small style="text-align: right;display:none;" class="ml-4 w-100 text-right img-name"></small> --}}
      </div>
    </div>
    <script>
      $(document).ready(function() {
        $('.ctr').click(function() {
          $('input[name="image"]').click()
        })
        $('input[name="image"]').change(function() {
          $('.img-name').show()
          $('.img-name').css('display','block')
          $('.img-name').text($(this).val().split('\\').pop())
        })
      })
    </script>
    <div>
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
    </div>
  </div>
</div>
</form>
@endsection
