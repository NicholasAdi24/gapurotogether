<br><br>
<div class="col-12 col-md-12">
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-xxl-6">

                    <div class="mb-8">

                        <h4 class="text-700 fw-bold">Indikator Sub Auditor {{$spmiindikator[0]->indikator}}</h4>
                    </div>
                </div>
                @foreach($spmiindikatorsubs as $sub)
                @php
                // Cari existing penilaian auditor untuk sub ini,
                // tapi hanya yang cocok dengan prodi & indikator
                $existing = $sub->getPenilaianindikator()
                ->where('spmi_penilaianprodis_id', $spmipenilaianprodi->id)
                ->where('spmi_indikators_id', $sub->spmi_indikators_id)
                ->where('spmi_indikatorsubs_id', $sub->id)
                ->first();
                @endphp

                {{-- Form untuk nilai auditor --}}
                <form id="auditor-form-{{ $sub->id }}"
                    method="POST"
                    action="{{ $existing
                    ? route('auditindikatorsubdetailposts.update', $existing->id)
                    : route('auditindikatorsubdetailposts.store') }}">
                    @csrf
                    @if($existing)
                    @method('PUT')
                    @endif

                    <input type="hidden" name="spmi_indikatorsubs_id" value="{{ $sub->id }}">
                    <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $spmipenilaianprodi->id }}">
                    <input type="hidden" name="auditor" value="1">

                    <h5 class="mt-3">{{ $sub->kode }} – {{ $sub->indikatorsub }}</h5>

                    @if($sub->getKualitatif->isNotEmpty())
                    <table class="table table-striped table-sm fs--1 mb-3">
                        <thead>
                            <tr>
                                <th width="5%">Nilai</th>
                                <th>Keterangan</th>
                                <th width="10%">PENILAIAN AUDITOR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sub->getKualitatif as $item)
                            <tr>
                                <td>{{ $item->nilai }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>*</td>
                                <td><strong>PENILAIAN</strong></td>
                                <td>
                                    @php
                                    $values = [
                                    '4.00','3.75','3.50','3.25','3.00',
                                    '2.75','2.50','2.25','2.00',
                                    '1.75','1.50','1.25','1.00',
                                    '0.75','0.50','0.25','0.00'
                                    ];

                                    // group by integer part
                                    $grouped = [];
                                    foreach ($values as $v) {
                                    [$int] = explode('.', $v);
                                    $grouped[$int][] = $v;
                                    }

                                    // nilai auditor yang sudah tersimpan
                                    $selectedAuditor = optional($existing)->nilai_auditor;
                                    @endphp

                                    <select name="nilai_auditor"
                                        class="form-control"
                                        onchange="document.getElementById('auditor-form-{{ $sub->id }}').submit()">
                                        <option value="">Pilih nilai</option>
                                        @foreach($grouped as $label => $opts)
                                        <optgroup label="{{ $label }}">
                                            @foreach($opts as $val)
                                            <option value="{{ $val }}"
                                                {{ ((string)$selectedAuditor === (string)$val) ? 'selected' : '' }}>
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
                    @endif

                </form>


                @if(count(@$sub->getIndikatorsubkomponen) > 0)
                <div class="col-12 col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5>Komponen</h5>
                            <form method="POST" action="{{ route('auditkomponenposts.store') }}">
                                @csrf
                                @php
                                $spmipenilaianindikatorsub = \App\Models\Spmipenilaianindikator::where('spmi_penilaianprodis_id',@$spmipenilaianprodi->id)->where('spmi_indikatorsubs_id',$sub->id)->first();
                                @endphp

                                <div class="row">
                                    @foreach(@$sub->getIndikatorsubkomponen as $spmiindikatorsubkomponen)
                                    @if($spmiindikatorsubkomponen->status == 1)
                                    <div class="mb-3 col-md-3">
                                        {{ $spmiindikatorsubkomponen->komponen }}
                                        <a tabindex="0" class="ms-1" role="button"
                                            data-bs-toggle="popover" data-bs-trigger="focus"
                                            title="Keterangan"
                                            data-bs-content="{{ $spmiindikatorsubkomponen->keterangan }}">
                                            <i class="fa fa-info-circle"></i>
                                        </a>
                                    </div>
                                    <div class="mb-3 col-md-3">
                                        @php

                                        // $spmipindikatorkomponen = \App\Models\Spmipindikatorkomponen::where('spmi_penilaianindikators_id',@$spmipenilaianindikator->id)->where('spmi_indikatorkomponens_id',$spmiindikatorsubkomponen->id)->first();
                                        $spmipindikatorkomponen = \App\Models\Spmipindikatorkomponen::where('spmi_penilaianindikators_id',@$spmipenilaianindikatorsub->id)->where('spmi_indikatorkomponens_id',$spmiindikatorsubkomponen->id)->first();
                                        @endphp
                                        {{-- {{ $spmipindikatorkomponen }} --}}
                                        <input type="hidden" name="komponens[{{ $spmiindikatorsubkomponen->id }}][id]" value="{{ @$spmipindikatorkomponen->id }}">
                                        <!-- <input type="number" id="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_auditor]" name="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_auditor]" value="{{ @$spmipindikatorkomponen->nilai_auditor }}" class="text-end form-control"> -->
                                        <!-- <select
                                            id="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_auditor]"
                                            name="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_auditor]"
                                            class="form-select text-end">
                                            @php
                                            // ambil nilai saat ini, default ke empty string jika null
                                            $currentAuditor = data_get($spmipindikatorkomponen, 'nilai_auditor', '');
                                            @endphp

                                            {{-- Placeholder jika kosong --}}
                                            <option value="" {{ $currentAuditor === '' ? 'selected' : '' }}>Pilih nilai</option>

                                            {{-- Loop opsi 1–4 --}}
                                            @for($i = 1; $i <= 4; $i++)
                                                <option value="{{ $i }}" {{ (string)$currentAuditor === (string)$i ? 'selected' : '' }}>
                                                {{ $i }}
                                                </option>
                                                @endfor
                                        </select> -->
                                        @if($spmiindikatorsubkomponen->custom)
                                        @php
                                        $data = json_decode($spmiindikatorsubkomponen->custom,true);
                                        // var_dump($sub->indikatorsub);

                                        @endphp
                                        <select id="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_auditor]"
                                            name="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_auditor]" class="form-control">
                                            <option {{ !@$currentAuditor ? 'selected' : '' }} disabled>Pilih</option>
                                            @foreach($data as $item)
                                            <option value="{{ $item['value'] }}" {{ ($item['value'] == @$currentAuditor) ? 'selected' : '' }}>{{ $item['description'] }}</option>
                                            @endforeach
                                        </select>
                                        @else
                                        @if($spmiindikatorsubkomponen->status == 1)
                                        <input
                                            type="number"
                                            id="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_auditor]"
                                            name="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_auditor]"
                                            class="form-control text-end"
                                            value="{{ $currentAuditor }}">
                                        @endif
                                        @endif


                                        <input type="number" id="komponens[{{ $spmiindikatorsubkomponen->id }}][spmi_indikatorkomponens_id]" name="komponens[{{ $spmiindikatorsubkomponen->id }}][spmi_indikatorkomponens_id]" value="{{ $spmiindikatorsubkomponen->id }}" class="text-end form-control" hidden>
                                        <input type="number" id="komponens[{{ $spmiindikatorsubkomponen->id }}][spmi_penilaianindikators_id]" name="komponens[{{ $spmiindikatorsubkomponen->id }}][spmi_penilaianindikators_id]" value="{{ @$spmipenilaianindikator->id }}" hidden>
                                    </div>
                                    @endif
                                    @endforeach
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-outline-primary">Simpan Penilaian</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <label> Nilai Auditor Sub Komponen</label>
                        <input type="text" class="form-control" id="spmi_penilaianprodis_nilaiprodi" name="nilai_prodi" value="{{ @$spmipenilaianindikatorsub->nilai_auditor }}" disabled><br>
                    </div>
                </div>
                <div class="row text-center">
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
                    $routeAction = 'komponencalculateauditorlamteknik';
                    }
                    // elseif ($spmipenilaianprodi->lembagas_id == 8) {
                    // $routeAction = 'null';
                    // } elseif ($spmipenilaianprodi->lembagas_id == 9) {
                    // $routeAction = 'null';
                    // }
                    elseif ($spmipenilaianprodi->lembagas_id == 10) {
                    $routeAction = 'v2.komponencalculateauditorlamteknik';
                    } else {
                    $routeAction = 'komponencalculateauditor';
                    }
                    @endphp

                    <form method="POST" action="{{ route($routeAction) }}">
                        @csrf
                        <div class="col-md-12">
                            <input type="text" id="spmi_penilaianprodis_id" name="spmi_penilaianprodis_id" value="{{ $spmipenilaianprodi->id }}" hidden>
                            <input type="text" id="auditor" name="auditor" value="1" hidden>
                            <input type="text" id="spmipenilaianindikatorsub_id" name="spmipenilaianindikatorsub_id" value="{{ @$spmipenilaianindikatorsub->id }}" hidden>
                            <input type="text" id="spmi_indikatorsubs_id" name="spmi_indikatorsubs_id" value="{{ @$spmiindikatorsubkomponen->id }}" hidden>
                            <button type="submit" class="btn btn-primary">Hitung</a>
                        </div>
                    </form>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>