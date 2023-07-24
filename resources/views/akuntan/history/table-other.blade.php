@php
$others = \App\Models\TransactionOther::where(function($query) {
  $query->has('membershipType')->orHas('details');
})->whereStatus($status ?? 'pending')->latest()->get();
@endphp
<!-- basic table -->
<table class="table table-stripped mt-2">
  <thead>
    <tr>
        <th scope="col">#</th>
        <th>Tanggal</th>
        <th scope="col">Nama</th>
        <th scope="col">Nomor HP</th>
        <th scope="col">EOT</th>
        <th scope="col">Jenis</th>
        <th scope="col">Informasi</th>
        <th scope="col">Transaksi</th>
        <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($others as $k => $row)
    {{-- @dd($row->toArray()) --}}
    <tr>
      <th scope="row">{{$k+1}}</th>
      <td>{{$row->created_at->format('d, F Y')}}</td>
      <th scope="row">{{$row->name}}</th>
      <th scope="row">{{$row->phone}}</th>
      {{-- <td>{{\Carbon\Carbon::parse($row->payment_date)->format('d, F Y')}}</td> --}}
      <td>
        @if ($row->payment_type == 'tunai')
        <div class="badge bg-info">Bayar Tunai</div>
        @else
        <img src="{{asset('storage/eot/'.$row->payment_eot)}}" alt="" srcset="" style="width:50px;height:auto;" />
        @endif
      </td>
      <td>{{$row->type}}</td>
      <td>
        @if ($row->type == 'membership')
        <div class="badge bg-info">{{$row->membershipType->name}}</div>
        @endif
        @if ($row->type == 'product')
          <div class="d-flex items-center">
            @forelse ($row->details()->take(2)->get() as $rowDetail)
            <div>
              <div class="d-flex flex-column" style="margin-right:1rem;">
                <img src="{{asset('storage/product/'.$rowDetail->product->image)}}" alt="" srcset="" style="width: 50px;height: auto;" />
                <div>{{Str::limit($rowDetail->product->name,50,'...')}} x{{$rowDetail->quantity}}</div>
              </div>
            </div>
            @empty
            (Produk dihapus)
            @endforelse
          </div>

          @if ($row->details->count() > 2)
          <button type="button" class="btn btn-sm btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$row->id}}" style="display: block;">+ {{$row->details->count() - 2}} Produk</button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <table class="table table-stripped">
                        @foreach ($row->details()->skip(2)->take($row->details->count() - 2)->get() as $rowDetail)
                          <tr>
                            <td>
                              <img src="{{asset('storage/product/'.$rowDetail->product->image)}}" alt="" srcset="" style="width: 100px;height: auto;"> <br />
                            </td>
                            <td>
                              <strong>{{$rowDetail->product->name}}</strong>
                              <div>Rp. {{number_format($rowDetail->sub_amount)}}</div>
                              <div>Jumlah {{$rowDetail->quantity}}</div>
                            </td>
                          </tr>
                        @endforeach
                      </table>
                    </div>
                </div>
            </div>
          </div>
          @endif
          @if ($row->details->count() > 0)
          <div class="badge bg-info">Rp {{number_format($row->details()->sum('sub_amount'))}}</div>
          @endif


        @endif
      </td>
      <td>
        @if ($row->type == 'membership')
        <div class="badge bg-info">Total Rp. {{number_format($row->membershipType->price)}}</div>
        @elseif($row->type == 'product')
          @if ($row->details->count() > 0)
          <div class="badge bg-info">Total Rp. {{number_format($row->details()->sum('sub_amount'))}}</div>
          @endif
          @if ($row->status == 'approve')
          <div class="badge bg-info">Bayar Rp. {{number_format($row->gross_amount)}}</div><br />
          <div class="badge bg-info">Kembalian Rp. {{number_format($row->payment_changes)}}</div>
          @endif
        @endif
      </td>
      <td>
        @if ($row->status == 'approve')
        Sudah lunas
        @elseif ($row->payment_type == 'transfer')
        <a href="{{url('akuntan/approved_payment_other?id='.$row->id)}}" onclick="return confirm('Approve Transaksi ?')" class="btn btn-sm btn-success">Approve</a>
        @else
        <button type="button" class="btn btn-sm btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$row->id}}">Verifikasi Pembayaran</button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{url('akuntan/approved_payment_other')}}" method="get" class="paymentt-{{$row->id}}">
                      <input type="hidden" name="id" value="{{$row->id}}">
                      <div class="modal-body">
                        <div class="form-group mb-3">
                          <label for="">Total Harga</label>
                          <input type="string" value="Rp {{number_format($row->membershipType->price ?? $row->details()->sum('sub_amount'))}}" id="" class="form-control" disabled />
                        </div>
                        <div class="form-group mb-3">
                          <label for="">Total Bayar</label>
                          <input type="number" name="payment_total" value="0" id="" class="form-control paymentt_totalm{{$row->id}}" />
                        </div>
                        <div class="form-group mb-3">
                          <label for="">Kembalian</label>
                          <input type="text" value="Rp 0" id="" class="form-control kembalimt{{$row->id}}" disabled />
                        </div>
                        <script>
                        $(document).ready(function() {
                          $('.paymentt_totalm{{$row->id}}').keyup(function() {
                            $('.kembalimt{{$row->id}}').val(`Rp ${($(this).val() - {{$row->membershipType->price ?? $row->details()->sum('sub_amount')}}).toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`)
                          })
                        })
                        </script>
                        <div class="form-group rm" style="display: none;">
                          <label for="">Kembalian</label>
                          <input type="number" name="payment_changes" value="0" id="" class="form-control" />
                        </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                    <script>
                      $(document).ready(function() {
                        $('.paymentt-{{$row->id}}').submit(function(e) {
                          const totalBayarEl = $(this).find('input[name="payment_total"]')
                          const totalChangesEl = $(this).find('input[name="payment_changes"]')
                          if (parseInt(totalBayarEl.val()) < parseInt('{{ $row->membershipType->price ?? $row->details()->sum('sub_amount') }}')) {
                            console.log(parseInt(totalBayarEl.val()))
                            Swal.fire('Error!', 'Total tidak boleh kurang dari '+'Rp. {{ number_format($row->membershipType->price ?? $row->details()->sum('sub_amount')) }}','error')
                            e.preventDefault()
                            return false
                          }
                          $(this).find('input[name="payment_changes"]').val(parseInt(totalBayarEl.val()) - parseInt('{{ $row->membershipType->price ?? $row->details()->sum('sub_amount') }}'))
                        })
                      })
                    </script>
                </div>
            </div>
        </div>

        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<!-- basic table -->
