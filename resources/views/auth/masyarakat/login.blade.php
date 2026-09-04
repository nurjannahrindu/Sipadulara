<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Masyarakat - SIPADULARA</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family: Arial, Helvetica, sans-serif;

            background: #f1f5f9;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;
        }

        .login-card {
            background: #fff;

            border-radius: 18px;

            padding: 38px;

            border: 1px solid #e2e8f0;

            box-shadow:
                0 10px 30px rgba(15, 23, 42, .08);
        }

        .logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .logo-icon {
            width: 58px;
            height: 58px;

            margin: 0 auto 14px;

            border-radius: 15px;

            background: #2563eb;
            color: #fff;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 27px;
        }

        .logo h1 {
            margin: 0;

            color: #0f172a;

            font-size: 25px;
        }

        .logo p {
            margin: 7px 0 0;

            color: #64748b;

            font-size: 13px;
        }

        .login-title {
            margin-bottom: 22px;
        }

        .login-title h2 {
            margin: 0 0 6px;

            color: #0f172a;

            font-size: 20px;
        }

        .login-title p {
            margin: 0;

            color: #64748b;

            font-size: 13px;
        }

        .alert {
            background: #fef2f2;

            border: 1px solid #fecaca;

            color: #991b1b;

            border-radius: 9px;

            padding: 12px 14px;

            margin-bottom: 18px;

            font-size: 13px;
        }

        .alert p {
            margin: 4px 0;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 13px;

            font-weight: 600;
        }

        .form-group input {
            width: 100%;

            padding: 12px 14px;

            border: 1px solid #cbd5e1;

            border-radius: 9px;

            outline: none;

            font-family: inherit;

            font-size: 14px;

            transition: .2s;
        }

        .form-group input:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .12);
        }

        .login-button {
            width: 100%;

            padding: 13px;

            border: none;

            border-radius: 9px;

            background: #2563eb;

            color: #fff;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            transition: .2s;
        }

        .login-button:hover {
            background: #1d4ed8;

            transform: translateY(-1px);
        }

        .register-link {
            text-align: center;

            margin-top: 20px;

            color: #64748b;

            font-size: 13px;
        }

        .register-link a,
        .admin-link a {
            color: #2563eb;

            font-weight: 600;

            text-decoration: none;
        }

        .register-link a:hover,
        .admin-link a:hover {
            text-decoration: underline;
        }

        .divider {
            display: flex;

            align-items: center;

            gap: 10px;

            margin: 20px 0;

            color: #94a3b8;

            font-size: 11px;
        }

        .divider::before,
        .divider::after {
            content: "";

            flex: 1;

            height: 1px;

            background: #e2e8f0;
        }

        .admin-link {
            text-align: center;

            font-size: 13px;
        }

        .footer {
            text-align: center;

            margin-top: 20px;

            color: #94a3b8;

            font-size: 11px;
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="login-card">

        <div class="logo">

            <div class="logo-icon">
                🛡️
            </div>

            <h1>SIPADULARA</h1>

            <p>
                Sistem Pengaduan Masyarakat
            </p>

        </div>


        <div class="login-title">

            <h2>
                Login Masyarakat
            </h2>

            <p>
                Masuk untuk melihat dan mengelola pengajuan kamu.
            </p>

        </div>


        @if ($errors->any())

            <div class="alert">

                @foreach ($errors->all() as $error)

                    <p>⚠️ {{ $error }}</p>

                @endforeach

            </div>

        @endif


        <form
            action="{{ route('masyarakat.login.submit') }}"
            method="POST"
        >

            @csrf


            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email kamu"
                    autocomplete="email"
                    required
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >

            </div>


            <button
                type="submit"
                class="login-button"
            >
                🔐 Login
            </button>

        </form>


        <div class="register-link">

            Belum punya akun?

            <a href="{{ route('masyarakat.register') }}">
                Daftar sekarang
            </a>

        </div>


        <div class="divider">
            atau
        </div>


        <div class="admin-link">

            <a href="{{ route('admin.login') }}">
                🔑 Login sebagai Admin
            </a>

        </div>

    </div>


    <div class="footer">
        © {{ date('Y') }} SIPADULARA
    </div>

</div>

</body>
</html>