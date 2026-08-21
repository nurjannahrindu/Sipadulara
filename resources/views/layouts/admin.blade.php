<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Admin SIPADULARA')
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;

            width: 250px;
            height: 100vh;

            background: #1e3a8a;
            color: white;

            padding: 25px 15px;

            overflow-y: auto;
        }

        .logo {
            text-align: center;

            font-size: 22px;
            font-weight: bold;

            margin-bottom: 35px;
        }

        .menu-title {
            font-size: 12px;
            text-transform: uppercase;

            color: #bfdbfe;

            margin: 20px 12px 10px;
        }

        .menu {
            display: block;

            padding: 12px 15px;

            margin-bottom: 5px;

            color: white;
            text-decoration: none;

            border-radius: 8px;

            transition: 0.2s;
        }

        .menu:hover {
            background: #2563eb;
        }

        .menu.active {
            background: #2563eb;
        }

        /* =========================
           LOGOUT
        ========================= */

        .logout-form {
            margin-top: 10px;
        }

        .logout-button {

            width: 100%;

            padding: 12px 15px;

            border: none;

            border-radius: 8px;

            background: transparent;

            color: #fecaca;

            text-align: left;

            font-size: 15px;

            cursor: pointer;

            font-family: inherit;
        }

        .logout-button:hover {
            background: #dc2626;
            color: white;
        }

        /* =========================
           CONTENT
        ========================= */

        .main {

            margin-left: 250px;

            min-height: 100vh;

            padding: 25px;
        }

        /* =========================
           TOPBAR
        ========================= */

        .topbar {

            background: white;

            padding: 18px 25px;

            border-radius: 12px;

            margin-bottom: 25px;

            box-shadow:
                0 2px 8px rgba(0,0,0,0.06);

            display: flex;

            justify-content: space-between;

            align-items: center;
        }

        .topbar h2 {
            margin: 0;

            color: #1e3a8a;
        }

        .admin-info {
            color: #64748b;
            font-size: 14px;
        }

        /* =========================
           ALERT
        ========================= */

        .alert {

            padding: 15px 18px;

            border-radius: 8px;

            margin-bottom: 20px;
        }

        .alert-success {

            background: #dcfce7;

            color: #166534;
        }

        .alert-error {

            background: #fee2e2;

            color: #991b1b;
        }

        /* =========================
           CARD
        ========================= */

        .card {

            background: white;

            padding: 25px;

            border-radius: 12px;

            box-shadow:
                0 2px 8px rgba(0,0,0,0.05);

            margin-bottom: 20px;
        }

        /* =========================
           TABLE
        ========================= */

        table {

            width: 100%;

            border-collapse: collapse;
        }

        th,
        td {

            padding: 13px;

            border-bottom:
                1px solid #e5e7eb;

            text-align: left;
        }

        th {

            background: #f8fafc;

            color: #374151;
        }

        /* =========================
           BUTTON
        ========================= */

        .btn {

            display: inline-block;

            padding: 9px 15px;

            border-radius: 7px;

            text-decoration: none;

            border: none;

            cursor: pointer;

            font-size: 14px;
        }

        .btn-primary {

            background: #2563eb;

            color: white;
        }

        .btn-primary:hover {

            background: #1d4ed8;
        }

        .btn-success {

            background: #16a34a;

            color: white;
        }

        .btn-danger {

            background: #dc2626;

            color: white;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .sidebar {

                width: 210px;
            }

            .main {

                margin-left: 210px;

                padding: 15px;
            }

            .topbar {

                flex-direction: column;

                align-items: flex-start;

                gap: 10px;
            }

        }

    </style>

</head>


<body>


    {{-- =========================
         SIDEBAR
    ========================= --}}

    <aside class="sidebar">

        <div class="logo">

            🛡️ SIPADULARA

        </div>


        <div class="menu-title">

            Menu Utama

        </div>


        {{-- DASHBOARD --}}

        <a
            href="{{ route('admin.dashboard') }}"
            class="menu"
        >

            📊 Dashboard

        </a>


        {{-- DATA PENGADUAN --}}

        <a
            href="{{ route('admin.pengajuan.index') }}"
            class="menu"
        >

            📁 Data Pengaduan

        </a>


        {{-- KATEGORI --}}

        <a
            href="{{ route('admin.kategori.index') }}"
            class="menu"
        >

            🏷️ Kategori

        </a>


        {{-- LAPORAN --}}

        <a
            href="{{ route('admin.laporan.index') }}"
            class="menu"
        >

            📈 Laporan

        </a>


        <div class="menu-title">

            Akun

        </div>


        {{-- LOGOUT HARUS POST --}}

        <form
            action="{{ route('admin.logout') }}"
            method="POST"
            class="logout-form"
        >

            @csrf

            <button
                type="submit"
                class="logout-button"
            >

                🚪 Logout

            </button>

        </form>


    </aside>



    {{-- =========================
         MAIN CONTENT
    ========================= --}}

    <main class="main">


        {{-- TOPBAR --}}

        <div class="topbar">

            <h2>

                @yield('title', 'Dashboard')

            </h2>


            <div class="admin-info">

                Login sebagai:
                <strong>Admin</strong>

            </div>

        </div>



        {{-- SUCCESS --}}

        @if (session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif



        {{-- ERROR --}}

        @if (session('error'))

            <div class="alert alert-error">

                {{ session('error') }}

            </div>

        @endif



        {{-- ISI HALAMAN --}}

        @yield('content')


    </main>


</body>

</html>