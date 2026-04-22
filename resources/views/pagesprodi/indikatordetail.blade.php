@extends('master2')



@section('content')
<style>
    .counter {
        font-size: 14px;
        margin: 4px 0 12px 0;
    }

    .red {
        color: red;
    }

    .green {
        color: green;
    }

    .disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    textarea {
        width: 100%;
        margin-bottom: 5px;
    }

    label {
        font-weight: bold;
    }
</style>
<style>
    fieldset[disabled] .keep-enabled {
        pointer-events: auto !important;
        /* re-enable clicks */
        opacity: 1 !important;
        /* restore full visibility */
    }
</style>
<div class="pb-5">
    <div class="row g-4">
        <div class="col-12">
            <!-- col-xxl-6 -->
            <div class="mb-8">
                <h2 class="mb-2">Elemen {{ $spmiindikator[0]->getSpmielemen->kriteria }}</h2>
                <h5 class="text-700 fw-semi-bold">Indikator {{ $spmiindikator[0]->indikator }}</h5>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12 col-xxl-12">

            <div class="row g-3">
                {{-- Prodi --}}

                <div class="text-start mt-3">
                    <a href="{{ session('penjamuindikator') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                @php
                $cekRoleProdi = (($roleprodi && $spmipenilaianprodi->status <= 2) ? '' : (($roleprodi && $spmipenilaianprodi->status == 10) ? '' : 'disabled')) ;
                    @endphp

                    <fieldset {{ $cekRoleProdi }}>

                        @if($errors->has('errorPenilaianCalculate'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Mohon Maaf',
                                text: "{{ $errors->first('errorPenilaianCalculate') }}",
                                confirmButtonColor: '#d33'
                            });
                        </script>
                        @endif

                        @if(session('successPenilaianCalculate'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: "{{ session('successPenilaianCalculate') }}",
                                confirmButtonColor: '#3085d6'
                            });
                        </script>
                        @endif


                        {{-- Pesan khusus Prodi --}}
                        @if(! $roleprodi)
                        <div class="alert alert-danger mt-3">
                            Anda tidak mempunyai hak akses untuk form Program Studi.
                        </div>
                        @elseif ($spmipenilaianprodi->status > 2)
                        <div class="alert alert-success mt-3">
                            Form Program Studi sudah dikunci.
                        </div>
                        @endif

                        {{-- Pesan jika Prodi belum submit --}}
                        @if((optional($spmipenilaianindikatorcalc)->status ?? 0) < 1)
                            <div class="alert alert-warning mt-3">
                            Form Penilaian ini belum diisi oleh Prodi.
            </div>
            @endif

            <div class="col-12 col-md-12">
                <div class="card mb-5">
                    <div class="card-body">
                        {{-- Data Indikator --}}

                        <div class="row align-items-center g-3">
                            <div class="col-12 col-sm-auto flex-1">
                                <h3 class="fw-bolder mb-2 line-clamp-1">
                                    {{ session()->get('programstudi')->nama_prodi }}
                                </h3>
                                <div class="d-flex align-items-center mb-4">

                                    <h5 class="fw-semi-bold">
                                        <!-- <span class="d-inline-block lh-sm me-1"
                                            data-feather="grid" style="height:16px;width:16px;">
                                        </span> -->
                                        <span
                                            class="d-inline-block lh-sm">{{ session()->get('programstudi')->getFakultas->nama_fakultas }}</span>
                                    </h5>
                                </div>
                                <div class="align-items-center justify-content-between mb-5">
                                    <div class="align-items-center mb-3 mb-md-0 mb-xl-3">
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">

                                            <tbody class="list">
                                                <tr>
                                                    <td class="align-middle elemen">Kode</td>
                                                    <td>:</td>
                                                    <td class="align-middle code">{{$spmiindikator[0]->kode}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle elemen">Indikator</td>
                                                    <td>:</td>
                                                    <td class="align-middle code"><strong>{{$spmiindikator[0]->indikator}}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle elemen">Keterangan</td>
                                                    <td>:</td>
                                                    <td class="align-middle code">{{$spmiindikator[0]->keterangan}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle elemen">Asal</td>
                                                    <td>:</td>
                                                    <td class="align-middle code">{{$spmiindikator[0]->asal}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle elemen">Rumus</td>
                                                    <td>:</td>
                                                    <td class="align-middle code">{{$spmiindikator[0]->rumus}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="align-middle elemen">Tanggal Submit</td>
                                                    <td>:</td>
                                                    <td class="align-middle code"><span id="current-time" style="color:blue;font-weight:bold"></span></td>
                                                </tr>



                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- Data Indikator ENd --}}
                        <div class="row">
                            {{-- Form Indikator --}}
                            <form method="POST" id="formProdi" action="{{ !@$spmipenilaianindikator? route('penjamuindikatordetailposts.store') : route('penjamuindikatordetailposts.update', @$spmipenilaianindikator->id) }}" enctype="multipart/form-data">
                                @csrf
                                @if(@$spmipenilaianindikator)
                                @method('PUT')
                                @endif

                                </br>
                                @if($spmiindikatorsubs->isNotEmpty())
                                <input type="text" id="perhatian" name="perhatian" value="1" hidden>
                                @else
                                <input type="text" id="perhatian" name="perhatian" value="0" hidden>
                                @endif
                                <input type="text" id="spmi_indikators_id" name="spmi_indikators_id" value="{{ $spmiindikator[0]->id }}" hidden>
                                <input type="text" id="spmi_penilaianprodis_id" name="spmi_penilaianprodis_id" value="{{ $spmipenilaianprodi->id }}" hidden>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <p><strong>Upload/Link Pendukung</strong></p>
                                        <div class="col-md-12"><input class="form-control" id="fileupload" name="fileupload" type="file" /></div>
                                        <div class="col-md-12"><input class="form-control" id="link" name="link" type="text" placeholder="https:// atau Drive" value="{{ @$spmipenilaianindikator->link }}" /></div>

                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <p><strong>Preview Berkas</strong></p>
                                        @if(@$spmipenilaianindikator->berkas)
                                        <a href="{{ asset(@$spmipenilaianindikator->berkas) }}" target="_blank">
                                            {{ basename(@$spmipenilaianindikator->berkas) }}
                                        </a>
                                        @else
                                        <span class="text-muted fst-italic">(Belum ada berkas)</span>
                                        @endif

                                        <p><strong>Preview Link</strong></p>
                                        @if(@$spmipenilaianindikator->link)
                                        <a href="{{ $spmipenilaianindikator->link }}" target="_blank" class="btn btn-primary btn-sm keep-enabled">
                                            <i class="fa fa-link"></i> Link Pendukung
                                        </a><br>
                                        <span class="text-danger small">mohon memastikan link memiliki https:// atau http:// pada bagian depan dan dapat diakses</span>
                                        @else
                                        <span class="text-muted fst-italic">(Belum ada Link)</span>
                                        @endif

                                    </div>
                                    <script>
                                        document.querySelectorAll('.keep-enabled').forEach(link => {
                                            const url = link.getAttribute('href');
                                            const isValid = /^https?:\/\//i.test(url); // check starts with http:// or https://

                                            if (!isValid) {
                                                link.removeAttribute('href'); // remove invalid href
                                                link.style.pointerEvents = "none"; // block click
                                                link.style.opacity = "0.5"; // make it look disabled
                                                link.style.cursor = "not-allowed"; // show disabled cursor
                                            }
                                        });
                                    </script>

                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="basic-form-textarea">Keterangan Tambahan (Prodi)</label>
                                        <textarea class="form-control" id="message1" name="catatan_prodi" rows="6" placeholder="Description">{{ @$spmipenilaianindikator->catatan_prodi }}</textarea>
                                        <p class="counter red">0 / 50 characters (minimum)</p>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="basic-form-textarea">Akar masalah</label>
                                        <textarea class="form-control" id="message2" rows="6" placeholder="Description" name="akar_masalah_temuan">{{ @$spmipenilaianindikator->akar_masalah_temuan }}</textarea>
                                        <p class="counter red">0 / 50 characters (minimum)</p>
                                    </div>
                                </div>





                                <br><br>
                                <div class="row text-center">
                                    @if(!@$spmipenilaianindikator )
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" class="disabled" disabled>Simpan Penilaian</a>
                                    </div>
                                    @else
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success" class="disabled" disabled>Update Penilaian</a>
                                    </div>
                                    @endif
                                </div>
                                <br>
                            </form>

                            {{-- Form Indikator End--}}

                            @if(($spmiindikator[0]->getIndikatorkualitatif)->isNotEmpty() || count(@$spmiindikator[0]->getIndikatorkomponen)>= 1)
                            @include("pagesprodi.kuantitatif.prodi")
                            @endif
                            {{-- Form Prodi Sub --}}
                            @if($spmiindikatorsubs->isNotEmpty())
                            @include("pagesprodi.kuantitatif.prodisub")
                            @endif
                            {{-- Form Prodi Sub End --}}


                            {{-- Calculation --}}
                            @if(@$spmipenilaianindikator || @$spmipenilaianindikatorcalc)
                            <div class="row mt-3 align-items-center">
                                <div class="col-md-6 d-flex justify-content-end">
                                    @php
                                    // rubah lembagas_id & route
                                    // if ($spmipenilaianprodi->lembagas_id == 2) {
                                    // $routeAction = 'null';
                                    // } elseif ($spmipenilaianprodi->lembagas_id == 3) {
                                    // $routeAction = 'null';
                                    // }elseif ($spmipenilaianprodi->lembagas_id == 4) {
                                    // $routeAction = 'null';
                                    // }elseif ($spmipenilaianprodi->lembagas_id == 5) {
                                    // $routeAction = 'null';
                                    // }elseif ($spmipenilaianprodi->lembagas_id == 6) {
                                    // $routeAction = 'null';
                                    // }
                                    if ($spmipenilaianprodi->lembagas_id == 7) {
                                    $routeAction = 'penilaiancalculatelamteknik';
                                    }
                                    // elseif ($spmipenilaianprodi->lembagas_id == 8) {
                                    // $routeAction = 'null';
                                    // }elseif ($spmipenilaianprodi->lembagas_id == 9) {
                                    // $routeAction = 'null';
                                    // }
                                    elseif ($spmipenilaianprodi->lembagas_id == 10) {
                                    $routeAction = 'v2.penilaiancalculatelamteknik';
                                    } else {
                                    $routeAction = 'penilaiancalculate';
                                    }
                                    @endphp

                                    <form method="POST" action="{{ route($routeAction) }}">
                                        @csrf
                                        <input type="text" id="spmi_penilaianprodis_id" name="spmi_penilaianprodis_id" value="{{ $spmipenilaianprodi->id }}" hidden>
                                        <input type="text" id="spmipenilaianindikator_id" name="spmipenilaianindikator_id" value="{{ @$spmipenilaianindikator->id }}" hidden>
                                        <input type="text" id="spmi_indikators_id" name="spmi_indikators_id" value="{{ $spmipenilaianindikator->spmi_indikators_id }}" hidden>
                                        <input type="text" id="spmi_indikators_kode" name="spmi_indikators_kode" value="{{ $spmiindikator[0]->kode }}" hidden>
                                        <button type="submit" class="btn btn-primary">Hitung Nilai Indikator Prodi</button>
                                    </form>
                                </div>
                                <div class="col-md-6 d-flex justify-content-start">
                                    <div class="bg-light border rounded-3 px-4 py-3 shadow-sm text-center">
                                        <small class="text-muted d-block">Nilai Prodi</small>
                                        <strong>{{ is_numeric(optional($spmipenilaianindikatorcalc)->nilai_prodi) ? number_format(optional($spmipenilaianindikatorcalc)->nilai_prodi, 2) : 'Belum ada nilai' }}</strong>
                                    </div>
                                </div>
                            </div>
                            @endif
                            {{-- Calculation End --}}
                        </div>
                        </fieldset>
                    </div>
                </div>
                {{-- Prodi End --}}
            </div>
            @php
            // $cekRoleAuditor=$roleauditor ? '' : 'disabled' ;
            $cekRoleAuditor= (!empty($roleauditor) && isset($spmipenilaianprodi->status) && $spmipenilaianprodi->status >= 6) ? '' : 'disabled';
            @endphp

            <fieldset {{ $cekRoleAuditor }}>
                {{-- Pesan khusus Auditor --}}
                @if(! $roleauditor)
                <div class="alert alert-danger mt-3">
                    Anda tidak mempunyai hak akses untuk form Auditor.
                </div>
                @elseif ($spmipenilaianprodi->status < 6)
                    <div class="alert alert-danger mt-3">
                    Auditor belum ditugaskan.
        </div>
        @endif


        <div class="col-12 col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row align-items-center g-3">
                        <div class="col-12 col-sm-auto flex-1">
                            <h3 class="fw-bolder mb-2 line-clamp-1">
                                Auditor Prodi [{{ session()->get('programstudi')->nama_prodi }}]</h3>
                            <div class="d-flex align-items-center mb-4">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="fw-semi-bold d-flex align-items-center mb-3">
                                            <span data-feather="users" class="me-2" style="width:16px; height:16px;"></span>
                                            <span>Daftar Auditor</span>
                                        </h5>

                                        <ul class="list-group">
                                            @forelse($auditorUsers ?? [] as $auditor)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $auditor->name }}
                                                <span class="ms-2 badge bg-secondary">ID: {{ $auditor->id }}</span>
                                            </li>
                                            @empty
                                            <li class="list-group-item text-muted">
                                                Belum ada Auditor.
                                            </li>
                                            @endforelse
                                        </ul>

                                    </div>
                                </div>

                            </div>
                            <div class="d-md-flex d-xl-block align-items-center justify-content-between mb-5">
                                <div class="d-flex align-items-center mb-3 mb-md-0 mb-xl-3">
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <form method="POST" id="formAudit" action="{{ route('auditindikatordetailposts.update', !@$spmipenilaianindikator ? '' : @$spmipenilaianindikator->id ) }}">
                            @csrf
                            @method('PUT')

                            <div class="col-md-6">

                                <table class="table table-striped table-sm fs--1 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="sort border-top" data-sort="Kode" width="10%">Kode</th>
                                            <th class="sort border-top" data-sort="Kategori">Kategori
                                            </th>
                                            <th class="sort border-top align-middle" width="10%"
                                                data-sort="checklist">
                                                Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        <?php
                                        $no = 1;
                                        ?>
                                        @foreach($spmikategorijenistemuans as $spmikategorijenistemuan)
                                        <tr>
                                            <td class="align-middle ps-3 nomor">
                                                {{ $spmikategorijenistemuan->kode }}
                                            </td>
                                            <td class="align-middle elemen">
                                                {{$spmikategorijenistemuan->kategori}} <a class="btn btn-xss" tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Keterangan" data-bs-content="{{$spmikategorijenistemuan->keterangan}}"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                            </td>
                                            <td><input type="radio"
                                                    id="spmi_kategorijenistemuans_id"
                                                    name="spmi_kategorijenistemuans_id"
                                                    value="{{ $spmikategorijenistemuan->id }}" <?= (@$spmipenilaianindikator->spmi_kategorijenistemuans_id === $spmikategorijenistemuan->id) ? 'checked' : '' ?>></td>

                                        </tr>
                                        {{-- {{ @$spmipenilaianindikator->spmi_kategorijenistemuans_id }}
                                        {{ $spmikategorijenistemuan->id }} --}}
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-form-textarea">Deskripsi (PLOR statement)</label>
                                    <textarea class="form-control" id="message1" rows="6" placeholder="Description" name="deskripsi_temuan">{{ @$spmipenilaianindikator->deskripsi_temuan }}</textarea>
                                    <p class="counter red">0 / 50 characters (minimum)</p>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-form-textarea">Permintaan Tindakan Korektif / Rekomendasi</label>
                                    <textarea class="form-control" id="message2" rows="6" placeholder="Description" name="rekomendasi_temuan">{{ @$spmipenilaianindikator->rekomendasi_temuan }}</textarea>
                                    <p class="counter red">0 / 50 characters (minimum)</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-form-textarea">Apresiasi (Terhadap Pelampauan)</label>
                                    <textarea class="form-control" id="message3" rows="6" placeholder="Description" name="apresiasi_pelampauan">{{ @$spmipenilaianindikator->apresiasi_pelampauan }}</textarea>
                                    <p class="counter red">0 / 50 characters (minimum)</p>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="basic-form-textarea">Dampak/Risiko dari adanya temuan</label>
                                    <textarea class="form-control" id="message4" rows="6" placeholder="Description" name="dampak_temuan">{{ @$spmipenilaianindikator->dampak_temuan }}</textarea>
                                    <p class="counter red">0 / 50 characters (minimum)</p>
                                </div>
                                <input type="hidden"
                                    name="akar_masalah_temuan"
                                    value="{{ old('akar_masalah_temuan', @$spmipenilaianindikator->akar_masalah_temuan) }}">
                            </div>

                            <br>
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success" class="disabled" disabled>Simpan Audit</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            (function() {
                                const MIN_LENGTH = 50;

                                function initForm(form) {
                                    const textareas = form.getElementsByTagName('textarea');
                                    const submitBtns = form.querySelectorAll('button[type="submit"]');

                                    function validateForm() {
                                        let allValid = true;
                                        Array.from(textareas).forEach((ta) => {
                                            if (ta.value.length < MIN_LENGTH) {
                                                allValid = false;
                                            }
                                        });
                                        submitBtns.forEach((btn) => {
                                            btn.disabled = !allValid;
                                            btn.classList.toggle('disabled', !allValid);
                                        });
                                    }

                                    Array.from(textareas).forEach((ta) => {
                                        const counter = ta.nextElementSibling;

                                        function updateCounter() {
                                            const count = ta.value.length;
                                            counter.textContent = `${count} / ${MIN_LENGTH} characters (minimum)`;
                                            counter.classList.toggle('red', count < MIN_LENGTH);
                                            counter.classList.toggle('green', count >= MIN_LENGTH);
                                            validateForm();
                                        }
                                        ta.addEventListener('input', updateCounter);
                                        updateCounter(); // jalan pertama kali saat load
                                    });
                                }

                                // apply ke semua form yg punya textarea + counter
                                document.querySelectorAll('form').forEach(initForm);

                            })();
                        </script>
                        @if(($spmiindikator[0]->getIndikatorkualitatif)->isNotEmpty() || count(@$spmiindikator[0]->getIndikatorkomponen)>= 1)
                        @include("pagesprodi.kuantitatif.auditor")
                        @endif
                        @if($spmiindikatorsubs->isNotEmpty())
                        @include("pagesprodi.kuantitatif.auditorsub")
                        @endif
                        <div class="row mt-3 mb-4 align-items-center">
                            <div class="col-md-6 d-flex justify-content-end">
                                @php
                                // rubah lembagas_id & route
                                // if ($spmipenilaianprodi->lembagas_id == 2) {
                                // $routeAction = 'null';
                                // } elseif ($spmipenilaianprodi->lembagas_id == 3) {
                                // $routeAction = 'null';
                                // } elseif ($spmipenilaianprodi->lembagas_id == 4) {
                                // $routeAction = 'null';
                                // } elseif ($spmipenilaianprodi->lembagas_id == 5) {
                                // $routeAction = 'null';
                                // } elseif ($spmipenilaianprodi->lembagas_id == 6) {
                                // $routeAction = 'null';
                                // }
                                if ($spmipenilaianprodi->lembagas_id == 7) {
                                $routeAction = 'penilaiancalculatelamteknik';
                                }
                                // elseif ($spmipenilaianprodi->lembagas_id == 8) {
                                // $routeAction = 'null';
                                // } elseif ($spmipenilaianprodi->lembagas_id == 9) {
                                // $routeAction = 'null';
                                // }
                                elseif ($spmipenilaianprodi->lembagas_id == 10) {
                                $routeAction = 'v2.penilaiancalculatelamteknik';
                                } else {
                                $routeAction = 'penilaiancalculate';
                                }
                                @endphp

                                <form method="POST" action="{{ route($routeAction) }}">
                                    @csrf
                                    <input type="text" id="spmi_penilaianprodis_id" name="spmi_penilaianprodis_id" value="{{ $spmipenilaianprodi->id }}" hidden>
                                    <input type="text" id="spmipenilaianindikator_id" name="spmipenilaianindikator_id" value="{{ @$spmipenilaianindikator->id }}" hidden>
                                    <input type="text" id="spmi_indikators_id" name="spmi_indikators_id" value="{{ @$spmipenilaianindikator->spmi_indikators_id }}" hidden>
                                    <input type="text" id="spmi_indikators_kode" name="spmi_indikators_kode" value="{{ $spmiindikator[0]->kode }}" hidden>
                                    <button type="submit" class="btn btn-primary">Hitung Nilai Indikator Auditor</button>
                                </form>
                            </div>
                            <div class="col-md-6 d-flex justify-content-start">
                                <!-- <div class="border rounded d-inline-flex px-3 py-2" id="spmi_penilaianprodis_nilaiprodi"> -->
                                <div class="bg-light border rounded-3 px-4 py-3 shadow-sm text-center">
                                    <small class="text-muted d-block">Nilai Auditor</small>
                                    <strong>{{ is_numeric(optional(@$spmipenilaianindikatorcalc)->nilai_auditor) ? number_format(optional(@$spmipenilaianindikatorcalc)->nilai_auditor, 2) : 'Belum ada nilai' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </fieldset>
        </div>

        {{-- Pesan jika bukan Prodi & bukan Auditor --}}
        @if(!$roleprodi && !$roleauditor)
        <div class="alert alert-danger mt-3">
            Anda tidak mempunyai hak akses untuk melihat seluruh form di atas.
        </div>
        @endif


        </script>
        {{-- add scroll back to position --}}
        <script>
            // Simpan posisi scroll sebelum reload
            window.addEventListener("beforeunload", function() {
                localStorage.setItem("scrollPos", window.scrollY);
            });

            // Scroll ke posisi sebelumnya saat reload
            window.addEventListener("load", function() {
                const scrollPos = localStorage.getItem("scrollPos");
                if (scrollPos) {
                    window.scrollTo(0, parseInt(scrollPos));
                }
            });
        </script>

    </div>

    <script>
        function updateTime() {
            const now = new Date();
            const yyyy = now.getFullYear();
            const mm = String(now.getMonth() + 1).padStart(2, '0');
            const dd = String(now.getDate()).padStart(2, '0');
            const hh = String(now.getHours()).padStart(2, '0');
            const mi = String(now.getMinutes()).padStart(2, '0');
            const ss = String(now.getSeconds()).padStart(2, '0');
            const formatted = `${yyyy}-${mm}-${dd} ${hh}:${mi}:${ss}`;
            document.getElementById('current-time').textContent = formatted;
        }

        updateTime();
        setInterval(updateTime, 1000);
    </script>




    @endsection