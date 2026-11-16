<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - SmartWaste</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">SmartWaste</a>
        <div class="d-flex align-items-center gap-3">
            <span class="text-white">{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button class="btn btn-sm btn-danger">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@stack('scripts')

</body>
</html>
