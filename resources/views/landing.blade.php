<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPADULARA - Sistem Pengaduan Masyarakat</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #0f172a;
            color: #ffffff;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;

            height: 78px;

            display: flex;
            align-items: center;

            padding: 0 7%;

            background: rgba(15, 23, 42, 0.88);

            backdrop-filter: blur(14px);

            border-bottom: 1px solid rgba(255,255,255,.08);

            z-index: 1000;
        }

        .nav-container {
            width: 100%;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;

            color: #ffffff;
        }

        .brand-logo {
            width: 42px;
            height: 42px;

            border-radius: 12px;

            background: linear-gradient(
                135deg,
                #2563eb,
                #38bdf8
            );

            display: flex;
            align-items: center;
            justify-content: center;

            box-shadow:
                0 8px 25px rgba(37,99,235,.35);
        }

        .brand-logo::before {
            content: "";
            width: 17px;
            height: 20px;

            border: 3px solid white;

            border-radius: 8px 8px 10px 10px;
        }

        .brand-text {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-menu a {
            color: #cbd5e1;

            font-size: 14px;
            font-weight: 500;

            padding: 10px 14px;

            border-radius: 9px;

            transition: .25s;
        }

        .nav-menu a:hover {
            color: #ffffff;
            background: rgba(255,255,255,.07);
        }

        .nav-login {
            border: 1px solid #3b82f6;
            color: #93c5fd !important;
        }

        .nav-register {
            background: #2563eb;
            color: white !important;
        }

        .nav-register:hover {
            background: #1d4ed8 !important;
        }

        .hamburger {
            display: none;

            width: 42px;
            height: 42px;

            border: 1px solid rgba(255,255,255,.1);

            border-radius: 10px;

            background: rgba(255,255,255,.05);

            cursor: pointer;

            align-items: center;
            justify-content: center;

            flex-direction: column;

            gap: 5px;
        }

        .hamburger span {
            width: 20px;
            height: 2px;

            background: #ffffff;

            border-radius: 5px;

            transition: .3s;
        }


        /* =====================================================
           HERO
        ===================================================== */

        .hero {
            min-height: 100vh;

            position: relative;

            display: flex;
            align-items: center;

            padding:
                130px 7%
                80px;

            overflow: hidden;

            background:
                radial-gradient(
                    circle at 80% 30%,
                    rgba(37,99,235,.30),
                    transparent 35%
                ),
                radial-gradient(
                    circle at 20% 80%,
                    rgba(14,165,233,.12),
                    transparent 30%
                ),
                #0f172a;
        }

        .hero::before {
            content: "";

            position: absolute;

            width: 500px;
            height: 500px;

            border-radius: 50%;

            border: 1px solid rgba(96,165,250,.15);

            right: -150px;
            top: 100px;

            animation: rotateCircle 20s linear infinite;
        }

        .hero::after {
            content: "";

            position: absolute;

            width: 300px;
            height: 300px;

            border-radius: 50%;

            border: 1px solid rgba(56,189,248,.12);

            right: 80px;
            bottom: -100px;

            animation: floatCircle 7s ease-in-out infinite;
        }

        .hero-container {
            width: 100%;
            max-width: 1250px;

            margin: auto;

            display: grid;

            grid-template-columns:
                1.15fr
                .85fr;

            gap: 70px;

            align-items: center;

            position: relative;

            z-index: 2;
        }

        .hero-content {
            animation: fadeLeft 1s ease forwards;
        }

        .hero-badge {
            display: inline-flex;

            padding: 8px 14px;

            border-radius: 30px;

            background: rgba(37,99,235,.15);

            border: 1px solid rgba(96,165,250,.25);

            color: #93c5fd;

            font-size: 13px;

            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: clamp(42px, 5vw, 70px);

            line-height: 1.05;

            letter-spacing: -2px;

            margin-bottom: 25px;
        }

        .hero h1 span {
            background:
                linear-gradient(
                    90deg,
                    #60a5fa,
                    #38bdf8
                );

            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-description {
            max-width: 650px;

            color: #94a3b8;

            font-size: 17px;

            line-height: 1.8;

            margin-bottom: 30px;
        }

        .hero-info {
            display: flex;
            gap: 30px;

            flex-wrap: wrap;
        }

        .hero-info-item {
            color: #cbd5e1;

            font-size: 13px;
        }

        .hero-info-item strong {
            display: block;

            color: #ffffff;

            font-size: 20px;

            margin-bottom: 4px;
        }


        /* =====================================================
           HERO VISUAL
        ===================================================== */

        .hero-visual {
            position: relative;

            height: 450px;

            display: flex;

            align-items: center;
            justify-content: center;

            animation: fadeRight 1s ease forwards;
        }

        .visual-main {
            width: 300px;
            height: 360px;

            border-radius: 28px;

            background:
                linear-gradient(
                    145deg,
                    #1e3a8a,
                    #172554
                );

            border: 1px solid rgba(147,197,253,.2);

            box-shadow:
                0 30px 80px rgba(0,0,0,.35);

            position: relative;

            transform:
                perspective(900px)
                rotateY(-10deg);

            animation:
                cardFloat 5s ease-in-out infinite;
        }

        .visual-header {
            padding: 25px;

            border-bottom:
                1px solid
                rgba(255,255,255,.08);
        }

        .visual-header small {
            color: #93c5fd;

            font-size: 12px;
        }

        .visual-header h3 {
            margin-top: 8px;

            font-size: 20px;
        }

        .visual-body {
            padding: 25px;
        }

        .visual-line {
            height: 10px;

            background: rgba(255,255,255,.08);

            border-radius: 20px;

            margin-bottom: 15px;
        }

        .visual-line.short {
            width: 65%;
        }

        .visual-status {
            margin-top: 30px;

            padding: 15px;

            border-radius: 12px;

            background: rgba(37,99,235,.25);

            border: 1px solid rgba(147,197,253,.15);
        }

        .visual-status span {
            display: block;

            color: #93c5fd;

            font-size: 11px;

            margin-bottom: 6px;
        }

        .visual-status strong {
            font-size: 17px;
        }

        .floating-card {
            position: absolute;

            padding: 18px 20px;

            border-radius: 15px;

            background:
                rgba(30,41,59,.9);

            border:
                1px solid
                rgba(255,255,255,.08);

            box-shadow:
                0 15px 40px rgba(0,0,0,.25);

            backdrop-filter: blur(10px);

            animation:
                floating 4s ease-in-out infinite;
        }

        .floating-card.one {
            left: 0;
            top: 70px;
        }

        .floating-card.two {
            right: -15px;
            bottom: 70px;

            animation-delay: 1s;
        }

        .floating-number {
            font-size: 22px;
            font-weight: bold;
        }

        .floating-label {
            color: #94a3b8;

            font-size: 11px;

            margin-top: 4px;
        }


        /* =====================================================
           SECTION
        ===================================================== */

        .section {
            padding: 100px 7%;
        }

        .section-dark {
            background: #111c32;
        }

        .section-blue {
            background:
                linear-gradient(
                    135deg,
                    #172554,
                    #0f172a
                );
        }

        .section-header {
            max-width: 700px;

            margin:
                0 auto 55px;

            text-align: center;
        }

        .section-label {
            color: #60a5fa;

            font-size: 12px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 2px;

            margin-bottom: 12px;
        }

        .section-title {
            font-size: 38px;

            margin-bottom: 15px;
        }

        .section-description {
            color: #94a3b8;

            line-height: 1.7;

            font-size: 15px;
        }


        /* =====================================================
           STATISTIK
        ===================================================== */

        .stats-grid {
            max-width: 1200px;

            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 18px;
        }

        .stat-box {
            padding: 30px;

            border-radius: 18px;

            background:
                rgba(30,41,59,.8);

            border:
                1px solid
                rgba(148,163,184,.10);

            transition: .3s;

            position: relative;

            overflow: hidden;
        }

        .stat-box::before {
            content: "";

            position: absolute;

            width: 100px;
            height: 100px;

            border-radius: 50%;

            background:
                rgba(37,99,235,.12);

            right: -30px;
            top: -30px;
        }

        .stat-box:hover {
            transform: translateY(-6px);

            border-color:
                rgba(96,165,250,.3);
        }

        .stat-number {
            font-size: 38px;

            font-weight: 800;

            color: #ffffff;

            margin-bottom: 7px;
        }

        .stat-title {
            color: #cbd5e1;

            font-size: 15px;

            margin-bottom: 6px;
        }

        .stat-description {
            color: #64748b;

            font-size: 12px;
        }


        /* =====================================================
           FITUR
        ===================================================== */

        .features-grid {
            max-width: 1200px;

            margin: auto;

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 20px;
        }

        .feature-card {
            padding: 30px;

            border-radius: 20px;

            background:
                #162238;

            border:
                1px solid
                rgba(148,163,184,.09);

            transition:
                transform .3s,
                border-color .3s;

            opacity: 0;

            transform: translateY(35px);
        }

        .feature-card.show {
            opacity: 1;

            transform: translateY(0);

            transition:
                opacity .7s ease,
                transform .7s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);

            border-color:
                rgba(96,165,250,.35);
        }

        .feature-number {
            font-size: 12px;

            color: #60a5fa;

            margin-bottom: 22px;
        }

        .feature-card h3 {
            font-size: 20px;

            margin-bottom: 12px;
        }

        .feature-card p {
            color: #94a3b8;

            font-size: 14px;

            line-height: 1.7;
        }


        /* =====================================================
           VISI MISI
        ===================================================== */

        .vision-wrapper {
            max-width: 1100px;

            margin: auto;

            display: grid;

            grid-template-columns:
                1fr
                1fr;

            gap: 25px;
        }

        .vision-card {
            padding: 40px;

            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    rgba(37,99,235,.16),
                    rgba(30,41,59,.7)
                );

            border:
                1px solid
                rgba(96,165,250,.14);

            opacity: 0;

            transform: translateY(40px);
        }

        .vision-card.show {
            opacity: 1;

            transform: translateY(0);

            transition:
                .8s ease;
        }

        .vision-card h3 {
            font-size: 24px;

            margin-bottom: 18px;

            color: #93c5fd;
        }

        .vision-card p,
        .vision-card li {
            color: #cbd5e1;

            font-size: 15px;

            line-height: 1.8;
        }

        .vision-card ul {
            padding-left: 20px;
        }

        .vision-card li {
            margin-bottom: 10px;
        }


        /* =====================================================
           TENTANG
        ===================================================== */

        .about-content {
            max-width: 900px;

            margin: auto;

            text-align: center;
        }

        .about-content p {
            color: #94a3b8;

            font-size: 16px;

            line-height: 1.9;
        }


        /* =====================================================
           CTA
        ===================================================== */

        .cta {
            padding:
                110px 7%;

            text-align: center;

            background:
                radial-gradient(
                    circle at center,
                    rgba(37,99,235,.35),
                    transparent 55%
                ),
                #0b1220;

            position: relative;

            overflow: hidden;
        }

        .cta h2 {
            font-size: 42px;

            margin-bottom: 18px;
        }

        .cta p {
            color: #94a3b8;

            max-width: 600px;

            margin:
                0 auto 30px;

            line-height: 1.7;
        }

        .cta-button {
            display: inline-flex;

            padding: 14px 27px;

            border-radius: 11px;

            background: #2563eb;

            color: white;

            font-size: 14px;

            font-weight: 700;

            transition: .3s;

            box-shadow:
                0 10px 30px
                rgba(37,99,235,.25);
        }

        .cta-button:hover {
            background: #1d4ed8;

            transform: translateY(-3px);

            box-shadow:
                0 15px 35px
                rgba(37,99,235,.35);
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {
            padding:
                25px 7%;

            text-align: center;

            background: #080f1c;

            border-top:
                1px solid
                rgba(255,255,255,.06);

            color: #64748b;

            font-size: 12px;
        }


        /* =====================================================
           ANIMASI
        ===================================================== */

        @keyframes fadeLeft {

            from {
                opacity: 0;
                transform: translateX(-40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }

        }

        @keyframes fadeRight {

            from {
                opacity: 0;
                transform: translateX(40px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }

        }

        @keyframes floating {

            0%,100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }

        }

        @keyframes cardFloat {

            0%,100% {
                transform:
                    perspective(900px)
                    rotateY(-10deg)
                    translateY(0);
            }

            50% {
                transform:
                    perspective(900px)
                    rotateY(-10deg)
                    translateY(-12px);
            }

        }

        @keyframes rotateCircle {

            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }

        }

        @keyframes floatCircle {

            0%,100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-30px);
            }

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            .navbar {
                padding: 0 5%;
            }

            .hamburger {
                display: flex;
            }

            .nav-menu {

                position: absolute;

                top: 78px;
                left: 0;
                right: 0;

                padding: 18px 5% 25px;

                background:
                    rgba(15,23,42,.98);

                border-bottom:
                    1px solid
                    rgba(255,255,255,.08);

                display: none;

                flex-direction: column;

                align-items: stretch;

                gap: 5px;
            }

            .nav-menu.active {
                display: flex;
            }

            .nav-menu a {
                width: 100%;

                padding: 14px;

                text-align: center;
            }

            .hero {
                padding:
                    120px 6%
                    70px;
            }

            .hero-container {
                grid-template-columns: 1fr;

                text-align: center;

                gap: 40px;
            }

            .hero-description {
                margin-left: auto;
                margin-right: auto;
            }

            .hero-info {
                justify-content: center;
            }

            .hero-visual {
                height: 380px;
            }

            .features-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

        }

        @media (max-width: 600px) {

            .brand-text {
                font-size: 18px;
            }

            .hero h1 {
                font-size: 43px;

                letter-spacing: -1px;
            }

            .hero-description {
                font-size: 15px;
            }

            .hero-visual {
                transform: scale(.82);

                margin:
                    -40px 0;
            }

            .stats-grid,
            .features-grid,
            .vision-wrapper {
                grid-template-columns: 1fr;
            }

            .section {
                padding:
                    75px 6%;
            }

            .section-title {
                font-size: 31px;
            }

            .cta {
                padding:
                    80px 6%;
            }

            .cta h2 {
                font-size: 32px;
            }

        }

    </style>

