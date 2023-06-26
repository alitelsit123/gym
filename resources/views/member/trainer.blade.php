@extends('member.layout')

@section('body')
@php
$packets = \App\Models\Packet::whereHas('trainer', function($query) {
  $query->whereRole('trainer');
})->get();
@endphp
<div class="app-content-area">
  <div class="container-fluid">
    <h4 class="mb-3">Sewa Paket</h4>
    <div class="row">
      @foreach ($packets as $row)
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex align-items-centerjustify-content-between">
              <div>
                <h4 class="mb-0"><a href="#!" class="text-inherit font-weight-bold">Paket {{$row->title}}</a></h4>
              </div>
            </div>
            <hr />
            <div class="card bg-primary text-white">
              <div class="card-body">
                <div>Trainer: {{$row->trainer->name}}</div>
                <div>
                  @foreach ($row->trainer->specialists as $rowBadge)
                  <span class="badge bg-info">{{$rowBadge->name}}</span>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="mt-3">
              <p class="mb-0">{{Str::limit($row->description, 50, '...')}}</p>
            </div>
          </div>
          <div class="card-footer p-2">
            <div class="row">
              <div class="col-6">
                <small style="display: block;">Harga Paket: </small>
                <strong>Rp. {{number_format($row->price)}},-</strong>
              </div>
              <div class="col-6">
                <form class="card" action="{{url('member/trainer/store_payment')}}" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="packet_id" value="{{$row->id}}" />
                  @php
                  $existingTrainerMemberPending = \App\Models\TrainerMember::whereMember_id(auth()->user()->id)->wherePacket_id($row->id)->whereStatus('pending')->first();
                  $existingTrainerMemberApprove = \App\Models\TrainerMember::whereMember_id(auth()->user()->id)->wherePacket_id($row->id)->whereStatus('approve')->first();
                  @endphp
                  @if ($existingTrainerMemberPending || $existingTrainerMemberApprove)
                  <button type="button" class="btn btn-secondary w-100 hover:bg-secondary" disabled>Anda sudah berlangganan</button>
                  @else
                  <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$row->id}}">Langganan</button>
                  @endif
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                              <div class="alert alert-info">
                                <strong>Perhatian!</strong><br />
                                <p>
                                  <strong>Transfer ke rekening xxx-xxx-xxx lalu upload bukti ke sini.</strong>
                                </p>
                              </div>
                              <div class="form-group mb-3">
                                <label for="" class="mb-1">Bukti Transfer</label>
                                <input type="file" name="payment_eot" id="" class="form-control" required />
                              </div>
                              <div class="form-group mb-3">
                                <label for="" class="mb-1">Tanggal Mulai</label>
                                <input type="date" name="start_date" id="" class="form-control" required />
                              </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
