<?php

namespace Modules\TitikSampah\Models; 

use Illuminate\Database\Eloquent\Model;

class TitikSampah extends Model
{
    protected $table = 'titik_sampahs';

    protected $fillable = [
        'nama_tps',
        'kecamatan',
        'deskripsi',
        'kapasitas_kg',
    ];
}
