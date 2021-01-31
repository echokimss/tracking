<?php

namespace App\Http\Controllers;
use App\Http\Controller\DB;
use App\Models\provinsi;
use App\Models\kota;
use App\Models\kecamatan;
use App\Models\kelurahan;
use App\Models\rw;
use App\Models\jumlahKasus2;
use Illuminate\Http\Request;

class jumlahKasus2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $jumlahkasus2 = jumlahKasus2::with('rw')->get();
        return view('jumlahkasus2.index', compact('jumlahkasus2'));
    }

    
    public function create()
    {   
        $jumlahkasus2 = jumlahKasus2::all();
        $rw = Rw::all();
        return view ('jumlahkasus2.create', compact('jumlahkasus2','rw'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_positif' => 'required:kasus2s',
            'jumlah_meninggal' => 'required:kasus2s',
            'jumlah_sembuh' => 'required:kasus2s',
            'tanggal' => 'required:kasus2s'
        ],   [
            'jumlah_positif.required' => 'Jumlah Positif Tidak Boleh kosong',
            'jumlah_meninggal.rquired' => 'jumlah Meninggal tidak boleh kosong',
            'jumlah_sembuh.required' => 'jumlah sembuh tidak boleh kosong',
            'tanggal.required' => 'tanggal tidak boleh kosong'
        ]);
        $jumlahkasus2 = new jumlahKasus2;
        $jumlahkasus2->id_rw = $request->id_rw;
        $jumlahkasus2->jumlah_positif = $request->jumlah_positif;
        $jumlahkasus2->jumlah_meninggal = $request->jumlah_meninggal;
        $jumlahkasus2->jumlah_sembuh = $request->jumlah_sembuh;
        $jumlahkasus2->tanggal = $request->tanggal;
        $jumlahkasus2->save();
        return redirect()->route('jumlahkasus2.index')->with(['message' => 'Data Kasus2 Berhasil disimpan']);
    }


    public function show($id)
    {
        $jumlahkasus2 = jumlahKasus2::findOrFail($id);
        return view('jumlahkasus2.show', compact('jumlahkasus2'));
    }

    
    public function edit($id)
    {
        $jumlahkasus2 = jumlahKasus2::findOrFail($id);
        $rw = Rw::all();
        return view('jumlahkasus2.edit', compact('jumlahkasus2', 'rw'))->with(['message' => 'Data Kasus2 Berhasil diedit']);
    }

    
    public function update(Request $request,$id)
    {
        $jumlahkasus2 = jumlahKasus2::findOrFail($id);
        $jumlahkasus2->id_rw = $request->id_rw;
        $jumlahkasus2->jumlah_positif = $request->jumlah_positif;
        $jumlahkasus2->jumlah_meninggal = $request->jumlah_meninggal;
        $jumlahkasus2->jumlah_sembuh = $request->jumlah_sembuh;
        $jumlahkasus2->tanggal = $request->tanggal;
        $jumlahkasus2->save();
        return redirect()->route('jumlahkasus2.index')->with(['message' => 'Data Kasus2 Berhasil disimpan']);
    }

    
    public function destroy($id)
    {
        $jumlahkasus2 = jumlahKasus2::findOrFail($id);
        $jumlahkasus2->delete();
        return redirect()->route('kumlahkasus2.index')->with(['message' => 'Data Kasus2 Berhasil diHapus']);
    }
}