</head>


<body>


{{-- =========================================================
     NAVBAR
========================================================= --}}

<nav class="navbar">

    <div class="nav-container">

        <a href="#beranda" class="brand">

            <div class="brand-logo"></div>

            <div class="brand-text">
                SIPADULARA
            </div>

        </a>


        <div class="nav-menu" id="navMenu">

            <a href="#beranda">
                Beranda
            </a>

            <a href="#fitur">
                Fitur
            </a>

            <a href="#visi-misi">
                Visi & Misi
            </a>

            <a href="#tentang">
                Tentang
            </a>

            <a
                href="{{ route('login') }}"
                class="nav-login"
            >
                Login
            </a>

        </div>


        <button
            class="hamburger"
            id="hamburger"
            type="button"
        >

            <span></span>
            <span></span>
            <span></span>

        </button>

    </div>

</nav>



{{-- =========================================================
     HERO
========================================================= --}}

<section
    class="hero"
    id="beranda"
>

    <div class="hero-container">


        <div class="hero-content">

            <div class="hero-badge">
                SISTEM PENGADUAN MASYARAKAT
            </div>


            <h1>

                Suara Masyarakat,

                <br>

                <span>
                    Perubahan Nyata.
                </span>

            </h1>


            <p class="hero-description">

                SIPADULARA membantu masyarakat menyampaikan
                pengaduan secara mudah, transparan, dan terarah
                sehingga setiap laporan dapat ditindaklanjuti
                dengan lebih baik.

            </p>


            <div class="hero-info">

                <div class="hero-info-item">

                    <strong>
                        Mudah
                    </strong>

                    Pengaduan online

                </div>


                <div class="hero-info-item">

                    <strong>
                        Transparan
                    </strong>

                    Status dapat dipantau

                </div>


                <div class="hero-info-item">

                    <strong>
                        Terarah
                    </strong>

                    Ditangani pemerintah

                </div>

            </div>

        </div>



        <div class="hero-visual">


            <div class="floating-card one">

                <div class="floating-number">
                    {{ $totalPengajuan ?? 0 }}
                </div>

                <div class="floating-label">
                    Total Pengaduan
                </div>

            </div>


            <div class="visual-main">

                <div class="visual-header">

                    <small>
                        SIPADULARA
                    </small>

                    <h3>
                        Pengaduan Masyarakat
                    </h3>

                </div>


                <div class="visual-body">

                    <div class="visual-line"></div>

                    <div class="visual-line short"></div>

                    <div class="visual-line"></div>

                    <div class="visual-status">

                        <span>
                            STATUS PENGADUAN
                        </span>

                        <strong>
                            Sedang Diproses
                        </strong>

                    </div>

                </div>

            </div>


            <div class="floating-card two">

                <div class="floating-number">
                    {{ $selesai ?? 0 }}
                </div>

                <div class="floating-label">
                    Pengaduan Selesai
                </div>

            </div>


        </div>

    </div>

