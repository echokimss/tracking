<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jumlahKasus2 extends Model
{
    use HasFactory;
    protected $table = "jumlah_Kasus2";
    public $timestamps = true;
    protected $fillable = ['jumlah_positif','jumlah_meninggal','jumlah_sembuh','id_rw'];

    public function rw() {
        return $this->belongsTo('App\Models\rw','id_rw');
    }


}
