@extends('master2')

@section('content')
<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
<div class="pb-5">
    <div class="row g-4">
        <div class="text-start mt-3">
            <a href="{{ session('penjamuelemen') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="col-12 col-xxl-6">

            <div class="mb-8">
                <h2 class="mb-2">Penjaminan Mutu Elemen</h2>
                <h5 class="text-700 fw-semi-bold">Berikut Elemen Penjaminan Mutu</h5>
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
                                                class="d-inline-block lh-sm">{{ session()->get('programstudi')->getFakultas->nama_fakultas }}</span>
                                        </h5>
                                    </div>
                                    <div class="align-items-center justify-content-between mb-5">
                                        <div class="align-items-center mb-3 mb-md-0 mb-xl-3">
                                        </div>
                                        <h3>Daftar Penjaminan Mutu Elemen {{ $spmielemen[0]->kriteria }}</h3>
                                        <br>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm fs--1 mb-0">
                                                <thead>
                                                    <tr>
                                                        <th class="sort border-top ps-3" data-sort="nomor">No</th>
                                                        <th class="sort border-top" data-sort="kode">Kode</th>
                                                        <th class="sort border-top" data-sort="kriteria">Indikator</th>
                                                        {{-- <th class="sort border-top" data-sort="keterangan" width="50%">Keterangan</th> --}}
                                                        <th class="sort border-top" data-sort="status">Self Assesment</th>
                                                        <th class="sort border-top" data-sort="status">Audit</th>
                                                        <th class="sort border-top" data-sort="status">Status</th>
                                                        <th class="sort align-middle pe-0 border-top" scope="col">
                                                            Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list">
                                                    <?php
                                                    $no = 1;
                                                    ?>
                                                    @foreach($spmiindikators as $spmiindikator)
                                                    @php
                                                    $spmipenilaianindikatorcalc = \App\Models\Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id',@$spmipenilaianprodiId)->where('spmi_indikators_id',$spmiindikator->id)->first();
                                                    @endphp
                                                    <tr>
                                                        <td class="align-middle ps-3 nomor">{{ $no++ }}</td>
                                                        <td class="align-middle fakultas">{{$spmiindikator->kode}}</td>
                                                        <td class="align-middle fakultas">{{$spmiindikator->indikator}} <a class="btn btn-xss" tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Keterangan" data-bs-content="{{$spmiindikator->keterangan}}"><i class="fa fa-info-circle" aria-hidden="true"></i></a></td>
                                                        {{-- <td class="align-middle fakultas">{{$spmiindikator->keterangan}}</td> --}}
                                                        <td class="align-middle fakultas"> {{ number_format(optional($spmipenilaianindikatorcalc)->nilai_prodi, 2) }} </td>
                                                        <td class="align-middle fakultas"> {{ number_format(optional($spmipenilaianindikatorcalc)->nilai_auditor, 2) }} </td>
                                                        <td class="align-middle fakultas">
                                                            @php
                                                            if($spmiindikator->status == 1) {
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-success">Aktif</span>';
                                                            } else {
                                                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-danger">Tidak Aktif</span>';
                                                            }

                                                            @endphp
                                                            {!! $status !!}




                                                        </td>
                                                        <td class="">
                                                            <form method="POST" action="{{ route('penjamupenilaianindikator') }}">
                                                                @csrf
                                                                <input type="hidden" name="spmipenilaianprodiId"
                                                                    value="{{$spmipenilaianprodiId}}">
                                                                <input type="hidden" name="spmiindikatorId"
                                                                    value="{{$spmiindikator->id}}">
                                                                <input type="hidden" name="spmiindikatorsubId"
                                                                    value="{{$spmiindikator->kode}}">
                                                                <button type="submit" class="btn btn-outline-primary col-md-12">
                                                                    Lihat Detail
                                                                </button>
                                                            </form>

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
            </div>
        </div>



    </div>
</div>


@endsection
