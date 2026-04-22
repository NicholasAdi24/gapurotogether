@extends('master2')

@section('content')
<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
<div class="pb-5">
    <div class="row g-4">
        <div class="col-12 col-xxl-6">

            <div class="mb-8">
                <h2 class="mb-2">Penjaminan Mutu</h2>
                <h5 class="text-700 fw-semi-bold">Berikut Daftar Periode Penjaminan Mutu</h5>
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
                                        <h3>Daftar Penjaminan Mutu</h3>
                                        <br>
                                        <table class="table table-striped table-sm fs--1 mb-0">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th class="sort border-top" data-sort="no">No</th>
                                                    <th class="sort border-top" data-sort="elemen">Nama</th>
                                                    <th class="sort border-top" data-sort="elemen">Lembaga</th>
                                                    <th class="sort border-top" data-sort="elemen">Tahun</th>
                                                    <th class="sort border-top" data-sort="elemen">Tanggal Mulai</th>
                                                    <th class="sort border-top" data-sort="elemen">Tanggal Selesai</th>
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
                                                    <td class="align-middle elemen">{{$spmipenilaianprodi->lembagas->nama }}</td>
                                                    <td class="align-middle elemen">{{$spmipenilaianprodi->spmiperiode->tahun}}</td>
                                                    <td class="align-middle elemen">{{$spmipenilaianprodi->spmiperiode->tanggal_mulai}}</td>
                                                    <td class="align-middle elemen">{{$spmipenilaianprodi->spmiperiode->tanggal_selesai}}</td>
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
                                                    @if(session()->get('roles')->id  == 8 || session()->get('roles')->id  == 13 || session()->get('roles')->id  == 7 || session()->get('roles')->id  == 2 || session()->get('roles')->id  == 5)
                                                        <td>
                                                            <a href="{{ route('penjamuelemen', ['id' => $spmipenilaianprodi->id]) }}" class="btn btn-outline-primary">
                                                                <i class="fa fa-file" aria-hidden="true"></i> Penjamu
                                                            </a>
                                                            <a href="{{ route('rtldetail', ['id' => $spmipenilaianprodi->spmiperiode->id]) }}" class="btn btn-outline-success">
                                                                <i class="fa fa-file" aria-hidden="true"></i> RTL
                                                            </a>

                                                        </td>
                                                    @else
                                                        @if ($spmipenilaianprodi->spmiperiode->status == 1)
                                                        <td>
                                                            <a href="{{ route('penjamuelemen', ['id' => $spmipenilaianprodi->id]) }}" class="btn btn-outline-primary">
                                                                <i class="fa fa-file" aria-hidden="true"></i>
                                                            </a>

                                                        </td>
                                                        @else
                                                        <td>
                                                            <a class="btn btn-outline-primary disabled" style="pointer-events: none; opacity: 0.5;">
                                                                <i class="fa fa-file" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                        @endif
                                                    @endif



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
