<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - SIPADULARA</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;

            font-family: Arial, Helvetica, sans-serif;

            background:
                linear-gradient(
                    135deg,
                    #eff6ff 0%,
                    #f8fafc 50%,
                    #eef4ff 100%
                );

            color: #334155;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px 20px;
        }


        /* =====================================================
           WRAPPER
        ===================================================== */

        .login-wrapper {
            width: 100%;
            max-width: 440px;
        }


        /* =====================================================
           LOGIN CARD
        ===================================================== */

        .login-card {
            background: #ffffff;

            border: 1px solid #e2e8f0;

            border-radius: 22px;

            padding: 42px 40px 36px;

            box-shadow:
                0 20px 45px rgba(15, 23, 42, 0.08);
        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {
            text-align: center;

            margin-bottom: 32px;
        }

        .logo-icon {
            width: 68px;
            height: 68px;

            margin: 0 auto 16px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #dbeafe;

            border-radius: 18px;

            box-shadow:
                0 8px 20px rgba(37, 99, 235, 0.12);
        }

        .logo-icon svg {
            width: 42px;
            height: 42px;
        }

        .logo h1 {
            margin: 0;

            color: #0f172a;

            font-size: 27px;
            font-weight: 800;

            letter-spacing: -0.5px;
        }

        .logo p {
            margin: 7px 0 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.5;
        }


        /* =====================================================
           LOGIN TITLE
        ===================================================== */

        .login-title {
            margin-bottom: 24px;
        }

        .login-title h2 {
            margin: 0 0 7px;

            color: #0f172a;

            font-size: 22px;
            font-weight: 800;
        }

        .login-title p {
            margin: 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.5;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            background: #fef2f2;

            border: 1px solid #fecaca;

            color: #991b1b;

            border-radius: 10px;

            padding: 12px 14px;

            margin-bottom: 20px;

            font-size: 13px;

            line-height: 1.5;
        }

        .alert p {
            margin: 3px 0;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .form-group {
            margin-bottom: 19px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            color: #334155;

            font-size: 13px;

            font-weight: 700;
        }

        .form-group input {
            width: 100%;

            padding: 13px 14px;

            background: #ffffff;

            border: 1px solid #cbd5e1;

            border-radius: 10px;

            outline: none;

            color: #0f172a;

            font-family: inherit;

            font-size: 14px;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .form-group input::placeholder {
            color: #94a3b8;
        }

        .form-group input:focus {
            border-color: #2563eb;

            background: #ffffff;

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, 0.12);
        }


        /* =====================================================
           LOGIN BUTTON
        ===================================================== */

        .login-button {
            width: 100%;

            border: none;

            border-radius: 10px;

            padding: 14px;

            background: #2563eb;

            color: #ffffff;

            font-family: inherit;

            font-size: 14px;

            font-weight: 700;

            cursor: pointer;

            transition:
                background 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }

        .login-button:hover {
            background: #1d4ed8;

            transform: translateY(-1px);

            box-shadow:
                0 7px 16px rgba(37, 99, 235, 0.20);
        }

        .login-button:active {
            transform: translateY(0);
        }


        /* =====================================================
           BOTTOM LINK
        ===================================================== */

        .bottom-link {
            text-align: center;

            margin-top: 24px;

            padding-top: 20px;

            border-top: 1px solid #f1f5f9;

            font-size: 13px;

            color: #64748b;
        }

        .bottom-link a {
            color: #2563eb;

            font-weight: 700;

            text-decoration: none;
        }

        .bottom-link a:hover {
            text-decoration: underline;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {
            text-align: center;

            margin-top: 20px;

            color: #94a3b8;

            font-size: 11px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 500px) {

            body {
                padding: 20px 15px;
            }

            .login-card {
                padding: 32px 24px 28px;

                border-radius: 18px;
            }

            .logo-icon {
                width: 62px;
                height: 62px;
            }

            .logo h1 {
                font-size: 24px;
            }

            .login-title h2 {
                font-size: 20px;
            }

        }
    </style>
</head>


<body>

<div class="login-wrapper">

    <div class="login-card">


        {{-- =================================================
             LOGO SIPADULARA
        ================================================== --}}

        <div class="logo">

            <div class="logo-icon">

                {{-- LOGO YANG SAMA DENGAN SIDEBAR --}}

                <svg
                    viewBox="0 0 64 64"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >

                    <path
                        d="M32 4L53 12V29C53 43 44 54 32 60C20 54 11 43 11 29V12L32 4Z"
                        fill="white"
                        fill-opacity="0.95"
                    />

                    <path
                        d="M32 10L47 16V29C47 39 41 48 32 53C23 48 17 39 17 29V16L32 10Z"
                        fill="#2563EB"
                    />

                    <path
                        d="M25 31L30 36L40 25"
                        stroke="white"
                        stroke-width="4"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />

                </svg>

            </div>


            <h1>
                SIPADULARA
            </h1>

            <p>
                Sistem Pengaduan Masyarakat
            </p>

        </div>


        {{-- =================================================
             JUDUL LOGIN
        ================================================== --}}

        <div class="login-title">

            <h2>
                Login Admin
            </h2>

            <p>
                Silakan masuk untuk mengelola pengaduan masyarakat.
            </p>

        </div>


        {{-- =================================================
             ERROR
        ================================================== --}}

        @if ($errors->any())

            <div class="alert">

                @foreach ($errors->all() as $error)

                    <p>
                        {{ $error }}
                    </p>

                @endforeach

            </div>

        @endif


        {{-- =================================================
             FORM LOGIN
        ================================================== --}}

        <form
            action="{{ route('admin.login.submit') }}"
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
                    placeholder="Masukkan email admin"
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
                Login Admin
            </button>

        </form>


        {{-- =================================================
             LOGIN MASYARAKAT
        ================================================== --}}

        <div class="bottom-link">

            Bukan Admin?

            <a href="{{ route('masyarakat.login') }}">
                Login sebagai Masyarakat
            </a>

        </div>

    </div>


    <div class="footer">
        © {{ date('Y') }} SIPADULARA
    </div>

</div>

</body>
</html>