@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <p>Tambah Data Kasus</p>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('jumlahkasus2.store') }}" method="POST">
                        @csrf
                            <div class="col">
                                <livewire:dropdowns />
                            </div>                                             
                            
                                <center><h2><p>-- Data Kasus Local --</p></h2></center>
                            
                            <div class="form-group">
                                <label for="">Jumlah Positif</label>
                                <input type="text"name="jumlah_positif" class="form-control" id="exampleInputEmail1"  placeholder="Jumlah Positif">
                                @if($errors->has('jumlah_positif'))
                                    <span class="text-danger">{{ $errors->first('jumlah_positif') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Meninggal</label>
                                <input type="text" name="jumlah_meninggal" class="form-control" id="exampleInputEmail1"  placeholder="Jumlah Meninggal">
                                @if($errors->has('jumlah_meninggal'))
                                    <span class="text-danger">{{ $errors->first('jumlah_meninggal') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Jumlah Sembuh</label>
                                <input type="text" name="jumlah_sembuh" class="form-control" id="exampleInputEmail1"  placeholder="Jumlah Sembuh">
                                @if($errors->has('jumlah_sembuh'))
                                    <span class="text-danger">{{ $errors->first('jumlah_sembuh') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="exampleInputEmail1"  placeholder="Jumlah Sembuh">
                            </div>
                            <a href="{{url()->previous()}}" class="btn btn-primary">Kembali</a>
                            <div class="float-right">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection