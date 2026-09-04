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
       SIDEBAR ADMIN
    ===================================================== */

    .sidebar-admin {

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

    .sidebar-admin .brand {

        padding:
            0 10px 25px;

        border-bottom:
            1px solid rgba(255,255,255,.18);

        margin-bottom: 28px;
    }

    .brand-logo {

        display: flex;

        align-items: center;

        gap: 14px;
    }

    .brand-icon {

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

    .brand-icon svg {

        width: 34px;
        height: 34px;
    }

    .brand-text {

        min-width: 0;
    }

    .brand-title {

        color: white;

        font-size: 22px;

        font-weight: 800;

        letter-spacing: .2px;

        line-height: 1.1;
    }

    .brand-subtitle {

        margin-top: 5px;

        color: #dbeafe;

        font-size: 11px;

        line-height: 1.4;

        white-space: nowrap;
    }


    /* =====================================================
       NAV SECTION
    ===================================================== */

    .sidebar-admin .nav-section {

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

    .sidebar-admin .sidebar-menu {

        display: flex;

        flex-direction: column;

        width: 100%;

        gap: 5px;
    }


    .sidebar-admin .sidebar-menu a {

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

        transition: all .2s ease;
    }


    .sidebar-admin .sidebar-menu a:hover {

        background:
            rgba(255,255,255,.10);

        transform:
            translateX(2px);
    }


    .sidebar-admin .sidebar-menu a.active {

        background: #2563eb;

        box-shadow:
            0 7px 18px rgba(0,0,0,.18);
    }


    /* =====================================================
       ICON
    ===================================================== */

    .sidebar-admin .nav-icon {

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


    .sidebar-admin .nav-icon svg {

        width: 20px;
        height: 20px;

        stroke: currentColor;

        fill: none;

        stroke-width: 1.8;

        stroke-linecap: round;

        stroke-linejoin: round;
    }


    .sidebar-admin .sidebar-menu a.active .nav-icon {

        background:
            rgba(255,255,255,.18);
    }


    /* =====================================================
       AKUN
    ===================================================== */

    .sidebar-admin .sidebar-account {

        margin-top: auto;
    }


    .sidebar-admin .sidebar-account hr {

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

    .sidebar-admin .logout-form {

        width: 100%;

        margin: 0;
    }


    .sidebar-admin .logout-btn {

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

        transition: all .2s ease;
    }


    .sidebar-admin .logout-btn:hover {

        background: #b91c1c;

        color: white;

        box-shadow:
            0 6px 16px rgba(127, 29, 29, .30);

        transform:
            translateY(-1px);
    }


    .sidebar-admin .logout-btn:hover .nav-icon {

        background: #991b1b;

        color: white;
    }


    .sidebar-admin .logout-btn .nav-icon {

        background:
            rgba(168, 36, 36, 0.12);

        transition:
            background .2s ease;
    }


    /* =====================================================
       MAIN
    ===================================================== */

    .main {

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
            16px 24px;

        margin-bottom: 22px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        box-shadow:
            0 5px 18px rgba(15,23,42,.05);
    }


    .topbar h2 {

        margin: 0;

        color: #1e3a8a;

        font-size: 27px;

        font-weight: 800;
    }


    .admin-info {

        display: flex;

        align-items: center;

        gap: 8px;

        padding:
            9px 15px;

        border:
            1px solid #e2e8f0;

        border-radius: 22px;

        background: #f8fafc;

        color: #64748b;

        font-size: 13px;
    }


    .admin-info strong {

        color: #1e3a8a;

        font-weight: 700;
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
       CARD
    ===================================================== */

    .card {

        background: white;

        border:
            1px solid #e5eaf1;

        border-radius: 16px;

        padding: 25px;

        margin-bottom: 20px;

        box-shadow:
            0 5px 18px rgba(15,23,42,.04);
    }


    /* =====================================================
       TABLE
    ===================================================== */

    .table-wrapper {

        width: 100%;

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

        transition: .2s ease;
    }


    .btn-primary {

        background: #2563eb;

        color: white;
    }


    .btn-primary:hover {

        background: #1d4ed8;

        transform:
            translateY(-1px);
    }


    .btn-success {

        background: #16a34a;

        color: white;
    }


    .btn-danger {

        background: #dc2626;

        color: white;
    }


    /* =====================================================
       TABLET
    ===================================================== */

    @media (max-width: 900px) {

        .sidebar-admin {

            width: 240px;
        }

        .main {

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


        .sidebar-admin {

            width: 260px;

            transform:
                translateX(-100%);

            transition:
                transform .25s ease;

            box-shadow:
                8px 0 25px rgba(15,23,42,.20);
        }


        .sidebar-admin.mobile-open {

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


        .main {

            margin-left: 0;

            padding:
                15px 14px 30px;
        }


        .topbar {

            min-height: 64px;

            padding:
                10px 14px;

            margin-bottom: 18px;

            border-radius: 13px;
        }


        .topbar h2 {

            font-size: 20px;
        }


        .admin-info {

            display: none;
        }

    }

</style>


@yield('styles')

</head>


<body>


{{-- SIDEBAR --}}

<x-sidebar role="admin" />


{{-- OVERLAY MOBILE --}}

<div
    id="sidebarOverlay"
    class="sidebar-overlay"
></div>


<main class="main">


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


        <h2>

            @yield(
                'title',
                'Dashboard Admin'
            )

        </h2>


        <div class="admin-info">

            <span>Login sebagai:</span>

            <strong>
                Admin
            </strong>

        </div>


    </div>


    @if (session('success'))

        <div class="alert alert-success">

            ✓ {{ session('success') }}

        </div>

    @endif


    @if (session('error'))

        <div class="alert alert-error">

            ⚠ {{ session('error') }}

        </div>

    @endif


    @yield('content')


</main>


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
                'adminSidebar'
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