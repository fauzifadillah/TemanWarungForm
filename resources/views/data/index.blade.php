@extends('script')

@section('content')
<div class="container">
  <div class="row container-content">
    <!-- Page Title -->
    <div class="col-lg-12 text-center">
      <img class="page-title" src="https://www.survey.temanwarung.id/tw_biru.png">
    </div>
    <div class="col-lg-12 text-center">
      <b>#SelaluAdaTeman</b>
    </div>
    <div class="col-lg-12">
      
    </div>
  </div>
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
              <input type="text" class="form-control" name="nama_canvaser" id="canvaser" placeholder="Masukan Nama Canvaser..">
            </div>
            <div class="form-group">
              <label for="nama_pemilik">Nama Pemilik Usaha</label>
              <input type="text" class="form-control" name="nama_pemilik" id="nama" placeholder="Masukan Nama Pemilik MSME..">
            </div>
              <label for="alamat_lengkap">Alamat Lengkap</label>
                <input type="text" class="form-control py-2 mb-3" name="alamat_lengkap" id="alamat" placeholder="Masukan Alamat..">
            {{-- Start of RT RW --}}
                <input type="text" class="form-control py-2 my-3" name="rt_rw" id="rt_rw" placeholder="Masukan RT/RW..">              
            {{-- End of RT RW --}}
            {{-- Start of Kelurahan --}}
              <input type="text" class="form-control py-2 my-3" name="kelurahan" id="kelurahan" placeholder="Masukan Kelurahan..">           
            {{-- End of Kelurahan --}}
            {{-- Start of Kecamatan --}}  
              <input type="text" class="form-control py-2 my-3" name="kecamatan" id="kecamatan" placeholder="Masukan Kecamatan..">
            {{-- End of Kecamatan --}}
            {{-- Start of Kota --}}
              <input type="text" class="form-control py-2 my-3" name="kota" id="kota" placeholder="Masukan Kota..">
            {{-- End of Kota --}}
            {{-- Start of Kode Pos --}}
              <input type="text" class="form-control py-2 my-3" name="kode_pos" id="kode_pos" placeholder="Masukan Kode Pos..">
            {{-- End of Kode Pos --}}
            <div class="form-group">
              <label for="jenis_usaha">Jenis Usaha</label>
              <input type="text" class="form-control" name="jenis_usaha" id="usaha" placeholder="Masukan Jenis Usaha..">
            </div>
            <div class="form-group">
              <label for="aplikasi_chat">Chat Platform yang sering digunakan</label>
              <input type="text" class="form-control" name="aplikasi_chat" id="chat" placeholder="Contoh: WhatsApp, LINE, dll..">
            </div>
            <div class="form-group">
              <label for="nomor_whatsapp">Nomor Whatsapp</label>
              <input type="number" class="form-control" name="nomor_whatsapp" id="wa" placeholder="Masukan Nomor WhatsApp..">
            </div>
            <div class="form-group">
                <label for="status_bangunan">Status Bangunan</label>
                <select class="custom-select custom-select-s" name="status_bangunan">
                    <option value="">Pilih</option>
                    <option value="Pribadi">Pribadi</option>
                    <option value="Kontrak">Kontrak</option>
                </select>
            </div>
            <div class="form-group">
              <label for="tiga_produk">3 Produk Terlaku</label>
              <input type="text" class="form-control" name="tiga_produk" id="produk" placeholder="Contoh: Teh Pucuk, Indomie, Softex..">
            </div>
            <div class="form-group">
              <label for="foto_ktp">Foto KTP</label>
              <input type="file" class="form-control" name="foto_ktp" id="ktp">
            </div>
            <div class="form-group">
              <label for="foto_bangunan" class="tai">Foto Bangunan</label>
              <input type="file" class="form-control" name="foto_bangunan" id="bangunan" accept="image/*">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection


