@extends('master2')

@section('content')
<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('click', function(e) {
        // VALIDASI SATUAN
        if (e.target.classList.contains('btn-confirm-validasi')) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan divalidasi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, validasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // BATAL VALIDASI SATUAN
        if (e.target.classList.contains('btn-confirm-batal')) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin batal validasi?',
                text: "Data akan dibatalkan dari status validasi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // VALIDASI SEMUA
        if (e.target.classList.contains('btn-validasi-semua')) {
            e.preventDefault();
            Swal.fire({
                title: 'Validasi seluruh penilaian?',
                text: "Semua indikator akan divalidasi sekaligus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, validasi semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // BATAL VALIDASI SEMUA
        if (e.target.classList.contains('btn-batal-validasi-semua')) {
            e.preventDefault();
            Swal.fire({
                title: 'Batalkan seluruh validasi?',
                text: "Semua validasi indikator akan dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, batalkan semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // KALKULASI PRODI
        if (e.target.classList.contains('btn-kalkulasi-prodi')) {
            e.preventDefault();
            Swal.fire({
                title: 'Lakukan kalkulasi nilai prodi?',
                text: "Nilai akan dikalkulasi dan disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, kalkulasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // KUNCI NILAI PRODI
        if (e.target.classList.contains('btn-kuncinilai-prodi')) {
            e.preventDefault();
            Swal.fire({
                title: 'Lakukan kunci nilai prodi?',
                text: "Nilai akan dikunci dan disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, kunci nilai!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // PROSES AL
        if (e.target.classList.contains('btn-prosesal-prodi')) {
            e.preventDefault();
            Swal.fire({
                title: 'Lakukan Proses AL?',
                text: "Nilai akan dikunci dan disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Proses AL!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // BUKA KUNCI NILAI PRODI
        if (e.target.classList.contains('btn-bukakuncinilai-prodi')) {
            e.preventDefault();
            Swal.fire({
                title: 'Lakukan buka kunci nilai prodi?',
                text: "Kunci akan dibuka dan disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, buka kunci nilai!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // KALKULASI AUDITOR
        if (e.target.classList.contains('btn-kalkulasi-auditor')) {
            e.preventDefault();
            Swal.fire({
                title: 'Lakukan kalkulasi nilai auditor?',
                text: "Nilai auditor akan dihitung dan disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, kalkulasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }
    });
</script>


<div class="pb-5">
    <div class="row g-4">
        <div class="text-start mt-3">
            <a href="{{ session('penjamuelemen') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="col-12 col-xxl-6">

            <div class="mb-8">
                <h2 class="mb-2">Data Indikator Hasil</h2>
                <h5 class="text-700 fw-semi-bold">Berikut Data Indikator Hasil</h5>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12 col-xxl-12">

            <div class="row g-3">

                <div class="col-12 col-md-12">
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
                                    <div class="d-md-flex d-xl-block align-items-center justify-content-between mb-5">
                                        <div class="d-flex align-items-center mb-3 mb-md-0 mb-xl-3">
                                        </div>

                                        <br>

                                        @php $no = 1; @endphp

                                        {{-- Loop data --}}
                                        @foreach($penilaianindikatorcalc as $item)
                                        @php
                                        $indikator = $spmiindikators->where('id', $item->spmi_indikators_id)->first();
                                        $nilaiProdi = $item->nilai_prodi;
                                        $nilaiAuditor = $item->nilai_auditor;
                                        $bobot = $indikator->bobot ?? 0;
                                        @endphp
                                        @endforeach

                                        {{-- Start Button untuk Wakil Dekan 1 --}}
                                        @foreach ($userroles as $userrole)
                                        @if($userrole->roles_id == 13)
                                        @if($penilaianindikatorcalc->isNotEmpty() && $penilaianProdi->status == 3)
                                        <form action="{{ route('validasisemuawadek') }}" method="POST">
                                            @csrf
                                            @foreach($penilaianindikatorcalc as $item)
                                            <input type="hidden" name="spmi_indikators_id[]" value="{{ $item->spmi_indikators_id }}">
                                            @endforeach

                                            {{-- spmi_penilaianprodis_id sama untuk semua item, ambil dari item pertama --}}
                                            @php
                                            $spmi_penilaianprodis_id = $penilaianindikatorcalc->first()->spmi_penilaianprodis_id ?? '';
                                            @endphp

                                            <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $spmi_penilaianprodis_id }}">
                                            <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                            <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">

                                            <button type="button" class="btn btn-outline-success btn-validasi-semua">Validasi Seluruh Penilaian</button>
                                        </form>
                                        @endif

                                        @if($penilaianindikatorcalc->isNotEmpty() && $penilaianProdi->status == 4)
                                        <form action="{{ route('validasisemuabatalwadek') }}" method="POST">
                                            @csrf
                                            @foreach($penilaianindikatorcalc as $item)
                                            <input type="hidden" name="spmi_indikators_id[]" value="{{ $item->spmi_indikators_id }}">
                                            @endforeach

                                            {{-- spmi_penilaianprodis_id sama untuk semua item, ambil dari item pertama --}}
                                            @php
                                            $spmi_penilaianprodis_id = $penilaianindikatorcalc->first()->spmi_penilaianprodis_id ?? '';
                                            @endphp

                                            <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $spmi_penilaianprodis_id }}">
                                            <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                            <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">

                                            <button type="button" class="btn btn-outline-danger btn-batal-validasi-semua">Batal Validasi Seluruh Penilaian</button>
                                        </form>
                                        @endif
                                        @endif
                                        @endforeach
                                        {{-- End Button untuk Wakil Dekan 1 --}}

                                        {{-- Start Button untuk Dekan --}}
                                        @foreach ($userroles as $userrole)
                                        @if($userrole->roles_id == 7) {{-- Dekan --}}
                                        @if($penilaianindikatorcalc->isNotEmpty() && $penilaianProdi->status == 4)
                                        <form action="{{ route('validasisemuadekan') }}" method="POST">
                                            @csrf
                                            @foreach($penilaianindikatorcalc as $item)
                                            <input type="hidden" name="spmi_indikators_id[]" value="{{ $item->spmi_indikators_id }}">
                                            @endforeach

                                            {{-- spmi_penilaianprodis_id sama untuk semua item, ambil dari item pertama --}}
                                            @php
                                            $spmi_penilaianprodis_id = $penilaianindikatorcalc->first()->spmi_penilaianprodis_id ?? '';
                                            @endphp

                                            <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $spmi_penilaianprodis_id }}">
                                            <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                            <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">

                                            <button type="button" class="btn btn-outline-success btn-validasi-semua">Validasi Seluruh Penilaian</button>
                                        </form>
                                        @endif

                                        @if($penilaianindikatorcalc->isNotEmpty() && $penilaianProdi->status == 5)
                                        <form action="{{ route('validasisemuabataldekan') }}" method="POST">
                                            @csrf
                                            @foreach($penilaianindikatorcalc as $item)
                                            <input type="hidden" name="spmi_indikators_id[]" value="{{ $item->spmi_indikators_id }}">
                                            @endforeach

                                            {{-- spmi_penilaianprodis_id sama untuk semua item, ambil dari item pertama --}}
                                            @php
                                            $spmi_penilaianprodis_id = $penilaianindikatorcalc->first()->spmi_penilaianprodis_id ?? '';
                                            @endphp

                                            <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $spmi_penilaianprodis_id }}">
                                            <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                            <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">

                                            <button type="button" class="btn btn-outline-danger btn-batal-validasi-semua">Batal Validasi Seluruh Penilaian</button>
                                        </form>
                                        @endif
                                        @endif
                                        @endforeach
                                        {{-- End Button untuk Dekan --}}


                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover">
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
                                                        <th class="border-top">Status</th>
                                                        <th class="align-middle pe-0 border-top">Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $no = 1;
                                                    $jumlahhasilprodi = 0; // Inisialisasi total hasil prodi
                                                    $jumlahhasilauditor = 0; // Inisialisasi total hasil auditor
                                                    @endphp
                                                    @foreach($penilaianindikatorcalc as $item)

                                                    @php
                                                    $indikator = $spmiindikators->where('id', $item->spmi_indikators_id)->first();
                                                    $nilaiProdi = $item->nilai_prodi ?? 0;
                                                    $nilaiAuditor = $item->nilai_auditor ?? 0;
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

                                                        <td class="align-middle" style="width:1%; white-space: nowrap;">
                                                            @php
                                                            switch ($item->status ?? 0) {
                                                            case 1:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-info">TELAH DIISI OLEH PRODI</span>';
                                                            break;
                                                            case 2:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">TELAH DIKALKULASI OLEH PRODI</span>';
                                                            break;
                                                            case 3:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKUNCI NILAI OLEH PRODI</span>';
                                                            break;
                                                            case 4:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-success">TELAH DIVALIDASI OLEH WADEK 1</span>';
                                                            break;
                                                            case 5:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-info">TELAH DIVALIDASI OLEH DEKAN</span>';
                                                            break;
                                                            case 6:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">PROSES AUDIT</span>';
                                                            break;
                                                            case 7:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIISI OLEH AUDITOR</span>';
                                                            break;
                                                            case 8:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKALKULASI OLEH AUDITOR</span>';
                                                            break;
                                                            case 9:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKUNCI NILAI OLEH AUDITOR</span>';
                                                            break;
                                                            case 10:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">PROSES AL</span>';
                                                            break;
                                                            default:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-danger">BELUM DIISI</span>';
                                                            break;

                                                            }
                                                            @endphp

                                                            {!! $status !!}
                                                        </td>


                                                        <td class="align-middle" style="width:1%; white-space: nowrap;">
                                                            <a href="{{ route('penjamuindikatordetail', ['id' => $indikator->id ?? 0]) }}"
                                                                class="btn btn-outline-primary" target="_blank">
                                                                Lihat Detail
                                                            </a>

                                                            <br> </br>
                                                            @foreach ($userroles as $userrole)
                                                            {{-- Start Button untuk Wakil Dekan 1 --}}
                                                            @if($userrole->roles_id == 13)
                                                            @if($item->status == 3)
                                                            <form action="{{ route('validasisatuanwadek') }}" method="POST" class="form-validasi" style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                <input type="hidden" name="spmi_indikators_id" value="{{ $item->spmi_indikators_id }}">
                                                                <input type="hidden" name="status" value="{{ $item->status }}">

                                                                <button type="button" class="btn btn-outline-success btn-confirm-validasi">
                                                                    Validasi
                                                                </button>
                                                            </form>

                                                            @endif
                                                            @if($item->status == 4)
                                                            <form action="{{ route('validasisatuanbatalwadek') }}" method="POST" class="form-batal-validasi" style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                <input type="hidden" name="spmi_indikators_id" value="{{ $item->spmi_indikators_id }}">
                                                                <input type="hidden" name="status" value="{{ $item->status }}">

                                                                <button type="button" class="btn btn-outline-danger btn-confirm-batal">
                                                                    Batal Validasi
                                                                </button>
                                                            </form>
                                                            @endif
                                                            @endif
                                                            {{-- End Button untuk Wakil Dekan 1 --}}

                                                            {{-- Start Button untuk Dekan --}}
                                                            @if($userrole->roles_id == 7)
                                                            @if($item->status == 4)
                                                            <form action="{{ route('validasisatuandekan') }}" method="POST" class="form-validasi" style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                <input type="hidden" name="spmi_indikators_id" value="{{ $item->spmi_indikators_id }}">
                                                                <input type="hidden" name="status" value="{{ $item->status }}">

                                                                <button type="button" class="btn btn-outline-success btn-confirm-validasi">
                                                                    Validasi
                                                                </button>
                                                            </form>

                                                            @endif
                                                            @if($item->status == 5)
                                                            <form action="{{ route('validasisatuanbataldekan') }}" method="POST" class="form-batal-validasi" style="display:inline;">
                                                                @csrf
                                                                <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                <input type="hidden" name="spmi_indikators_id" value="{{ $item->spmi_indikators_id }}">
                                                                <input type="hidden" name="status" value="{{ $item->status }}">

                                                                <button type="button" class="btn btn-outline-danger btn-confirm-batal">
                                                                    Batal Validasi
                                                                </button>
                                                            </form>
                                                            @endif
                                                            @endif
                                                            {{-- End Button untuk Dekan --}}


                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                    @if($penilaianindikatorcalc->isNotEmpty())
                                                    <tr class="fw-bold">
                                                        <td colspan="6" class="text-end">Total:</td>
                                                        <td>{{ number_format($jumlahhasilprodi, 2)}}</td>
                                                        <td>{{ number_format($jumlahhasilauditor, 2)}}</td>
                                                        <td class="align-middle" style="width:1%; white-space: nowrap;">
                                                            @php
                                                            switch ($penilaianProdi->status ?? 0) {
                                                            case 1:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-info">TELAH DIISI OLEH PRODI</span>';
                                                            break;
                                                            case 2:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">TELAH DIKALKULASI OLEH PRODI</span>';
                                                            break;
                                                            case 3:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKUNCI NILAI OLEH PRODI</span>';
                                                            break;
                                                            case 4:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-success">TELAH DIVALIDASI OLEH WADEK 1</span>';
                                                            break;
                                                            case 5:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-info">TELAH DIVALIDASI OLEH DEKAN</span>';
                                                            break;
                                                            case 6:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">PROSES AUDIT</span>';
                                                            break;
                                                            case 7:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIISI OLEH AUDITOR</span>';
                                                            break;
                                                            case 8:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKALKULASI OLEH AUDITOR</span>';
                                                            break;
                                                            case 9:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKUNCI NILAI OLEH AUDITOR</span>';
                                                            break;
                                                            case 10:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">PROSES AL</span>';
                                                            break;
                                                            default:
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">BELUM DIISI</span>';
                                                            break;
                                                            }
                                                            @endphp

                                                            {!! $status !!}
                                                        </td>
                                                        <td class="align-middle" style="width:1%; white-space: nowrap;">
                                                            @foreach ($userroles as $userrole)
                                                            {{-- PRODI START --}}
                                                            @if($userrole->roles_id == 9 && ($penilaianProdi->status == 1 || $penilaianProdi->status == 2))
                                                            <form action="{{ route('kalkulasiprodi') }}" method="POST" class="form-kalkulasiprodi" style="display:inline;">
                                                                @csrf

                                                                <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                <input type="hidden" name="jumlahhasilprodi" value="{{ $jumlahhasilprodi }}">
                                                                <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">
                                                                <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                                                @if ($penilaianProdi->status == 1)
                                                                <button type="submit" class="btn btn-outline-success btn-kalkulasi-prodi">Kalkulasi</button>
                                                                @elseif ($penilaianProdi->status == 2)
                                                                <button type="submit" class="btn btn-outline-success btn-kalkulasi-prodi">Kalkulasi Ulang</button>
                                                                @endif
                                                            </form>
                                                            @endif

                                                            @if($userrole->roles_id == 9 && ($penilaianProdi->status == 2)) {{-- KUNCI NILAI --}}
                                                            <form action="{{ route('kuncinilaiprodi') }}" method="POST" class="form-kuncinilaiprodi mt-3 text-center">
                                                                @csrf
                                                                <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">
                                                                <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                                                @if ($penilaianProdi->status == 2)
                                                                <button type="submit" class="btn btn-outline-info btn-kuncinilai-prodi">Kunci Nilai</button>
                                                                @endif
                                                            </form>
                                                            @endif
                                                            @php
                                                            $spmi_periode = \App\Models\Spmiperiode::where('id',@$penilaianProdi->spmi_periodes_id)->first();
                                                            $now = date('Y-m-d');
                                                            $date = @$spmi_periode->tanggal_selesai;

                                                            if(strtotime($now) <= strtotime($date)) {
                                                                $isvalid=1;
                                                                } else {
                                                                $isvalid=0;
                                                                }
                                                                @endphp
                                                                @if($userrole->roles_id == 9 && ($penilaianProdi->status == 3) && $isvalid) {{-- BUKA KUNCI NILAI --}}

                                                                <form action="{{ route('bukakuncinilaiprodi') }}" method="POST" class="form-bukakuncinilaiprodi" style="display:inline;">
                                                                    @csrf
                                                                    <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                    <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">
                                                                    <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                                                    @if ($penilaianProdi->status == 3)
                                                                    <button type="submit" class="btn btn-outline-info btn-bukakuncinilai-prodi">Buka Kunci Nilai</button>
                                                                    @endif
                                                                </form>
                                                                @elseif ($userrole->roles_id == 9 && ($penilaianProdi->status == 3) && !$isvalid)
                                                                <button class="btn btn-danger" readonly>Buka Kunci Diluar <br> Periode Pengisian</button>
                                                                @endif
                                                                {{-- PRODI END --}}

                                                                {{-- AUDITOR START --}}
                                                                @if($userrole->roles_id == 12 && ($penilaianProdi->status == 7 || $penilaianProdi->status == 8 || $penilaianProdi->status == 10))
                                                                <form action="{{ route('kalkulasiauditor') }}" method="POST" class="form-kalkulasiauditor" style="display:inline;">
                                                                    @csrf
                                                                    <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                    <input type="hidden" name="jumlahhasilauditor" value="{{ $jumlahhasilauditor }}">
                                                                    <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">
                                                                    <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">

                                                                    @if ($penilaianProdi->status == 7)
                                                                    <button type="submit" class="btn btn-outline-success btn-kalkulasi-auditor">
                                                                        Kalkulasi
                                                                    </button>
                                                                    @elseif ($penilaianProdi->status == 8 || $penilaianProdi->status == 10)
                                                                    <button type="submit" class="btn btn-outline-success btn-kalkulasi-auditor">
                                                                        Kalkulasi Ulang
                                                                    </button>
                                                                    @endif
                                                                </form>
                                                                @endif
                                                                {{-- PROSES AL --}}
                                                                {{-- @if($userrole->roles_id == 12 && ($penilaianProdi->status == 8))
                                                            <form action="{{ route('prosesalauditor') }}" method="POST" class="form-kuncinilaiprodi mt-3 text-center">
                                                                @csrf
                                                                <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">
                                                                <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                                                @if ($penilaianProdi->status == 8)
                                                                <button type="submit" class="btn btn-outline-primary btn-prosesal-prodi"><i class="fa fa-key"></i> Proses AL</button>
                                                                @endif
                                                                </form>
                                                                @endif --}}
                                                                {{-- KUNCI NILAI --}}
                                                                @if($userrole->roles_id == 12 && ($penilaianProdi->status == 8))
                                                                <form action="{{ route('kuncinilaiauditor') }}" method="POST" class="form-kuncinilaiprodi mt-3 text-center">
                                                                    @csrf
                                                                    <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                    <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">
                                                                    <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                                                    @if ($penilaianProdi->status == 8)
                                                                    <button type="submit" class="btn btn-outline-info btn-kuncinilai-prodi"><i class="fa fa-lock"></i> Kunci Nilai</button>
                                                                    @endif
                                                                </form>
                                                                @endif

                                                                @if($userrole->roles_id == 12 && ($penilaianProdi->status == 9)) {{-- BUKA KUNCI NILAI --}}
                                                                <form action="{{ route('bukakuncinilaiauditor') }}" method="POST" class="form-bukakuncinilaiprodi" style="display:inline;">
                                                                    @csrf
                                                                    <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $item->spmi_penilaianprodis_id }}">
                                                                    <input type="hidden" name="spmi_periodes_id" value="{{ $penilaianProdi->spmi_periodes_id }}">
                                                                    <input type="hidden" name="programstudi" value="{{ session()->get('programstudi')->id }}">
                                                                    @if ($penilaianProdi->status == 9)
                                                                    <button type="submit" class="btn btn-outline-info btn-bukakuncinilai-prodi">Buka Kunci Nilai</button>
                                                                    @endif
                                                                </form>
                                                                @endif
                                                                {{-- AUDITOR END --}}

                                                                @endforeach
                                                        </td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-12">
                                    <h3 class="fw-bolder mb-2 line-clamp-1">
                                        GRAFIK INDIKATOR
                                    </h3>
                                    @if (!$errorChart)
                                    <div class="d-xl-block align-items-center justify-content-between mb-5">
                                        GRAFIK
                                        <div id="c1" style="width: 600px; height: 400px; !important"></div>
                                        <div id="c2" style="width: 600px; height: 400px; !important"></div>
                                        <div id="c3" style="width: 600px; height: 400px; !important"></div>
                                        <div id="c4" style="width: 600px; height: 400px; !important"></div>
                                        <div id="c5" style="width: 600px; height: 400px; !important"></div>
                                        <div id="c6" style="width: 600px; height: 400px; !important"></div>
                                        <div id="c7" style="width: 600px; height: 400px; !important"></div>
                                        <div id="c8" style="width: 600px; height: 400px; !important"></div>
                                        <div id="c9" style="width: 600px; height: 400px; !important"></div>
                                    </div>
                                    @else
                                    <div class="alert alert-danger mt-3">
                                        {{ $errorChart }}
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <div class="row align-items-center g-3">
                                <div class="col-6 col-sm-auto flex-1">
                                    <h3 class="fw-bolder mb-2 line-clamp-1">
                                        Cetak Hasil
                                    </h3>

                                    <form method="POST" action="{{ route('laporan.generate') }}">
                                        @csrf
                                        <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                                        <input type="hidden" name="program_studiid" value="{{ request('id') }}">
                                        <input type="hidden" name="chart_image" id="chart_image">
                                        <input type="hidden" name="chart_image2" id="chart_image2">
                                        <input type="hidden" name="chart_image3" id="chart_image3">
                                        <input type="hidden" name="chart_image4" id="chart_image4">
                                        <input type="hidden" name="chart_image5" id="chart_image5">
                                        <input type="hidden" name="chart_image6" id="chart_image6">
                                        <input type="hidden" name="chart_image7" id="chart_image7">
                                        <input type="hidden" name="chart_image8" id="chart_image8">
                                        <input type="hidden" name="chart_image9" id="chart_image9">
                                        <button class="btn btn-secondary" type="submit"><i class="fas fa-print me-1"></i>Cetak PDF</button>
                                    </form>
                                </div>
                                <div class="col-6 col-sm-auto flex-1">
                                    <a href="{{ route('laporan.generate_excel') }}" class="btn btn-success"><i class="fas fa-file-excel me-1"></i>Cetak Excel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<!-- ECharts CDN -->

@if(!$errorChart)
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

<script>
    const chartDom = document.getElementById('c1');
    const myChart = echarts.init(chartDom);
    const chartc1 = @json($chartsc1);
    const option = {
        title: {
            text: 'Indikator C1 Radar'
        },
        tooltip: {},
        legend: {
            data: ['C1']
        },
        radar: {
            indicator: chartc1.indikators
        },
        series: [{
            name: 'Score Comparison',
            type: 'radar',
            data: chartc1.series
        }]
    };

    myChart.setOption(option);
</script>

<script>
    const chartDom2 = document.getElementById('c2');
    const myChart2 = echarts.init(chartDom2);
    const chartc2 = @json($chartsc2);

    const option2 = {
        title: {
            text: 'Indikator C2 Radar'
        },
        tooltip: {},
        legend: {
            data: ['C2']
        },
        radar: {
            indicator: chartc2.indikators
        },
        series: [{
            name: 'Score Comparison',
            type: 'radar',
            data: chartc2.series
        }]
    };

    myChart2.setOption(option2);
</script>

<script>
    const chartDom3 = document.getElementById('c3');
    const myChart3 = echarts.init(chartDom3);
    const chartc3 = @json($chartsc3);

    const option3 = {
        title: {
            text: 'Indikator C3 Radar'
        },
        tooltip: {},
        legend: {
            data: ['C3']
        },
        radar: {
            indicator: chartc3.indikators
        },
        series: [{
            name: 'Score Comparison',
            type: 'radar',
            data: chartc3.series
        }]
    };

    myChart3.setOption(option3);
</script>

<script>
    const chartDom4 = document.getElementById('c4');
    const myChart4 = echarts.init(chartDom4);
    const chartc4 = @json($chartsc4);

    const option4 = {
        title: {
            text: 'Indikator C4 Radar'
        },
        tooltip: {},
        legend: {
            data: ['C4']
        },
        radar: {
            indicator: chartc4.indikators
        },
        series: [{
            name: 'Score Comparison',
            type: 'radar',
            data: chartc4.series
        }]
    };

    myChart4.setOption(option4);
</script>

<script>
    const chartDom5 = document.getElementById('c5');
    const myChart5 = echarts.init(chartDom5);
    const chartc5 = @json($chartsc5);

    const option5 = {
        title: {
            text: 'Indikator C5 Radar'
        },
        tooltip: {},
        legend: {
            data: ['C5']
        },
        radar: {
            indicator: chartc5.indikators
        },
        series: [{
            name: 'Score Comparison',
            type: 'radar',
            data: chartc5.series
        }]
    };

    myChart5.setOption(option5);
</script>

<script>
    const chartDom6 = document.getElementById('c6');
    const myChart6 = echarts.init(chartDom6);
    const chartc6 = @json($chartsc6);

    const option6 = {
        title: {
            text: 'Indikator C6 Radar'
        },
        tooltip: {},
        legend: {
            data: ['C6']
        },
        radar: {
            indicator: chartc6.indikators
        },
        series: [{
            name: 'Score Comparison',
            type: 'radar',
            data: chartc6.series
        }]
    };

    myChart6.setOption(option6);
</script>
<script>
    const chartDom7 = document.getElementById('c7');
    const myChart7 = echarts.init(chartDom7);
    const chartc7 = @json($chartsc7);

    const option7 = {
        title: {
            text: 'Indikator C7 Radar'
        },
        tooltip: {},
        legend: {
            data: ['C7']
        },
        radar: {
            indicator: chartc7.indikators
        },
        series: [{
            name: 'Score Comparison',
            type: 'radar',
            data: chartc7.series
        }]
    };

    myChart7.setOption(option7);
</script>

<script>
    const chartDom8 = document.getElementById('c8');
    const myChart8 = echarts.init(chartDom8);
    const chartc8 = @json($chartsc8);

    const option8 = {
        title: {
            text: 'Indikator C8 Radar'
        },
        tooltip: {},
        legend: {
            data: ['C8']
        },
        radar: {
            indicator: chartc8.indikators
        },
        series: [{
            name: 'Score Comparison',
            type: 'radar',
            data: chartc8.series
        }]
    };

    myChart8.setOption(option8);
</script>

<script>
    const chartDom9 = document.getElementById('c9');
    const myChart9 = echarts.init(chartDom9);
    const chartc9 = @json($chartsc9);

    const option9 = {
        title: {
            text: 'Indikator C9 Radar'
        },
        tooltip: {},
        legend: {
            data: ['C9']
        },
        radar: {
            indicator: chartc9.indikators
        },
        series: [{
            name: 'Score Comparison',
            type: 'radar',
            data: chartc9.series
        }]
    };

    myChart9.setOption(option9);
</script>
<script>
    // Convert chart to image after delay
    setTimeout(() => {
        const img = myChart.getDataURL({
            type: 'png',
            pixelRatio: 2,
            backgroundColor: '#fff'
        });
        const img2 = myChart2.getDataURL({
            type: 'png',
            pixelRatio: 2,
            backgroundColor: '#fff'
        });
        const img3 = myChart3.getDataURL({
            type: 'png',
            pixelRatio: 2,
            backgroundColor: '#fff'
        });
        const img4 = myChart4.getDataURL({
            type: 'png',
            pixelRatio: 2,
            backgroundColor: '#fff'
        });
        const img5 = myChart5.getDataURL({
            type: 'png',
            pixelRatio: 2,
            backgroundColor: '#fff'
        });
        const img6 = myChart6.getDataURL({
            type: 'png',
            pixelRatio: 2,
            backgroundColor: '#fff'
        });
        const img7 = myChart7.getDataURL({
            type: 'png',
            pixelRatio: 2,
            backgroundColor: '#fff'
        });
        const img8 = myChart8.getDataURL({
            type: 'png',
            pixelRatio: 2,
            backgroundColor: '#fff'
        });
        const img9 = myChart9.getDataURL({
            type: 'png',
            pixelRatio: 2,
            backgroundColor: '#fff'
        });
        document.getElementById('chart_image').value = img;
        document.getElementById('chart_image2').value = img2;
        document.getElementById('chart_image3').value = img3;
        document.getElementById('chart_image4').value = img4;
        document.getElementById('chart_image5').value = img5;
        document.getElementById('chart_image6').value = img6;
        document.getElementById('chart_image7').value = img7;
        document.getElementById('chart_image8').value = img8;
        document.getElementById('chart_image9').value = img9;
    }, 1000);
</script>

@else
<script>
    console.warn("{{ e($errorChart) }}");
</script>
@endif

@endsection