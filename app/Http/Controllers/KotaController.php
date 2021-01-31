<?php

namespace App\Http\Controllers;

use App\Models\kota;
use App\Models\provinsi;
use App\Http\Controllers\DB;
use Illuminate\Http\Request;

class KotaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kota = kota::with('provinsi')->get();
        return view('kota.index', compact('kota'));
    }


    public function create()
    {
        $provinsi = provinsi::all();
        return view('kota.create', compact('provinsi'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode_kota' => 'required|max:10|unique:kotas',
            'nama_kota' => 'required|unique:kotas'
        ],   [
            'kode_kota.required' => 'Kode kota Tidak Boleh kosong',
            'Kode_kota.max' => 'Kode maksimal 10 karakter',
            'kode_kota.unique' => 'kode kota Sudah Terdaftar',
            'nama_kota.required' => 'Nama kota Tidak Boleh Kosong',
            'nama_kota.unique' => 'Nama kota Sudah Terdaftar'
        ]);
        $kota = new kota();
        $kota->kode_kota = $request->kode_kota;
        $kota->nama_kota = $request->nama_kota;
        $kota->id_provinsi = $request->id_provinsi;
        $kota->save(); //method khusus untuk inputan/menyimpan ke DB
        return redirect()->route('kota.index');
    }


    public function show($id)
    {
        $kota = kota::findOrFail($id);
        return view('kota.show', compact('kota'));
    }


    public function edit($id)
    {
        $kota = kota::findOrFail($id);
        $provinsi = provinsi::all();
        return view('kota.edit', compact('kota','provinsi'));     
    }


    public function update(Request $request, $id)
    {
        $kota = kota::findOrFail($id);
        $kota->kode_kota = $request->kode_kota;
        $kota->nama_kota = $request->nama_kota;
        $kota->id_provinsi = $request->id_provinsi;
        $kota->save();
        return redirect()->route('kota.index');
    }


    public function destroy($id)
    {
        $kota = kota::findOrFail($id)->delete();
        return redirect()->route('kota.index');
    }
}