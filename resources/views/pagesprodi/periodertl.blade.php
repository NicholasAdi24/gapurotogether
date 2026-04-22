@extends('master2')

@section('content')
<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
<div class="pb-5">
    <div class="row g-4">
        <div class="col-12 col-xxl-6">

            <div class="mb-8">
                <h2 class="mb-2">Rencana Tidak Lanjut</h2>
                <h5 class="text-700 fw-semi-bold">Berikut Daftar Periode RTL</h5>
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
                                                class="d-inline-block lh-sm">{{ session()->get('programstudi')->getFakultas->nama_fakultas }}
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="d-md-flex d-xl-block align-items-center justify-content-between mb-5">
                                        <div class="d-flex align-items-center mb-3 mb-md-0 mb-xl-3">
                                        </div>
                                        <h3>Daftar RTLProgram Studi</h3>
                                        <br>
                                        <table class="table table-striped table-sm fs--1 mb-0">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th class="sort border-top" data-sort="no">No</th>
                                                    <th class="sort border-top" data-sort="elemen">Nama</th>
                                                    <th class="sort border-top" data-sort="elemen">Tahun</th>
                                                    <th class="sort border-top" data-sort="elemen">Nilai Prodi</th>
                                                    <th class="sort border-top" data-sort="elemen">Nilai Auditor</th>
                                                    <th class="sort border-top" data-sort="elemen">Status</th>
                                                    <th class="sort border-top" data-sort="keterangan">Keterangan</th>
                                                    <th class="sort border-top" scope="col">
                                                        Tindakan</th>
                                                </tr>
                                            </thead>
                                            <tbody class="list">
                                                <?php
                                                $no = 1;

                                                ?>
                                                @foreach($spmipenilaianprodis as $spmipenilaianprodi)
                                                <?php

                                                ?>
                                                <tr align="center">
                                                    <td>{{ $no++ }}</td>
                                                    <td class="align-middle elemen">{{$spmipenilaianprodi->spmiperiode->nama }}</td>
                                                    <td class="align-middle elemen">{{$spmipenilaianprodi->spmiperiode->tahun}}</td>
                                                    <td class="align-middle elemen"><span class="badge badge-phoenix badge-phoenix-success">{{@$spmipenilaianprodi->nilai_prodi_final}}</span></td>
                                                    <td class="align-middle elemen"><span class="badge badge-phoenix badge-phoenix-danger">{{@$spmipenilaianprodi->nilai_auditor_final}}</span></td>
                                                    <td class="align-middle elemen">
                                                        @php
                                                        if($spmipenilaianprodi->spmiperiode->status == 1) {
                                                        $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-success">Dibuka</span>';
                                                        } else {
                                                        $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-danger">Belum Dibuka</span>';
                                                        }

                                                        @endphp
                                                        {!! $status !!}




                                                    </td>
                                                    <td class="align-middle elemen">{{$spmipenilaianprodi->spmiperiode->keterangan}}</td>

                                                    {{-- @if ($spmipenilaianprodi->spmiperiode->status == 1) --}}
                                                    <td>
                                                        <a href="{{ route('rtldetail', ['id' => $spmipenilaianprodi->spmiperiode->id]) }}" class="btn btn-outline-primary">
                                                            <i class="fa fa-file" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                    {{-- @else --}}
                                                    {{-- <td>
                                                        <a class="btn btn-outline-primary disabled" style="pointer-events: none; opacity: 0.5;">
                                                            <i class="fa fa-file" aria-hidden="true"></i>
                                                        </a>
                                                    </td> --}}
                                                    {{-- @endif --}}


                                                </tr>
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
        </div>



    </div>
</div>


@endsection
