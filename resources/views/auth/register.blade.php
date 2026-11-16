<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - SmartWaste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 420px;">
    <h3 class="mb-3">Register</h3>

    <form action="{{ route('register.process') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button class="btn btn-success w-100">Daftar</button>
    </form>
    <p class="mt-3">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</div>
</body>
</html>
