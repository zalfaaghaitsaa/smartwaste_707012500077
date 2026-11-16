@extends('layouts.app')
@section('title', 'Laporan')

@section('content')
<h3>Laporan</h3>

<div id="alert-ajax" class="alert d-none"></div>

<form id="form-laporan" action="{{ route('laporan.store') }}" method="POST" class="card card-body mb-4">
    @csrf
    <div class="mb-3">
        <label>Volume Sampah</label>
        <textarea name="volume_sampah" rows="3" class="form-control"></textarea>
        <small class="text-danger" id="error-deskripsi"></small>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control"></textarea>
        <small class="text-danger" id="error-deskripsi"></small>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <textarea name="foto_bukti" rows="3" class="form-control"></textarea>
        <small class="text-danger" id="error-deskripsi"></small>
    </div>

    <button type="submit" id="btn-kirim" class="btn btn-primary">Kirim Laporan</button>
</form>

<h5>Daftar Pengaduan</h5>
<table class="table table-bordered bg-white">
    <thead class="table-dark">
        <tr><th>#</th><th>Pelapor</th><th>Fasilitas</th><th>Deskripsi</th><th>Status</th></tr>
    </thead>
    {{-- id="tabel-pengaduan" = target tempat baris baru disisipkan oleh JavaScript --}}
    <tbody id="tabel-pengaduan">
        @forelse ($pengaduan as $p)
            <tr>
                <td class="nomor">{{ $loop->iteration }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->fasilitas->nama_fasilitas }}</td>
                <td>{{ $p->deskripsi }}</td>
                <td><span class="badge bg-warning text-dark">{{ $p->status }}</span></td>
            </tr>
        @empty
            <tr id="baris-kosong"><td colspan="5" class="text-center">Belum ada pengaduan.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection

{{-- @push('scripts') = script ini masuk ke @stack('scripts') di layout (setelah jQuery dimuat) --}}
@push('scripts')
<script>
$(document).ready(function () {

    // Menangkap event submit milik form pengaduan
    $('#form-pengaduan').on('submit', function (e) {
        e.preventDefault(); // BATALKAN submit biasa, supaya halaman tidak reload

        // Bersihkan pesan error dari percobaan sebelumnya
        $('small.text-danger').text('');
        $('#alert-ajax').addClass('d-none');

        // FormData = membungkus seluruh isi form (termasuk file nanti di Tahap 8) siap kirim
        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),      // alamat tujuan: route pengaduan.store
            type: 'POST',                     // metode HTTP
            data: formData,
            processData: false,               // WAJIB false jika memakai FormData (jangan diubah jadi query string)
            contentType: false,               // WAJIB false: biar browser mengatur tipe konten multipart sendiri
            dataType: 'json',                 // kita mengharapkan balasan JSON dari controller
            headers: {
                // CSRF token: bukti bahwa request berasal dari halaman kita sendiri
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                $('#btn-kirim').prop('disabled', true).text('Mengirim...'); // cegah klik ganda
            },

            // SUCCESS: dipanggil saat server membalas status 2xx (di sini 201)
            success: function (res) {
                tampilkanAlert('success', res.message);
                $('#form-pengaduan')[0].reset();     // kosongkan form

                // Hapus baris "Belum ada pengaduan" jika ada
                $('#baris-kosong').remove();

                // PERBARUI TAMPILAN: sisipkan baris baru di atas tabel TANPA reload
                // .text() dipakai (bukan menempel HTML mentah) agar aman dari XSS
                var baris = $('<tr>')
                    .append($('<td class="nomor">'))
                    .append($('<td>').text(res.data.pelapor))
                    .append($('<td>').text(res.data.fasilitas))
                    .append($('<td>').text(res.data.deskripsi))
                    .append($('<td>').append($('<span class="badge bg-warning text-dark">').text(res.data.status)));
                $('#tabel-pengaduan').prepend(baris);

                // Nomori ulang kolom #
                $('#tabel-pengaduan .nomor').each(function (i) { $(this).text(i + 1); });
            },

            // ERROR: dipanggil saat server membalas status 4xx/5xx
            error: function (xhr) {
                if (xhr.status === 422) {
                    // 422 = validasi gagal. Laravel mengirim { errors: { field: [pesan, ...] } }
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, pesan) {
                        $('#error-' + field).text(pesan[0]); // tampilkan pesan pertama di bawah field
                    });
                } else if (xhr.status === 403) {
                    tampilkanAlert('danger', 'Anda tidak memiliki akses.');
                } else {
                    tampilkanAlert('danger', 'Terjadi kesalahan server (' + xhr.status + ').');
                }
            },

            // COMPLETE: selalu dipanggil, berhasil atau gagal
            complete: function () {
                $('#btn-kirim').prop('disabled', false).text('Kirim Pengaduan');
            }
        });
    });

    // Fungsi bantu: tampilkan alert hijau/merah
    function tampilkanAlert(tipe, pesan) {
        $('#alert-ajax')
            .removeClass('d-none alert-success alert-danger')
            .addClass('alert-' + tipe)
            .text(pesan);
    }
});
</script>
@endpush
