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
      {title: '', data: 'action', name: 'action', orderable:false, className: 'dt-center'}
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
    }
    else {
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
    $($.fn.dataTable.tables(true)).DataTable()
     .columns.adjust();
  });

  $('body').on('click', '.modal-show', function(event){
    event.preventDefault();
    $('#modal-body').trigger('reset');

    var me = $(this),
        url = me.attr('href'),
        title = me.attr('name');

    $.ajax({
      url: url,
      dataType: 'html',
      success: function (response) {
        $('#modal-content').html(response);
        $('#modal-title').text(title);
        $('input[name=_method]').val(me.hasClass('edit') ? 'PUT' : 'POST');
        $('#modal-close').text(me.hasClass('edit') ? 'Cancel' : 'Close');
        $('#modal-save').text(me.hasClass('edit') ? 'Update' : 'Create');
      }
    });

    $('#modal').modal('show');
  });

  $('body').on('submit','.form', function(event){
    event.preventDefault();

    var form = $('.form'),
        url = form.attr('action'),
        method = form.attr('id');

    $.ajax({
      url : url,
      type : "POST",
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      processData: false,

      success: function(data){
        $('#modal').modal('hide');
        $('#table').DataTable().ajax.reload();
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          background: '#28a745',
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })
        Toast.fire({
          type: 'success',
          title: 'Data has been saved!'
        })
        $('#modal-body').trigger('reset');
      },

      error: function(xhr){
        var res = xhr.responseJSON;
        if ($.isEmptyObject(res) == false) {
          form.find('.invalid-feedback').remove();
          form.find('.is-invalid').removeClass('is-invalid');
          $.each(res.errors, function (key, value) {
            $('#' + key)
              .addClass('is-invalid')
              .after('<div class="invalid-feedback d-block">'+value+'</div>');
          });
        };
      }
    });
  });

  $('body').on('click', '.delete', function (event) {
    event.preventDefault();

    var me = $(this),
        url = me.attr('href'),
        name = me.attr('name');

    swal({
      title: "Are you sure want to delete '" + name + "'?",
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result)=>{
      if(result.value){
        $.ajax({
          url: url,
          type: "POST",
          data: {
            '_method': 'DELETE',
            '_token': '{{ csrf_token() }}'
          },
          success: function(response){
            $('#table').DataTable().ajax.reload();
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              background: '#BD362F',
              onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            Toast.fire({
              type: 'success',
              text: 'Data has been deleted'
            })
          },
          error: function(xhr){
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'Something went wrong!'
            });
          }
        });
      }
    });
  });

</script>
@endpush