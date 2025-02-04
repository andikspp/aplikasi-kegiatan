<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Peserta</title>
    <style>
        .body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            margin: 30px;
        }

        #judul {
            text-align: center;
            margin-bottom: 10px;
        }

        .biodata-item {
            display: table;
            width: 100%;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .label,
        .value {
            display: table-cell;
            padding-right: 10px;
            font-size: 18px;
        }

        .label {
            width: 250px;
            text-align: left;
        }

        .value {
            text-align: left;
        }

        .signature {
            margin-top: 50px;
            text-align: center;
            float: right;
            margin-right: 40px;
        }

        /* Pemisah halaman */
        .page-break {
            page-break-before: always;
        }

        @media print {
            .page-break {
                page-break-before: always;
            }
        }

        @page {
            size: A4;
            margin: 20mm;
            /* Atur margin sesuai kebutuhan */
        }
    </style>
</head>

<body>

    @foreach ($pesertaList as $peserta)
        <h1 id="judul">BIODATA</h1>

        <h3 id="judul">({{ $peserta->peran }})</h3><br><br><br>

        <div class="biodata-item">
            <p class="label">1. Nama</p>
            <p class="value">: {{ $peserta->nama_lengkap }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">2. NIP/NIK</p>
            <p class="value">: {{ $peserta->nip }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">3. Tempat/tanggal lahir</p>
            <p class="value">: {{ $peserta->tempat_lahir }} /
                {{ \Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d-m-Y') }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">4. Pangkat/Golongan</p>
            <p class="value">: {{ $peserta->pangkat_golongan }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">5. Jabatan</p>
            <p class="value">: {{ $peserta->jabatan }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">6. Pendidikan Terakhir</p>
            <p class="value">: {{ $peserta->pendidikan_terakhir }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">7. Unit Kerja</p>
            <p class="value">: {{ $peserta->unit_kerja }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">8. Alamat Kantor</p>
            <p class="value">: {{ $peserta->alamat_kantor }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">9. Telp Kantor</p>
            <p class="value">: {{ $peserta->telp_kantor }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">10. Alamat Rumah</p>
            <p class="value">: {{ $peserta->alamat_rumah }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">11. Telp Rumah</p>
            <p class="value">: {{ $peserta->telp_rumah }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">12. NPWP</p>
            <p class="value">: {{ $peserta->npwp }}</p>
        </div>

        <div class="biodata-item">
            <p class="label">13. Alamat E-Mail</p>
            <p class="value">: {{ $peserta->alamat_email }}</p>
        </div><br><br><br><br>

        <div class="signature">
            <p>Tanda Tangan</p><br><br><br>
            @if ($peserta->signature)
                <img src="{{ public_path('storage/' . $peserta->signature) }}"
                    style="max-width: 200px; max-height: 150px;">
                <p>{{ $peserta->nama_lengkap }}</p>
            @else
                <p>{{ $peserta->nama_lengkap }}</p>
            @endif
        </div>

        <!-- Page Break -->
        <div class="page-break"></div>
    @endforeach

</body>

</html>
