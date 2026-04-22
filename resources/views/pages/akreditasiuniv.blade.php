@extends('master')

@section('content')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<h2 class="mb-2 lh-sm">Akreditasi Universitas</h2>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-12">
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-soft">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-12 col-md">
                                <h4 class="text-900 mb-0" data-anchor="data-anchor">Daftar Akreditasi Universitas</h4>
                                <p class="mb-0 mt-2 text-800">Daftar <code>Akreditasi Universitas</code> Di Universitas
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
                                                <th class="sort border-top" data-sort="kode_prodi">Universitas</th>
                                                <th class="sort border-top" data-sort="nama_prodi">No SK</th>
                                                <th class="sort border-top" data-sort="strata">Tahun</th>
                                                <th class="sort border-top" data-sort="fakultas">Masa Mulai</th>
                                                <th class="sort border-top" data-sort="fakultas">Masa Akhir</th>
                                                <th class="sort border-top" data-sort="fakultas">Akreditasi</th>
                                                <th class="sort border-top" data-sort="fakultas">Berkas</th>
                                                <th class="sort border-top" data-sort="fakultas">Lembaga</th>
                                                <th class="sort border-top" data-sort="status">Status <br> Updated By</th>
                                                <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                                    Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            <?php
                                                    $no = 1;
                                                ?>
                                            @foreach($akreditasiunivs as $akreditasiuniv)
                                                @php
                                                    $masaakhir = date_create($akreditasiuniv->masa_akhir);
                                                    $now = date_create(date('Y-m-d', strtotime('now')));
                                                    $diff = date_diff($now, $masaakhir);
                                                    $month =  $diff->format('%r%m');
                                                    $day = $diff->format('%r%d');
                                                    $year = $diff->format('%r%y');
                                                    $different = $diff->format('%r%a');
                                                    if ($day <= 0 && $month <= 0 && $year <= 0) {
                                                        $color = 'bg-danger text-white';
                                                        $status = '<b class="text-white">Habis Masa Berlaku</b>';
                                                        $sisa = 0;
                                                    }else if ($month < 6 && $year < 1){
                                                        $color = 'bg-warning text-white';
                                                        $status = '<b class="text-white">Waspada</b>';
                                                        $sisa = 1;
                                                    }else if($year <= 1 ){
                                                        $color = 'bg-info text-white';
                                                        $status = '<b class="text-white">Persiapan</b>';
                                                        $sisa = 2;
                                                    }else{
                                                        $color = '';
                                                        $status = '<b class="text-success">Aman</b>';
                                                        $sisa = 3;
                                                    }

                                                @endphp
                                            <tr class="{{ $color }}">
                                                <td class="align-middle ps-3 nomor">{{ $no++ }}</td>
                                                <td class="align-middle kode_prodi">Universitas Diponegoro</td>
                                                <td class="align-middle nama_prodi">{{$akreditasiuniv->no_sk}}</td>
                                                <td class="align-middle strata">
                                                    {{$akreditasiuniv->tahun }}</td>
                                                <td class="align-middle fakultas"> {{$akreditasiuniv->masa_mulai}}</td>
                                                <td class="align-middle fakultas"> {{$akreditasiuniv->masa_akhir}}</td>
                                                <td class="align-middle fakultas"> {{$akreditasiuniv->akreditasi}}</td>
                                                 <td class="align-middle fakultas">
                                                    <a href="{{ asset(@$akreditasiuniv->berkas) }}" target="_blank" class="btn btn-sm btn-primary ">
                                                        <i class="fa fa-file"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle fakultas"> {{$akreditasiuniv->lembaga}}</td>
                                                <td class="align-middle status"> {!! $status !!}</td>
                                                <td class="align-middle white-space-nowrap text-end pe-0">

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
