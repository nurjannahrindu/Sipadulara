<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cetak Laporan Pengajuan</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            color: #111827;
            background: white;
            font-size: 13px;
        }


        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 22px;
            color: #111827;
        }

        .header h2 {
            margin: 5px 0 0;
            font-size: 16px;
            font-weight: normal;
        }

        .header p {
            margin-top: 8px;
            color: #4b5563;
        }


        .garis {
            border-top: 2px solid #111827;
            margin: 15px 0 20px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #9ca3af;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f3f4f6;
            font-weight: bold;
            text-align: center;
        }


        .no {
            width: 40px;
            text-align: center;
        }

        .tanggal {
            width: 90px;
        }

        .status {
            width: 90px;
        }


        .status-badge {
            display: inline-block;
            padding: 4px 7px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }

        .diajukan {
            background: #fef3c7;
            color: #92400e;
        }

        .diproses {
            background: #dbeafe;
            color: #1e40af;
        }

        .ditangani {
            background: #e0e7ff;
            color: #3730a3;
        }

        .selesai {
            background: #dcfce7;
            color: #166534;
        }

        .ditolak {
            background: #fee2e2;
            color: #991b1b;
        }


        .footer {
            margin-top: 30px;
            text-align: right;
        }


        .tanda-tangan {
            display: inline-block;
            width: 220px;
            text-align: center;
        }

        .tanda-tangan .tempat {
            margin-bottom: 60px;
        }


        .btn-print {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-back {
            position: fixed;
            top: 20px;
            left: 20px;
            background: #6b7280;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 14px;
        }


        @media print {

            body {
                padding: 0;
                font-size: 11px;
            }

            .btn-print,
            .btn-back {
                display: none;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            thead {
                display: table-header-group;
            }

            @page {
                size: A4 landscape;
                margin: 15mm;
            }

        }

    </style>

</head>


<body>




    <button
        onclick="window.print()"
        class="btn-print"
    >
         Cetak
    </button>



    {{-- HEADER LAPORAN --}}

    <div class="header">

        <h1>
            SIPADULARA
        </h1>

        <h2>
            SISTEM PENGADUAN LAYANAN MASYARAKAT
        </h2>

        <p>
            Laporan Pengajuan Masyarakat
        </p>

    </div>


    <div class="garis"></div>


    {{-- TABEL --}}

    <table>

        <thead>

            <tr>

                <th class="no">
                    No
                </th>

                <th>
                    Masyarakat
                </th>

                <th>
                    Kategori
                </th>

                <th>
                    Judul
                </th>

                <th>
                    Lokasi
                </th>

                <th class="tanggal">
                    Tanggal
                </th>

                <th class="status">
                    Status
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse ($pengajuans as $pengajuan)

                <tr>

                    <td class="no">
                        {{ $loop->iteration }}
                    </td>


                    <td>
                        {{ $pengajuan->masyarakat->nama ?? '-' }}
                    </td>


                    <td>
                        {{ $pengajuan->kategori->nama_kategori ?? '-' }}
                    </td>


                    <td>
                        {{ $pengajuan->judul }}
                    </td>


                    <td>
                        {{ $pengajuan->lokasi ?? '-' }}
                    </td>


                    <td>
                        {{ $pengajuan->tanggal ? $pengajuan->tanggal->format('d-m-Y') : '-' }}
                    </td>


                    <td>

                        @if ($pengajuan->status === 'diajukan')

                            <span class="status-badge diajukan">
                                Diajukan
                            </span>

                        @elseif ($pengajuan->status === 'diproses')

                            <span class="status-badge diproses">
                                Diproses
                            </span>

                        @elseif ($pengajuan->status === 'ditangani')

                            <span class="status-badge ditangani">
                                Ditangani
                            </span>

                        @elseif ($pengajuan->status === 'selesai')

                            <span class="status-badge selesai">
                                Selesai
                            </span>

                        @elseif ($pengajuan->status === 'ditolak')

                            <span class="status-badge ditolak">
                                Ditolak
                            </span>

                        @else

                            {{ ucfirst($pengajuan->status) }}

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td
                        colspan="7"
                        style="text-align:center;"
                    >
                        Belum ada data pengajuan.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>



    {{-- JUMLAH DATA --}}

    <p style="margin-top: 15px;">

        <strong>
            Total Pengajuan:
        </strong>

        {{ $pengajuans->count() }}

    </p>



    {{-- TANDA TANGAN --}}

    <div class="footer">

        <div class="tanda-tangan">

            <div class="tempat">
                {{ date('d-m-Y') }}
            </div>

            <strong>
                Admin SIPADULARA
            </strong>

        </div>

    </div>


</body>

</html>