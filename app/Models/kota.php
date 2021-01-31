<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $fillable = [
        'kode_kota',
        'kota',
        'id_provinsi'
    ];

    protected $table = "kotas";

    public $timestamp = true;

    public function Kecamatan(){
        return $this->hasMany('App\Models\Kecamatan', 'id_kota');
    }
    public function Provinsi(){
        return $this->belongsTo('App\Models\Provinsi', 'id_provinsi');
    }
}