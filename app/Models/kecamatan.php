<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = "kecamatans";
    protected $fillable = [
        'kode_kecamatan',
        'nama_kecamatan',
        'id_kota'
    ];
        
    public function kota() {
        return $this->belongsTo('App\Models\kota','id_kota');
    }

    public function kelurahan() {
        return $this->hasMany('App\kelurahan','id_kelurahan');
        
    }
}