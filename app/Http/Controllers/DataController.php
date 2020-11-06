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
            'foto_ktp' => 'nullable|file|image|mimes:jpeg,png,jpg',
            'foto_bangunan' => 'required|file|image|mimes:jpeg,png,jpg'
        ]);

        $model = $request->all();
        if($request->hasFile('foto_ktp')){
            $directory = '/upload/foto_ktp/';
            $imageName = $request->nama_pemilik.'.'.$request->foto_ktp->extension();
            $request->foto_ktp->move(public_path($directory), $imageName);
            $model['foto_ktp'] = $imageName;
        }
        else{
            $model['foto_ktp'] = 'noimage.png';
        }

        if($request->hasFile('foto_bangunan')){
            $directory = '/upload/foto_bangunan/';
            $imageBangunan = $request->nama_pemilik.'.'.$request->foto_bangunan->extension();
            $request->foto_bangunan->move(public_path($directory), $imageBangunan);
            $model['foto_bangunan'] = $imageBangunan;
        }

        $save = Data::create($model);
        $request->session()->flash('status', "Data berhasil ditambahkan!");
        return redirect('/');
    }

    public function edit($id)
    {
        $model = Data::findOrFail($id);
        return view('data.form', ['model' => $model]);
    }

    public function update(Request $request, $id)
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
            'nomor_whatsapp' => 'required|max:255',
            'aplikasi_chat' => 'required|max:255',
            'status_bangunan' => 'required|max:255',
            'tiga_produk' => 'required|max:255',
            'foto_ktp' => 'nullable|file|image|mimes:jpeg,png,jpg',
            'foto_bangunan' => 'nullable|file|image|mimes:jpeg,png,jpg'
        ]);

        $model = $request->all();
        if($request->hasFile('foto_ktp')){
            $directory = 'foto_ktp';
            $imageName = $request->nama_pemilik.'.'.$request->foto_ktp->extension();
            $request->foto_ktp->move(public_path($directory), $imageName);
            $model['foto_ktp'] = $imageName;
        }

        if($request->hasFile('foto_bangunan')){
            $directory = 'foto_bangunan';
            $imageBangunan = $request->nama_pemilik.'.'.$request->foto_bangunan->extension();
            $request->foto_bangunan->move(public_path($directory), $imageBangunan);
            $model['foto_bangunan'] = $imageBangunan;
        }

        $model = Data::findOrFail($id)->update($model);
        return response()->json($model);
    }

    public function delete($id)
    {
        $model = Data::findOrFail($id)->delete();
        return response()->json($model);
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
                if ($model->foto_ktp == 'noimage.png'){
                    return 'No Image';
                }
                $url = asset('/foto_ktp/'.$model->foto_ktp);
                $image = '<img src="'.$url.'" width="100"/>';
                return $image;
            })
            ->editColumn('foto_bangunan', function($model){
                if ($model->foto_bangunan == NULL){
                    return 'No Image';
                }
                $url = asset('/foto_bangunan/'.$model->foto_bangunan);
                $image = '<img src="'.$url.'" width="100"/>';
                return $image;
            })
            ->addColumn('alamat', function($model){
                $alamat = $model->alamat_lengkap.' '.$model->rt_rw.' '.$model->kelurahan.' '.$model->kecamatan.' '.$model->kota.' '.$model->kode_pos;
                return $alamat;
            })
            ->addColumn('action', function($model){
                $button = '<a href="#" class="details-control"><i class="nav-icon fas fa-eye text-primary"></i></a> | 
<a href="'.route('data.edit', $model->id).'" class="modal-show edit" name="Edit '.$model->nama_canvaser.'"><i class="nav-icon fas fa-pencil-alt text-primary"></i></a> | 
<a href="'.route('data.delete', $model->id).'" class="delete" name="'.$model->nama_canvaser.'"><i class="nav-icon fas fa-trash-alt text-danger"></i></a>';
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['foto_ktp', 'foto_bangunan', 'action'])
            ->make(true);
    }
}
