<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIPADULARA</title>
</head>
<body>

    <h1>Register Masyarakat</h1>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('masyarakat.register.submit') }}" method="POST">
        @csrf

        <div>
            <label>Nama</label>
            <input
                type="text"
                name="nama"
                value="{{ old('nama') }}"
                required
            >
        </div>

        <div>
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div>
            <label>Alamat</label>
            <textarea name="address">{{ old('address') }}</textarea>
        </div>

        <div>
            <label>No. HP</label>
            <input
                type="text"
                name="no_hp"
                value="{{ old('no_hp') }}"
            >
        </div>

        <div>
            <label>Password</label>
            <input
                type="password"
                name="password"
                required
            >
        </div>

        <div>
            <label>Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                required
            >
        </div>

        <button type="submit">Daftar</button>
    </form>

    <p>
        Sudah punya akun?
        <a href="{{ route('masyarakat.login') }}">Login</a>
    </p>

</body>
</html>