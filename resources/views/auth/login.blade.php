<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - SIPADULARA</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family: Arial, Helvetica, sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #0b1930 0%,
                    #102744 50%,
                    #1e3a6d 100%
                );

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;
        }

        /* ================= WRAPPER ================= */

        .login-wrapper {
            width: 100%;
            max-width: 430px;
        }

        /* ================= CARD ================= */

        .login-card {
            background: #17263d;

            border: 1px solid #304766;

            border-radius: 20px;

            padding: 38px;

            box-shadow:
                0 20px 45px rgba(0, 0, 0, 0.35);
        }

        /* ================= LOGO ================= */

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 62px;
            height: 62px;

            margin: 0 auto 14px;

            border-radius: 16px;

            background: #dbeafe;

            display: flex;
            align-items: center;
            justify-content: center;

            position: relative;

            box-shadow:
                0 8px 20px rgba(37, 99, 235, 0.25);
        }

        .shield {
            width: 25px;
            height: 29px;

            background: #2563eb;

            clip-path: polygon(
                50% 0%,
                92% 16%,
                88% 58%,
                72% 82%,
                50% 100%,
                28% 82%,
                12% 58%,
                8% 16%
            );

            position: relative;
        }

        .shield::after {
            content: "";

            position: absolute;

            width: 7px;
            height: 12px;

            left: 9px;
            top: 7px;

            border-right: 2px solid white;
            border-bottom: 2px solid white;

            transform: rotate(45deg);
        }

        .logo h1 {
            margin: 0;

            color: #f8fafc;

            font-size: 26px;

            font-weight: 800;

            letter-spacing: -0.4px;
        }

        .logo p {
            margin: 7px 0 0;

            color: #94a3b8;

            font-size: 13px;
        }

        /* ================= TITLE ================= */

        .login-title {
            margin-bottom: 22px;
        }

        .login-title h2 {
            margin: 0 0 6px;

            color: #f8fafc;

            font-size: 21px;

            font-weight: 700;
        }

        .login-title p {
            margin: 0;

            color: #94a3b8;

            font-size: 13px;

            line-height: 1.5;
        }

        /* ================= ERROR ================= */

        .alert {
            background: #3a1f28;

            border: 1px solid #7f3345;

            color: #fda4af;

            border-radius: 10px;

            padding: 12px 14px;

            margin-bottom: 18px;

            font-size: 13px;
        }

        .alert p {
            margin: 4px 0;
        }

        /* ================= FORM ================= */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 7px;

            color: #dbeafe;

            font-size: 13px;

            font-weight: 600;
        }

        .form-group input {
            width: 100%;

            padding: 12px 14px;

            border: 1px solid #405775;

            border-radius: 10px;

            outline: none;

            background: #22344d;

            color: #f8fafc;

            font-family: inherit;

            font-size: 14px;

            transition: 0.2s;
        }

        .form-group input::placeholder {
            color: #8fa2bb;
        }

        .form-group input:focus {
            border-color: #3b82f6;

            box-shadow:
                0 0 0 3px rgba(59, 130, 246, 0.18);
        }

        /* ================= PASSWORD ================= */

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 48px;
        }

        .show-password {
            position: absolute;

            right: 12px;
            top: 50%;

            transform: translateY(-50%);

            width: 28px;
            height: 28px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: none;

            background: transparent;

            cursor: pointer;

            padding: 0;

            color: #94a3b8;

            transition: 0.2s;
        }

        .show-password:hover {
            color: #60a5fa;
        }

        .show-password svg {
            width: 20px;
            height: 20px;
        }

        /* ================= BUTTON ================= */

        .login-button {
            width: 100%;

            padding: 13px;

            border: none;

            border-radius: 10px;

            background: #2563eb;

            color: #ffffff;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.2s;
        }

        .login-button:hover {
            background: #3b82f6;

            transform: translateY(-1px);

            box-shadow:
                0 6px 15px rgba(37, 99, 235, 0.30);
        }

        /* ================= REGISTER ================= */

        .register-link {
            text-align: center;

            margin-top: 21px;

            color: #94a3b8;

            font-size: 13px;
        }

        .register-link a {
            color: #60a5fa;

            font-weight: 600;

            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* ================= FOOTER ================= */

        .footer {
            text-align: center;

            margin-top: 20px;

            color: #8193ad;

            font-size: 11px;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 500px) {

            .login-card {
                padding: 28px 22px;
            }

        }

    </style>
</head>


<body>

<div class="login-wrapper">

    <div class="login-card">


        {{-- ================= LOGO ================= --}}

        <div class="logo">

            <div class="logo-icon">

                <div class="shield"></div>

            </div>

            <h1>
                SIPADULARA
            </h1>

            <p>
                Sistem Pengaduan Masyarakat
            </p>

        </div>


        {{-- ================= JUDUL ================= --}}

        <div class="login-title">

            <h2>
                Selamat Datang
            </h2>

            <p>
                Silakan masuk untuk melanjutkan ke SIPADULARA.
            </p>

        </div>


        {{-- ================= ERROR ================= --}}

        @if ($errors->any())

            <div class="alert">

                @foreach ($errors->all() as $error)

                    <p>
                        {{ $error }}
                    </p>

                @endforeach

            </div>

        @endif


        {{-- ================= FORM LOGIN ================= --}}

        <form
            action="{{ route('login.submit') }}"
            method="POST"
        >

            @csrf


            {{-- EMAIL --}}

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
                    autocomplete="email"
                    required
                >

            </div>


            {{-- PASSWORD --}}

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <div class="password-wrapper">

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >


                    <button
                        type="button"
                        class="show-password"
                        onclick="togglePassword()"
                        id="togglePasswordButton"
                        aria-label="Tampilkan password"
                    >

                        {{-- MATA DICORET --}}

                        <svg
                            id="eye-off"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            <path d="M3 3l18 18"></path>

                            <path d="M10.58 10.58a2 2 0 0 0 2.83 2.83"></path>

                            <path d="M9.88 4.24A9.77 9.77 0 0 1 12 4c7 0 10 8 10 8a17.94 17.94 0 0 1-3.17 4.36"></path>

                            <path d="M6.61 6.61C3.93 8.35 2 12 2 12s3 8 10 8a9.8 9.8 0 0 1 3.18-.53"></path>

                        </svg>


                        {{-- MATA BIASA --}}

                        <svg
                            id="eye"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            style="display: none;"
                        >

                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7S2 12 2 12Z"></path>

                            <circle
                                cx="12"
                                cy="12"
                                r="3"
                            ></circle>

                        </svg>

                    </button>

                </div>

            </div>


            {{-- ================= LOGIN ================= --}}

            <button
                type="submit"
                class="login-button"
            >
                Login
            </button>

        </form>


        {{-- ================= REGISTER ================= --}}

        <div class="register-link">

            Belum punya akun?

            <a href="{{ route('masyarakat.register') }}">
                Daftar sekarang
            </a>

        </div>


    </div>


    {{-- ================= FOOTER ================= --}}

    <div class="footer">

        © {{ date('Y') }} SIPADULARA

    </div>

</div>


{{-- ================= JAVASCRIPT ================= --}}

<script>

function togglePassword()
{
    const password =
        document.getElementById('password');

    const eyeOff =
        document.getElementById('eye-off');

    const eye =
        document.getElementById('eye');

    const button =
        document.getElementById('togglePasswordButton');


    if (password.type === 'password') {

        password.type = 'text';

        eyeOff.style.display = 'none';

        eye.style.display = 'block';

        button.setAttribute(
            'aria-label',
            'Sembunyikan password'
        );

    } else {

        password.type = 'password';

        eyeOff.style.display = 'block';

        eye.style.display = 'none';

        button.setAttribute(
            'aria-label',
            'Tampilkan password'
        );

    }
}

</script>


</body>

</html>