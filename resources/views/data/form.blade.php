<form class="form" method="POST" action="{{ $model->exists ? route('data.update', $model->id) : route('data.store') }}" files=true>
{{ csrf_field() }} {{ method_field($model->exists ? 'PUT' : 'POST') }}

<div class="modal-header">
    <h5 class="modal-title" id="modal-title"></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        &times;
    </button>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="" class="control-label">Nama Canvaser</label>
        <input type="text" class="form-control" name="nama_canvaser" id="canvaser" placeholder="Masukan Nama Canvaser.." value="{{$model->nama_canvaser}}">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Nama Pemilik Usaha</label>
        <input type="text" class="form-control" name="nama_pemilik" id="nama" placeholder="Masukan Nama Pemilik MSME.." value="{{$model->nama_pemilik}}">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Alamat</label>
        <input type="text" class="form-control py-2 mb-3" name="alamat_lengkap" id="alamat" placeholder="Masukan Alamat.." value="{{$model->alamat_lengkap}}">
        <input type="text" class="form-control py-2 my-3" name="rt_rw" id="rt_rw" placeholder="Masukan RT/RW.." value="{{$model->rt_rw}}">
        <input type="text" class="form-control py-2 my-3" name="kelurahan" id="kelurahan" placeholder="Masukan Kelurahan.." value="{{$model->kelurahan}}">
        <input type="text" class="form-control py-2 my-3" name="kecamatan" id="kecamatan" placeholder="Masukan Kecamatan.." value="{{$model->kecamatan}}">
        <input type="text" class="form-control py-2 my-3" name="kota" id="kota" placeholder="Masukan Kota.." value="{{$model->kota}}">
        <input type="text" class="form-control py-2 my-3" name="kode_pos" id="kode_pos" placeholder="Masukan Kode Pos.." value="{{$model->kode_pos}}">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Jenis Usaha</label>
        <input type="text" class="form-control" name="jenis_usaha" id="usaha" placeholder="Masukan Jenis Usaha.." value="{{$model->jenis_usaha}}">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Chat Platform yang sering digunakan</label>
        <input type="text" class="form-control" name="aplikasi_chat" id="chat" placeholder="Contoh: WhatsApp, LINE, dll.." value="{{$model->aplikasi_chat}}">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Nomor WhatsApp</label>
        <input type="number" class="form-control" name="nomor_whatsapp" id="wa" placeholder="Masukan Nomor WhatsApp.." value="{{$model->nomor_whatsapp}}">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Status Bangunan</label>
        <select class="custom-select custom-select-s" name="status_bangunan">
          <option value="">Pilih</option>
          <option value="Pribadi">Pribadi</option>
          <option value="Kontrak">Kontrak</option>
        </select>
    </div>
    <div class="form-group">
        <label for="" class="control-label">3 Produk Terlaku</label>
        <input type="text" class="form-control" name="tiga_produk" id="produk" placeholder="Contoh: Teh Pucuk, Indomie, Softex.." value="{{$model->tiga_produk}}">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Foto KTP</label>
        <input type="file" class="form-control" name="foto_ktp" id="ktp" accept="image/*" value="{{$model->foto_ktp}}">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Foto Bangunan</label>
        <input type="file" class="form-control" name="foto_bangunan" id="bangunan" accept="image/*" value="{{$model->name}}">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close"></button>
    <button type="submit" class="btn btn-primary" id="modal-save"></button>
</div>

</form>