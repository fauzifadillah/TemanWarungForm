@extends('script')

@section('content')
<div class="container">
    <div class="justify-content-center mt-5">
        @if(Session()->has('status'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">X</button>
                {{Session()->get('status')}}
            </div>
        @endif

        @if($errors->any())
            <div class="aler alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/createData" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="nama_canvaser">Nama Canvaser</label>
              <input type="text" class="form-control" name="nama_canvaser" id="canvaser" placeholder="input..">
            </div>
            <div class="form-group">
              <label for="nama_pemilik">Nama Pemilik Usaha</label>
              <input type="text" class="form-control" name="nama_pemilik" id="nama" placeholder="input..">
            </div>
            <div class="form-group">
              <label for="alamat_lengkap">Alamat Lengkap</label>
              <div class="input-group-append">
                <span class="input-group-text">jalan, kecamatan, kota</span>
                <input type="text" class="form-control" name="alamat_lengkap" id="alamat" placeholder="input..">
              </div>
            </div>
            <div class="form-group">
              <label for="jenis_usaha">Jenis Usaha</label>
              <input type="text" class="form-control" name="jenis_usaha" id="usaha" placeholder="input..">
            </div>
            <div class="form-group">
              <label for="aplikasi_chat">Aplikasi Chatting Yang Sering Digunakan</label>
              <input type="text" class="form-control" name="aplikasi_chat" id="chat" placeholder="input..">
            </div>
            <div class="form-group">
              <label for="nomor_whatsapp">Nomor Whatsapp</label>
              <input type="number" class="form-control" name="nomor_whatsapp" id="wa" placeholder="input..">
            </div>
            <div class="form-group">
                <label for="status_bangunan">Status Bangunan</label>
                <select class="custom-select custom-select-s" name="status_bangunan">
                    <option value="">Pilih</option>
                    <option value="Pribadi">Pribadi</option>
                    <option value="Ngontrak">Ngontrak</option>
                </select>
            </div>
            <div class="form-group">
              <label for="tiga_produk">Tiga Produk Terlaku</label>
              <input type="text" class="form-control" name="tiga_produk" id="produk" placeholder="input..">
            </div>
            <div class="form-group">
              <label for="foto_ktp">Foto KTP</label>
              <input type="file" class="form-control" name="foto_ktp" id="ktp">
            </div>
            <div class="form-group">
              <label for="foto_bangunan" class="tai">Foto Bangunan</label>
              <input type="file" class="form-control" name="foto_bangunan" id="bangunan" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection


