@extends('master2')

@section('content')
<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
<div class="pb-5">
    <div class="row g-4">
        <div class="col-12 col-xxl-6">

            <div class="mb-8">
                <h2 class="mb-2">Penjaminan Mutu Elemen</h2>
                <h5 class="text-700 fw-semi-bold">Berikut Elemen Penjaminan Mutu</h5>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12 col-md-12">

            <div class="row g-3">

                <div class="col-md-10">
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
                                    <div class="align-items-center justify-content-between mb-5">
                                        <div class="align-items-center">
                                        </div>
                                        <h3>Daftar Penjaminan Mutu Elemen</h3>
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm fs--1 mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="sort border-top ps-3" data-sort="nomor">No</th>
                                                        <th class="sort border-top" data-sort="kode">Kode</th>
                                                        <th class="sort border-top" data-sort="tahun">Tahun</th>
                                                        <th class="sort border-top" data-sort="kriteria">Kriteria</th>
                                                        {{-- <th class="sort border-top" data-sort="keterangan">Keterangan</th> --}}
                                                        <th class="sort border-top" data-sort="status">Status</th>
                                                        <th class="sort align-middle pe-0 border-top" scope="col">
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
                                                        <td class="align-middle fakultas">{{$spmiperiodetahun}}</td>
                                                        <td class="align-middle fakultas">{{$spmielemen->kriteria}} <a class="btn btn-xss" tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Keterangan" data-bs-content="{{$spmielemen->keterangan}}"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                                                        {{-- <td class="align-middle fakultas">{{$spmielemen->keterangan}}</td> --}}
                                                        <td class="align-middle fakultas">
                                                            @php
                                                            if($spmielemen->status == 1) {
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-success">Aktif</span>';
                                                            } else {
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-danger">Tidak Aktif</span>';
                                                            }

                                                            @endphp
                                                            {!! $status !!}




                                                        </td>
                                                        <td class="">
                                                            <a href="{{ route('penjamuindikator', [
                                                                    session('programstudi')->id,
                                                                    'elemen' => $spmielemen->id, 
                                                                    'tahun' => $spmiperiodetahun, 
                                                                    'lembaga' => $spmiperiodelembaga
                                                                ]) }}"
                                                                class="col-md-12 btn btn-outline-primary {{ $spmielemen->status ? '':'disabled' }}">
                                                                Lihat detail
                                                            </a>

                                                        </td>
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
                <div class="col-md-2">
                    <div class="row g-3">

                        <div class="col-md-12">
                            <div class="card mb-5">
                                <div class="card-body">
                                    <h5 class="fw-semi-bold"><span class="d-inline-block lh-sm me-1"
                                            data-feather="file-text" style="height:16px;width:16px;"></span><span
                                            class="d-inline-block lh-sm">Data Indikator Hasil</span>
                                    </h5>
                                    <p>Data hasil Kalkulasi pada setiap indikator</p>
                                    </br></br>
                                    <td class="">
                                        @if(session()->has('programstudi'))
                                        <!-- <a href="{{ route('penjamuindikatorhasil', session('programstudi')->id) }}" class="col-md-12 btn btn-outline-primary">{{$spmiperiodetahun}}</a> -->
                                        <a href="{{ route('penjamuindikatorhasil', [
                                                                    session('programstudi')->id, 
                                                                    'tahun' => $spmiperiodetahun, 
                                                                    'lembaga' => $spmiperiodelembaga
                                                                ]) }}"
                                            class="col-md-12 btn btn-outline-primary {{ $spmielemen->status ? '':'disabled' }}">
                                            Lihat detail
                                        </a>
                                        @else
                                        <span class="text-danger">Program Studi tidak ditemukan</span>
                                        @endif
                                    </td>

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