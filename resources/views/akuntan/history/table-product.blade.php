@php
$order = \App\Models\Order::where('status', 'pending')->get();
// \App\Models\Order::query()->update(['status' => 'pending']);
@endphp
<table class="table table-centered text-nowrap mb-0">
  <thead class="table-light">
    <tr>
      <th>#</th>
      <th>Tanggal</th>
      <th>Produk</th>
      <th>Jumlah</th>
      <th>Total Harga</th>
      <th>Bukti Pembayaran</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($order as $row)
      <tr>
        <td>#{{$row->id}}</td>
        <td>{{$row->created_at->format('d, F Y')}}</td>
        <td style="width:300px;">
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
        </td>
        <td>{{$row->details()->sum('quantity')}}</td>
        <td>Rp. {{number_format($row->details()->sum('sub_amount'))}}</td>
        <td>
          <img src="{{asset('storage/product_payment/'.$row->payment_eot)}}" alt="" srcset="" style="width:50px;height:auto;" />
        </td>
        <td>
          @if ($row->payment_type == 'transfer')
          <a href="{{url('akuntan/approved_payment_product?id='.$row->id)}}" onclick="return confirm('Approve Transaksi ?')" class="btn btn-sm btn-success">Approve</a>
          @else
          <button type="button" class="btn btn-sm btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModals-{{$row->id}}">Bayar sekarang</button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModals-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <form action="{{url('akuntan/approved_payment_product?id='.$row->id)}}" method="get" class="payment-{{$row->id}}">
                        <input type="hidden" name="id" value="{{$row->id}}">
                        <div class="modal-body">
                          <div class="form-group mb-3">
                            <label for="">Total Harga</label>
                            <input type="string" value="Rp {{number_format($row->gross_amount)}}" id="" class="form-control" disabled />
                          </div>
                          <div class="form-group mb-3">
                            <label for="">Total Bayar</label>
                            <input type="number" name="payment_total" value="0" id="" class="form-control payment_totalm{{$row->id}}" />
                          </div>
                          <div class="form-group mb-3">
                            <label for="">Kembalian</label>
                            <input type="text" value="Rp 0" id="" class="form-control kembalim{{$row->id}}" disabled />
                          </div>
                          <script>
                          $(document).ready(function() {
                            $('.payment_totalm{{$row->id}}').keyup(function() {
                              $('.kembalim{{$row->id}}').val(`Rp ${($(this).val() - {{$row->gross_amount}}).toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`)
                            })
                          })
                          </script>
                          <div class="form-group" style="display: none;">
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
                          $('.payment-{{$row->id}}').submit(function(e) {
                            const totalBayarEl = $(this).find('input[name="payment_total"]')
                            const totalChangesEl = $(this).find('input[name="payment_changes"]')
                            if (parseInt(totalBayarEl.val()) < parseInt('{{ $row->gross_amount }}')) {
                              Swal.fire('Error!', 'Total tidak boleh kurang dari '+'Rp. {{ number_format($row->gross_amount) }}','error')
                              e.preventDefault()
                              return false
                            }
                            $(this).find('input[name="payment_changes"]').val(parseInt(totalBayarEl.val()) - parseInt('{{ $row->gross_amount }}'))
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
