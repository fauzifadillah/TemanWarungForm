<?php

namespace App\Http\Controllers;

use App\Data;
use DataTables;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return view('data.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_canvaser' => 'required|max:255',
            'nama_pemilik' => 'required|max:255',
            'alamat_lengkap' => 'required',
            'rt_rw' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
            'jenis_usaha' => 'required|max:255',
            'nomor_whatsapp' => 'required|unique:data|max:255',
            'aplikasi_chat' => 'required|max:255',
            'status_bangunan' => 'required|max:255',
            'tiga_produk' => 'required|max:255',
            'foto_bangunan' => 'required|file|image|mimes:jpeg,png,jpg|max:5000'
        ]);

        $imageName = "noimage.png";
        if ($request->foto_ktp) {
            $request->validate([
                'foto_ktp' => 'nullable|file|image|mimes:jpeg,png,jpg'
            ]);
            $directory = '/upload/foto_ktp/';
            $imageName = $request->nama_pemilik.'.'.$request->foto_ktp->extension();
            $request->foto_ktp->move(public_path($directory), $imageName);
            $imageName = $directory.$imageName;
        }

        $fileName = null;
        if(request()->hasFile('foto_bangunan')){
            $request->validate([
                'foto_bangunan' => 'nullable|file|image|mimes:jpeg,png,jpg'
            ]);
            $directory = '/upload/foto_bangunan/';
            $imageBangunan = $request->nama_pemilik.'.'.$request->foto_bangunan->extension();
            $request->foto_bangunan->move(public_path($directory), $imageBangunan);
            $imageBangunan = $directory.$imageBangunan;
        }


        $data = new Data();
        $data->nama_canvaser = $request->nama_canvaser;
        $data->nama_pemilik = $request->nama_pemilik;
        $data->alamat_lengkap = $request->alamat_lengkap;
        $data->rt_rw = $request->rt_rw;
        $data->kelurahan = $request->kelurahan;
        $data->kecamatan = $request->kecamatan;
        $data->kota = $request->kota;
        $data->kode_pos = $request->kode_pos;
        $data->jenis_usaha = $request->jenis_usaha;
        $data->aplikasi_chat = $request->aplikasi_chat;
        $data->nomor_whatsapp = $request->nomor_whatsapp;
        $data->status_bangunan = $request->status_bangunan;
        $data->tiga_produk = $request->tiga_produk;
        $data->foto_ktp = $imageName;
        $data->foto_bangunan = $imageBangunan;
        $data->save();
        $request->session()->flash('status', "Data berhasil ditambahkan!");
        return redirect('/');
    }

    public function dashboard()
    {
        return view('data.dashboard');
    }

    public function datatable()
    {
        $model = Data::get();
        return DataTables::of($model)
            ->editColumn('foto_ktp', function($model){
                if ($model->foto_ktp == NULL){
                    return 'No Image';
                }
                $url = asset($model->foto_ktp);
                $image = '<img src="'.$url.'" width="100"/>';
                return $image;
            })
            ->editColumn('foto_bangunan', function($model){
                if ($model->foto_bangunan == NULL){
                    return 'No Image';
                }
                $url = asset($model->foto_bangunan);
                $image = '<img src="'.$url.'" width="100"/>';
                return $image;
            })
            ->addColumn('alamat', function($model){
                $alamat = $model->alamat_lengkap.' '.$model->rt_rw.' '.$model->kelurahan.' '.$model->kecamatan.' '.$model->kota.' '.$model->kode_pos;
                return $alamat;
            })
            ->addColumn('detail', function($model){
                return '<button type="button" href="#" class="btn btn-primary btn-sm details-control">Detail</button>';
            })
            ->addIndexColumn()
            ->rawColumns(['foto_ktp', 'foto_bangunan', 'detail'])
            ->make(true);
    }
}
