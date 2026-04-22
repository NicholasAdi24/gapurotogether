@extends('master')

@section('content')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<h2 class="mb-2 lh-sm">Akreditasi Nasional</h2>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-12">
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-soft">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-12 col-md">
                                <h4 class="text-900 mb-0" data-anchor="data-anchor">Daftar Akreditasi {{ $programstudi->nama_prodi }}</h4>
                                <p class="mb-0 mt-2 text-800">Daftar <code>Akreditasi Program Studi {{ $programstudi->nama_prodi }}</code> Di Universitas
                                    Diponegoro</p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <button class="btn btn-primary btn-sm px-6 px-sm-8" data-bs-toggle="modal" data-bs-target="#addAkred">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Akreditasi
                                    </button>
                                </div>
                            </div>
                            <div id="tableExample3"
                                data-list='{"valueNames":["nomor","kode_prodi","nama_prodi", "strata", "fakultas","status"],"page":25,"pagination":true}'>
                                <div class="search-box mb-3 mx-auto">
                                    <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                                        <input class="form-control search-input search form-control-sm" type="search"
                                            placeholder="Search" aria-label="Search" />
                                        <span class="fas fa-search search-box-icon"></span>
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm fs--1 mb-0">
                                        <thead>
                                            <tr>
                                                <th class="sort border-top ps-3" data-sort="nomor">No</th>
                                                <th class="sort border-top" data-sort="kode_prodi">Universitas</th>
                                                <th class="sort border-top" data-sort="nama_prodi">No SK</th>
                                                <th class="sort border-top" data-sort="strata">Tahun</th>
                                                <th class="sort border-top" data-sort="fakultas">Masa Mulai</th>
                                                <th class="sort border-top" data-sort="fakultas">Masa Akhir</th>
                                                <th class="sort border-top" data-sort="fakultas">Akreditasi (Skor)</th>
                                                <th class="sort border-top" data-sort="fakultas">Berkas</th>
                                                <th class="sort border-top" data-sort="fakultas">Lembaga</th>
                                                <th class="sort border-top" data-sort="status">Status</th>
                                                <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                                    Tindakan</th>
                                            </tr>
                                        </thead>

                                        <tbody class="list">
                                                <?php
                                                    $no = 1;
                                                ?>
                                            @foreach($akreditasis as $akreditasi)
                                                @php
                                                    $masaakhir = date_create($akreditasi->masa_akhir);
                                                    $now = date_create(date('Y-m-d', strtotime('now')));
                                                    $diff = date_diff($now, $masaakhir);
                                                    $month =  $diff->format('%r%m');
                                                    $day = $diff->format('%r%d');
                                                    $year = $diff->format('%r%y');
                                                    $different = $diff->format('%r%a');
                                                    if ($day <= 0 && $month <= 0 && $year <= 0) {
                                                        $color = 'bg-danger text-white';
                                                        $status = '<b class="text-white">Habis Masa Berlaku</b>';
                                                        $sisa = 0;
                                                    }else if ($month < 6 && $year < 1){
                                                        $color = 'bg-warning text-white';
                                                        $status = '<b class="text-white">Waspada</b>';
                                                        $sisa = 1;
                                                    }else if($year <= 1 ){
                                                        $color = 'bg-info text-white';
                                                        $status = '<b class="text-white">Persiapan</b>';
                                                        $sisa = 2;
                                                    }else{
                                                        $color = '';
                                                        $status = '<b class="text-success">Aman</b>';
                                                        $sisa = 3;
                                                    }

                                                @endphp
                                            <tr class="{{ $color }}">
                                                <td class="align-middle ps-3 nomor">{{ $no++ }}</td>
                                                <td class="align-middle kode_prodi">{{ $akreditasi->Getprogramstudi->nama_prodi }}</td>
                                                <td class="align-middle nama_prodi">{{ $akreditasi->no_sk}}</td>
                                                <td class="align-middle strata">
                                                    {{$akreditasi->tahun }}</td>
                                                <td class="align-middle fakultas"> {{$akreditasi->masa_mulai}}</td>
                                                <td class="align-middle fakultas"> {{$akreditasi->masa_akhir}}</td>
                                                <td class="align-middle fakultas"> {{$akreditasi->akreditasi}} <br>({{$akreditasi->skor ?? 0}})</td>
                                                <td class="align-middle fakultas">
                                                    <a href="{{ asset(@$akreditasi->berkas) }}" target="_blank" class="btn btn-sm btn-primary ">
                                                        <i class="fa fa-file"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle fakultas"> {{$akreditasi->lembaga}}</td>
                                                <td class="align-middle status"> {!! $status !!}</td>
                                                <td class="align-middle white-space-nowrap text-end pe-0">
                                                    <a href="{{ route('akreditasi.destroy', ['id' => $akreditasi->id]) }}" class="btn btn-sm btn-danger"><i class='fas fa-trash'></i></a>
                                                    <button data-id="{{ $akreditasi->id }}" class="btn btn-sm btn-warning editBtn"><i class='fas fa-pencil'></i></button>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-between mt-3"><span class="d-none d-sm-inline-block"
                                        data-list-info="data-list-info"></span>
                                    <div class="d-flex"><button class="page-link" data-list-pagination="prev"><span
                                                class="fas fa-chevron-left"></span></button>
                                        <ul class="mb-0 pagination"></ul><button class="page-link pe-0"
                                            data-list-pagination="next"><span
                                                class="fas fa-chevron-right"></span></button>
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

