@extends('master')

@section('content')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<h2 class="mb-2 lh-sm">SPMI ELEMEN</h2>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-12">
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-soft">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-12 col-md">
                                <h4 class="text-900 mb-0" data-anchor="data-anchor">Daftar SPMI Elemen</h4>
                                <p class="mb-0 mt-2 text-800">Daftar <code>SPMI Elemen</code> Di Universitas DIponegoro
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">
                            <div id="tableExample3"
                                data-list='{"valueNames":["kode","tahun", "kriteria", "keterangan","status"],"page":25,"pagination":true}'>
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
                                                <th class="sort border-top" data-sort="kode">Kode</th>
                                                <th class="sort border-top" data-sort="tahun">Tahun</th>
                                                <th class="sort border-top" data-sort="kriteria">Kriteria</th>
                                                <th class="sort border-top" data-sort="keterangan">Keterangan</th>
                                                <th class="sort border-top" data-sort="status">Status</th>
                                                <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                                    Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php
                                                    $no = 1;
                                                ?>
                                            @foreach($spmielemens as $spmielemen)
                                            <tr>
                                                <td class="align-middle ps-3 nomor">{{ $no++ }}</td>
                                                <td class="align-middle fakultas">{{$spmielemen->kode}}</td>
                                                <td class="align-middle fakultas">{{$spmielemen->tahun}}</td>
                                                <td class="align-middle fakultas">{{$spmielemen->kriteria}}</td>
                                                <td class="align-middle fakultas">{{$spmielemen->keterangan}}</td>
                                                <td class="align-middle fakultas">
                                                    @php
                                                    if($spmielemen->status == 1) {
                                                    $status = '<span
                                                        class="badge badge-phoenix ms-auto fs--2 badge-phoenix-success">Active</span>';
                                                    } else {
                                                    $status = '<span
                                                        class="badge badge-phoenix ms-auto fs--2 badge-phoenix-danger">Not
                                                        Active</span>';
                                                    }

                                                    @endphp
                                                    {!! $status !!}




                                                </td>
                                                <td class="">
                                                    <a href="{{ route('spmielemenid', ['id' => $spmielemen->id]) }}"
                                                        class="btn btn-outline-primary">Lihat Detail</a>

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
