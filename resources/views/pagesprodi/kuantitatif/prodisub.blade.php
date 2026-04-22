<br><br>
<div class="col-12 col-md-12">
    <div class="card mb-5">
        <div class="card-body">

            <div class="row">
                <div class="col-12 col-xxl-6">

                    <div class="mb-8">

                        <h4 class="text-700 fw-bold">Indikator Sub Prodi {{$spmiindikator[0]->indikator}}</h4>
                    </div>
                </div>
                @foreach($spmiindikatorsubs as $sub)
                @php
                // sekarang kita cari bukan hanya berdasarkan sub_id,
                // tapi juga prodi_id dan indikator_id:
                $existing = $sub->getPenilaianindikator()
                ->where('spmi_penilaianprodis_id', $spmipenilaianprodi->id)
                ->where('spmi_indikators_id', $sub->spmi_indikators_id)
                ->where('spmi_indikatorsubs_id', $sub->id)
                ->first();
                @endphp

                <form id="form-{{ $sub->id }}" method="POST" action="{{ $existing
                    ? route('penjamuindikatorsubdetailposts.update', $existing->id)
                    : route('penjamuindikatorsubdetailposts.store') }}">
                    @csrf
                    @if($existing)
                    @method('PUT')
                    @endif

                    <input type="hidden" name="spmi_indikatorsubs_id" value="{{ $sub->id }}">
                    <input type="hidden" name="spmi_penilaianprodis_id" value="{{ $spmipenilaianprodi->id }}">
                    <input type="hidden" name="auditor" value="{{ request('auditor', 0) }}">

                    <h5 class="mt-3">{{ $sub->kode }} – {{ $sub->indikatorsub }}</h5>

                    @if($sub->getKualitatif->isNotEmpty())
                    <table class="table table-striped table-sm fs--1 mb-3">
                        <thead>
                            <tr>
                                <th width="5%">Nilai</th>
                                <th>Keterangan</th>
                                <th width="10%">PENILAIAN PRODI</th>
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
                                <td><strong>PENILAIAN INDIKATOR SUB</strong></td>
                                <td>
                                    @php
                                    // Nilai yang sudah dipilih (jika ada)
                                    $selected = optional($existing)->nilai_prodi;

                                    // semua opsi
                                    $values = [
                                    '4.00','3.75','3.50','3.25','3.00',
                                    '2.75','2.50','2.25','2.00',
                                    '1.75','1.50','1.25','1.00',
                                    '0.75','0.50','0.25','0.00'
                                    ];
                                    // grouping berdasarkan integer part
                                    $grouped = [];
                                    foreach ($values as $v) {
                                    [$int] = explode('.', $v);
                                    $grouped[$int][] = $v;
                                    }
                                    @endphp

                                    <select name="nilai_prodi" class="form-control"
                                        onchange="document.getElementById('form-{{ $sub->id }}').submit()">
                                        <option value="">Pilih nilai</option>
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

                                    <!-- <input type="number" name="nilai_prodi" class="form-control"
                                        onchange="document.getElementById('form-{{ $sub->id }}').submit()"
                                        value="{{ $selected }}" min="0" max="4"> -->


                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif

                </form>

                @if(count(@$sub->getIndikatorsubkomponen) >= 1)
                <div class="col-12 col-md-12">
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5>Komponen </h5>
                            <form method="POST" action="{{ route('penjamukomponenposts.store') }}">
                                @csrf
                                @php
                                $spmipenilaianindikatorsub =
                                \App\Models\Spmipenilaianindikator::where('spmi_penilaianprodis_id',@$spmipenilaianprodi->id)->where('spmi_indikatorsubs_id',$sub->id)->first();
                                @endphp

                                <input type="number" id="spmipenilaianindikatorsub_id"
                                    name="spmipenilaianindikatorsub_id" value="{{ @$spmipenilaianindikatorsub->id }}"
                                    hidden>
                                <input type="text" id="spmi_penilaianprodis_id" name="spmi_penilaianprodis_id"
                                    value="{{ $spmipenilaianprodi->id }}" hidden>
                                <input type="text" id="spmi_indikatorsubs_id" name="spmi_indikatorsubs_id"
                                    value="{{ $sub->id }}" hidden>
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
                                        $spmipindikatorkomponen =
                                        \App\Models\Spmipindikatorkomponen::where('spmi_penilaianindikators_id',@$spmipenilaianindikatorsub->id)->where('spmi_indikatorkomponens_id',$spmiindikatorsubkomponen->id)->first();
                                        @endphp
                                        <input type="hidden" name="komponens[{{ $spmiindikatorsubkomponen->id }}][id]"
                                            value="{{ @$spmipindikatorkomponen->id }}">
                                        <!-- <input type="number" id="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]" name="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]" value="{{ @$spmipindikatorkomponen->nilai_prodi }}" class="text-end form-control"> -->

                                        {{-- <select
                                            id="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]"
                                        name="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]"
                                        class="form-control text-end">
                                        @php
                                        // current value (might be null)
                                        $current = data_get($spmipindikatorkomponen, 'nilai_prodi');
                                        @endphp

                                        <option value="" {{ $current === '' ? 'selected' : '' }}>Pilih nilai</option>

                                        @for($i = 1; $i <= 4; $i++) <option value="{{ $i }}"
                                            {{ $current == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                            </option>
                                            @endfor
                                            </select> --}}
                                            @php
                                            // current value (might be null)
                                            $current = data_get($spmipindikatorkomponen, 'nilai_prodi');
                                            @endphp
                                            @if($spmiindikatorsubkomponen->custom)
                                            @php
                                            $data = json_decode($spmiindikatorsubkomponen->custom,true);
                                            // var_dump($sub->indikatorsub);

                                            @endphp
                                            <select id="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]"
                                                name="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]" class="form-control">
                                                <option {{ !@$current ? 'selected' : '' }} disabled>Pilih</option>
                                                @foreach($data as $item)
                                                <option value="{{ $item['value'] }}" {{ ($item['value'] == @$current) ? 'selected' : '' }}>{{ $item['description'] }}</option>
                                                @endforeach
                                            </select>
                                            @else
                                            @if($spmiindikatorsubkomponen->status == 1)
                                            <input type="number"
                                                id="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]"
                                                name="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]"
                                                value="{{ $current }}" class="form-control" step="0.01">
                                            @endif
                                            @endif
                                            {{-- <select id="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]"--}}
                                            {{-- name="komponens[{{ $spmiindikatorsubkomponen->id }}][nilai_prodi]"--}}
                                            {{-- class="form-select text-end">--}}
                                            {{-- <option value="">Pilih nilai</option>--}}
                                            {{-- @for ($i = 1; $i <= 4; $i++)--}}
                                            {{-- <option value="{{ $i }}"
                                            {{ $current == $i ? 'selected' : '' }}>--}}
                                            {{-- {{ $i }}--}}
                                            {{-- </option>--}}
                                            {{-- @endfor--}}
                                            {{-- </select>--}}
                                            <input type="number"
                                                id="komponens[{{ $spmiindikatorsubkomponen->id }}][spmi_indikatorkomponens_id]"
                                                name="komponens[{{ $spmiindikatorsubkomponen->id }}][spmi_indikatorkomponens_id]"
                                                value="{{ $spmiindikatorsubkomponen->id }}"
                                                class="text-end form-control" hidden>

                                    </div>
                                    @endif
                                    @endforeach
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">Simpan Penilaian</a>
                                    </div>

                                </div>
                            </form>

                        </div>

                    </div>
                    @if($sub->calculate == 1)
                    <div class="row text-center">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <label> Nilai Prodi Sub Komponen </label>
                            <input type="text" class="form-control" id="spmi_penilaianprodis_nilaiprodi"
                                name="nilai_prodi" value="{{ @$spmipenilaianindikatorsub->nilai_prodi }}" disabled><br>
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
                        $routeAction = 'komponencalculatelamteknik';
                        }
                        // elseif ($spmipenilaianprodi->lembagas_id == 8) {
                        // $routeAction = 'null';
                        // }elseif ($spmipenilaianprodi->lembagas_id == 9) {
                        // $routeAction = 'null';
                        // }
                        elseif ($spmipenilaianprodi->lembagas_id == 10) {
                        $routeAction = 'v2.komponencalculatelamteknik';
                        } else {
                        $routeAction = 'komponencalculate';
                        }
                        @endphp

                        <form method="POST" action="{{ route($routeAction) }}">
                            @csrf
                            <div class="col-md-12">
                                <input type="text" id="spmi_penilaianprodis_id" name="spmi_penilaianprodis_id"
                                    value="{{ $spmipenilaianprodi->id }}" hidden>
                                <input type="text" id="spmipenilaianindikatorsub_id" name="spmipenilaianindikatorsub_id"
                                    value="{{ @$spmipenilaianindikatorsub->id }}" hidden>
                                <input type="text" id="spmi_indikatorsubs_id" name="spmi_indikatorsubs_id"
                                    value="{{ @$spmiindikatorsubkomponen->id }}" hidden>
                                <button type="submit" class="btn btn-outline-primary">Calculate</a>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
                @endif



                @endforeach
            </div>
        </div>
    </div>
</div>