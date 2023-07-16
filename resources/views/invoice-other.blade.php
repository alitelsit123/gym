@extends('akuntan.layout')

@section('body')

<div class="card">
  <div class="card-body">
    <div class="card">
      <div class="card-body mx-4">
        <div class="container">
          <p class="my-5" style="font-size: 30px;">Termakasih atas pembeliannya</p>
          <div class="row">
            <ul class="list-unstyled">
              <li class="text-black">{{$model->name}}</li>
              <li class="text-muted mt-1"><span class="text-black">Invoice</span> #{{$model->id}}</li>
              <li class="text-black mt-1">{{now()}}</li>
            </ul>
            <hr>

          </div>
          @if ($type != 'Order')
          <div class="row">
            <div class="col-xl-10">
              <p>{{(Str::ucfirst($type) == 'Membership' ? $model->membershipType->name.' '.$model->membershipType->class:(Str::ucfirst($type) == 'Product' ? ($model->product->name ?? ''):$model->packet->title))}}</p>
            </div>
            <div class="col-xl-2">
              <p class="float-end">
                Rp. {{((Str::ucfirst($type) == 'Membership' ? $model->membershipType->{'price'}:(Str::ucfirst($type) == 'Product' ? 'Rp. '.($model->details()->sum('sub_amount') > 0 ? $model->details()->sum('sub_amount') ?? 0:0):0)))}}
              </p>
            </div>
            <hr>
          </div>
          @else
          @foreach ($model->details as $row)
          <div class="row">
            <div class="col-xl-10">
              <p><strong>{{$row->product->category}} - </strong> {{$row->product->name}} (x{{$row->quantity}})</p>
            </div>
            <div class="col-xl-2">
              <p class="float-end">
                Rp. {{number_format($row->sub_amount)}}
              </p>
            </div>
            <hr>
          </div>
          @endforeach
          @endif

          <div class="row text-black">
            <div class="col-xl-12">
              <p class="float-end fw-bold">
                @if ($type != 'Order')
                @php
                $price = ((Str::ucfirst($type) == 'Membership' ? $model->membershipType->{'price'}:(Str::ucfirst($type) == 'Product' ? 'Rp. '.($model->details()->sum('sub_amount') > 0 ? $model->details()->sum('sub_amount') ?? 0:0):0)));
                @endphp
                Total: Rp. {{$price}}
                @else
                Total: Rp. {{$price}}
                @endif
              </p>
            </div>
            <hr style="border: 2px solid black;">
            @if ($model->payment_type == 'tunai')
            <div class="col-xl-12">
              <p class="float-end fw-bold text-end">
                Total Bayar: Rp. {{number_format($model->gross_amount)}}
                <br />Kembalian: Rp. {{number_format($model->payment_changes)}}
              </p>
            </div>
            @endif
          </div>
          <div class="text-center" style="margin-top: 90px;">
            <a href="#" onclick="window.print()"><u class="text-info">CETAK</u></a>
            <p>MAHESA GYM & FITNESS</p>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
