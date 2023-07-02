<form action="{{url('akuntan/broadcast/store_type')}}" method="post" class="mt-4">
  <input type="hidden" name="type" value="{{$item}}">
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
