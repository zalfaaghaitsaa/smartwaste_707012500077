<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SmartWaste</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 420px;">
    <h3 class="mb-3">Login SmartWaste</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
        @csrf 
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
        <button class="btn btn-primary w-100">Login</button>
    </form>
    <p class="mt-3">Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
</div>
</body>
</html>
