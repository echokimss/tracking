<?php

namespace App\Http\Controllers;
use App\Http\Controllers\DB;
use App\Models\kecamatan;
use App\Models\kelurahan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $kelurahan = kelurahan::with('kecamatan')->get();
        return view('Kelurahan.index', compact('kelurahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = kecamatan::all();
        return view('Kelurahan.create', compact('kecamatan'));
    }   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kelurahan' => 'required|max:10|unique:kelurahans',
            'nama_kelurahan' => 'required|unique:kelurahans'
        ],   [
            'kode_kelurahan.required' => 'Kode kelurahan Tidak Boleh kosong',
            'Kode_kelurahan.max' => 'Kode maksimal 10 karakter',
            'kode_kelurahan.unique' => 'kode kelurahan Sudah Terdaftar',
            'nama_kelurahan.required' => 'Nama kelurahan Tidak Boleh Kosong',
            'nama_kelurahan.unique' => 'Nama kelurahan Sudah Terdaftar'
        ]);
        $kelurahan = new kelurahan();
        $kelurahan->kode_kelurahan = $request->kode_kelurahan;
        $kelurahan->nama_kelurahan = $request->nama_kelurahan;
        $kelurahan->id_kecamatan = $request->id_kecamatan;
        $kelurahan->save(); //method khusus untuk inputan/menyimpan ke DB
        return redirect()->route('Kelurahan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelurahan = kelurahan::findOrFail($id);
        return view('Kelurahan.show', compact('kelurahan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelurahan = kelurahan::findOrFail($id);
        $kecamatan = kecamatan::all();
        return view('Kelurahan.edit', compact('kelurahan','kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kelurahan =kelurahan::findOrFail($id);
        $kelurahan->kode_kelurahan = $request->kode_kelurahan;
        $kelurahan->nama_kelurahan = $request->nama_kelurahan;
        $kelurahan->id_kecamatan = $request->id_kecamatan;
        $kelurahan->save();
        return redirect()->route('Kelurahan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kelurahan  $kelurahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(kelurahan $kelurahan)
    {
        $kelurahan= kelurahan::findOrFail($id)->delete();
        return redirect()->route('Kelurahan.index');


    }
}