</section>



{{-- =========================================================
     STATISTIK
========================================================= --}}

<section class="section section-dark">

    <div class="section-header">

        <div class="section-label">
            Statistik
        </div>

        <h2 class="section-title">
            SIPADULARA dalam angka
        </h2>

        <p class="section-description">
            Data pengaduan masyarakat yang tercatat
            di dalam sistem.
        </p>

    </div>


    <div class="stats-grid">


        <div class="stat-box">

            <div class="stat-number">
                {{ $totalMasyarakat ?? 0 }}
            </div>

            <div class="stat-title">
                Masyarakat Terdaftar
            </div>

            <div class="stat-description">
                Pengguna yang telah memiliki akun
            </div>

        </div>


        <div class="stat-box">

            <div class="stat-number">
                {{ $totalPengajuan ?? 0 }}
            </div>

            <div class="stat-title">
                Total Pengaduan
            </div>

            <div class="stat-description">
                Seluruh pengaduan yang masuk
            </div>

        </div>


        <div class="stat-box">

            <div class="stat-number">
                {{ $diajukan ?? 0 }}
            </div>

            <div class="stat-title">
                Menunggu Proses
            </div>

            <div class="stat-description">
                Pengaduan baru yang diajukan
            </div>

        </div>


        <div class="stat-box">

            <div class="stat-number">
                {{ $diproses ?? 0 }}
            </div>

            <div class="stat-title">
                Sedang Diproses
            </div>

            <div class="stat-description">
                Pengaduan dalam proses
            </div>

        </div>


        <div class="stat-box">

            <div class="stat-number">
                {{ $ditangani ?? 0 }}
            </div>

            <div class="stat-title">
                Sedang Ditangani
            </div>

            <div class="stat-description">
                Pengaduan dalam penanganan
            </div>

        </div>


        <div class="stat-box">

            <div class="stat-number">
                {{ $selesai ?? 0 }}
            </div>

            <div class="stat-title">
                Pengaduan Selesai
            </div>

            <div class="stat-description">
                Pengaduan yang telah diselesaikan
            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     FITUR
