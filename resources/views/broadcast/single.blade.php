<form action="{{url(auth()->user()->role.'/broadcast/store')}}" method="post" class="mt-4">
  <div class="form-group mb-3">
    <label for="" class="mb-2">User</label>
    <select name="id" id="" class="form-control" required>
      <option value="">-- Pilih User --</option>
      @foreach (\App\Models\User::where('id', '<>', auth()->user()->id)->get() as $row)
      <option value="{{$row->id}}">{{$row->name}} - {{$row->email}} - {{$row->role}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group mb-3">
    <label for="" class="mb-2">Pesan</label>
    <textarea name="text" id="" class="form-control" rows="4" required></textarea>
  </div>
  <button class="btn btn-primary" type="submit">Kirim</button>
</form>
<script>
$(document).ready(function() {
  $('select[name="id"]').select2()
})
</script>
