<head>
    <title>Cetak Laporan AMI</title>
    <link rel="icon" type="image/png" href="{{ asset('templates/assets/img/favicons/favicon new.ico') }}">
</head>
<style>

    .box {
        font-family: sans-serif;
        font-size: 12px;
        text-align: center;
        margin-bottom: 20px;
    }

    .box img {
        height: 100px;
    }

    .section {
        margin-top: 30px;
    }

    /* ===================== */
    /* HEADER TABLE STYLE    */
    /* ===================== */
    .header table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        background-color: #fff;
    }

    .header tr {
        border: 1px solid #000;
        padding: 6px;
        text-align: center;
    }

    /* ===================== */
    /* PENGESAHAN TABLE STYLE */
    /* ===================== */
    .pengesahan table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 5px;
        margin-top: 10px;
        background-color: #fff;
    }

    .pengesahan th,
    .pengesahan td {
        border: 1px dashed #555;
        padding: 8px;
        text-align: left;
    }

    /* ===================== */
    /* PRODI TABLE STYLE */
    /* ===================== */
    .prodi table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 5px;
        background-color: #fff;
    }

    .prodi th,
    .prodi td {
        border: 0px;
        text-align: left;
    }

    @page {
        margin: 70px 50px 80px 50px; /* top right bottom left */
    }
    .pdf-footer {
        position: fixed;
        bottom: -50px;
        left: 0;
        right: 0;
        height: 40px;
    }
    .datetime {
        position: absolute;
        bottom: -10px;
        right: 20px;
        font-size: 11px;
        font-family: sans-serif;
        color: #333;
    }
    /* ===================== */
    /* PENJAMU TABLE STYLE */
    /* ===================== */
    .penjamu table {
        width: 100%;
        border-collapse: separate;
        /* border-spacing: 5px; */
        margin-top: 10px;
        background-color: #ffffff;
    }

    .penjamu th,
    .penjamu tr,td {
        border: 1px solid black;
        /* padding: 2px; */
        text-align: left;
    }




</style>

{{-- Halaman Cover --}}
<div style="page-break-after: always;">
    <div style="
        padding: 8px;
        background-color: #002B5B;  /* biru gelap */
        color: white;
        width: 100%;
        height: 95%;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: sans-serif;">
        <h1>Universitas Diponegoro</h1>

        <img src="{{ public_path('templates/assets/img/icons/Undip.png') }}" alt="Logo Undip" style="height: 120px; margin-top: 50px;">
        <br><br><br>
        <h2>Borang Audit Mutu Internal {{ $tahun }}</h2>
        Program Studi {{ $nama_programstudi }}
        <br><br>
        <p>{{ now()->format('d F Y') }}</p>

        <img src="{{ public_path('templates/assets/img/icons/logo new.png') }}" alt="Logo Gapuro" style="height: 120px; margin-top: 50px;">
    </div>
</div>
<div class="pdf-footer">
    <div class="datetime">
        <strong>Dicetak: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</strong>
    </div>
</div>