<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->
{{-- Modal Add --}}
<div class="modal fade" id="addAkred" tabindex="-1" aria-labelledby="addAkredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAkredModalLabel">Add Akreditasi {{ $programstudi->nama_prodi }}</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
            </div>
        <form action="{{ route('akreditasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="row">
                <input class="form-control" id="basic-form-name" type="hidden" name="programstudis_id" value="{{ $programstudi->id }}" />
                <div class="col-md-4">
                    <label class="form-label" for="basic-form-tahun" >Tahun </label>
                    <select class="form-select" id="basic-form-tahun" aria-label="select tahun" required name="tahun">
                        <option disabled selected>Select Tahun</option>
                        @for($i = 2000;$i <= date('Y')+10;$i++)
                            <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }} >{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="form-label" for="basic-form-tahun" >No SK </label>
                    <input class="form-control" id="basic-form-nosk" type="text" required name="no_sk" placeholder="Nomor SK" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Masa Mulai </label>
                    <input class="form-control" id="basic-form-nosk" type="date" required name="masa_mulai" placeholder="Masa Mulai" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Masa Akhir </label>
                    <input class="form-control" id="basic-form-nosk" type="date" required name="masa_akhir" placeholder="Masa Akhir" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label" for="basic-form-tahun" >Peringkat Akreditasi </label>
                    <select class="form-select" id="basic-form-tahun" aria-label="select akreditasi" name="akreditasi" required>
                        <option disabled selected>Select Akreditasi</option>
                        <option value="UNGGUL">UNGGUL</option>
                        <option value="BAIK SEKALI">BAIK SEKALI</option>
                        <option value="BAIK">BAIK</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="PRODI BARU">PRODI BARU</option>
                        <option value="INTERNASIONAL">INTERNASIONAL</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="basic-form-tahun" >Skor </label>
                    <input class="form-control" id="basic-form-nosk" type="number" name="skor" placeholder="Skor (Optional)" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="basic-form-tahun" >Tipe Akreditasi </label>
                    <select class="form-select" id="basic-form-tahun" aria-label="select akreditasi" name="type" required>
                        <option disabled selected>Select Tipe</option>
                        <option value="1">Nasional</option>
                        <option value="2">Internasional</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Lembaga </label>
                    <select type="text" class="form-control" id="lembaga" name="lembaga" required>
                        <option disabled selected>Select Lembaga</option>
                        <optgroup label="Nasional">
                            <option value="BANPT">BANPT</option>
                            <option value="LAM-PTKes">LAM-PTKes</option>
                            <option value="LAMEMBA">LAMEMBA</option>
                            <option value="LAMSAMA">LAMSAMA</option>
                            <option value="LAM INFOKOM">LAM INFOKOM</option>
                            <option value="LAM TEKNIK">LAM TEKNIK </option>
                            <option value="SK REKTOR UNDIP">SK REKTOR UNDIP</option>
                        </optgroup>
                        <optgroup label="Internasional">
                            <option value="ASIIN">ASIIN</option>
                            <option value="FIBAA">FIBAA</option>
                            <option value="IABEE">IABEE</option>
                            <option value="ABEST">ABEST</option>
                        </optgroup>


                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Keterangan </label>
                    <select class="form-select" id="basic-form-tahun" aria-label="select akreditasi" name="keterangan" required>
                        <option disabled selected>Select Keterangan</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                        <option value="Proses Review Borang">Proses Review Borang</option>
                        <option value="Menunggu Visitasi">Menunggu Visitasi</option>
                        <option value="Akreditasi Sementara">Akreditasi Sementara</option>
                        <option value="Akreditasi Pertama">Akreditasi Pertama</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-form-gender" >Status</label>
                <select class="form-select" id="basic-form-gender" aria-label="Default select example" name="status" required>
                <option disabled selected>Select status</option>
                <option value="1" selected>Active</option>
                <option value="0">Not Active</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Berkas</label>
                <input class="form-control" type="file" name="berkas" />
            </div>


        </div>
        <div class="modal-footer">
            <button class="btn btn-outline-primary" type="submit">Submit</button>
            <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button></div>
        </div>
        </form>
    </div>
</div>

{{-- Modal Edit --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="addAkredModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModal">Edit Akreditasi {{ $programstudi->nama_prodi }}</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
            </div>
        <form action="{{ route('akreditasi.edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="row">
                <input class="form-control" id="editId" type="hidden" required name="id" placeholder="Nama Dokumen"/>
                <input class="form-control" id="basic-form-name" type="hidden" name="programstudis_id" value="{{ $programstudi->id }}" />
                <div class="col-md-4">
                    <label class="form-label" for="basic-form-tahun" >Tahun </label>
                    <select class="form-select" id="editTahun" aria-label="select tahun" required name="tahun">
                        <option disabled selected>Select Tahun</option>
                        @for($i = 2000;$i <= date('Y')+10;$i++)
                            <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }} >{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="form-label" for="basic-form-tahun" >No SK </label>
                    <input class="form-control" id="editNosk" type="text" required name="no_sk" placeholder="Nomor SK" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Masa Mulai </label>
                    <input class="form-control" id="editMasamulai" type="date" required name="masa_mulai" placeholder="Masa Mulai" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Masa Akhir </label>
                    <input class="form-control" id="editMasaakhir" type="date" required name="masa_akhir" placeholder="Masa Akhir" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label" for="basic-form-tahun" >Peringkat Akreditasi </label>
                    <select class="form-select" id="editAkreditasi" aria-label="select akreditasi" name="akreditasi" required>
                        <option disabled selected>Select Akreditasi</option>
                        <option value="UNGGUL">UNGGUL</option>
                        <option value="BAIK SEKALI">BAIK SEKALI</option>
                        <option value="BAIK">BAIK</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="PRODI BARU">PRODI BARU</option>
                        <option value="INTERNASIONAL">INTERNASIONAL</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="basic-form-tahun" >Skor </label>
                    <input class="form-control" id="editSkor" type="number" name="skor" placeholder="Skor (Optional)" />
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="basic-form-tahun" >Tipe Akreditasi </label>
                    <select class="form-select" id="editType" aria-label="select akreditasi" name="type" required>
                        <option disabled selected>Select Tipe</option>
                        <option value="1">Nasional</option>
                        <option value="2">Internasional</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Lembaga </label>
                    <select type="text" class="form-control" id="editLembaga" name="lembaga" required>
                        <option disabled selected>Select Lembaga</option>
                        <optgroup label="Nasional">
                            <option value="BANPT">BANPT</option>
                            <option value="LAM-PTKes">LAM-PTKes</option>
                            <option value="LAMEMBA">LAMEMBA</option>
                            <option value="LAMSAMA">LAMSAMA</option>
                            <option value="LAM INFOKOM">LAM INFOKOM</option>
                            <option value="LAM TEKNIK">LAM TEKNIK </option>
                            <option value="SK REKTOR UNDIP">SK REKTOR UNDIP</option>
                        </optgroup>
                        <optgroup label="Internasional">
                            <option value="ASIIN">ASIIN</option>
                            <option value="FIBAA">FIBAA</option>
                            <option value="IABEE">IABEE</option>
                            <option value="ABEST">ABEST</option>
                        </optgroup>


                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Keterangan </label>
                    <select class="form-select" id="editKeterangan" aria-label="select akreditasi" name="keterangan" required>
                        <option disabled selected>Select Keterangan</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                        <option value="Proses Review Borang">Proses Review Borang</option>
                        <option value="Menunggu Visitasi">Menunggu Visitasi</option>
                        <option value="Akreditasi Sementara">Akreditasi Sementara</option>
                        <option value="Akreditasi Pertama">Akreditasi Pertama</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="basic-form-gender" >Status</label>
                <select class="form-select" id="editStatus" aria-label="Default select example" name="status" required>
                <option disabled selected>Select status</option>
                <option value="1" selected>Active</option>
                <option value="0">Not Active</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Upload Berkas</label>
                <input class="form-control" type="file" name="berkas" />
            </div>


        </div>
        <div class="modal-footer">
            <button class="btn btn-outline-primary" type="submit">Submit</button>
            <button class="btn btn-outline-danger" type="button" data-bs-dismiss="modal">Cancel</button></div>
        </div>
        </form>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');
        // console.log("Button clicked, id = " + id);
        $.get("{{ url('akreditasi-show') }}/" + id, function (data) {
            $('#editId').val(data.id);
            $('#editNosk').val(data.no_sk);
            $('#editTahun').val(data.tahun);
            $('#editMasamulai').val(data.masa_mulai);
            $('#editMasaakhir').val(data.masa_akhir);
            $('#editAkreditasi').val(data.akreditasi);
            $('#editSkor').val(data.skor);
            $('#editType').val(data.type);
            $('#editLembaga').val(data.lembaga);
            $('#editKeterangan').val(data.keterangan);
            $('#editStatus').val(data.status);
            if (data.berkas) {
                $('#editBerkas').attr('href', "{{ asset('') }}" + data.berkas);
            } else {
                $('#editBerkas').attr('href', '#');
            }
            $('#editModal').modal('show');
        });
    });
});
</script>
