<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rw extends Model
{
    use HasFactory;

    protected $fillable = ['nama_rw','id_kelurahan'];
    public $timestamps = true;
    protected $table = "rws";
    
    public function kelurahan() {
        return $this->belongsTo('App\Models\kelurahan','id_kelurahan');
    }

    public function jumlahKasus2() {
        return $this->hasMany('App\Models\jumlahKasus2','id_rws');
        
    }
}
