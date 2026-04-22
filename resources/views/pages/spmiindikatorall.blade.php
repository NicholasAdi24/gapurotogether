@extends('master')

@section('content')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<h2 class="mb-2 lh-sm">SPMI INDIKATOR</h2>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-12">
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-soft">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-10 col-md">
                                <h4 class="text-900 mb-0" data-anchor="data-anchor">Daftar SPMI Indikator</h4>
                                <p class="mb-0 mt-2 text-800">Daftar <code>SPMI Indikator</code> Di Universitas
                                    DIponegoro</p>
                            </div>
                            {{-- <div class="col-2 col-md pull-right"> --}}
                            <a href="{{ route('spmielemen') }}" class="btn btn-outline-secondary col-1">Kembali</a>
                            {{-- </div> --}}

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">

                            @foreach($spmielemens as $spmielemen)
                            <br>
                            <h5 class="text-900 mb-0" data-anchor="data-anchor">
                                {{$spmielemen->kode."  -  ".$spmielemen->kriteria}}</h5>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered fs--1 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="sort border-top ps-3" data-sort="nomor">No</th>
                                            <th class="sort border-top" data-sort="elemen">Elemen</th>
                                            <th class="sort border-top" data-sort="code">Kode</th>
                                            <th class="sort border-top" data-sort="indikator">Indikator</th>
                                            <th class="sort border-top" data-sort="keterangan">Keterangan</th>
                                            <th class="sort border-top" data-sort="keterangan">Strata</th>
                                            <th class="sort border-top" data-sort="asal">Asal</th>
                                            <th class="sort border-top" data-sort="rumus">Rumus</th>
                                            <th class="sort border-top" data-sort="status">Status</th>
                                            <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                                Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php
                                                    $no = 1;
                                                ?>
                                        @foreach($spmiindikators as $spmiindikator)
                                        @if($spmiindikator->spmi_elemens_id == $spmielemen->id)
                                        <tr>
                                            <td class="align-middle ps-3 nomor">{{ $no++ }}</td>
                                            <td class="align-middle elemen">{{$spmiindikator->getSpmielemen->kriteria}}
                                            </td>
                                            <td class="align-middle code">{{$spmiindikator->kode}}</td>
                                            <td class="align-middle indikator">{{$spmiindikator->indikator}}</td>
                                            <td class="align-middle keterangan">{{$spmiindikator->keterangan}}</td>
                                            <td class="align-middle keterangan">{{$spmiindikator->spmi_tipe_id}}</td>
                                            <td class="align-middle asal">{{$spmiindikator->asal}}</td>
                                            <td class="align-middle rumus">{{$spmiindikator->rumus}}</td>
                                            <td class="align-middle status">
                                                @php
                                                if($spmiindikator->status == 1) {
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
                                                <a href="{{ route('spmiindikatordetail', ['id' => $spmiindikator->id]) }}"
                                                    class="btn btn-outline-primary">Lihat Detail</a>
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                            <div class="d-flex justify-content-between mt-3"><span class="d-none d-sm-inline-block"
                                    data-list-info="data-list-info"></span>
                                <div class="d-flex"><button class="page-link" data-list-pagination="prev"><span
                                            class="fas fa-chevron-left"></span></button>
                                    <ul class="mb-0 pagination"></ul><button class="page-link pe-0"
                                        data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
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
