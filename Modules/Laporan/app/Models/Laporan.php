<?php

namespace Modules\Laporan\Models; 

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\TitikSampah\Models\TitikSampah;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $fillable = [
        'user_id',
        'titik_sampahs_id',
        'volume_sampah',
        'status_kondisi',
        'deskripsi',
        'foto_bukti'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function titik_sampahs()
    {
        return $this->belongsTo(TitikSampah::class, 'titik_sampahs');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'titik_sampahs_id');
    }

}
