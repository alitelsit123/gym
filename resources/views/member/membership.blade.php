@extends('member.layout')

@section('body')
@php
$memberships = \App\Models\MembershipType::get();
@endphp
<div class="app-content-area">
  <div class="container-fluid">
    <h4 class="mb-3">Sewa Membership</h4>
    <div class="row">
      @foreach ($memberships as $row)
      <div class="col-md-6">
        <form class="card type-{{$row->id}}" action="{{url('member/membership/store_payment')}}" enctype="multipart/form-data" method="post">
          <input type="hidden" name="type_id" value="{{$row->id}}" />
          <div class="card-body">
            <h4 class="font-weight-bold">{{$row->name}}</h4>
            <h4 class="badge bg-info">{{$row->class}}</h4>
            <p>{{$row->description}}</p>
            <h3 class="text-center font-weight-bold">
              <strong>
                Rp. {{number_format($row->price)}}
              </strong>
            </h3>
            <div class="alert alert-danger mb-0 mt-3 error-{{$row->id}}" style="display:none;">
              Pilih salah satu
            </div>
          </div>
          <div class="card-footer p-2">
            <div class="row">
              <div class="col-12">
                @php
                $existingMembershipPending = \App\Models\Membership::whereUser_id(auth()->user()->id)->where('membership_type_id', $row->id)->whereStatus('pending')->first();
                $existingMembershipApproved = \App\Models\Membership::whereUser_id(auth()->user()->id)->where('membership_type_id', $row->id)->whereStatus('approve')->first();
                @endphp
                @if($existingMembershipPending)
                <button type="button" class="btn btn-warning w-100 hover:bg-warning" disabled>Menunggu verifikasi pembayaran</button>
                @elseif ($existingMembershipApproved)
                <button type="button" class="btn btn-secondary w-100 hover:bg-secondary" disabled>Anda sudah berlangganan</button>
                @else
                <button type="button" class="btn btn-success w-100 btn-open-modal-{{$row->id}}">Langganan</button>
                @endif
                <!-- Modal -->
                <div class="modal fade" id="exampleModal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-body">
                            <div class="alert alert-info eot-body{{$row->id}}">
                              <strong>Perhatian!</strong><br />
                              <p>
                                <strong>Transfer ke rekening {{config('app.norek.bni')}} lalu upload bukti ke sini.</strong>
                              </p>
                            </div>
                            <div class="form-group mb-3 ">
                              <label for="" class="mb-1">Tipe Pembayaran</label>
                              <select name="payment_type" id="" class="form-control select{{$row->id}}" required>
                                <option value="">-- Pilih Tipe Pembayaran --</option>
                                <option value="transfer">Transfer</option>
                                <option value="tunai">Tunai</option>
                              </select>
                            </div>
                            <div class="form-group mb-3 eot-body{{$row->id}}" style="display: none;">
                              <label for="" class="mb-1">Bukti Transfer</label>
                              <input type="file" name="payment_eot" id="" class="form-control" />
                            </div>
                            <div class="form-group mb-3">
                              <label for="" class="mb-1">Tanggal Mulai</label>
                              <input type="date" name="start_date" id="" class="form-control" required />
                            </div>
                            {{-- <div class="form-group">
                              <label for="" class="mb-1 typename-{{$row->id}}"></label>
                              <input type="number" name="duration" class="form-control" id="" required />
                            </div> --}}

                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <script>
          $(document).ready(function() {
            $('.btn-open-modal-{{$row->id}}').click(function(e) {
              // $('.error-{{$row->id}}').hide()
              // console.log($('input[name="type"]:checked'))
              // if ($('input[name="type"]:checked').length == 0) {
              //   e.preventDefault()
              //   $('.error-{{$row->id}}').show()
              // } else {
              //   $('.typename-{{$row->id}}').text(`Total ${$('input[name="type"]:checked').first().data('tr')}`)
              //   $('#exampleModal-{{$row->id}}').modal('show')
              // }
              $('#exampleModal-{{$row->id}}').modal('show')
            })
          })
        </script>
        <script>
          $(document).ready(function() {
            $('.select{{$row->id}}').change(function() {
              console.log('test')
              if ($(this).val() == 'transfer') {
                $('.eot-body{{$row->id}}').show()
              } else {
                $('.eot-body{{$row->id}}').hide()
              }
            })
          })
        </script>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
