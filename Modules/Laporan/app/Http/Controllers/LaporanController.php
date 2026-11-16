<?php

namespace Modules\Laporan\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Fasilitas\Http\Requests\PengaduanRequest;
use Modules\Laporan\Http\Requests\LaporanRequest;
use Modules\TitikSampah\Models\TitikSampah;
use Modules\Laporan\Models\Laporan;



class LaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $query = Laporan::with(['user', 'titik_sampahs'])->latest();

        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        $laporan = $query->get();

        $fasilitas = TitikSampah::orderBy('nama_tps')->get();

        return view('titik_sampahs::laporan.index', compact('laporan', 'titik_sampahs'));
    }

    public function store(LaporanRequest $request)
    {
        
        $data = $request->safe()->except('foto');

        $data['user_id'] = Auth::id();
        $data['status']  = 'menunggu';

        $laporan = Laporan::create($data);
        $laporan->load(['user', 'titik_sampahs']); 

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dikirim.',
            'data'    => [
                'id'        => $laporan->id,
                'pelapor'   => $laporan->user->name,
                'fasilitas' => $laporan->titik_sampahs->nama_tps,
                'status'    => $laporan->status,
                'deskripsi' => $laporan->deskripsi,
                'foto_bukti' => $laporan->foto_bukti,
            ],
        ], 201);
    }
}

