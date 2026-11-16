@extends('layouts.app')
@section('title', 'Tambah Titik Sampah')

@section('content')
<h3>Tambah Titik Sampah</h3>

<form action="{{ route('titik-sampahs.store') }}" method="POST">
    @csrf
    @include('titik_sampahs::_form')
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
