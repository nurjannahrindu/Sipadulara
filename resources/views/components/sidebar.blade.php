@props(['role'])

<aside
    id="{{ $role }}Sidebar"
    class="sidebar {{ $role === 'admin' ? 'sidebar-admin' : 'sidebar-masyarakat' }}"
>

    {{-- =====================================================
         BRAND
    ====================================================== --}}

    <div class="brand">

        <div class="brand-logo">

            {{-- LOGO SIPADULARA --}}
            <div class="brand-icon">
                <svg
                    viewBox="0 0 64 64"
                    width="30"
                    height="30"
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

            <div class="brand-text">

                <div class="brand-title">
                    SIPADULARA
                </div>

                <div class="brand-subtitle">
                    Sistem Pengaduan Masyarakat
                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
         MENU ADMIN
    ====================================================== --}}

    @if ($role === 'admin')

        <div class="nav-section">
            MENU UTAMA
        </div>

        <nav class="sidebar-menu">

            {{-- DASHBOARD --}}
            <a
                href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
            >
                <span class="nav-icon">

                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                    </svg>

                </span>

                <span>Dashboard</span>
            </a>


            {{-- DATA PENGADUAN --}}
            <a
                href="{{ route('admin.pengajuan.index') }}"
                class="{{ request()->routeIs('admin.pengajuan.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">

                    <svg viewBox="0 0 24 24">
                        <path d="M4 5h16v14H4z"/>
                        <path d="M4 8h16"/>
                        <path d="M8 4v4"/>
                    </svg>

                </span>

                <span>Data Pengaduan</span>
            </a>


            {{-- LAPORAN --}}
            <a
                href="{{ route('admin.laporan.index') }}"
                class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">

                    <svg viewBox="0 0 24 24">
                        <path d="M4 19V5"/>
                        <path d="M4 19h17"/>
                        <path d="M7 15l4-4 3 2 5-6"/>
                    </svg>

                </span>

                <span>Laporan</span>
            </a>


            {{-- KATEGORI --}}
            <a
                href="{{ route('admin.kategori.index') }}"
                class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}"
            >
                <span class="nav-icon">

                    <svg viewBox="0 0 24 24">
                        <path d="M20 13L11 22H4v-7l9-9 7 7Z"/>
                        <circle cx="8" cy="16" r="1.5"/>
                    </svg>

                </span>

                <span>Kategori</span>
            </a>

        </nav>


        {{-- =================================================
             AKUN ADMIN
        ================================================== --}}

        <div class="sidebar-account">

            <hr>

            <div class="nav-section">
                AKUN
            </div>

            <form
                action="{{ route('admin.logout') }}"
                method="POST"
                class="logout-form"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-btn"
                >

                    <span class="nav-icon">

                        <svg viewBox="0 0 24 24">
                            <path d="M10 5H5v14h5"/>
                            <path d="M14 8l4 4-4 4"/>
                            <path d="M9 12h9"/>
                        </svg>

                    </span>

                    <span>Logout</span>

                </button>

            </form>

        </div>


    {{-- =====================================================
        MENU MASYARAKAT
    ====================================================== --}}

    @elseif ($role === 'masyarakat')

        <div class="nav-section">
            MENU UTAMA
        </div>

        <nav class="sidebar-menu">

            {{-- DASHBOARD --}}
            <a
                href="{{ route('masyarakat.dashboard') }}"
                class="{{ request()->routeIs('masyarakat.dashboard') ? 'active' : '' }}"
            >

                <span class="nav-icon">

                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                    </svg>

                </span>

                <span>Dashboard</span>

            </a>


            {{-- PENGAJUAN --}}
            <a
                href="{{ route('masyarakat.pengajuan.index') }}"
                class="{{ request()->routeIs('masyarakat.pengajuan.*') ? 'active' : '' }}"
            >

                <span class="nav-icon">

                    <svg viewBox="0 0 24 24">
                        <path d="M4 5h16v14H4z"/>
                        <path d="M4 8h16"/>
                        <path d="M8 4v4"/>
                    </svg>

                </span>

                <span>Pengajuan Saya</span>

            </a>

        </nav>


        {{-- =================================================
            AKUN MASYARAKAT
        ================================================== --}}

        <div class="sidebar-account">

            <hr>

            <div class="nav-section">
                AKUN
            </div>

            {{-- LOGOUT SELALU DI BAGIAN PALING BAWAH --}}
            <form
                action="{{ route('masyarakat.logout') }}"
                method="POST"
                class="logout-form"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-btn"
                >

                    <span class="nav-icon">

                        <svg viewBox="0 0 24 24">
                            <path d="M10 5H5v14h5"/>
                            <path d="M14 8l4 4-4 4"/>
                            <path d="M9 12h9"/>
                        </svg>

                    </span>

                    <span>Logout</span>

                </button>

            </form>

        </div>

    @endif

</aside>