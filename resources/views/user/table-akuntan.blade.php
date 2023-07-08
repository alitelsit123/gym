@php
$users = \App\Models\User::whereRole('akuntan')->where('email', '<>', auth()->user()->email)->get();
@endphp
<!-- basic table -->
<table class="table table-stripped mt-2">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Nomor HP</th>
        <th scope="col">Photo</th>
        {{-- <th>Membership</th> --}}
        <th scope="col">Alamat</th>
        <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $k => $row)
    <tr>
      <th scope="row">{{$row->code}}</th>
      <td>
        {{$row->name}}<br />
        <div class="badge bg-secondary">{{$row->email}}</div><br />
        <div class="badge bg-info">{{$row->role}}</div>
      </td>
      <td>{{$row->phone}}</td>
      <td></td>
      {{-- <td>
        <select name="s{{$row->id}}" id="" class="form-control">
          <option value="">Belum punya membership</option>
          @foreach (\App\Models\MembershipType::all() as $rowMembership)
          <option value="{{$rowMembership->id}}" @if($rowMembership->id == $row->membership_type_id) selected @endif>{{ucfirst($rowMembership->name)}}</option>
          @endforeach
        </select>
        <script>
          $(document).ready(function() {
            $('select[name="s{{$row->id}}"]').change(function() {
              const value = $(this).val()
              $.post('{{url('admin/update_attribute')}}', {model: 'User', attr: 'membership_type_id', value, id: '{{$row->id}}'}, function(data) {
                if (data.message) {
                  Swal.fire('Berhasil!.', data.message, 'success');
                }
              });
            })
          })
        </script>
      </td> --}}
      <td>{{$row->address}}</td>
      <td>
        @if (auth()->user()->role == 'admin')
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalu-{{$row->id}}">
          Update
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalu-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update Akun</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form action="{{url('admin/user/update/'.$row->id)}}" method="post">
                    <div class="modal-body">
                      <div class="form-group mb-3">
                        <label class="form-label" for="">Nama Lengkap</label>
                        <input type="text" id="" name="name" class="form-control" value="{{$row->name}}" placeholder="Nama Lengkap">
                      </div>
                      <div class="form-group mb-3">
                        <label class="form-label" for="">Hak Akses</label>
                        <select name="role" id="" class="form-control">
                          <option value=""></option>
                          <option value="admin" @if($row->role == 'admin') selected @endif>Admin</option>
                          <option value="trainer" @if($row->role == 'trainer') selected @endif>Trainer</option>
                          <option value="akuntan" @if($row->role == 'akuntan') selected @endif>Akuntan</option>
                          <option value="member" @if($row->role == 'member') selected @endif>Member</option>
                        </select>
                      </div>
                      <div class="form-group mb-3">
                        <label class="form-label" for="">Email</label>
                        <input type="text" id="" name="email" value="{{$row->email}}" class="form-control" placeholder="">
                      </div>
                      <div class="form-group mb-3">
                        <label class="form-label" for="">Nomor HP</label>
                        <input type="text" id="" name="phone" class="form-control" value="{{$row->phone}}" placeholder="">
                      </div>
                      <div class="form-group mb-3">
                        <label class="form-label" for="">Jenis Kelamin</label>
                        <select name="gender" id="" class="form-control">
                          <option value=""></option>
                          <option value="m" @if($row->gender == 'm') selected @endif>Laki laki</option>
                          <option value="f" @if($row->gender == 'f') selected @endif>Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group mb-3">
                        <label class="form-label" for="">Alamat</label>
                        <textarea name="address" id="" rows="3" class="form-control w-100">{{$row->address}}</textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Button trigger modal -->
        <a href="{{url('admin/user/destroy')}}?id={{$row->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus ?');">
          Hapus
        </a>
        @else

        <a href="{{url(auth()->user()->role.'/chat')}}?receiver_id={{$row->id}}" class="">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="" style="width: 22px;height:22px;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
          </svg>
        </a>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<!-- basic table -->
