<form action="{{url(auth()->user()->role.'/broadcast/store_type')}}" method="post" class="mt-4">
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