========================================================= --}}

<section
    class="section section-blue"
    id="fitur"
>

    <div class="section-header">

        <div class="section-label">
            Fitur
        </div>

        <h2 class="section-title">
            Semua dalam satu sistem
        </h2>

        <p class="section-description">
            SIPADULARA menyediakan fasilitas yang
            membantu masyarakat dan pemerintah
            mengelola pengaduan secara terstruktur.
        </p>

    </div>


    <div class="features-grid">


        <div class="feature-card">

            <div class="feature-number">
                01
            </div>

            <h3>
                Pengajuan Pengaduan
            </h3>

            <p>
                Masyarakat dapat menyampaikan pengaduan
                secara online dengan informasi yang lengkap.
            </p>

        </div>


        <div class="feature-card">

            <div class="feature-number">
                02
            </div>

            <h3>
                Pantau Status
            </h3>

            <p>
                Setiap pengaduan memiliki status sehingga
                masyarakat dapat mengetahui perkembangannya.
            </p>

        </div>


        <div class="feature-card">

            <div class="feature-number">
                03
            </div>

            <h3>
                Penanganan Terstruktur
            </h3>

            <p>
                Admin dapat mencatat proses penanganan
                setiap pengaduan secara terorganisir.
            </p>

        </div>


        <div class="feature-card">

            <div class="feature-number">
                04
            </div>

            <h3>
                Riwayat Pengaduan
            </h3>

            <p>
                Masyarakat dapat melihat kembali
                pengaduan dan riwayat penanganannya.
            </p>

        </div>


        <div class="feature-card">

            <div class="feature-number">
                05
            </div>

            <h3>
                Informasi Lokasi
            </h3>

            <p>
                Pengaduan dapat dilengkapi dengan
                informasi lokasi untuk membantu proses
                penanganan.
            </p>

        </div>


        <div class="feature-card">

            <div class="feature-number">
                06
            </div>

            <h3>
                Transparansi
            </h3>

            <p>
                Masyarakat dapat mengetahui perkembangan
                pengaduan yang telah mereka sampaikan.
            </p>

        </div>

    </div>

