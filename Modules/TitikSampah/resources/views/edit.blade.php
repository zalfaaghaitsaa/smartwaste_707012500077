@extends('layouts.app')
@section('title', 'Ubah Titik Sampah')

@section('content')
<h3>Ubah Titik Sampah</h3>

<form action="{{ route('titik_sampahs.update', $titik_sampahs->id) }}" method="POST">
    @csrf
    @method('PUT') 
    @include('titik_sampahs::_form')
    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('titik_sampahs.index') }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
