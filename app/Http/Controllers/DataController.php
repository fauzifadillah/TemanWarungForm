<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;

class DataController extends Controller
{
    public function index() {
        return view('data.index');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_canvaser' => 'required|max:255',
            'nama_pemilik' => 'required|max:255',
            'alamat_lengkap' => 'required',
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
                'foto_ktp' => 'nullable|file|image|mimes:jpeg,png,jpg|max:5000'
            ]);
            $imageName = $request->nama_pemilik . '.' . $request->foto_ktp->extension();
            $request->foto_ktp->move(public_path('foto_ktp'), $imageName);
        }

        $fileName = null;
        if(request()->hasFile('foto_bangunan')) {
            $imageBangunan = $request->nama_pemilik . '.' . $request->foto_bangunan->extension();
            $request->foto_bangunan->move(public_path('foto_bangunan'), $imageBangunan);
        }


        $data = new Data();
        $data->nama_canvaser = $request->nama_canvaser;
        $data->nama_pemilik = $request->nama_pemilik;
        $data->alamat_lengkap = $request->alamat_lengkap;
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
}