{{-- Halaman Berita Acara --}}
<div style="page-break-after: always;">
    <div style="
        padding: 8px;
        width: 100%;
        height: 95%;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: sans-serif;">
        <img src="{{ public_path('templates/assets/img/icons/Undip.png') }}" alt="Logo Undip" style="height: 120px; margin-top: 50px; text-align: center !important;">
        <h1 >Berita Acara</h1>
        <h2 >AUDIT MUTU INTERNAL TAHUN {{ $tahun }}</h2>
        <h2 >PROGRAM STUDI DI UNIVERSITAS DIPONEGORO</h2>


        <p style="text-align: left;">Pada hari ............. tanggal ........... bulan ................... tahun {{ $tahun }} telah dilaksanakan Kegiatan Assesment Lapangan Audit Mutu Internal (AMI) Universitas Diponegoro Tahun {{ $tahun }} dengan rincian sebagai berikut:</p>

        <br>
        <div class="prodi">
            <table border="0">
                <tr>
                    <td width="40%">Program Studi</td>
                    <td width="5%"> : </td>
                    <td>{{ $nama_programstudi }}</td>
                </tr>
                <tr>
                    <td>Fakultas / Sekolah</td>
                    <td> : </td>
                    <td>{{ $fakultas->nama_fakultas }}</td>
                </tr>
            </table>
        </div>
        <p style="text-align: left;">Dari kegiatan assesment lapangan diperoleh informasi dan hasil isian Borang Audit berdasarkan kondisi lapangan yang ada di Program Studi terkait. Adapun  hasil  pelaksanaan  Audit  Mutu  Internal  (AMI) Program Kerja Prodi terlampir  pada kertas kerja pemeriksaan.</p>
        <p style="text-align: left;">Demikian  Berita Acara ini dibuat untuk  dapat dilaksanakan</p>
        <div class="pengesahan">
            <table border="0">
                <tr>
                    <td width="45%"><br>Ketua Program Studi</td>
                    <td></td>
                    <td width="45%">Semarang, ....................... {{ $tahun }} <br> Auditor</td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td><br><br><br><br></td>
                    <td><br><br><br><br></td>
                </tr>
                <tr>
                    <td> <br>NIP</td>
                    <td> </td>
                    <td>{{ $auditor }}<br>NIP</td>
                </tr>
            </table>
        </div>

    </div>
</div>




{{-- Page break --}}
{{-- <div style="page-break-after: always;"></div> --}}


{{-- Halaman Hasil --}}
{{-- <div style="page-break-after: always;"></div> --}}

@php
$jumlahhasilprodi = 0; // Inisialisasi total hasil prodi
$jumlahhasilauditor = 0; // Inisialisasi total hasil auditor
$no = 1;
@endphp

@foreach ($elemens as $elemen)
    @if (!str_contains($elemen->kode, 'A') && !str_contains($elemen->kode, 'D.'))
        <div style="page-break-after: always;">
    @endif
        <h3>{{ $elemen->kriteria }}</h3>
        @php
            $no = 1;
        @endphp
        @if (str_contains($elemen->kode, 'C.'))

        @php
        $i = str_replace('C.','',$elemen->kode);
        $chart = ${"chart_image$i"};

        @endphp
        <img src="{{ $chart }}" style="width: 50%; max-height: 400px;">

        @endif
        <div class="box penjamu">
        <table class="table table-striped table-hover">
            <thead>
                <tr class="table-primary">
                    <th class="border-top ps-3">No</th>
                    <th class="border-top">Kode</th>
                    <th class="border-top" width="20%">Indikator</th>
                    <th class="border-top">Self Assessment</th>
                    <th class="border-top">Audit</th>
                    <th class="border-top">Bobot</th>
                    <th class="border-top">Hasil <br>[Prodi]</th>
                    <th class="border-top">Hasil <br>[Auditor]</th>
                </tr>
            </thead>
            <tbody>



            {{-- @php $chart = ${"chart_image$i"}; @endphp
            <img src="{{ $chart }}" style="width: 50%; max-height: 400px;"> --}}
            @foreach($elemen->getSpmiIndikator as $indikator)

            @php
            $cek = json_decode($indikator->spmi_tipe_id);
            if ($strata->nama_strata == "PROFESI") {
                $strata->nama_strata = "S2";
            }
            @endphp

            @if($indikator->spmi_tipe_id == 'U' || in_array($strata->nama_strata, $cek))


            @php
            $penilaianindikatorcalc = \App\Models\Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaian_prodi->id)->where('spmi_indikators_id', $indikator->id)->first();
            // var_dump($penilaianindikatorcalc->nilai_prodi);
            $nilaiProdi = $penilaianindikatorcalc->nilai_prodi ?? 0;
            $nilaiAuditor = $penilaianindikatorcalc->nilai_auditor ?? 0;
            if($strata->nama_strata == 'S1') {
            $bobot = $indikator->getSpmibobot->first()->bobots1 ?? 0;
            } else if($strata->nama_strata == 'D4') {
            $bobot = $indikator->getSpmibobot->first()->bobotd4 ?? 0;
            } else if($strata->nama_strata == 'S2' || $strata->nama_strata == 'PROFESI') {
            $bobot = $indikator->getSpmibobot->first()->bobots2 ?? 0;
            } else if($strata->nama_strata == 'S3') {
            $bobot = $indikator->getSpmibobot->first()->bobots3 ?? 0;
            } else {
            $bobot = 0;
            }

            if (is_numeric($nilaiProdi)) {
            $jumlahhasilprodi += $bobot * $nilaiProdi;
            $jumlahhasilauditor += $bobot * $nilaiAuditor;
            }
            // $elemen = \App\Models\Spmielemen::where('kode', "C.$i")->first();
            @endphp
            <tr>
                <td class="align-middle ps-3">{{ $no++ }}</td>

                {{-- Kode dari indikator sub --}}
                <td class="align-middle">{{$indikator->kode}}</td>

                {{-- Indikator --}}
                <td class="align-middle">
                    {{ $indikator->indikator ?? '-' }}
                    @if(!empty($indikator->keterangan))
                    <a class="btn btn-xss" tabindex="0" role="button" data-bs-toggle="popover"
                        data-bs-trigger="focus" title="Keterangan"
                        data-bs-content="{{ $indikator->keterangan }}">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </a>
                    @endif
                </td>

                {{-- Self Assessment --}}
                <td class="align-middle">{{ $nilaiProdi >= 0 ? number_format($nilaiProdi, 2) : '-' }}
                </td>

                {{-- Audit --}}
                <td class="align-middle">{{ $nilaiAuditor >= 0 ? number_format($nilaiAuditor, 2) : '-' }}</td>

                {{-- Bobot --}}
                <td class="align-middle">{{ $bobot }}</td>

                {{-- Hasil Prodi --}}
                <td class="align-middle">
                    {{ is_numeric($nilaiProdi) ? number_format($bobot * $nilaiProdi, 2) : '-' }}

                </td>

                {{-- Hasil Auditor --}}
                <td class="align-middle">
                    {{ is_numeric($nilaiAuditor) ? number_format($bobot * $nilaiAuditor, 2) : '-' }}

                </td>
            </tr>

            @php

                // $jumlahhasilprodi += $bobot * $nilaiProdi;
                // $jumlahhasilauditor += $bobot * $nilaiAuditor;
            @endphp
            @endif
            @endforeach
            </tbody>
        </table>
        </div>
    @if (!str_contains($elemen->kode, 'A') && !str_contains($elemen->kode, 'D.'))
    </div>

        {{-- <div style="page-break-after: always;"></div> --}}
    @endif
