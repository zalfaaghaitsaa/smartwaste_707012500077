<?php

namespace Modules\TitikSampah\Http\Controllers; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\TitikSampah\Models\TitikSampah;    
use Modules\Fasilitas\Http\Requests\FasilitasRequest;    

class TitikSampahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search'); 

        $fasilitas = TitikSampah::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama_tps', 'like', "%{$search}%")
                      ->orWhere('kecamatan', 'like', "%{$search}%");
            })
            ->latest()  
            ->get();

        return view('titik_sampahs::index', compact('titik_sampahs', 'search'));
    }

    public function create()
    {
        return view('titik_sampahs::create');
    }

    public function store(TitikSampahController $request)
    {
        // validated() = hanya data yang LOLOS validasi
        TitikSampah::create($request->validated());

        return redirect()->route('titik_sampahs.index')
            ->with('success', 'Titik Sampah berhasil ditambahkan.');
    }


    public function edit(TitikSampah $titik_sampahs)
    {
        return view('fasilitas::edit', compact('fasilitas'));
    }

    public function update(TitikSampahController $request, TitikSampah $titik_sampahs)
    {
        $titik_sampahs->update($request->validated());

        return redirect()->route('titik_sampahs.index')
            ->with('success', 'Titik Samppah berhasil diubah.');
    }   


    public function destroy(TitikSampah $titik_sampahs)
    {
        $titik_sampahs->delete();

        return redirect()->route('titik_sampahs.index')
            ->with('success', 'Titik Sampah berhasil dihapus.');
    }
}
