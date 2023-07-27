@extends('admin.layout')

@section('body')
@php
if (request('range')) {
  $startDate = explode(' - ', request('range'))[0] ?? null;
  $startDate = \Carbon\Carbon::create(explode('/',$startDate)[2],explode('/',$startDate)[0],explode('/',$startDate)[1])->format('Y-m-d');
  $endDate = explode(' - ', request('range'))[1] ?? null;
  $endDate = \Carbon\Carbon::create(explode('/',$endDate)[2],explode('/',$endDate)[0],explode('/',$endDate)[1])->format('Y-m-d');
} else {
  $startDate = null;
  $endDate = null;
}

// dd($endDate);
@endphp
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">



<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>






<div class="card">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between">
      <h4>Transaksi</h4>

    </div>
    <hr />
    <div>
      <form action="" method="get">
        <label for="" class="mb-2">Range Tanggal</label>
        <input type="text" name="range" id="" class="form-control range" readonly>
        <a  href="{{url()->current()}}" class="btn btn-sm btn-danger mt-2">Reset</a>
        <button type="submit" class="btn btn-sm btn-primary mt-2">Filter</button>
        <button type="button" class="btn btn-success btn-sm btn-print-all mt-2">Print Laporan</button>
        <script>
          $(document).ready(function() {
            $('.btn-print-all').click(function() {
              window.open("{{url('report-all')}}?range="+$('input[name="range"]').val());
            })
          })
        </script>
      </form>
      <script>
        $(document).ready(function () {

          function cb(start, end) {
              $('.range').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
          }
          var start = moment('{{request('range') ? $startDate:\Carbon\Carbon::now()->format('m-d-Y')}}', "YYYY/MM/DD");
          var end = moment('{{request('range') ? $endDate:\Carbon\Carbon::now()->format('m-d-Y')}}', "YYYY/MM/DD");
          console.log(start)
          $('.range').daterangepicker({
            startDate: start,
            endDate: end,
            linkedCalendars: false,
            autoUpdateInput: false,
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
          },cb);
          @if(request('range'))
          cb(start, end);
          @else
          $('.range').val('')
          @endif
        })
      </script>
    </div>
    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">Semua</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="member-tab" data-bs-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">Produk</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="trainer-tab" data-bs-toggle="tab" href="#trainer" role="tab" aria-controls="trainer" aria-selected="false">Membership</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="beban-tab" data-bs-toggle="tab" href="#beban" role="tab" aria-controls="beban" aria-selected="false">Beban Pengeluaran</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="other-tab" data-bs-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false">Other</a>
      </li>
    </ul>
    <div class="tab-content pt-2" id="myTabContent">
      <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
        @include('admin.history.table-all')
      </div>
      <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
        @include('admin.history.table-product')
      </div>
      <div class="tab-pane fade" id="trainer" role="tabpanel" aria-labelledby="trainer-tab">
        @include('admin.history.table-membership')
      </div>
      <div class="tab-pane fade" id="beban" role="tabpanel" aria-labelledby="beban-tab">
        @include('admin.history.table-packet')
      </div>
      <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
        @include('admin.history.table-other')
      </div>
    </div>
  </div>
</div>
@endsection
