@extends('master')

@section('content')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<h2 class="mb-2 lh-sm">SPMI INDIKATOR DETAIL</h2>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-12">
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-secondary">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-12 col-md">
                                <h4 class="text-900 mb-0 text-white dark__text-100" data-anchor="data-anchor">Detail
                                    SPMI Indikator</h4>
                                <p class="mb-0 mt-2 text-800 text-white dark__text-100">Daftar <code>Indikator
                                    </code> SPMI</p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="sort border-top ps-3" data-sort="nomor">No</th>
                                            <th class="sort border-top" data-sort="elemen">Detail</th>
                                            <th class="sort border-top" data-sort="code">Keterangan</th>

                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <tr>
                                            <td class="align-middle ps-3 nomor">1</td>
                                            <td class="align-middle elemen">Kode</td>
                                            <td class="align-middle code">{{$spmiindikator->kode}}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle ps-3 nomor">2</td>
                                            <td class="align-middle elemen">Indikator</td>
                                            <td class="align-middle code">{{$spmiindikator->indikator}}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle ps-3 nomor">3</td>
                                            <td class="align-middle elemen">Keterangan</td>
                                            <td class="align-middle code">{{$spmiindikator->keterangan}}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle ps-3 nomor">4</td>
                                            <td class="align-middle elemen">Asal</td>
                                            <td class="align-middle code">{{$spmiindikator->asal}}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle ps-3 nomor">5</td>
                                            <td class="align-middle elemen">Rumus</td>
                                            <td class="align-middle code">{{$spmiindikator->rumus}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <p class="mb-0 mt-2 text-800">Indikator <code>Komponen</code></p>
                            <a href="" class="btn btn-outline-primary">Tambah</a>
                            @if(($spmiindikator->getIndikatorkomponen)->isNotEmpty())
                            <table class="table table-striped table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th class="sort border-top" data-sort="no">No</th>
                                        <th class="sort border-top" data-sort="elemen">Komponen</th>
                                        <th class="sort border-top" data-sort="keterangan">Keterangan</th>
                                        <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                            Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php
                                                $no = 1;
                                            ?>


                                    @foreach($spmiindikator->getIndikatorkomponen as $spmiindikatorkomponen)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td class="align-middle ps-3 nomor">{{ $spmiindikatorkomponen->komponen }}
                                        </td>
                                        <td class="align-middle elemen">{{$spmiindikatorkomponen->keterangan}}</td>
                                        <td><a href="" class="btn btn-outline-primary">Edit</a></td>

                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            @endif

                            <p class="mb-0 mt-2 text-800">Indikator <code>Penilaian</code></p>
                            <a href="" class="btn btn-outline-primary">Tambah</a>
                            @if(($spmiindikator->getIndikatorkualitatif)->isNotEmpty())
                            <table class="table table-striped table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th class="sort border-top" data-sort="elemen">Nilai</th>
                                        <th class="sort border-top" data-sort="keterangan">Keterangan</th>
                                        <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                            Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php
                                                $no = 1;
                                            ?>
                                    @foreach($spmiindikator->getIndikatorkualitatif as $spmiindikatorkualitatif)
                                    <tr>
                                        <td class="align-middle ps-3 nomor">{{ $spmiindikatorkualitatif->nilai }}
                                        </td>
                                        <td class="align-middle elemen">{{$spmiindikatorkualitatif->keterangan}}
                                        </td>
                                        <td><a href="" class="btn btn-outline-primary">Edit</a></td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @endif
                            <br>
                        </div>
                    </div>
                </div>
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-secondary">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-12 col-md">
                                <h4 class="text-900 mb-0 text-white dark__text-100" data-anchor="data-anchor">
                                    Detail Sub Indikator</h4>
                                <p class="mb-0 mt-2 text-800 text-white dark__text-100">Daftar <code>SPMI
                                        Sub Indikator</code> SPMI</p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">
                            <p class="mb-0 mt-2 text-800">Sub <code>Indikator</code></p>
                            <a href="" class="btn btn-outline-primary">Tambah</a>
                            {{-- @if($spmiindikatorsubs === []) --}}
                            <?php
                                        $no = 1;
                                    ?>
                            @foreach($spmiindikatorsubs as $spmiindikatorsub)
                            <table class="table table-striped table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th class="sort border-top" data-sort="elemen">Kode</th>
                                        <th class="sort border-top" data-sort="keterangan">Indikator Sub</th>
                                        <th class="sort border-top" data-sort="keterangan">Keterangan</th>
                                        <th class="sort border-top" data-sort="keterangan">Rumus</th>
                                        <th class="sort border-top" data-sort="keterangan">Status</th>
                                        <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                            Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">

                                    <tr>
                                        <td class="align-middle ps-3 nomor">{{ $spmiindikatorsub->kode }}</td>
                                        <td class="align-middle elemen">{{$spmiindikatorsub->indikatorsub}}</td>
                                        <td class="align-middle elemen">{{$spmiindikatorsub->keterangan}}</td>
                                        <td class="align-middle elemen">{{$spmiindikatorsub->rumus}}</td>
                                        <td class="align-middle status">
                                            @php
                                            if($spmiindikatorsub->status == 1) {
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
                                        <td><a href="" class="btn btn-outline-primary">Edit</a></td>

                                    </tr>
                                </tbody>
                            </table>

                            <br><br>
                            <p class="mb-0 mt-2 text-800">Indikator Sub <code>Komponen</code></p>
                            <a href="" class="btn btn-outline-primary">Tambah</a>
                            @if(($spmiindikatorsub->getKomponen)->isNotEmpty() )
                            <table class="table table-striped table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th class="sort border-top" data-sort="no">No</th>
                                        <th class="sort border-top" data-sort="elemen">Komponen</th>
                                        <th class="sort border-top" data-sort="keterangan">Keterangan
                                        </th>
                                        <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                            Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php
                                                        $no = 1;
                                                    ?>

                                    @foreach($spmiindikatorsub->getKomponen as $spmiindikatorsubskomponen)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td class="align-middle ps-3 nomor">
                                            {{ $spmiindikatorsubskomponen->komponen }}</td>
                                        <td class="align-middle elemen">
                                            {{ $spmiindikatorsubskomponen->keterangan}}</td>
                                        <td><a href="" class="btn btn-outline-primary">Edit</a></td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @endif

                            <br><br>
                            <p class="mb-0 mt-2 text-800">Indikator Sub <code>Penilaian</code></p>
                            <a href="" class="btn btn-outline-primary">Tambah</a>
                            @if(($spmiindikatorsub->getKualitatif)->isNotEmpty())
                            <table class="table table-striped table-sm fs--1 mb-0">
                                <thead>
                                    <tr>
                                        <th class="sort border-top" data-sort="elemen">Nilai</th>
                                        <th class="sort border-top" data-sort="keterangan">Keterangan
                                        </th>
                                        <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                            Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php
                                                        $no = 1;
                                                    ?>
                                    @foreach($spmiindikatorsub->getKualitatif as $spmiindikatorkualitatif)
                                    <tr>
                                        <td class="align-middle ps-3 nomor">
                                            {{ $spmiindikatorkualitatif->nilai }}</td>
                                        <td class="align-middle elemen">
                                            {{$spmiindikatorkualitatif->keterangan}}</td>
                                        <td><a href="" class="btn btn-outline-primary">Edit</a></td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @endif
                            </tbody>

                            @endforeach
                            {{-- @endif --}}



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
