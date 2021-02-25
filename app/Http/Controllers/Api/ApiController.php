<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Kelurahan;
use App\Models\Rw;
use App\Models\provinsi;
use App\Models\Kasus2;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function sprovinsi()
    {
        $tampil = DB::table('provinsis')
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','= ','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('jumlah_kasus2','jumlah_kasus2.id_rw','=','rws.id')
        ->select('nama_provinsi',
        DB::raw('sum(jumlah_kasus2.jumlah_positif) as jumlah_positif'),
        DB::raw('sum(jumlah_kasus2.jumlah_sembuh) as jumlah_sembuh'),
        DB::raw('sum(jumlah_kasus2.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_provinsi')
        ->get();

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);

    }


    public function index()
    {
        $dt = DB::table('jumlah_kasus2')
        ->select(DB::raw('provinsis.nama_provinsi as provinsi'), 
                 DB::raw('SUM(jumlah_kasus2.jumlah_positif) as positif'), 
                 DB::raw('SUM(jumlah_kasus2.jumlah_meninggal) as meninggal'),
                 DB::raw('SUM(jumlah_kasus2.jumlah_sembuh) as sembuh')) 
        ->join('rws', 'rws.id', '=', 'jumlah_kasus2.id_rw')
        ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
        ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
        ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kota')
        ->join('provinsis', 'provinsis.id', '=', 'kotas.id_provinsi')
        ->groupBy('provinsis.nama_provinsi')
        ->get();
$res = [
    'success' => true,
    'data' => $dt,
    'message' => 'berhasil'
];
return response()->json($res, 200);
    }

    public function dprovinsi($id)
    {
        $tampil = DB::table('provinsis')
        ->join('kotas','kotas.id_provinsi','=','provinsis.id')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('jumlah_kasus2','jumlah_kasus2.id_rw','=','rws.id')
        ->where('provinsis.id',$id)
        ->select('nama_provinsi',
        DB::raw('sum(jumlah_kasus2.jumlah_positif) as jumlah_positif'),
        DB::raw('sum(jumlah_kasus2.jumlah_sembuh) as jumlah_sembuh'),
        DB::raw('sum(jumlah_kasus2.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_provinsi')
        ->get();

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);


    }
    public function provinsi()
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

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);

    }

    public function skota()
    {
        $tampil = DB::table('kotas')
        ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('jumlah_kasus2','jumlah_kasus2.id_rw','=','rws.id')
        ->select('nama_kota','kode_kota',
        DB::raw('sum(jumlah_kasus2.jumlah_positif) as jumlah_positif'),
        DB::raw('sum(jumlah_kasus2.jumlah_sembuh) as jumlah_sembuh'),
        DB::raw('sum(jumlah_kasus2.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_kota','kode_kota')
        ->get();

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);

    }


    public function skecamatan()
    {
        $tampil = DB::table('kecamatans')
        ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('jumlah_kasus2','jumlah_kasus2.id_rw','=','rws.id')
        ->select('nama_kecamatan','kode_kecamatan',
        DB::raw('sum(jumlah_kasus2.jumlah_positif) as jumlah_positif'),
        DB::raw('sum(jumlah_kasus2.jumlah_sembuh) as jumlah_sembuh'),
        DB::raw('sum(jumlah_kasus2.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_kecamatan','kode_kecamatan')
        ->get();

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);

    }

    public function skelurahan()
    {
        $tampil = DB::table('kelurahans')
        ->join('rws','rws.id_kelurahan','=','kelurahans.id')
        ->join('jumlah_kasus2','jumlah_kasus2.id_rw','=','rws.id')
        ->select('nama_kelurahan','kode_kelurahan',
        DB::raw('sum(jumlah_kasus2.jumlah_positif) as jumlah_positif'),
        DB::raw('sum(jumlah_kasus2.jumlah_sembuh) as jumlah_sembuh'),
        DB::raw('sum(jumlah_kasus2.jumlah_meninggal) as jumlah_meninggal'))
        ->groupBy('nama_kelurahan','kode_kelurahan')
        ->get();

        $data = [
            'success' => true,
            'Data Provinsi' => $tampil,
            'message' => 'Data Kasus Di tampilkan'
        ];
return response()->json($data,200);

    }
    public function hari(){

        $kasus2 = kasus2::get('created_at')->last();
        $jumlah_positif = kasus2::where('tanggal', date('Y-m-d'))->sum('jumlah_positif');
        $jumlah_sembuh = kasus2::where('tanggal', date('Y-m-d'))->sum('jumlah_sembuh');
        $jumlah_meninggal = kasus2::where('tanggal', date('Y-m-d'))->sum('jumlah_meninggal');

        $join = DB::table('jumlah_kasus')
                    ->select('jumlah_positif', 'jumlah_sembuh', 'jumlah_meninggal')
                    ->join('rws' ,'jumlah_kasus.id_rw', '=', 'rws.id')
                    ->get();
        $arr1 = [
           'Data' => 'DATA KASUS SELURUH INDONESIA',
            'jumlah_positif' =>$join->sum('jumlah_positif'),
            'jumlah_sembuh' =>$join->sum('jumlah_sembuh'),
            'jumlah_meninggal' =>$join->sum('jumlah_meninggal'),
        ];
        $arr2 = [
           'Data' => 'DATA KASUS HARI INI',
            'jumlah_positif' =>$jumlah_positif,
            'jumlah_sembuh' =>$jumlah_sembuh,
            'jumlah_meninggal' =>$jumlah_meninggal,
        ];
        $arr = [
            'status' => 200,
            'data' => [
                'Hari Ini' => $arr2,
                'total' => $arr1
            ],
            'message' => 'Berhasil'
        ];
       
        return response()->json($arr, 200);
   }

   //api kawal corona

   public function Global(){
       $url = Http::get('https://api.kawalcorona.com/')->json();
       $data = [];
       foreach ($url as $key => $value) {
           $ul = $value['attributes'];
           $res = [
               'id '=>$ul['OBJECTID'],
               'Country'=>$ul['Country_Region'],
               'Confirmed'=>$ul['Confirmed'],
               'Deaths'=>$ul['Deaths'],
               'Recovered'=>$ul['Recovered'],
           ];
           array_push($data,$res);

       }
       $response = [
           'success' => true,
           'country' =>$data,
           'message'=> 'Data berhasil ditampilkan',
       ];
       return response()->json($response,200);

    }




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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dt = DB::table('jumlah_kasus2')
                ->select(DB::raw('provinsis.nama_provinsi as provinsi'), 
                         DB::raw('SUM(jumlah_kasus2.jumlah_positif) as positif'), 
                         DB::raw('SUM(jumlah_kasus2.jumlah_meninggal) as meninggal'),
                         DB::raw('SUM(jumlah_kasus2.jumlah_sembuh) as sembuh')) 
    			->join('rws', 'rws.id', '=', 'jumlah_kasus2.id_rw')
    			->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
    			->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
    			->join('kotas', 'kotas.id', '=', 'kecamatans.id_kota')
    			->join('provinsis', 'provinsis.id', '=', 'kotas.id_provinsi')
    			->where('provinsis.id', $id)
    			->groupBy('provinsis.nama_provinsi')
    			->get();
    	$res = [
    		'success' => true,
    		'data' => $dt,
    		'message' => 'berhasil'
    	];
    	return response()->json($res, 200);

        // CARA KEDUA
        // $kasus2 = kasus2::get('created_at')->last();
        // $jumlah_positif = kasus2::where('tanggal', date('Y-m-d'))->sum('jumlah_positif');
        // $jumlah_sembuh = kasus2::where('tanggal', date('Y-m-d'))->sum('jumlah_sembuh');
        // $jumlah_meninggal = kasus2::where('tanggal', date('Y-m-d'))->sum('jumlah_meninggal');

        // $join = DB::table('jumlah_kasus2')
        //             ->select('jumlah_positif', 'jumlah_sembuh', 'jumlah_meninggal')
        //             ->join('rws' ,'jumlah_kasus2.id_rw', '=', 'rws.id')
        //             ->get();
        // $arr1 = [
        //     'jumlah_positif' =>$join->sum('jumlah_positif'),
        //     'jumlah_sembuh' =>$join->sum('jumlah_sembuh'),
        //     'jumlah_meninggal' =>$join->sum('jumlah_meninggal'),
        // ];
        // $arr2 = [
        //     'jumlah_positif' =>$jumlah_positif,
        //     'jumlah_sembuh' =>$jumlah_sembuh,
        //     'jumlah_meninggal' =>$jumlah_meninggal,
        // ];
        // $arr = [
        //     'status' => 200,
        //     'data' => [
        //         'Hari Ini' => $arr2,
        //         'total' => $arr1
        //     ],
        //     'message' => 'Berhasil'
        // ];
        
        // return response()->json($arr, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        //
    }
}