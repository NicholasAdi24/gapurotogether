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
<style>
.table-compact {
    border: 1px solid #0d6efd;
    border-collapse: collapse;
    width: 100%;
    font-size: 0.75rem; /* smaller text */
    background-color: #f8fbff;
    border-radius: 0.5rem;
    overflow: hidden;
}

.table-compact th {
    background-color: #0d6efd;
    color: white;
    text-align: center;
    font-weight: 600;
    padding: 6px;
    border: 1px solid #0d6efd;
}

.table-compact td {
    border: 1px solid #0d6efd;
    padding: 4px 6px;
    vertical-align: middle;
}

.table-compact tr:nth-child(even) {
    background-color: #f1f7ff;
}

.table-compact td:first-child {
    text-align: center;
    width: 70px;
    font-weight: 600;
}

.table-compact td:nth-child(2) {
    width: 100px;
    font-weight: 500;
}

.badge-level {
    background-color: #e7f1ff;
    color: #0d6efd;
    font-weight: 500;
    padding: 3px 6px;
    border-radius: 0.25rem;
    font-size: 0.75rem;
}

fieldset[disabled] a {
  pointer-events: auto !important;
  opacity: 1 !important;
}
</style>
<div class="pb-5">
    <div class="row g-4">
        <div class="col-12">
            <!-- col-xxl-6 -->
            <div class="mb-8">
                <h2 class="mb-2">Indikator {{ $spmipenilaianindikatorcalc->indikator->kriteria }}</h2>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-12 col-xxl-12">

            <div class="row g-3">
                {{-- Prodi --}}

                <div class="text-start mt-3">
                    <a href="{{ session('rtldetail') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                @php
                $cekRoleProdi = (($roleprodi && (@$spmirtl->persetujuan == 'Submission' || @$spmirtl->persetujuan == 'Needs to be Revisited' ||  @$spmirtl->persetujuan == 'Disapproved' )) || !isset($spmirtl->persetujuan) ? '' : 'disabled') ;
                @endphp

                {{-- <fieldset {{ $cekRoleProdi }}> --}}

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

                    @endif

                    {{-- Pesan jika Prodi belum submit --}}


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
                                        <div
                                            class="align-items-center justify-content-between mb-5">
                                            <div class="align-items-center mb-3 mb-md-0 mb-xl-3">
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table table-striped">

                                                    <tbody class="list">
                                                        <tr>
                                                            <td class="align-middle elemen">Kode</td>
                                                            <td>:</td>
                                                            <td class="align-middle code">
                                                                {{$spmipenilaianindikatorcalc->indikator->kode}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle elemen">Indikator</td>
                                                            <td>:</td>
                                                            <td class="align-middle code">
                                                                <strong>{{$spmipenilaianindikatorcalc->indikator->indikator}}</strong>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="align-middle elemen">Nilai Assesment</td>
                                                            <td>:</td>
                                                            <td class="align-middle code">
                                                                <strong>
                                                                    <span
                                                                        class="badge badge-phoenix badge-phoenix-success">Prodi
                                                                        :
                                                                        {{ number_format(@$spmipenilaianindikatorcalc->nilai_prodi,2) }}</span>
                                                                    <br>
                                                                    <span
                                                                        class="badge badge-phoenix badge-phoenix-danger">Auditor
                                                                        :
                                                                        {{ number_format(@$spmipenilaianindikatorcalc->nilai_auditor,2) }}</span>
                                                                </strong>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td class="align-middle elemen">Tanggal Submit</td>
                                                            <td>:</td>
                                                            <td class="align-middle code"><span id="current-time"
                                                                    style="color:blue;font-weight:bold"></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Data Penjamu</td>
                                                            <td>:</td>
                                                            <td><a href="{{ route('penjamuindikatordetail', ['id' => $spmipenilaianindikatorcalc->indikator->id ?? 0]) }}" class="btn btn-outline-success" target="_blank">
                                                                    <i class="fa fa-file" aria-hidden="true"></i> Lihat Data
                                                                </a>
                                                            </td>
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
                                    <form method="POST" id="formProdis"
                                        action="{{ !@$spmirtl? route('rtlposts.store') : route('rtlposts.update', @$spmirtl->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($spmirtl))
                                            @method('PUT')
                                        @endif

                                        </br>

                                        <style>
  .mini-label {
    display: inline-block;   /* biar gak full width */
    background: #656b7b;     /* warna biru */
    color: #fff;
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 4px;
    margin-bottom: 4px;
    white-space: nowrap;
  }
</style>

                                        <input type="text" id="spmi_penilaianindikatorcalc_id"
                                            name="spmi_penilaianindikatorcalc_id"
                                            value="{{ @$spmipenilaianindikatorcalc->id }}" hidden>

                                        <input type="text" id="spmi_rtl_id" name="spmi_rtl_id"
                                            value="{{ @$spmi_rtl->id }}" hidden>
                                <fieldset {{ $cekRoleProdi }}>
                                        <div class="row">
                                            <p><strong>Program Kerja</strong></p>
                                            <div class="mb-6 col-md-12">
                                                <span class="mini-label">Program Kerja yg sudah dilaksanakan terkait Subindikator ini</span>
                                                <br><br>
                                                <textarea class="form-control" id="programkerja" rows="6"
                                                    placeholder="Description"
                                                    name="programkerja" required>{{ @$spmirtl->program_kerja }}</textarea>
                                                <p class="counter red">0 / 50 characters (minimum)</p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <p><strong>Target</strong></p>
                                                <div class="col-md-12">
                                                    <input class="form-control" name="target" type="text"
                                                        placeholder="Target" value="{{ @$spmirtl->target }}" required />
                                                </div>
                                                <p><strong>Capaian</strong></p>
                                                <div class="col-md-12">
                                                    <input class="form-control" name="capaian"
                                                        type="text" placeholder="Capaian" value="{{ @$spmirtl->capaian }}" required />
                                                </div>

                                            </div>
                                            <script>
                                            // const targetInput = document.getElementById('targetInput');
                                            // const capaianInput = document.getElementById('capaianInput');

                                            // function enforceLimit(input) {
                                            //     input.addEventListener('input', function () {
                                            //         if (this.value > 100) this.value = 100; // limit max
                                            //         if (this.value < 0) this.value = 0;     // limit min
                                            //     });
                                            // }

                                            // enforceLimit(targetInput);
                                            // enforceLimit(capaianInput);
                                            </script>
                                            <div class="mb-3 col-md-6">
                                                <p><strong>Satuan</strong><label class="form-label" for="">(dipergunakan untuk Target dan Capaian)</label></p>

                                                <div class="col-md-12">
                                                <input class="form-control" id="satuan" name="satuan"
                                                        type="text" placeholder="Prosentase / Rupiah / (Rupiah/Dosen/Mahasiswa) / etc"  value="{{ @$spmirtl->satuan }}" required/>
                                                </div>
                                            </div>



                                        </div>


                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="basic-form-textarea">
                                                    Deskripsi Resiko / Dampak <a class="btn btn-xss" tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Keterangan" data-bs-content="Contoh dampak dan program mitigasi dari temuan indikator ini, dapat dilihat pada Buku Standar Manajemen Risiko Indikator"><i class="fa fa-info-circle" aria-hidden="true"></i></a>

                                                </label>
                                                <textarea class="form-control" id="message1" name="deskripsi_risiko"
                                                    rows="6"
                                                    placeholder="Description" required>{{ @$spmirtl->deskripsi_risiko }}</textarea>
                                                <p class="counter red">0 / 50 characters (minimum)</p>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="basic-form-textarea">Pengendalian yang Sudah Dilakukan</label>
                                                <textarea class="form-control" id="message2" rows="6"
                                                    placeholder="Description"
                                                    name="pengendalian" required>{{ @$spmirtl->pengendalian }}</textarea>
                                                <p class="counter red">0 / 50 characters (minimum)</p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="basic-form-textarea">Analisis Penyebab / Akar Masalah</label>
                                                <textarea class="form-control" id="message1" name="akar_masalah"
                                                    rows="6"
                                                    placeholder="Description" required>{{ @$spmirtl->akar_masalah }}</textarea>
                                                <p class="counter red">0 / 50 characters (minimum)</p>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="basic-form-textarea">
                                                    Rencana Tindak Lanjut / Program Kerja untuk Mitigasi Risiko <a class="btn btn-xss" tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Keterangan" data-bs-content="Contoh dampak dan program mitigasi dari temuan indikator ini, dapat dilihat pada Buku Standar Manajemen Risiko Indikator"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
                                                </label>
                                                <textarea class="form-control" id="message2" rows="6"
                                                    placeholder="Description"
                                                    name="rtl" required>{{ @$spmirtl->rtl }}</textarea>
                                                <p class="counter red">0 / 50 characters (minimum)</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="alert alert-soft-info" role="alert">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">

                                                        <table class="table-compact">
                                                            <tr>
                                                                <td colspan="3">Probability</td>
                                                            </tr>
                                                            @foreach($spmirtlprob as $prob)
                                                            <tr>
                                                                <td>{{ $prob->nilai }}</td>
                                                                <td>{{ $prob->kategori }}</td>
                                                                <td>{{ $prob->keterangan }}</td>
                                                            </tr>
                                                            @endforeach


                                                        </table>
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <table class="table-compact">
                                                            <tr>
                                                                <td colspan="3">Severity</td>
                                                            </tr>
                                                            @foreach($spmirtlsever as $sever)
                                                            <tr>
                                                                <td>{{ $sever->nilai }}</td>
                                                                <td>{{ $sever->kategori }}</td>
                                                                <td>{{ $sever->keterangan }}</td>
                                                            </tr>
                                                            @endforeach


                                                        </table>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-6 col-md-12">

                                                        <table class="table-compact">
                                                            <tr>
                                                                <td colspan="3">Nilai Resiko (Probability x Severity)</td>
                                                            </tr>
                                                            <tr>
                                                                <td>1-5</td>
                                                                <td>Rendah</td>
                                                                <td>Tidak diperlukan tambahan tindakan pengendalian risiko</td>
                                                            </tr>
                                                            <tr>
                                                                <td>6-15</td>
                                                                <td>Sedang</td>
                                                                <td>Perlu tindakan untuk mengurangi resiko</td>
                                                            </tr>
                                                            <tr>
                                                                <td>16-25</td>
                                                                <td>Tinggi</td>
                                                                <td>Tindakan untuk mengurangi risiko harus mendapat persetujuan pimpinan</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            @php
                                                $prob = \App\Models\Spmirtlprob::where('status',1)->get();
                                                $sever = \App\Models\Spmirtlsever::where('status',1)->get();
                                            @endphp
                                            <div class="mb-3 col-md-6">
                                                <p><strong>Probability (Kemungkinan Terjadi) (1-5)</strong></p>
                                                <div class="col-md-12">
                                                    <select id="kategori_risiko" class="form-select" id="basic-form-role" aria-label="Default select example" name="probability">
                                                        <option>Select Probability</option>
                                                        @foreach ($prob as $p)
                                                            <option value="{{ $p->id }}" {{ old('probability', @$spmirtl->probability) == $p->id ? 'selected' : '' }}>
                                                                {{ $p->kategori }} ({{ $p->nilai }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p><strong>Severity (Tingkat Keparahan Dampak)</strong></p>
                                                <div class="col-md-12">
                                                    <select id="kategori_risiko" class="form-select" id="basic-form-role" aria-label="Default select example" name="severity">
                                                        <option>Select Severity</option>
                                                        @foreach ($sever as $s)
                                                            <option value="{{ $s->id }}" {{ old('severity', @$spmirtl->severity) == $s->id ? 'selected' : '' }}>
                                                                {{ $s->kategori }} ({{ $s->nilai }})
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                            </div>


                                            <div class="mb-3 col-md-6">
                                                @php
                                                    $risikos = [
                                                        'Risiko Strategis',
                                                        'Risiko Operasional',
                                                        'Risiko Keuangan',
                                                        'Risiko Kepatuhan',
                                                        'Risiko Kecurangan',
                                                    ];
                                                @endphp
                                                <p><strong>Kategori Resiko</strong></p>
                                                <div class="col-md-12">
                                                    <select id="kategori_risiko" class="form-select" id="basic-form-role" aria-label="Default select example" name="kategori_risiko" required>
                                                        <option disabled>Select Kategori</option>
                                                        @foreach($risikos as $risiko)
                                                            <option value="{{ $risiko }}" {{ @$spmirtl->kategori_risiko == $risiko ? 'selected' : '' }}>
                                                                {{ $risiko }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <p><strong>Rencana Sumber Anggaran <a class="btn btn-xss" tabindex="0" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Keterangan" data-bs-content="RKAT, Hibah, Kerjasama dll"><i class="fa fa-info-circle" aria-hidden="true"></i></a></strong></p>
                                                <div class="col-md-12">
                                                    <input class="form-control" id="anggaran" name="anggaran" type="text"
                                                        placeholder="RKAT, Hibah, Kerjasama dll" value="{{ @$spmirtl->anggaran }}" required/>

                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <p><strong>Upload Bukti Rencana Sumber Dana</strong> <span class="mini-label">Screen shot (SS) Bagian RKAT, SS RAB, SS Proposal</span></p>

                                                <div class="col-md-12">
                                                    <input class="form-control" id="bukti" name="bukti" type="file"
                                                        placeholder="" {{ @$spmirtl->bukti ? '' : 'required'}}/>
                                                    @if(@$spmirtl->bukti)
                                                        <a class="btn btn-success" id="buktiaktif" href="{{ asset(@$spmirtl->bukti) }}" target="_blank">
                                                            <i class="fa fa-file" aria-hidden="true"></i> Sumber Dana
                                                        </a>
                                                    @else
                                                        <span class="text-muted fst-italic">(Belum ada berkas)</span>
                                                    @endif

                                                </div>


                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <p><strong>PIC</strong></p>
                                                <div class="col-md-12">
                                                <input class="form-control" id="pic" name="pic"
                                                        type="text" placeholder="Person in Charge"  value="{{ @$spmirtl->pic }}" required/>
                                                </div>


                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <p><strong>Target Selesai</strong></p>
                                                <div class="col-md-12">
                                                    <input class="form-control" id="target_selesai" name="target_selesai"
                                                        type="text" placeholder="Target Selesai" value="{{ @$spmirtl->selesai }}" required/>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                        <div class="mb-6 col-md-12">


                                            <p><strong>Persetujuan</strong></p>
                                            <div class="col-md-12">
                                                @if(@$roledekan )
                                                <input class="form-control" id="roledekan" name="roledekan"
                                                        type="hidden" placeholder="Role Dekan" value="{{ @$roledekan }}" required/>
                                                @endif
                                                <select id="persetujuan" class="form-select" name="persetujuan"
                                                    {{ @$roledekan ? '' : 'disabled' }}>
                                                    <option disabled>Select Persetujuan</option>

                                                    {{-- Jika belum ada data: prodi memilih Submission --}}
                                                    @if(empty(@$spmirtl))
                                                        <option value="Submission" selected style="color: blue; font-weight: bold;">
                                                            Submission
                                                        </option>

                                                    {{-- Jika sudah ada data: dekan menilai --}}
                                                    @else
                                                    {{-- Tampilkan Submission kalau statusnya masih Submission (readonly) --}}
                                                        @if(@$spmirtl->persetujuan == 'Submission')
                                                            <option value="Submission" selected style="color: blue; font-weight: bold;" disabled>
                                                                Submission (waiting for approval)
                                                            </option>
                                                        @endif
                                                        <option value="Approved"
                                                            {{ old('persetujuan', @$spmirtl->persetujuan) == 'Approved' ? 'selected' : '' }}
                                                            style="color: green; font-weight: bold;">
                                                            Approved
                                                        </option>
                                                        <option value="Needs to be Revisited"
                                                            {{ old('persetujuan', @$spmirtl->persetujuan) == 'Needs to be Revisited' ? 'selected' : '' }}
                                                            style="color: orange; font-weight: bold;">
                                                            Needs to be Revisited
                                                        </option>
                                                        <option value="Disapproved"
                                                            {{ old('persetujuan', @$spmirtl->persetujuan) == 'Disapproved' ? 'selected' : '' }}
                                                            style="color: red; font-weight: bold;">
                                                            Disapproved
                                                        </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>





                                        <br><br>
                                        <div class="row text-center">
                                            @if(!@$spmirtl )
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary" class="disabled"
                                                    >Simpan Penilaian</a>
                                            </div>
                                            @else
                                                @if(@$roledekan || @$roleprodi)
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-success" class="disabled"
                                                        >Update Penilaian</a>
                                                </div>
                                                @endif
                                            @endif
                                        </div>
                                        <br>

                                    </form>



                                    {{-- Form Indikator End--}}
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </fieldset> --}}
            </div>
        </div>
    </div>
<script>
    (function () {
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

    {{-- add scroll back to position --}}
    <script>
        // Simpan posisi scroll sebelum reload
        window.addEventListener("beforeunload", function () {
            localStorage.setItem("scrollPos", window.scrollY);
        });

        // Scroll ke posisi sebelumnya saat reload
        window.addEventListener("load", function () {
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
