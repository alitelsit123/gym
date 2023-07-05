@extends('trainer.layout')

@section('body')
<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Transaksi</h4>
    </div>
    @php
    $memberships = \App\Models\TrainerMember::has('packet')->latest()->get();
    @endphp
    <!-- basic table -->
    <table class="table table-stripped mt-2">
      <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Paket</th>
            <th scope="col">Tanggal Langganan</th>
            <th scope="col">EOT</th>
            <th scope="col">Nama Membership</th>
            <th scope="col">Harga</th>
            <th scope="col">Durasi</th>
            <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($memberships as $k => $row)
        <tr>
          <th scope="row">{{$k+1}}</th>
          <th scope="row">{{$row->packet->title}}</th>
          <td>{{\Carbon\Carbon::parse($row->payment_date)->format('d, F Y')}}</td>
          <td>
            <img src="{{asset('storage/eot/'.$row->payment_eot)}}" alt="" srcset="" style="width:50px;height:auto;" />
          </td>
          <td>{{$row->member->name}}</td>
          <td>Rp. {{ number_format($row->packet->price) }}</td>
          <td>{{$row->duration}} Hari</td>
          <td>
            @if($row->status == 'approve')
            <div class="badge bg-success">Sudah diverifikasi</div>
            @elseif ($row->payment_type == 'transfer')
            <a href="{{url('trainer/approved_payment_packet?id='.$row->id)}}" onclick="return confirm('Approve Transaksi ?')" class="btn btn-sm btn-success">Approve</a>
            @else
            <button type="button" class="btn btn-sm btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$row->id}}">Bayar Tunai</button>
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
                        <form action="{{url('trainer/approved_payment_packet?id='.$row->id)}}" method="get" class="payment-{{$row->id}}">
                          <input type="hidden" name="id" value="{{$row->id}}">
                          <div class="modal-body">
                            <div class="form-group mb-3">
                              <label for="">Total Harga</label>
                              <input type="string" value="Rp {{number_format($row->packet->price)}}" id="" class="form-control" disabled />
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
                                $('.kembalim{{$row->id}}').val(`Rp ${($(this).val() - {{$row->packet->price}}).toLocaleString('us', {minimumFractionDigits: 0, maximumFractionDigits: 0})}`)
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
                              if (parseInt(totalBayarEl.val()) < parseInt('{{ $row->packet->price }}')) {
                                Swal.fire('Error!', 'Total tidak boleh kurang dari '+'Rp. {{ number_format($row->packet->price) }}','error')
                                e.preventDefault()
                                return false
                              }
                              $(this).find('input[name="payment_changes"]').val(parseInt(totalBayarEl.val()) - parseInt('{{ $row->packet->price }}'))
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

  </div>
</div>
@endsection
