<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DB;

class FrontendController extends Controller
{
    public function index()
    {       
        $tampil = DB::table('provinsis')
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('jumlah_kasus2','jumlah_kasus2.id_rw','=','rws.id')
        ->select('nama_provinsi',
        DB::raw('sum(jumlah_kasus2.jumlah_positif) as jumlah_positif'),
        DB::raw('sum(jumlah_kasus2.jumlah_sembuh) as jumlah_sembuh'),
        DB::raw('sum(jumlah_kasus2.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_provinsi')
        ->get();


        $positif = DB::table('rws')
                ->select('jumlah_kasus2.jumlah_positif',
                'jumlah_kasus2.jumlah_sembuh', 'jumlah_kasus2.jumlah_meninggal')
                ->join('jumlah_kasus2','rws.id','=','jumlah_kasus2.id_rw')
                ->sum('jumlah_kasus2.jumlah_positif'); 
        $sembuh = DB::table('rws')
                ->select('jumlah_kasus2.jumlah_positif',
                'jumlah_kasus2.sembuh','jumlah_kasus2.jumlah_meninggal')
                ->join('jumlah_kasus2','rws.id','=','jumlah_kasus2.id_rw')
                ->sum('jumlah_kasus2.jumlah_sembuh');
        $meninggal = DB::table('rws')
                ->select('jumlah_kasus2.jumlah_positif',
                'jumlah_kasus2.jumlah_sembuh','jumlah_kasus2.jumlah_meninggal')
                ->join('jumlah_kasus2','rws.id','=','jumlah_kasus2.id_rw')
                ->sum('jumlah_kasus2.jumlah_meninggal');

            //      $global = file_get_contents('https://api.kawalcorona.com/positif');
            // $getglobal = json_decode($global, TRUE);

             // Table Global
        // $dataglobal= file_get_contents("https://api.kawalcorona.com/");
        // $globall = json_decode($dataglobal, TRUE);

        return view('Frontend.welcome',compact('positif', 'sembuh', 'meninggal','tampil'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function kims(){
        $url = Http::get('https://api.kawalcorona.com/')->json();
        $url1 = Http::get('https://api.kawalcorona.com/indonesia')->json();
        $url2 = Http::get('https://api.kawalcorona.com/indonesia/provinsi')->json();
        return view('welcome', compact('url', 'url1', 'url2'));
    }
}