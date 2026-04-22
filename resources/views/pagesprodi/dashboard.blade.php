@extends('master2')

@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeButtons = document.querySelectorAll('.btn-close[data-session-key]');
        closeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const sessionKey = btn.getAttribute('data-session-key');
                fetch("{{ route('clear-session') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            key: sessionKey
                        })
                    })
                    .then(response => response.json())
                    .then(data => console.log('Session cleared:', data))
                    .catch(error => console.error('Error clearing session:', error));
            });
        });
    });
</script>

<div class="pb-5">
    <div class="row g-4">
        <div class="col-12">

            <div class="mb-8">
                <h2 class="mb-2">Dashboard Gapuro</h2>
                <h5 class="text-700 fw-semi-bold">Selamat Datang di website sistem Gapuro</h5>
            </div>

            <div class="row align-items-center g-4">
                <div class="card mb-5">
                    <div class="card-header hover-actions-trigger position-relative mb-7"
                        style="min-height: 130px; ">
                        <div class="bg-holder rounded-top"
                            style="background-image: linear-gradient(0deg, #000000 -3%, rgba(0, 0, 0, 0) 83%), url({{asset('templates/assets/img/generic/59.png') }}">
                            <input class="d-none" id="upload-feed-cover-image" type="file" /><label
                                class="cover-image-file-input" for="upload-feed-cover-image"></label>
                            <div class="hover-actions end-0 bottom-0 pe-1 pb-2 text-white"><span
                                    class="fa-solid fa-camera me-2 overlay-icon"> </span></div>
                        </div><input class="d-none" id="upload-feed-porfile-picture" type="file" /><label
                            class="avatar avatar-4xl status-online feed-avatar-profile cursor-pointer"
                            for="upload-feed-porfile-picture"><img
                                class="rounded-circle img-thumbnail bg-white shadow-sm"
                                src="{{asset('templates/assets/img/team/Undipcek.png') }}" width="200"
                                alt="" /></label>
                    </div> <!-- Bagian Card -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-wrap mb-3 align-items-center">
                                    <h3 class="me-2">{{ session()->get('user')->name }}</h3>
                                    <span
                                        class="badge badge-phoenix badge-phoenix-warning rounded-pill fs--1 ms-2 d-grid place-items-center text-center"
                                        style="min-height: 1.5rem;">
                                        <span
                                            class="badge-label">{{ session()->get('user')->name }}</span></span>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="d-flex me-4 mb-2"><span
                                                class="fa-solid fa-user-group fs--2 me-2 me-lg-1 me-xl-2"></span>
                                            <h6 class="d-inline-block mb-0"><span
                                                    class="fw-semi-bold">{{ session()->get('user')->email }}</span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <p class="fw-semi-bold mb-0">Keterangan<a href="#!"><span
                                            class="fa-solid fa-pencil fs--2 text-500 ms-3"></span></a></p>
                                <p class="text-700 mb-0">“Keterangan Lanjut” </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <hr class="bg-200 mb-6 mt-4" />

        </div>

        @if(session()->get('programstudi') == NULL && $userroles->first()->roles_id == 7) {{-- Dekan --}}
        <div class="col-12">
            <div class="row g-3">
                <div class="col-12 col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-12 col-sm-auto flex-1">

                                    <h3 class="fw-bolder mb-2" style="text-align: center;">Akses daftar program studi melalui menu Validasi pada navigation bar Penjamu</h3>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @elseif(session()->get('programstudi') == NULL && $userroles->first()->roles_id == 12) {{-- Auditor --}}
        <div class="col-12">

            <div class="row g-3">
                <div class="col-12 col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-12 col-sm-auto flex-1">

                                    <h3 class="fw-bolder mb-2" style="text-align: center;">Akses daftar program studi melalui menu Audit pada navigation bar Penjamu</h3>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @elseif(session()->get('programstudi') == NULL && $userroles->first()->roles_id == 13) {{-- Wakil Dekan 1 --}}
        <div class="col-12">
            <div class="row g-3">
                <div class="col-12 col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-12 col-sm-auto flex-1">

                                    <h3 class="fw-bolder mb-2" style="text-align: center;">Akses daftar program studi melalui menu Validasi pada navigation bar Penjamu</h3>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @elseif(session()->get('programstudi') == NULL && $userroles->first()->roles_id == 8) {{-- TPMF --}}
        <div class="col-12">
            <div class="mb-2">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="text-700 fw-semi-bold mb-0">Daftar Program Studi</h5>
                </div>
            </div>

            <div class="row g-3">
                @foreach ($prodis as $prodi)
                <div class="col-12 col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-12 col-sm-auto flex-1">

                                    <h3 class="fw-bolder mb-2 line-clamp-1">{{ $prodi->nama_prodi }}</h3>
                                    <div class="d-flex align-items-center mb-4">

                                        <h5 class="fw-semi-bold">
                                            <span class="d-inline-block lh-sm me-1" data-feather="grid" style="height:16px;width:16px;"></span>
                                            <span class="d-inline-block lh-sm">{{ $prodi->getFakultas->nama_fakultas }}</span>
                                        </h5>
                                    </div>

                                    {{-- Tabel Periode dan Status --}}
                                    <table class="table table-sm table-bordered w-100 mb-4">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Periode</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($prodi->spmipenilaianprodi ?? [] as $penilaian)
                                            <tr>
                                                <td>{{ $penilaian->spmiperiode->nama ?? '-' }}</td>
                                                <td>
                                                    @php
                                                    switch ($penilaian->status) {
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
                                                    default:
                                                    $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-danger">BELUM DIISI</span>';
                                                    break;
                                                    }
                                                    @endphp
                                                    {!! $status !!}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- <div class="d-md-flex d-xl-block align-items-center justify-content-between mb-5">
                                        <div class="d-flex align-items-center mb-3 mb-md-0 mb-xl-3">

                                        </div>
                                        <h6>Periode {{ $prodi->tahun ?? '-' }}</h6>
                                        <div>
                                            <span class="badge badge-phoenix badge-phoenix-success me-2">Baik</span>
                                            <span class="badge badge-phoenix badge-phoenix-danger me-2">Kurang Baik</span>
                                            <span class="badge badge-phoenix badge-phoenix-secondary">Tidak Mengisi</span>
                                        </div>
                                    </div>

                                    <div class="progress mb-2" style="height:5px">
                                        <div class="progress-bar bg-primary-200" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="mb-0"> New</p>
                                        <div>
                                            <span class="d-inline-block lh-sm me-1" data-feather="clock" style="height:16px;width:16px;"></span>
                                            <span class="d-inline-block lh-sm"> Dec 15, 05:00AM</span>
                                        </div>
                                    </div>
                                    <br> -->
                                    <div class="col-12">
                                        <!-- d-flex align-items-center -->
                                        <form action="{{ route('penjaminanmutuproditpmf') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="prodi_id" value="{{ $prodi->id }}">
                                            <input type="hidden" name="nama_prodi" value="{{ $prodi->nama_prodi }}">
                                            <button class="btn btn-primary w-100 fw-bold mb-3">
                                                <i class="fa-solid fa-right-to-bracket me-2"></i>Pilih Prodi
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>


        @elseif((session()->get('programstudi')) == NULL)
        <div class="col-12">
            <div class="mb-8">

                <h5 class="text-700 fw-semi-bold">Daftar Program Studi</h5>
            </div>
            <div class="row g-3">
                @foreach ($prodis as $prodi)
                <div class="col-12 col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-12 col-sm-auto flex-1">
                                    <h3 class="fw-bolder mb-2 line-clamp-1">{{ $prodi->getProgramstudi->nama_prodi }}</h3>
                                    <div class="d-flex align-items-center mb-4">

                                        <h5 class="fw-semi-bold"><span class="d-inline-block lh-sm me-1" data-feather="grid" style="height:16px;width:16px;"></span><span class="d-inline-block lh-sm">{{ $prodi->getProgramstudi->getFakultas->nama_fakultas }}</span></h5>
                                    </div>
                                    <!-- <div class="d-md-flex d-xl-block align-items-center justify-content-between mb-5">
                                        <div class="d-flex align-items-center mb-3 mb-md-0 mb-xl-3">
                                            {{-- <div class="avatar avatar-xl me-3"><img class="rounded-circle" src="../../assets/img/team/72x72/58.webp" alt="" /></div>
                                        <div>
                                          <h5>Ansolo Lazinatov</h5>

                                        </div> --}}
                                        </div>
                                        <h6>Periode {{ $prodi->tahun ?? '-' }}</h6>
                                        <div><span class="badge badge-phoenix badge-phoenix-success me-2">Baik</span><span class="badge badge-phoenix badge-phoenix-danger me-2">Kurang Baik</span><span class="badge badge-phoenix badge-phoenix-secondary">Tidak Mengisi</span></div>
                                    </div>
                                    <div class="progress mb-2" style="height:5px">
                                        <div class="progress-bar bg-primary-200" role="progressbar" style="width: 40%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="mb-0"> New</p>
                                        <div><span class="d-inline-block lh-sm me-1" data-feather="clock" style="height:16px;width:16px;"></span><span class="d-inline-block lh-sm"> Dec 15, 05:00AM</span></div>
                                    </div>
                                    <br> -->
                                    <div class="col-12">
                                        <!-- d-flex align-items-center -->
                                        <form action="{{ route('chooseprodiattempt') }}" method="post">
                                            @csrf
                                            <input class="form-control form-icon-input" id="prodi_id" type="text" placeholder="" name="prodi_id" value="{{ $prodi->getProgramstudi->id }}" hidden />
                                            <button class="btn btn-primary w-100 fw-bold mb-3">
                                                <i class="fa-solid fa-right-to-bracket me-2"></i>Pilih Prodi
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        @else
        <div class="col-12">
            <div class="mb-1">

                <!-- <h5 class="text-700 fw-semi-bold">Daftar Program Studi</h5> -->
                <div>
                    <!-- col-3 col-md-3 -->
                    <a href="{{ route('logoutprodi') }}" class="btn btn-primary w-100 mb-3"><i
                            class="fa-solid fa-right-to-bracket me-2"
                            style="transform: scaleX(-1);"></i>
                        Pindah Prodi</a>
                </div>
            </div>
            <div class="row g-3">

                <div class="col-12 col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row align-items-center g-3">
                                <div class="col-12 col-sm-auto flex-1">
                                    <h3 class="fw-bolder mb-2 line-clamp-1">{{ session()->get('programstudi')->nama_prodi }}</h3>
                                    <div class="d-flex align-items-center mb-4">

                                        <h5 class="fw-semi-bold"><span class="d-inline-block lh-sm me-1" data-feather="grid" style="height:16px;width:16px;"></span><span class="d-inline-block lh-sm">{{ session()->get('programstudi')->getFakultas->nama_fakultas }}</span></h5>
                                    </div>
                                    <div class="d-md-flex d-xl-block align-items-center justify-content-between mb-5">
                                        <div class="d-flex align-items-center mb-3 mb-md-0 mb-xl-3">
                                        </div>
                                        <h3>Daftar Akreditasi</h3>
                                        <br>
                                        @isset($akreditasis)
                                        <table class="table table-striped table-sm fs--1 mb-0">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th class="sort border-top" data-sort="no">No</th>
                                                    <th class="sort border-top" data-sort="elemen">No Akreditasi</th>
                                                    <th class="sort border-top" data-sort="elemen">Lembaga</th>
                                                    <th class="sort border-top" data-sort="elemen">Akreditasi</th>
                                                    <th class="sort border-top" data-sort="keterangan">Tipe</th>
                                                    <th class="sort border-top" scope="col">
                                                        Tindakan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                @php $no = 1; @endphp

                                                @forelse($akreditasis as $akreditasi)
                                                @php
                                                $type = $akreditasi->type === 1 ? 'Nasional' : 'Internasional';
                                                @endphp
                                                <tr style="text-align: center;">
                                                    <td>{{ $no++ }}</td>
                                                    <td class="align-middle elemen">{{ $akreditasi->no_sk }}</td>
                                                    <td class="align-middle elemen">{{ $akreditasi->lembaga }}</td>
                                                    <td class="align-middle elemen">{{ $akreditasi->akreditasi }}</td>
                                                    <td class="align-middle elemen">{{ $type }}</td>
                                                    <td>
                                                        <a href="{{ asset('uploads/'.$akreditasi->berkas) }}" class="btn btn-outline-primary" target="_blank">
                                                            <i class="fa fa-file" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Berkas akreditasi kosong</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        @else
                                        <div class="alert alert-warning">
                                            Silakan ulangi pemilihan Program Studi melalui menu <b>Pindah Prodi</b> untuk mengakses halaman ini.
                                        </div>
                                        @endisset



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endsection