</section>



{{-- =========================================================
     VISI & MISI
========================================================= --}}

<section
    class="section section-dark"
    id="visi-misi"
>

    <div class="section-header">

        <div class="section-label">
            Visi & Misi
        </div>

        <h2 class="section-title">
            Membangun pelayanan yang lebih baik
        </h2>

    </div>


    <div class="vision-wrapper">


        <div class="vision-card">

            <h3>
                Visi
            </h3>

            <p>
                Mewujudkan pelayanan pengaduan masyarakat
                yang mudah diakses, transparan, responsif,
                dan mampu mendukung terciptanya pelayanan
                publik yang lebih baik.
            </p>

        </div>


        <div class="vision-card">

            <h3>
                Misi
            </h3>

            <ul>

                <li>
                    Mempermudah masyarakat dalam menyampaikan
                    pengaduan.
                </li>

                <li>
                    Meningkatkan transparansi proses penanganan
                    pengaduan.
                </li>

                <li>
                    Membantu pemerintah mengelola pengaduan
                    secara lebih terstruktur.
                </li>

                <li>
                    Meningkatkan kualitas pelayanan kepada
                    masyarakat.
                </li>

            </ul>

        </div>

    </div>

</section>



{{-- =========================================================
     TENTANG
========================================================= --}}