@endforeach
</br></br>
<div class="box penjamu">
<table class="table table-striped table-hover">
    <thead>
        <tr class="table-primary">
            <th class="border-top ps-3" width="5%">No</th>
            <th class="border-top ps-3">Penilaian</th>
            <th class="border-top ps-3" width="10%">Total Skor</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="border-top ps-3">1</td>
            <td class="border-top ps-3">Nilai Prodi</td>
            <td class="border-top ps-3">{{ number_format($jumlahhasilprodi,2) }}</td>
        </tr>
        <tr>
            <td class="border-top ps-3">2</td>
            <td class="border-top ps-3">Nilai Auditor</td>
            <td class="border-top ps-3">{{ number_format($jumlahhasilauditor,2) }}</td>
        </tr>
    </tbody>
</table>
</div>


{{-- <div style="page-break-before: always;"></div> --}}

{{-- <div style="page-break-after: always;"></div> --}}

{{-- Halaman Penutupan --}}
{{-- <div style="page-break-before: always;">awawawaw</div> --}}
<div style="page-break-before: always;">
<div style="
    padding: 8px;
    background-color: #002B5B;  /* biru gelap */
    color: white;
    width: 100%;
    height: 95%;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-family: sans-serif;">
    <h1>Terima Kasih</h1>
    <p>Laporan ini disusun dengan Sistem Penjaminan Mutu <br>Lembaga Pengembangan dan Penjaminan Mutu Pendidikan<br>Universitas Diponegoro</p>
    <p>{{ now()->format('d F Y') }}</p>
    <img src="{{ public_path('templates/assets/img/icons/Undip.png') }}" style="height: 120px; margin-top: 50px;">
</div>
</div>
