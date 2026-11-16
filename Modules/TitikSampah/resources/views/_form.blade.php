<div class="mb-3">
    <label>Nama TPS</label>
    <input type="text" name="nama_tps" class="form-control"
           value="{{ old('nama_tps', $titik_sampahs->nama_tps ?? '') }}">
    @error('nama_tps') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Kecamatan</label>
    <input type="text" name="kecamatan" class="form-control"
           value="{{ old('kecamatan', $titik_sampahs->kecamatan ?? '') }}">
    @error('kecamatan') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <input type="text" name="deskripsi" class="form-control"
           value="{{ old('deskripsi', $titik_sampahs->deskripsi ?? '') }}">
    @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Kapasitas/kg</label>
    <input type="text" name="kapasitas_kg" class="form-control"
           value="{{ old('kapasitas_kg', $titik_sampahs->kapasitas_kg ?? '') }}">
    @error('kapasitas_kg') <small class="text-danger">{{ $message }}</small> @enderror
</div>
