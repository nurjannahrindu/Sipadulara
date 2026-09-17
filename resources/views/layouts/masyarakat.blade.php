<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'SIPADULARA')
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background: #f4f7fb;

            color: #334155;
        }

        a {
            text-decoration: none;
        }


        /* =====================================================
           SIDEBAR MASYARAKAT
        ===================================================== */

        .sidebar-masyarakat {

            position: fixed;

            left: 0;
            top: 0;

            width: 270px;

            height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #1e3a8a 0%,
                    #173b8f 100%
                );

            color: white;

            padding: 28px 15px;

            overflow-y: auto;

            z-index: 1000;

            display: flex;

            flex-direction: column;

            box-shadow:
                4px 0 18px rgba(15,23,42,.10);
        }


        /* =====================================================
           BRAND
        ===================================================== */

        .sidebar-masyarakat .brand {

            padding:
                0 10px 25px;

            border-bottom:
                1px solid rgba(255,255,255,.18);

            margin-bottom: 28px;
        }


        .sidebar-masyarakat .brand-logo {

            display: flex;

            align-items: center;

            gap: 14px;
        }


        /* LOGO SAMA DENGAN ADMIN */

        .sidebar-masyarakat .brand-icon {

            width: 54px;
            height: 54px;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #2563eb;

            border-radius: 13px;

            flex-shrink: 0;

            box-shadow:
                0 5px 15px rgba(0,0,0,.15);
        }


        .sidebar-masyarakat .brand-icon svg {

            width: 34px;
            height: 34px;
        }


        .sidebar-masyarakat .brand-text {

            min-width: 0;
        }


        .sidebar-masyarakat .brand-title {

            color: white;

            font-size: 22px;

            font-weight: 800;

            letter-spacing: .2px;

            line-height: 1.1;
        }


        .sidebar-masyarakat .brand-subtitle {

            margin-top: 5px;

            color: #dbeafe;

            font-size: 11px;

            line-height: 1.4;

            white-space: nowrap;
        }


        /* =====================================================
           NAV SECTION
        ===================================================== */

        .sidebar-masyarakat .nav-section {

            margin:
                0 10px 12px;

            color: #dbeafe;

            font-size: 13px;

            font-weight: 700;

            letter-spacing: .8px;

            text-transform: uppercase;
        }


        /* =====================================================
           MENU
        ===================================================== */

        .sidebar-masyarakat .sidebar-menu {

            display: flex;

            flex-direction: column;

            width: 100%;

            gap: 5px;
        }


        .sidebar-masyarakat .sidebar-menu a {

            display: flex;

            align-items: center;

            gap: 13px;

            width: 100%;

            min-height: 53px;

            padding: 9px 12px;

            color: white;

            border-radius: 11px;

            font-size: 15px;

            font-weight: 600;

            transition:
                all .2s ease;
        }


        .sidebar-masyarakat .sidebar-menu a:hover {

            background:
                rgba(255,255,255,.10);

            transform:
                translateX(2px);
        }


        .sidebar-masyarakat .sidebar-menu a.active {

            background: #2563eb;

            box-shadow:
                0 7px 18px rgba(0,0,0,.18);
        }


        /* =====================================================
           ICON MENU
        ===================================================== */

        .sidebar-masyarakat .nav-icon {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 9px;

            background:
                rgba(255,255,255,.12);
        }


        .sidebar-masyarakat .nav-icon svg {

            width: 20px;
            height: 20px;

            stroke: currentColor;

            fill: none;

            stroke-width: 1.8;

            stroke-linecap: round;

            stroke-linejoin: round;
        }


        .sidebar-masyarakat
        .sidebar-menu a.active
        .nav-icon {

            background:
                rgba(255,255,255,.18);
        }


        /* =====================================================
           AKUN
        ===================================================== */

        .sidebar-masyarakat .sidebar-account {

            margin-top: auto;
        }


        .sidebar-masyarakat .sidebar-account hr {

            width: 100%;

            border: 0;

            border-top:
                1px solid rgba(255,255,255,.20);

            margin:
                25px 0 18px;
        }


        /* =====================================================
           LOGOUT
        ===================================================== */

        .sidebar-masyarakat .logout-form {

            width: 100%;

            margin: 0;
        }


        .sidebar-masyarakat .logout-btn {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 13px;

            min-height: 53px;

            padding: 9px 12px;

            border: none;

            border-radius: 11px;

            background: transparent;

            color: white;

            font-family: inherit;

            font-size: 15px;

            font-weight: 600;

            text-align: left;

            cursor: pointer;

            transition:
                all .2s ease;
        }


        .sidebar-masyarakat .logout-btn:hover {
            background: #b91c1c;

                color: white;

                box-shadow:
                    0 6px 16px rgba(127, 29, 29, .30);

                transform:
                    translateY(-1px);
        }

        .sidebar-masyarakat .logout-btn .nav-icon {

                background:
                rgba(168, 36, 36, 0.12);

            transition:
                background .2s ease;
        }

        /* =====================================================
           CONTENT
        ===================================================== */

        .content {

            margin-left: 270px;

            min-height: 100vh;

            padding:
                20px 30px 40px;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {

            min-height: 78px;

            background: white;

            border:
                1px solid #e5eaf1;

            border-radius: 16px;

            padding:
                16px 0;

            margin-bottom: 22px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            box-shadow:
                0 5px 18px rgba(15,23,42,.05);
        }


        .topbar-title {

            color: #1e3a8a;

            font-size: 30px;

            font-weight: 800;

            line-height: 1.2;

            white-space: nowrap;
        }


        .topbar-subtitle {

            margin-top: 6px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.4;

            white-space: nowrap;
        }


        /* =====================================================
           USER
        ===================================================== */

        .user-info {

            display: flex;

            align-items: center;

            gap: 11px;

            padding:
                9px 15px;

            border:
                1px solid #e2e8f0;

            border-radius: 22px;

            background: #f8fafc;

            color: #64748b;

            font-size: 13px;
        }


        .user-avatar {

            width: 40px;
            height: 40px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #eff6ff;

            color: #2563eb;

            font-size: 17px;

            border:
                1px solid #dbeafe;
        }


        .user-name {

            margin-top: 2px;

            color: #1e3a8a;

            font-size: 13px;

            font-weight: 700;

            max-width: 220px;

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /* =====================================================
           HAMBURGER
        ===================================================== */

        .mobile-menu-button {

            display: none;

            width: 44px;
            height: 44px;

            border: none;

            border-radius: 10px;

            background: #2563eb;

            color: white;

            cursor: pointer;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;
        }


        .mobile-menu-button svg {

            width: 23px;
            height: 23px;

            stroke: currentColor;

            fill: none;

            stroke-width: 2;

            stroke-linecap: round;
        }


        .sidebar-overlay {

            display: none;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert {

            padding:
                14px 17px;

            border-radius: 11px;

            margin-bottom: 22px;

            font-size: 13px;

            font-weight: 500;
        }


        .alert-success {

            background: #f0fdf4;

            color: #166534;

            border:
                1px solid #bbf7d0;
        }


        .alert-error {

            background: #fef2f2;

            color: #991b1b;

            border:
                1px solid #fecaca;
        }


        /* =====================================================
           PAGE HEADER
        ===================================================== */

        .page-header {

            margin-bottom: 24px;
        }


        .page-title {

            margin: 0;

            color: #0f172a;

            font-size: 28px;

            font-weight: 800;

            letter-spacing: -.4px;
        }


        .page-description {

            margin: 8px 0 0;

            color: #64748b;

            font-size: 13px;

            line-height: 1.6;
        }


        /* =====================================================
           STATISTIK
        ===================================================== */

        .stats {

            display: grid;

            grid-template-columns:
                repeat(5, minmax(0, 1fr));

            gap: 14px;

            margin-bottom: 25px;
        }


        .stat-card {

            position: relative;

            overflow: hidden;

            min-height: 100px;

            background: #ffffff;

            border:
                1px solid #e5eaf1;

            border-radius: 12px;

            padding: 13px 12px;

            box-shadow:
                0 5px 18px rgba(15,23,42,0.045);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }


        .stat-card:hover {

            transform:
                translateY(-3px);

            box-shadow:
                0 10px 25px rgba(15,23,42,0.08);
        }


        .stat-card::after {

            content: "";

            position: absolute;

            right: -30px;

            bottom: -30px;

            width: 85px;

            height: 85px;

            border-radius: 50%;

            background: #eff6ff;

            opacity: .85;
        }


        .stat-title {

            position: relative;

            z-index: 2;

            color: #64748b;

            font-size: 12px;

            font-weight: 600;

            margin-bottom: 9px;
        }


        .stat-number {

            position: relative;

            z-index: 2;

            color: #0f172a;

            font-size: 27px;

            font-weight: 800;

            line-height: 1;
        }


        .stat-description {

            position: relative;

            z-index: 2;

            margin-top: 8px;

            color: #94a3b8;

            font-size: 10px;

            line-height: 1.4;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .card {

            background: #ffffff;

            border:
                1px solid #e5eaf1;

            border-radius: 16px;

            padding: 26px;

            box-shadow:
                0 5px 18px rgba(15,23,42,.04);
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .btn {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding:
                10px 16px;

            border: 0;

            border-radius: 9px;

            cursor: pointer;

            font-family: inherit;

            font-size: 13px;

            font-weight: 600;
        }


        .btn-primary {

            background: #2563eb;

            color: white;
        }


        .btn-secondary {

            background: #e2e8f0;

            color: #334155;
        }


        .btn-danger {

            background: #dc2626;

            color: white;
        }


        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrapper {

            overflow-x: auto;
        }


        table {

            width: 100%;

            border-collapse: collapse;
        }


        th {

            padding:
                13px 15px;

            background: #f8fafc;

            color: #64748b;

            border-bottom:
                1px solid #e2e8f0;

            text-align: left;

            font-size: 12px;

            font-weight: 600;
        }


        td {

            padding:
                14px 15px;

            color: #334155;

            border-bottom:
                1px solid #f1f5f9;

            font-size: 13px;
        }


        tr:hover td {

            background: #f8fafc;
        }


        /* =====================================================
           BADGE
        ===================================================== */

        .badge {

            display: inline-flex;

            align-items: center;

            padding:
                5px 9px;

            border-radius: 20px;

            font-size: 11px;

            font-weight: 600;
        }


        .badge-warning {

            background: #fef3c7;

            color: #92400e;
        }


        .badge-info {

            background: #dbeafe;

            color: #1e40af;
        }


        .badge-success {

            background: #dcfce7;

            color: #166534;
        }


        .badge-danger {

            background: #fee2e2;

            color: #991b1b;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 900px) {

            .sidebar-masyarakat {

                width: 240px;
            }


            .content {

                margin-left: 240px;

                padding: 20px;
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 700px) {

            .mobile-menu-button {

                display: flex;
            }


            .sidebar-masyarakat {

                width: 260px;

                transform:
                    translateX(-100%);

                transition:
                    transform .25s ease;

                box-shadow:
                    8px 0 25px rgba(15,23,42,.20);
            }


            .sidebar-masyarakat.mobile-open {

                transform:
                    translateX(0);
            }


            .sidebar-overlay {

                position: fixed;

                inset: 0;

                background:
                    rgba(15,23,42,.45);

                z-index: 999;

                display: none;
            }


            .sidebar-overlay.active {

                display: block;
            }


            .content {

                margin-left: 0;

                padding:
                    15px 14px 30px;
            }


           .topbar {

                min-height: 90px;

                background: white;

                border:
                    1px solid #e5eaf1;

                border-radius: 16px;

                padding:
                    18px 30px;


            .topbar-title {

                font-size: 22px;

                line-height: 1.2;
            }


            .topbar-subtitle {

                font-size: 11px;

                margin-top: 4px;
            }


            .user-info {

                display: none;
            }


            .stats {

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 10px;
            }


            .stat-card {

                min-height: 105px;

                padding: 14px;
            }


            .stat-title {

                font-size: 11px;
            }


            .stat-number {

                font-size: 24px;
            }


            .stat-description {

                font-size: 9px;
            }


            .page-title {

                font-size: 24px;
            }


            .card {

                padding: 20px;
            }

        }


        /* =====================================================
           MOBILE SANGAT KECIL
        ===================================================== */

        @media (max-width: 430px) {

            .stats {

                grid-template-columns: 1fr 1fr;
            }


            .stat-card {

                min-height: 100px;

                padding: 12px;
            }


            .stat-number {

                font-size: 22px;
            }

        }

    </style>


    @yield('styles')

</head>


<body>


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <x-sidebar role="masyarakat" />


    {{-- =====================================================
         OVERLAY
    ====================================================== --}}

    <div
        id="sidebarOverlay"
        class="sidebar-overlay"
    ></div>


    <main class="content">


        {{-- =================================================
             TOPBAR
        ================================================== --}}

        <div class="topbar">


            {{-- HAMBURGER --}}

            <button
                type="button"
                id="mobileMenuButton"
                class="mobile-menu-button"
                aria-label="Buka menu"
            >

                <svg viewBox="0 0 24 24">

                    <path d="M4 6h16"/>

                    <path d="M4 12h16"/>

                    <path d="M4 18h16"/>

                </svg>

            </button>


            <div>

                <div class="topbar-title">

                    SIPADULARA

                </div>


                <div class="topbar-subtitle">

                    Sistem Pengaduan Masyarakat

                </div>

            </div>


            {{-- USER --}}

            <div class="user-info">

                <div class="user-avatar">

                    👤

                </div>


                <div>

                    <div>

                        Login sebagai

                    </div>


                    <div class="user-name">

                        {{ $masyarakat->nama ?? 'Masyarakat' }}

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
             SUCCESS
        ================================================== --}}

        @if(session('success'))

            <div class="alert alert-success">

                ✓ {{ session('success') }}

            </div>

        @endif


        {{-- =================================================
             ERROR
        ================================================== --}}

        @if(session('error'))

            <div class="alert alert-error">

                ⚠ {{ session('error') }}

            </div>

        @endif


        {{-- =================================================
             CONTENT
        ================================================== --}}

        @yield('content')


    </main>


    {{-- =====================================================
         HAMBURGER SCRIPT
    ====================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const button =
                    document.getElementById(
                        'mobileMenuButton'
                    );


                const sidebar =
                    document.getElementById(
                        'masyarakatSidebar'
                    );


                const overlay =
                    document.getElementById(
                        'sidebarOverlay'
                    );


                if (
                    !button ||
                    !sidebar ||
                    !overlay
                ) {

                    return;

                }


                button.addEventListener(
                    'click',
                    function () {

                        sidebar.classList.toggle(
                            'mobile-open'
                        );


                        overlay.classList.toggle(
                            'active'
                        );

                    }
                );


                overlay.addEventListener(
                    'click',
                    function () {

                        sidebar.classList.remove(
                            'mobile-open'
                        );


                        overlay.classList.remove(
                            'active'
                        );

                    }
                );

            }
        );

    </script>


    @yield('scripts')


</body>

</html>