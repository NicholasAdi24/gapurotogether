@extends('master')

@section('content')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<h2 class="mb-2 lh-sm">Program Studi</h2>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-12">
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-soft">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-12 col-md">
                                <h4 class="text-900 mb-0" data-anchor="data-anchor">Daftar Program Studi</h4>
                                <p class="mb-0 mt-2 text-800">Daftar <code>Program Studi</code> Di Universitas
                                    Diponegoro</p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">
                            <div id="tableExample3"
                                data-list='{"valueNames":["nomor","kode_prodi","nama_prodi", "strata", "fakultas","status"],"page":25,"pagination":true}'>
                                <div class="search-box mb-3 mx-auto">
                                    <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                                        <input class="form-control search-input search form-control-sm" type="search"
                                            placeholder="Search" aria-label="Search" />
                                        <span class="fas fa-search search-box-icon"></span>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm fs--1 mb-0">
                                        <thead>
                                            <tr>
                                                <th class="sort border-top ps-3" data-sort="nomor">No</th>
                                                <th class="sort border-top" data-sort="kode_prodi">Kode Prodi</th>
                                                <th class="sort border-top" data-sort="nama_prodi">Nama Prodi</th>
                                                <th class="sort border-top" data-sort="strata">Strata</th>
                                                <th class="sort border-top" data-sort="fakultas">Fakultas</th>
                                                <th class="sort border-top" data-sort="status">Status</th>
                                                <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                                    Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php
                                                    $no = 1;
                                                ?>
                                            @foreach($programstudis as $programstudi)
                                            <tr>
                                                <td class="align-middle ps-3 nomor">{{ $no++ }}</td>
                                                <td class="align-middle kode_prodi">{{$programstudi->kode_prodi}}</td>
                                                <td class="align-middle nama_prodi">{{$programstudi->nama_prodi}}</td>
                                                <td class="align-middle strata">
                                                    {{$programstudi->getstrata->nama_strata}}</td>
                                                <td class="align-middle fakultas">
                                                    {{$programstudi->getfakultas->nama_fakultas}}</td>
                                                <td class="align-middle status">{!! $programstudi->status == 1
                                                    ? '<span class="badge bg-success">Active</span>'
                                                    : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                                <td class="align-middle white-space-nowrap text-end pe-0">
                                                    <a href="{{ route('akreditasi', ['id' => $programstudi->id]) }}" class="btn btn-sm btn-info"><i class='fas fa-medal'></i> Akreditasi</a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-between mt-3"><span class="d-none d-sm-inline-block"
                                        data-list-info="data-list-info"></span>
                                    <div class="d-flex"><button class="page-link" data-list-pagination="prev"><span
                                                class="fas fa-chevron-left"></span></button>
                                        <ul class="mb-0 pagination"></ul><button class="page-link pe-0"
                                            data-list-pagination="next"><span
                                                class="fas fa-chevron-right"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->
@endsection
