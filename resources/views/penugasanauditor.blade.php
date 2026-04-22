@extends('master-kapus')

@section('content')

<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
<script src="{{asset('templates/vendors/popper/popper.min.js') }}"></script>
<script src="{{asset('templates/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{asset('templates/vendors/anchorjs/anchor.min.js') }}"></script>
<script src="{{asset('templates/vendors/is/is.min.js') }}"></script>
<script src="{{asset('templates/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{asset('templates/vendors/lodash/lodash.min.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll')"></script>
<script src="{{asset('templates/vendors/list.js/list.min.js') }}"></script>
<script src="{{asset('templates/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{asset('templates/vendors/dayjs/dayjs.min.js') }}"></script>
<script src="{{asset('templates/assets/js/phoenix.js') }}"></script>
<script src="{{asset('templates/vendors/echarts/echarts.min.js') }}"></script>
<script src="{{asset('templates/vendors/leaflet/leaflet.js') }}"></script>
<script src="{{asset('templates/vendors/leaflet.markercluster/leaflet.markercluster.js') }}"></script>
<script src="{{asset('templates/vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js') }}">
</script>
<script src="{{asset('templates/assets/js/ecommerce-dashboard.js') }}"></script>

<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
<style>
.select2-container--bootstrap-5 .select2-selection {
    box-shadow: none !important;
}

/* Make Select2 same width and height as Bootstrap inputs */
.select2-container {
    width: 100% !important; /* full width */
}

.select2-container--default .select2-selection--single {
    height: calc(2.25rem + 2px); /* same as .form-control */
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    background-color: #fff;
}

/* Center text properly */
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 1.5rem;
    color: #212529;
}

/* Match arrow alignment */
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%;
    right: 0.75rem;
}
</style>


<div class="pb-5">
    <div class="row g-4">
        <!-- <a href="{{route('login')}}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali
        </a> -->
        <div class="col-12 col-xxl-6">
            <div class="mb-8" style="text-align: center;">
                <h2 class="mb-2">Penugasan Auditor</h2>
                <h5 class="text-700 fw-semi-bold">Informasi Penugasan Auditor dalam Sistem Gapuro</h5>
            </div>


            <form action="{{ route('penugasanauditorpilih', request()->query()) }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="periode" class="form-label">Pilih Periode</label>
                    <select
                        name="spmiperiode_id"
                        id="spmiperiode_id"
                        class="form-select">
                        <option value="">-- Pilih Periode --</option>
                        @foreach($spmiperiodes as $periode)
                        <option value="{{ $periode->id }}"
                            {{ request('periode') == $periode->id ? 'selected' : '' }}
                            {{ $periode->status == 0 ? 'disabled' : '' }}>
                            {{ $periode->nama }}
                        </option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-3">
                    <label for="programstudi" class="form-label">Pilih Program Studi</label>
                    <select
                        name="programstudis_id"
                        id="programstudi"
                        class="form-select">
                        <option value="" disabled {{ $selectedProdi ? '' : 'selected' }}>
                            -- Pilih Program Studi --
                        </option>
                        @foreach($programstudis as $prodi)
                        <option value="{{ $prodi->programstudi->id }}"
                            {{ $prodi->programstudi->id == request('program') ? 'selected' : '' }}>
                            {{ $prodi->programstudi->nama_prodi }}
                        </option>
                        @endforeach
                    </select>

                </div>

                @php
                $first = $assignedAuditors[0] ?? null;
                $second = $assignedAuditors[1] ?? null;
                @endphp


                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="auditor1" class="form-label">Pilih Auditors 1</label>
                        <select name="auditor_id_1" id="auditor1" class="form-select select2" {{ $selectedProdi ? '' : 'disabled' }}>
                            <option value="" {{ $first === null ? 'selected' : '' }}>-- Pilih Auditor 1 --</option>
                            @foreach($usersrolesauditor as $ura)
                            <option value="{{ $ura->users_id }}" {{ $ura->users_id === $first ? 'selected' : '' }}>
                                {{ $ura->getUser->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="auditor2" class="form-label">Pilih Auditor 2</label>
                        <select name="auditor_id_2" id="auditor2" class="form-select" {{ $selectedProdi ? '' : 'disabled' }}>
                            <option value="" {{ $second === null ? 'selected' : '' }}>-- Pilih Auditor 2 --</option>
                            @foreach($usersrolesauditor as $ura)
                            <option value="{{ $ura->users_id }}" {{ $ura->users_id === $second ? 'selected' : '' }}>
                                {{ $ura->getUser->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button
                    type="submit"
                    class="btn btn-primary mt-3"
                    {{ $selectedProdi ? '' : 'disabled' }}>
                    {{ (! is_null($first) && ! is_null($second)) ? 'Update Penugasan' : 'Tambah Penugasan' }}
                </button>

            </form>

            @if($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        html: `<ul style="text-align:left; margin:0; padding-left:1rem;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>`
                    });
                });
            </script>
            @endif

            @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session("success") }}'
                    });
                });
            </script>
            @endif



            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const periodeSelect = document.getElementById('spmiperiode_id');
                    const programSelect = document.getElementById('programstudi');

                    function updateQueryParam(param, value) {
                        const url = new URL(window.location.href);
                        if (value) {
                            url.searchParams.set(param, value);
                        } else {
                            url.searchParams.delete(param);
                        }
                        window.location.href = url.toString();
                    }

                    periodeSelect.addEventListener('change', function() {
                        updateQueryParam('periode', this.value);
                    });

                    programSelect.addEventListener('change', function() {
                        updateQueryParam('program', this.value);
                    });
                });
            </script>

        </div>

        <div class="col-12 col-xxl-6">
            <div class="mb-8" style="text-align: center;">
                <h2 class="mb-2">Daftar Auditor</h2>
                <h5 class="text-700 fw-semi-bold">Menampilkan Daftar Auditor yang berperan dalam proses audit Gapuro</h5>
            </div>
            <div class="mb-3">
                <form method="GET" class="row g-2 align-items-end">
                    <div class="col-auto">
                        <label for="filterYear" class="form-label">Filter:</label>
                        <select name="tahun" id="filterYear" class="form-select">
                            <option value="" {{ request('tahun') ? '' : 'selected' }}>
                                –- Pilih Tahun –-
                            </option>

                            @foreach($usersprogramstudis->pluck('tahun')->unique()->sort() as $year)
                            <option
                                value="{{ $year }}"
                                {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </div>
                </form>
                <br>
                <table class="table table-bordered table-sm">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Tahun</th>
                            <th>Program Studi</th>
                            <th>Auditor</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                        $coll = $usersprogramstudis;
                        if(request('tahun')) {
                        $coll = $coll->where('tahun', request('tahun'));
                        }
                        @endphp

                        @foreach($coll->groupBy('programstudis_id') as $prodiId => $groupByProdi)
                        @php $namaProdi = $groupByProdi->first()->nama_prodi; @endphp

                        @foreach($groupByProdi->sortBy('tahun')->groupBy('tahun') as $tahun => $groupByTahun)
                        @php
                        $auditorHtml = $groupByTahun->pluck('user_name')->implode('<br>');
                        @endphp
                        <tr>
                            <td>{{ $tahun }}</td>
                            <td>{{ $namaProdi }}</td>
                            <td>{!! $auditorHtml !!}</td>
                        </tr>
                        @endforeach

                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Auditor 1",
            allowClear: true,
        });

    });
</script>

@endsection
