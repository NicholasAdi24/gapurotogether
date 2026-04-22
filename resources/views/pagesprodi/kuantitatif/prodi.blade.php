<!-- Self Assessment Prodi -->
<p><strong>Self Assessment Prodi</strong></p>
<div class="col-md-12">

    @if($spmiindikator[0]->getIndikatorkualitatif->isNotEmpty())
    <form method="POST" action="{{ route('penjamuindikatorkualitatif.update') }}">
        @csrf
        <table class="table table-striped table-sm fs--1 mb-0">
            <thead>
                <tr>
                    <th width="5%">Nilai</th>
                    <th>Keterangan</th>
                    <th width="10%">PENILAIAN PRODI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($spmiindikator[0]->getIndikatorkualitatif as $kualitatif)
                <tr>
                    <td>{{ $kualitatif->nilai }}</td>
                    <td>{{ $kualitatif->keterangan }}</td>
                    <td></td>
                </tr>
                @endforeach

                @php
                $values = [
                '4.00','3.75','3.50','3.25','3.00',
                '2.75','2.50','2.25','2.00',
                '1.75','1.50','1.25','1.00',
                '0.75','0.50','0.25','0.00'
                ];
                $grouped = [];
                foreach ($values as $v) {
                [$int] = explode('.', $v);
                $grouped[$int][] = $v;
                }
                $selected = optional(@$spmipenilaianindikator)->nilai_prodi;
                @endphp

                <tr>
                    <td>*</td>
                    <td><strong>PENILAIAN INDIKATOR</strong></td>
                    <td>
                        <form method="POST" action="{{ route('penjamuindikatorkualitatif.update') }}">
                            @csrf
                            <input type="hidden"
                                name="spmi_penilaianindikator_id"
                                value="{{ optional(@$spmipenilaianindikator)->id }}">
                            <input type="hidden"
                                name="spmi_penilaianprodis_id"
                                value="{{ $spmipenilaianprodi->id }}">

                            <select name="nilai_prodi"
                                class="form-control"
                                onchange="this.form.submit()">
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
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    @endif

    @if($spmiindikator[0]->getIndikatorkomponen->where('status',1)->isNotEmpty())
    <div class="card mb-5">
        <div class="card-body">
            <h5>Komponen</h5>
            <form method="POST" action="{{ route('penjamukomponenposts.store') }}">
                @csrf
                @php
                $penilaianIndikator = \App\Models\Spmipenilaianindikator::firstWhere([
                ['spmi_penilaianprodis_id', $spmipenilaianprodi->id],
                ['spmi_indikators_id', $spmiindikator[0]->id]
                ]);
                @endphp

                {{-- Hidden fields supaya tidak ada yang kosong --}}
                <input type="hidden"
                    name="spmi_penilaianindikators_id"
                    value="{{ optional($penilaianIndikator)->id }}">
                <input type="hidden"
                    name="spmi_penilaianprodis_id"
                    value="{{ $spmipenilaianprodi->id }}">
                <input type="hidden"
                    name="spmi_indikators_id"
                    value="{{ $spmiindikator[0]->id }}">

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
                            name="komponens[{{ $komponen->id }}][nilai_prodi]"
                            value="{{ optional($existing)->nilai_prodi }}"
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
                            name="komponens[{{ $komponen->id }}][nilai_prodi]"
                            value="{{ optional($existing)->nilai_prodi }}"
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
                        {{-- input asli --}}
                        @if($komponen->custom)
                        @php
                        $data = json_decode($komponen->custom,true);
                        // var_dump($sub->indikatorsub);

                        @endphp
                        <select id="komponens[{{ $komponen->id }}][nilai_prodi]"
                            name="komponens[{{ $komponen->id }}][nilai_prodi]" class="form-control">
                            <option {{ !@$existing->nilai_prodi ? 'selected' : '' }} disabled>Pilih</option>
                            @foreach($data as $item)
                            <option value="{{ $item['value'] }}" {{ ($item['value'] == @$existing->nilai_prodi) ? 'selected' : '' }}>{{ $item['description'] }}</option>
                            @endforeach
                        </select>
                        @else
                        <input type="number"
                            name="komponens[{{ $komponen->id }}][nilai_prodi]"
                            value="{{ optional($existing)->nilai_prodi }}"
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
            <label>Nilai Prodi Komponen</label>
            <input type="text"
                class="form-control"
                value="{{ optional($penilaianIndikator)->nilai_prodi }}"
                disabled>
        </div>
    </div> -->

    <!-- {{-- Tombol Calculate --}}
    <div class="row text-center">
        <form method="POST" action="{{ route('komponencalculate') }}">
            @csrf
            <input type="hidden"
                name="spmi_penilaianprodis_id"
                value="{{ $spmipenilaianprodi->id }}">
            <input type="hidden"
                name="spmi_penilaianindikators_id"
                value="{{ optional($penilaianIndikator)->id }}">
            <button type="submit" class="btn btn-outline-primary">
                Calculate
            </button>
        </form>
    </div> -->
    @endif

</div>