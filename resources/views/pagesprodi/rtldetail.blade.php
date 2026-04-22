@extends('master2')

@section('content')
<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
<div class="pb-5">
    <div class="row g-4">
        <div class="col-12 col-xxl-12">

            <div class="mb-6">
                <h2 class="mb-2">RTL Detail Periode </h2>
                <h5 class="fw-semi-bold">Berikut Daftar RTL : Daftar RTL Berisikan Indikator yang memiliki nilai audit kurang dari sama dengan 3 (<=3)</h5>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12 col-xxl-12">


            <div class="card mb-5">
                <div class="card-body">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-sm-auto flex-1">
                            <h3 class="fw-bolder mb-2 line-clamp-1">
                                {{ session()->get('programstudi')->nama_prodi }}
                            </h3>
                            <div class="d-flex align-items-center mb-4">

                                <h5 class="fw-semi-bold"><span class="d-inline-block lh-sm me-1"
                                        data-feather="grid" style="height:16px;width:16px;"></span><span
                                        class="d-inline-block lh-sm">{{ session()->get('programstudi')->getFakultas->nama_fakultas }}</span>
                                </h5>
                            </div>
                            <div class="align-items-center justify-content-between mb-5">
                                <div class="align-items-center">
                                </div>
                                <h3>Daftar Penjaminan Mutu Elemen</h3>
                                <br>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr class="table-primary">
                                                <th class="border-top ps-3">No</th>
                                                <th class="border-top" width="15%">Kode Indikator Temuan</th>
                                                <th class="border-top">Kategori <br>Temuan</th>
                                                <th class="border-top">Kategori <br>Resiko</th>
                                                <th class="border-top">Assessment</th>
                                                <th class="border-top">Target</th>
                                                <th class="border-top">Capaian</th>
                                                <th class="border-top">Nilai Resiko <br>(Probabilty x<br> Severity)</th>
                                                <th class="border-top">Target Selesai</th>
                                                {{-- <th class="border-top">Status</th> --}}
                                                <th class="border-top">Persetujuan <br> Pimpinan</th>
                                                <th class="align-middle pe-0 border-top">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php
                                            $no = 1;
                                            ?>
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
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $indikator->kode}} - {{$indikator->indikator}}</td>
                                                            <td><span class="badge badge-phoenix badge-phoenix-{{ $color }}">{{ @$penilaianindikator->getKategori->kategori }}</span></td>
                                                            <td><span class="badge badge-phoenix badge-phoenix-primary">{{ @$rtl->kategori_risiko }}</span></td>
                                                            <td>
                                                                <span class="badge badge-phoenix badge-phoenix-{{ number_format(@$penilaianindikatorcalc->nilai_prodi,2) <= 3 ? 'danger':'success' }}">Prodi : {{ number_format(@$penilaianindikatorcalc->nilai_prodi,2) }}</span> <br>
                                                                <span class="badge badge-phoenix badge-phoenix-{{ number_format(@$penilaianindikatorcalc->nilai_auditor,2) <= 3 ? 'danger':'success' }}">Auditor : {{ number_format(@$penilaianindikatorcalc->nilai_auditor,2) }}</span></td>
                                                            <td>{{ @$rtl->target }}</td>
                                                            <td>{{ @$rtl->capaian }}</td>
                                                            <td>{{ @$rtl->probability }} x {{ @$rtl->severity }} = {{ @(int)$rtl->probability * @(int)$rtl->severity }}</td>
                                                            <td>{{ @$rtl->selesai }}</td>
                                                            {{-- <td>{{ @$rtl->status }}</td> --}}
                                                            @php
                                                                if(@$rtl->persetujuan == 'Approved') {
                                                                    $colorp = 'success';
                                                                } else if(@$rtl->persetujuan == 'Needs to be Revisited') {
                                                                    $colorp = 'warning';
                                                                } else if(@$rtl->persetujuan == 'Disapproved') {
                                                                    $colorp = 'danger';
                                                                } else if(@$rtl->persetujuan == 'Submission') {
                                                                    $colorp = 'secondary';
                                                                } else {
                                                                    $colorp = 'info';
                                                                }
                                                            @endphp
                                                            <td><span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-{{ $colorp }}">{{ @$rtl->persetujuan }}</span></td>
                                                            <td>
                                                                @if(number_format(@$penilaianindikatorcalc->nilai_auditor,2) <= 3)
                                                                <a href="{{ @$penilaianindikatorcalc->id ? route('rtlaction', ['id' => @$penilaianindikatorcalc->id]) : 'javascript:void(0)' }}" class="btn btn-outline-primary {{ $penilaianindikatorcalc?->id ? '' : 'disabled' }}"">
                                                                    <i class="fa fa-hourglass" aria-hidden="true"></i> Action Plan
                                                                </a>

                                                                @else
                                                                    <span class="badge badge-phoenix badge-phoenix-danger">Tidak RTL</span>
                                                                @endif
                                                                <br><br>

                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xxl-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-sm-auto flex-1">
                            <h3 class="fw-bolder mb-2 line-clamp-1">
                                {{ session()->get('programstudi')->nama_prodi }}
                            </h3>
                            <div class="d-flex align-items-center mb-4">

                                <h5 class="fw-semi-bold"><span class="d-inline-block lh-sm me-1"
                                        data-feather="grid" style="height:16px;width:16px;"></span><span
                                        class="d-inline-block lh-sm">{{ session()->get('programstudi')->getFakultas->nama_fakultas }}</span>
                                </h5>
                            </div>
                            <div class="align-items-center justify-content-between mb-5">
                                <h3>Cetak Rencana Tindak Lanjut</h3>
                                <div class="col-6 col-sm-auto flex-1">
                                    <a href="{{ route('laporan.generate_rtl') }}"  class="btn btn-danger"><i class="fas fa-file-pdf me-1"></i>Cetak RTL PDF</a>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
