@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><b>{{ __('Data Kasus Local') }}</b></center></div>

                <div class="card-body">
                <a href="{{route('jumlahkasus2.create')}}"class="btn btn-outline-success float-right"><b>Tambah Data</b></a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                     <tr class="bg-black">
                      <th scope="col">No</th>
                                            <th scope="col"><center>Lokasi</center></th>
                                            <th scope="col"><center>RW</center></th>
                                            <th scope="col"><center>Positif</center></th>
                                            <th scope="col"><center>Meninggal</center></th>
                                            <th scope="col"><center>Sembuh</center></th>
                                            <th scope="col"><center>Tanggal</center></th>
                                            <th scope="col"><center>Action</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no=1;
                                    @endphp
                                    @foreach($jumlahkasus2 as $data)

                                        <tr>
                                            <th scope="row"><center>{{$no++}}</center></th>
                                            <td><center><b>Provinsi : {{$data->rw->kelurahan->kecamatan->kota->provinsi->nama_provinsi}}<br>
                                            Kota : {{$data->rw->kelurahan->kecamatan->kota->nama_kota}}<br>
                                            Kecamatan : {{$data->rw->kelurahan->kecamatan->nama_kecamatan}}<br>
                                            Kelurahan : {{$data->rw->kelurahan->nama_kelurahan}}<br></b>
                                           </center></td>
                                            <td><center>{{$data->rw->nama_rw}}</center></td>
                                            <td><center>{{$data->jumlah_positif}}</center></td>
                                            <td><center>{{$data->jumlah_meninggal}}</center></td>
                                            <td><center>{{$data->jumlah_sembuh}}</center></td>
                                            <td><center>{{$data->tanggal}}</center></td>
                                            
                                            <form action="{{route('jumlahkasus2.destroy', $data->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <td><a class="btn btn-primary btn-sm" href="{{route('jumlahkasus2.show', $data->id)}}">SHOW</a>|
                                <a class="btn btn-warning btn-sm" href="{{route('jumlahkasus2.edit', $data->id)}}">EDIT</a>|
                                <button type="submit" class="btn btn-danger  btn-sm" onclick="return confirm('Apakah anda yakin ?')"><a>DELETE</a></button>
                        </td>
                      </tr>
                          </form>
                                        </tr>
                                    @endforeach
                            </tbody>  
                        </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
