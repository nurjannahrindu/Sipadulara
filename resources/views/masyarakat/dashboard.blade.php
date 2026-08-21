<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Masyarakat - SIPADULARA</title>
</head>
<body>

    <h1>Dashboard Masyarakat</h1>

    <h2>Selamat datang, {{ $masyarakat->nama }}</h2>

    <hr>

    <h3>Statistik Pengajuan</h3>

    <p>Total Pengajuan: {{ $totalPengajuan }}</p>

    <p>Diajukan: {{ $diajukan }}</p>

    <p>Diproses: {{ $diproses }}</p>

    <p>Selesai: {{ $selesai }}</p>

    <hr>

    <a href="{{ route('masyarakat.logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form"
          action="{{ route('masyarakat.logout') }}"
          method="POST"
          style="display: none;">
        @csrf
    </form>

</body>
</html>