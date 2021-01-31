<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelurahan extends Model
{
    use HasFactory;

    protected $table = "kelurahans";
    protected $fillable = [
        'kode_kelurahan',
        'nama_kelurahan',
        'id_kecamatan'
    ];
    
    public function kecamatan() {
        return $this->belongsTo('App\Models\kecamatan','id_kecamatan');
    }

    public function kelurahan() {
        return $this->hasMany('App/Models/kelurahan','id_kelurahan');
        
    }
}
