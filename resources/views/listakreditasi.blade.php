@extends('master-kapus')

@section('content')
<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
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
<script>
    let typingTimer;

    function submitWithDelay(form) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            form.submit();
        }, 1000);
    }
</script>


<div class="pb-5">
    <div class="row g-4">
        <div class="col-12 col-xxl-6">

            <div class="mb-8">
                <h2 class="mb-2">Daftar Akreditasi</h2>
                <h5 class="text-700 fw-semi-bold">Berikut Daftar Akreditasi Program Studi</h5>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12">
        <div class="card mb-5">
            <div class="card-body">
                <div class="row align-items-center g-3">
                    <div class="col-12 col-sm-auto flex-1">
                        <h3 class="fw-bolder mb-2 line-clamp-1"> {{ session()->get('programstudi')->nama_prodi }} </h3>
                        <div class="d-flex align-items-center mb-4">

                            <h5 class="fw-semi-bold"><span class="d-inline-block lh-sm me-1" data-feather="grid" style="height:16px;width:16px;"></span><span class="d-inline-block lh-sm"> {{ session()->get('programstudi')->getFakultas->nama_fakultas }} </span></h5>
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


@endsection