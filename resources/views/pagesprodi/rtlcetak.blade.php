<head>
    <title>Cetak Laporan RTL</title>
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
        margin-top: 0px;
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
        margin: 10px 50px 80px 50px; /* top right bottom left */
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
        /* border-collapse: separate; */
        /* border-spacing: 5px; */
        margin-top: 20px;
        background-color: #ffffff;
    }

    .penjamu th,
    .penjamu tr,td {
        border: 1px solid black;
        /* padding: 2px; */
        text-align: left;
    }




</style>



{{-- Halaman RTL --}}
<div style="page-break-after: always;">
    <div style="
        width: 100%;
        height: 95%;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: sans-serif;">
        <img src="{{ public_path('templates/assets/img/icons/Undip.png') }}" alt="Logo Undip" style="height: 120px; margin-top: 50px; text-align: center !important;">
        <h1 >Action Plan</h1>
        <h2>Rencana Tindak Lanjut {{ $tahun }}</h2>
        Program Studi {{ $nama_programstudi }}


        <p style="text-align: left;">Pada hari ............. tanggal ........... bulan ................... tahun {{ $tahun }} telah dibuat Rencana Tindak Lanjut (RTL) Universitas Diponegoro Tahun {{ $tahun }} dengan rincian sebagai berikut:</p>


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

        <p style="text-align: left;">Demikian  Berita Acara RTL ini dibuat untuk  dapat dilaksanakan</p>
        <div class="pengesahan">
            <table border="0">
                <tr>
                    <td width="45%"><br>Ketua Program Studi</td>
                    <td></td>
                    <td width="45%">Semarang, ....................... {{ $tahun }} <br> Dekan {{ ucwords(strtolower($fakultas->nama_fakultas)) }}</td>
                </tr>
                <tr>
                    <td><br><br><br><br></td>
                    <td><br><br><br><br></td>
                    <td><br><br><br><br></td>
                </tr>

            </table>
        </div>

    </div>
</div>
<style>
  .wrap-text {
    white-space: normal;   /* biar teks bisa turun ke bawah */
    word-wrap: break-word; /* support lama */
    word-break: break-word;/* support modern */
  }
  .text-danger {
  color: #dc3545; /* Bootstrap danger color */
}

</style>
<div class="penjamu">
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="table-primary">
                <th class="border-top" width="5%">No</th>
                <th class="border-top" width="10%">Indikator Temuan</th>
                <th class="border-top" width="20%">Program Kerja</th>
                <th class="border-top" width="20%">Deskripsi Risiko <br> Pengendalian <br> Akar Masalah</th>
                <th class="border-top">Target <br> Capaian <br>Kategori <br>& Nilai Risiko</th>
                <th class="border-top" width="20%">RTL</th>
                <th class="border-top">Anggaran / <br> Target /  <br> PIC /<br> Persetujuan Pimpinan</th>
            </tr>
        </thead>
        @php
        $no = 1;
        @endphp
        <tbody>
            @foreach ($spmielemens as $elemen)
                @foreach($elemen->getSpmiIndikator as $indikator)
                @php
                    $cek = json_decode($indikator->spmi_tipe_id);
                    if ($strata->nama_strata == "PROFESI") {
                        $strata->nama_strata = "S2";
                    }
                    // var_dump($indikator->id);
                    // die();
                    @endphp

                    @if($indikator->spmi_tipe_id == 'U' || in_array($strata->nama_strata, $cek))
                        @php

                            $penilaianindikatorcalc = \App\Models\Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaianprodi->id)->where('spmi_indikators_id', $indikator->id)->first();
                            $penilaianindikator = \App\Models\Spmipenilaianindikator::where('spmi_penilaianprodis_id', $penilaianprodi->id)->where('spmi_indikators_id', $indikator->id)->first();
                            $rtl = \App\Models\Spmirtl::where('spmi_penilaianindikatorscalc_id', @$penilaianindikatorcalc->id)->first();
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
                            $kategori_id = @optional($penilaianindikator->getKategori)->id;
                            if($kategori_id == 1) {
                                $color = 'primary';
                            } else if($kategori_id == 2){
                                $color = 'info';
                            } else if($kategori_id == 3) {
                                $color = 'warning';
                            } else if($kategori_id == 4) {
                                $color = 'danger';
                            } else if($kategori_id == 5) {
                                $color = 'success';
                            } else {
                                $color = 'secondary';
                            }


                        @endphp
                        @if(@$penilaianindikatorcalc->nilai_auditor <= 3)
                        <tr>
                            <td class="">{{ $no++ }}</td>
                            <td class="wrap-text">{{ @$indikator->indikator }}<span class="text-danger"><br><br>{{ empty($penilaianindikatorcalc) ? 'Tidak Mengisi Indikator' : '' }}</span></td>
                            <td class="wrap-text">{{ @$penilaianindikatorcalc->getrtl->program_kerja }}</td>
                            <td class="wrap-text">
                                <strong> Deskripsi Resiko : </strong> {{ @$penilaianindikatorcalc->getrtl->deskripsi_risiko }} <br><br>
                                <hr>
                                <strong> Pengendalian : </strong> {{ @$penilaianindikatorcalc->getrtl->pengendalian }} <br><br>
                                <hr>
                                <strong> Akar Masalah : </strong> {{ @$penilaianindikatorcalc->getrtl->akar_masalah }} <br>
                            </td>
                            <td class="wrap-text">
                                Target :  {{ @$penilaianindikatorcalc->getrtl->target }} <br><br>

                                Capaian :  {{ @$penilaianindikatorcalc->getrtl->capaian }} <br><br>

                                Kategori Resiko :  {{ @$penilaianindikatorcalc->getrtl->kategori_risiko }} <br><br>

                                Nilai Resiko : {{ @(int)$penilaianindikatorcalc->getrtl->probability * @(int)$spmipenilaianindikatorcalc->getrtl->severity }}<br>

                            </td>
                            <td class="wrap-text">{{ @$penilaianindikatorcalc->getrtl->rtl }}</td>
                            <td class="wrap-text">
                                Anggaran : {{ @$penilaianindikatorcalc->getrtl->anggaran }} <br><br>

                                Target Selesai : {{ @$penilaianindikatorcalc->getrtl->selesai }} <br><br>

                                PIC : {{ @$penilaianindikatorcalc->getrtl->pic }} <br><br>

                                {{-- Bukti : {{ @$spmipenilaianindikatorcalc->getrtl->bukti }} <br><br> --}}

                                Persetujuan : {{ @$penilaianindikatorcalc->getrtl->persetujuan }}<br>
                            </td>
                        </tr>
                        @endif
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>





