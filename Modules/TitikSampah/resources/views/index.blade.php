@extends('layouts.app')
@section('title', 'Data Titik Sampah')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Titik Sampah</h3>

    @if (Auth::user()->isAdmin())
        <a href="{{ route('titik_sampahs.create') }}" class="btn btn-primary">+ Tambah Titik Sampah</a>
    @endif
</div>

<form action="{{ route('titik_sampahs.index') }}" method="GET" class="d-flex mb-3 gap-2">
    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Cari nama atau kecamatan...">
    <button class="btn btn-secondary">Cari</button>
</form>

<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr>
            <th>#</th><th>Nama</th><th>Kecamatan</th><th>Deskripsi</th><th>Kapasitas/kg</th>
            @if (Auth::user()->isAdmin()) <th>Aksi</th> @endif
        </tr>
    </thead>
    <tbody>
        @forelse ($titik_sampahs as $t)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->nama_tps }}</td>
                <td>{{ $t->kecamatan }}</td>
                <td>{{ $t->deskripsi }}</td>
                <td>{{ $t->kapasitas_kg }}</td>
                @if (Auth::user()->isAdmin())
                    <td>
                        <a href="{{ route('titik_sampahs.edit', $t->id) }}" class="btn btn-sm btn-warning">Ubah</a>
                        <form action="{{ route('titik_sampahs.destroy', $t->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                @endif
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">Data tidak ditemukan.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
