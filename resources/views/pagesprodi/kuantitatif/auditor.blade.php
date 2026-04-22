<p><strong>Auditor Assessment</strong></p>
<div class="col-md-12">
    @if($spmiindikator[0]->getIndikatorkualitatif->isNotEmpty())
    @php
    // Daftar opsi nilai
    $values = [
    '4.00','3.75','3.50','3.25','3.00',
    '2.75','2.50','2.25','2.00',
    '1.75','1.50','1.25','1.00',
    '0.75','0.50','0.25','0.00'
    ];
    // Kelompokkan berdasarkan bagian integer
    $grouped = [];
    foreach ($values as $v) {
    [$int] = explode('.', $v);
    $grouped[$int][] = $v;
    }
    // Ambil nilai auditor yang sudah tersimpan (jika ada)
    $selected = optional(@$spmipenilaianindikator)->nilai_auditor;
    @endphp

    <form method="POST" action="{{ route('penjamuindikatorkualitatifauditor_update') }}">
        @csrf

        {{-- Hidden fields untuk pengait record --}}
        <input type="hidden"
            name="spmi_penilaianindikators_id"
            value="{{ optional(@$spmipenilaianindikator)->id }}">
        <input type="hidden"
            name="spmi_penilaianprodis_id"
            value="{{ $spmipenilaianprodi->id }}">

        <table class="table table-striped table-sm fs--1 mb-0">
            <thead>
                <tr>
                    <th width="5%">Nilai</th>
                    <th>Keterangan</th>
                    <th width="10%">PENILAIAN AUDITOR</th>
                </tr>
            </thead>
            <tbody>
                @foreach($spmiindikator[0]->getIndikatorkualitatif as $item)
                <tr>
                    <td class="ps-3">{{ $item->nilai }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td></td>
                </tr>
                @endforeach

                <tr>
                    <td class="ps-3">*</td>
                    <td><strong>PENILAIAN AUDITOR</strong></td>
                    <td>
                        <select name="nilai_auditor"
                            class="form-control"
                            onchange="this.form.submit()">
                            {{-- Opsi default --}}
                            <option value="" {{ is_null($selected) ? 'selected' : '' }}>
                                -- Nilai --
                            </option>
                            @foreach($grouped as $label => $opts)
                            <optgroup label="{{ $label }}">
                                @foreach($opts as $val)
                                <option value="{{ $val }}"
                                    {{ ((string)$selected === (string)$val) ? 'selected' : '' }}>
                                    {{ $val }}
                                </option>
                                @endforeach
                            </optgroup>
                            @endforeach
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    @endif

</div>


@if($spmiindikator[0]->getIndikatorkomponen->where('status',1)->isNotEmpty())
<div class="col-12 col-md-12">
    <div class="card mb-5">
        <div class="card-body">
            <h5>Komponen</h5>
            <form method="POST" action="{{ route('penjamukomponenauditposts.store') }}">
                @csrf
                @php
                $penilaianIndikator = \App\Models\Spmipenilaianindikator::firstWhere([
                ['spmi_penilaianprodis_id', $spmipenilaianprodi->id],
                ['spmi_indikators_id', $spmiindikator[0]->id],
                ]);
                @endphp


                {{-- Hidden fields supaya tidak ada yang kosong --}}
                <input type="hidden"
                    name="spmi_penilaianindikators_id"
                    value="{{ optional($penilaianIndikator)->id }}">
                <input type="hidden"
                    name="spmi_penilaianprodis_id"
                    value="{{ @$spmipenilaianprodi->id }}">
                <input type="hidden"
                    name="spmi_indikators_id"
                    value="{{ $spmiindikator[0]->id }}">
                {{-- <input type="text" id="spmi_indikatorsubs_id" name="spmi_indikatorsubs_id" value="{{ $spmiindikatorsub->id }}" hidden> --}}

                <div class="row">
                    @foreach($spmiindikator[0]->getIndikatorkomponen as $komponen)
                    @php
                    $existing = \App\Models\Spmipindikatorkomponen::firstWhere([
                    ['spmi_penilaianindikators_id', optional($penilaianIndikator)->id],
                    ['spmi_indikatorkomponens_id', $komponen->id]
                    ]);

                    $strata = \App\Models\Strata::where('id', session()->get('programstudi')->stratas_id)->first();
                    if($strata->nama_strata == "S2") {
                    $status = 2;
                    } else if($strata->nama_strata == "S3") {
                    $status = 3;
                    } else {
                    $status = 1;
                    }
                    @endphp
                    @if($strata->nama_strata == "S3" || $strata->nama_strata == "S2" || $strata->nama_strata == "PROFESI")
                    @if($spmiindikator[0]->id == 56 || $spmiindikator[0]->id == 57 || $spmiindikator[0]->id == 58)
                    @if($komponen->status == $status)
                    <div class="col-md-3 mb-2 d-flex align-items-center">
                        {{ $komponen->komponen }}
                        <a tabindex="0" class="ms-1" role="button"
                            data-bs-toggle="popover" data-bs-trigger="focus"
                            title="Keterangan"
                            data-bs-content="{{ $komponen->keterangan }} ">
                            <i class="fa fa-info-circle"></i>
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">

                        <input type="hidden"
                            name="komponens[{{ $komponen->id }}][id]"
                            value="{{ optional($existing)->id }}">
                        <input type="hidden"
                            name="komponens[{{ $komponen->id }}][spmi_indikatorkomponens_id]"
                            value="{{ $komponen->id }}">
                        <input type="number"
                            name="komponens[{{ $komponen->id }}][nilai_auditor]"
                            value="{{ optional($existing)->nilai_auditor }}"
                            class="text-end form-control" step="0.01">
                    </div>
                    @endif
                    @else
                    @if($komponen->status == 1)
                    <div class="col-md-3 mb-2 d-flex align-items-center">
                        {{ $komponen->komponen }}
                        <a tabindex="0" class="ms-1" role="button"
                            data-bs-toggle="popover" data-bs-trigger="focus"
                            title="Keterangan"
                            data-bs-content="{{ $komponen->keterangan }} ">
                            <i class="fa fa-info-circle"></i>
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="hidden"
                            name="komponens[{{ $komponen->id }}][id]"
                            value="{{ optional($existing)->id }}">
                        <input type="hidden"
                            name="komponens[{{ $komponen->id }}][spmi_indikatorkomponens_id]"
                            value="{{ $komponen->id }}">
                        <input type="number"
                            name="komponens[{{ $komponen->id }}][nilai_auditor]"
                            value="{{ optional($existing)->nilai_auditor }}"
                            class="text-end form-control" step="0.01">
                    </div>
                    @endif
                    @endif
                    @else
                    @if($komponen->status == 1)
                    <div class="col-md-3 mb-2 d-flex align-items-center">
                        {{ $komponen->komponen }}
                        <a tabindex="0" class="ms-1" role="button"
                            data-bs-toggle="popover" data-bs-trigger="focus"
                            title="Keterangan"
                            data-bs-content="{{ $komponen->keterangan }} ">
                            <i class="fa fa-info-circle"></i>
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="hidden"
                            name="komponens[{{ $komponen->id }}][id]"
                            value="{{ optional($existing)->id }}">
                        <input type="hidden"
                            name="komponens[{{ $komponen->id }}][spmi_indikatorkomponens_id]"
                            value="{{ $komponen->id }}">
                        {{--Nilai Input --}}
                        @if($komponen->custom)
                        @php
                        $data = json_decode($komponen->custom,true);
                        // var_dump($sub->indikatorsub);

                        @endphp
                        <select id="komponens[{{ $komponen->id }}][nilai_auditor]"
                            name="komponens[{{ $komponen->id }}][nilai_auditor]" class="form-control">
                            <option {{ !@$existing->nilai_auditor ? 'selected' : '' }} disabled>Pilih</option>
                            @foreach($data as $item)
                            <option value="{{ $item['value'] }}" {{ ($item['value'] == @$existing->nilai_auditor) ? 'selected' : '' }}>{{ $item['description'] }}</option>
                            @endforeach
                        </select>
                        @else
                        <input type="number"
                            name="komponens[{{ $komponen->id }}][nilai_auditor]"
                            value="{{ optional($existing)->nilai_auditor }}"
                            class="text-end form-control" step="0.01">
                        @endif
                    </div>
                    @endif
                    @endif

                    @endforeach

                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-outline-primary">
                            Simpan Penilaian
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <!-- {{-- Tampilkan ringkasan nilai --}}
    <div class="row text-center mb-4">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <label>Nilai Auditor Komponen</label>
            <input type="text"
                class="form-control"
                id="spmi_penilaianprodis_nilaiauditor"
                name="nilai_auditor"
                value="{{ @$spmipenilaianindikatorsub->nilai_auditor }}"
                disabled>
        </div>
    </div> -->

    <!-- {{-- Tombol Calculate --}}
    <div class="row text-center">
        <form method="POST" action="{{ route('komponencalculateauditor') }}">
            @csrf
            {{--<input type="hidden"
                id="spmi_penilaianprodis_id"
                name="spmi_penilaianprodis_id"
                value="{{ $spmipenilaianprodi->id }}"> --}}
            {{--<input type="hidden"
                id="spmipenilaianindikatorsub_id"
                name="spmipenilaianindikatorsub_id"
                value="{{ @$spmipenilaianindikatorsub->id }}"> --}}
            {{-- <input type="text" id="spmi_indikatorsubs_id" name="spmi_indikatorsubs_id" value="{{ @$spmiindikatorsubkomponen->id }}" hidden> --}}

            <input type="hidden"
                name="spmi_penilaianprodis_id"
                value="{{ $spmipenilaianprodi->id }}">
            <input type="hidden"
                name="spmi_penilaianindikators_id"
                value="{{ optional($penilaianIndikator)->id }}">
            <button type="submit" class="btn btn-outline-primary">Hitung</a>
        </form>
    </div> -->
</div>
@endif

</div>