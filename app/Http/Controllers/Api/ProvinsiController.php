<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provinsi;
use App\Models\Rw;
use App\Models\jumlahKasus2;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProvinsiController;


class ProvinsiController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsi = Provinsi::latest()->get();
        $kims = [
            'succes'  => true,
            'data'    => $provinsi,
            'message' => 'Data Provinsi Di Tampilkan'
        ];
        return response()->json($kims,200);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provinsi = new Provinsi();
        $provinsi->kode_provinsi = $request->kode_provinsi;
        $provinsi->nama_provinsi = $request->nama_provinsi;
        $provinsi->save();
       
        $kims = [
            'success'  => true,
            'data'    => $provinsi,
            'message' => 'Data Provinsi Di Tampilkan'
        ];
        return response()->json($kims,200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provinsi = Provinsi::whereId($id)->first();
            $kims = [
                'success'=>true,
                'data'=> $provinsi,
                'message' => 'berhasil'
            ];
        return response()->json($kims,200);

    }

   
    public function provinsi($id){
        $tampil = DB::table('provinsis')
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('jumlahKasus2s','jumlahKasus2s.id_rw','=','rws.id')
        ->where('provinsis.id',$id)
        ->select('nama_provinsi',
        DB::raw('sum(jumlahKasus2s.jumlah_positif) as jumlah_positif'),
        DB::raw('sum(jumlahKasus2s.jumlah_sembuh) as jumlah_sembuh'),
        DB::raw('sum(jumlahKasus2s.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('provinsi')
        ->get();

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);


    }





    
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        if ($provinsi) {
            return response()->json([
                'succes' => true,
                'message' => 'Provinsi berhasil di hapus!!!',
                
            ], 200);
        }else {
            return response()->json([
                'succes' => false,
                'message' => 'Provinsi gagal dihapus!!!',
            ], 500);
        }
        }
    }