<section
    class="section section-blue"
    id="tentang"
>

    <div class="about-content">

        <div class="section-label">
            Tentang SIPADULARA
        </div>

        <h2 class="section-title">
            Satu tempat untuk menyampaikan aspirasi
        </h2>

        <p>

            SIPADULARA merupakan sistem pengaduan masyarakat
            yang dirancang untuk membantu masyarakat
            menyampaikan permasalahan yang terjadi di
            lingkungan mereka kepada pemerintah.

            Sistem ini juga membantu admin dalam menerima,
            memproses, menangani, dan memantau pengaduan
            masyarakat secara terstruktur.

        </p>

    </div>

</section>



{{-- =========================================================
     CTA
========================================================= --}}

<section class="cta">

    <h2>
        Siap menyampaikan pengaduan?
    </h2>

    <p>
        Buat akun dan sampaikan pengaduan kamu
        melalui SIPADULARA.
    </p>


    <a
        href="{{ route('masyarakat.register') }}"
        class="cta-button"
    >
        Mulai Sekarang
    </a>

</section>



{{-- =========================================================
     FOOTER
========================================================= --}}

<footer class="footer">

    © {{ date('Y') }} SIPADULARA.
    Sistem Pengaduan Masyarakat.

</footer>



<script>

    /* =====================================================
       HAMBURGER MENU
    ===================================================== */

    const hamburger =
        document.getElementById('hamburger');

    const navMenu =
        document.getElementById('navMenu');


    hamburger.addEventListener(
        'click',
        function () {

            navMenu.classList.toggle('active');

        }
    );


    /* =====================================================
       TUTUP MENU SETELAH KLIK
    ===================================================== */

    document
        .querySelectorAll('.nav-menu a')
        .forEach(function(link) {

            link.addEventListener(
                'click',
                function() {

                    navMenu.classList.remove('active');

                }
            );

        });


    /* =====================================================
       SCROLL ANIMATION
    ===================================================== */

    const observer =
        new IntersectionObserver(
            function(entries) {

                entries.forEach(
                    function(entry) {

                        if (entry.isIntersecting) {

                            entry.target.classList.add('show');

                        }

                    }
                );

            },
            {
                threshold: 0.15
            }
        );


    document
        .querySelectorAll(
            '.feature-card, .vision-card'
        )
        .forEach(
            function(element) {

                observer.observe(element);

            }
        );

</script>


</body>

</html>