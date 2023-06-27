@php
$users = \App\Models\User::whereRole('member')->get();
@endphp
<!-- basic table -->
<table class="table table-stripped mt-2">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Nomor HP</th>
        <th scope="col">Photo</th>
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
      <td>
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
      </td>
      <td>{{$row->address}}</td>
      <td>
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
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<!-- basic table -->
