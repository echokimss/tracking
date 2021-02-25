@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><center><b>{{ __('Data Kelurahan') }}</b></center></div>

                <div class="card-body">
                <form action="{{route('Kelurahan.store')}}" method="POST">
                @csrf
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            
           
                   <dov class="col">
                       <livewire:kellive>
                   </dov>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama kelurahan</label>
                        <input type="text" name="nama_kelurahan" class="form-control" id="">
                        @if($errors->has('nama_kelurahan'))
                        <span class="text-danger">{{ $errors->first('nama_kelurahan')}}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection