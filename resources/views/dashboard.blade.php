<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SmartWaste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3>Dashboard</h3>

    <p>Halo, <b>{{ Auth::user()->name }}</b></p>
    <p>Email: {{ Auth::user()->email }}</p>
    <p>Role: <span class="badge bg-info">{{ Auth::user()->role }}</span></p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>
</div>
</body>
</html>
