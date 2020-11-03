@extends('layouts.index')

@section('title', 'Form List')

@section('content')
<div class="row" style="padding-top:15px;">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-3"><strong>Form List</strong></h3>
        <table id="table" class="table table-striped table-bordered text-sm" style="width:100%"></table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  var detail = $('#table').DataTable({
    responsive: true,
    serverSide: true,
    scrollX: true,
    ajax: "{{ route('data.dt') }}",
    order: [[ 1, "asc" ]],
    columns: [
      {title: 'No', data: 'DT_RowIndex', name: 'no', orderable:false, className: 'dt-center'},
      {title: 'Nama Canvaser', data: 'nama_canvaser', name: 'nama_canvaser', className: 'dt-head-center'},
      {title: 'Nama Pemilik', data: 'nama_pemilik', name: 'nama_pemilik', className: 'dt-head-center'},
      {title: 'Jenis Usaha', data: 'jenis_usaha', name: 'jenis_usaha', orderable:false, className: 'dt-center'},
      {title: 'No WhatsApp', data: 'nomor_whatsapp', name: 'nomor_whatsapp', orderable:false, className: 'dt-center'},
      {title: '', data: 'detail', name: 'detail', orderable:false, className: 'dt-center'}
    ],
  });

  function format (d) {
    return '<table>'+
        '<tr>'+
            '<td>3 Produk :</td>'+
            '<td>'+d.tiga_produk+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Status Bangunan:</td>'+
            '<td>'+d.status_bangunan+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Alamat:</td>'+
            '<td>'+d.alamat+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Foto Bangunan:</td>'+
            '<td>'+d.foto_bangunan+'</td>'+
        '</tr>'+
        '<tr >'+
            '<td>Foto KTP:</td>'+
            '<td>'+d.foto_ktp+'</td>'+
        '</tr>'+
    '</table>';
  };


  $('#table tbody').on('click', '.details-control', function () {
    event.preventDefault();
    var tr = $(this).closest('tr');
    var row = detail.row( tr );

    if ( row.child.isShown() ) {
        row.child.hide();
        tr.removeClass('shown');
        $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust();
    }
    else {
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
        $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust();
    }
  });
</script>
@endpush