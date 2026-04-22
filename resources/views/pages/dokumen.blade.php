@extends('master')

@section('content')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<h2 class="mb-2 lh-sm">Dokumen Penjaminan Mutu</h2>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-12">
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-soft">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-12 col-md">
                                <h4 class="text-900 mb-0" data-anchor="data-anchor">Daftar Dokumen </h4>
                                <p class="mb-0 mt-2 text-800">Daftar <code>Dokumen Penting Penjaminan Mutu </code> Di Universitas
                                    Diponegoro</p>
                            </div>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <button class="btn btn-primary btn-sm px-6 px-sm-8" data-bs-toggle="modal" data-bs-target="#addAkred">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Dokumen
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
                                                <th class="sort border-top" data-sort="kode_prodi">Nama</th>
                                                <th class="sort border-top" data-sort="nama_prodi">Kategori</th>
                                                <th class="sort border-top" data-sort="strata">Type</th>
                                                <th class="sort border-top" data-sort="fakultas">Berkas</th>
                                                <th class="sort border-top" data-sort="fakultas">Keterangan</th>
                                                <th class="sort border-top" data-sort="fakultas">Updated By</th>
                                                <th class="sort border-top" data-sort="status">Status</th>
                                                <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                                    Tindakan</th>
                                            </tr>
                                        </thead>

                                        <tbody class="list">
                                                <?php
                                                    $no = 1;

                                                ?>
                                            @foreach($dokumens as $dokumen)
                                            @php
                                                    if($dokumen->type == 0) {
                                                        $label = '<span class="badge bg-danger">TERBATAS</span>';
                                                    } else if($dokumen->type == 1) {
                                                        $label = '<span class="badge bg-primary">PENTING</span>';
                                                    } else if($dokumen->type == 2) {
                                                        $label = '<span class="badge bg-warning">PERATURAN DAN KEBIJAKAN</span>';
                                                    } else if($dokumen->type == 3) {
                                                        $label = '<span class="badge bg-secondary">LAPORAN</span>';
                                                    } else if($dokumen->type == 4) {
                                                        $label = '<span class="badge bg-success">DOKUMEN PENDUKUNG</span>';
                                                    } else if($dokumen->type == 5) {
                                                        $label = '<span class="badge bg-info">LAINNYA</span>';
                                                    }
                                            @endphp

                                            <tr class="">
                                                <td class="align-middle ps-3 nomor">{{ $no++ }}</td>
                                                <td class="align-middle kode_prodi">{{ $dokumen->nama }}</td>
                                                <td class="align-middle nama_prodi">{{ $dokumen->kategori}}</td>

                                                <td class="align-middle fakultas"> {!! $label !!}</td>

                                                <td class="align-middle fakultas">
                                                    <a href="{{ asset(@$dokumen->berkas) }}" target="_blank" class="btn btn-sm btn-primary ">
                                                        <i class="fa fa-file"></i>
                                                    </a>
                                                </td>
                                                <td class="align-middle fakultas"> {{$dokumen->keterangan}}</td>
                                                <td class="align-middle fakultas"> {{$dokumen->updateby}}</td>
                                                <td class="align-middle status">{!! $dokumen->status == 1
                                                    ? '<span class="badge bg-success">Active</span>'
                                                    : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                                                <td class="align-middle white-space-nowrap text-end pe-0">
                                                    <a href="{{ route('dokumen.destroy', ['id' => $dokumen->id]) }}" class="btn btn-sm btn-danger"><i class='fas fa-trash'></i></a>
                                                    <button data-id="{{ $dokumen->id }}" class="btn btn-sm btn-warning editBtn"><i class='fas fa-pencil'></i></button>
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
                <h5 class="modal-title" id="addAkredModalLabel">Add Dokumen</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
            </div>
        <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="row">

                <div class="col-md-12">
                    <label class="form-label" for="basic-form-tahun" >Nama Dokumen </label>
                    <input class="form-control" id="basic-form-nosk" type="text" required name="nama" placeholder="Nama Dokumen"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Kategori </label>
                    <input class="form-control" id="basic-form-nosk" type="text" required name="kategori" placeholder="Kategori Dokumen" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Tipe Dokumen </label>
                    <select class="form-select" id="basic-form-tahun" aria-label="select type" name="type" required>
                        <option disabled selected>Select Type</option>
                        <option value="0">TERBATAS</option>
                        <option value="1">PENTING</option>
                        <option value="2">PERATURAN DAN KEBIJAKAN</option>
                        <option value="3">LAPORAN</option>
                        <option value="4">DOKUMEN PENDUKUNG</option>
                        <option value="5">LAINNYA</option>
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <label class="form-label" for="basic-form-tahun" >Keterangan </label>
                    <textarea class="form-control" id="basic-form-nosk" type="text" required name="keterangan" rows="6" placeholder="Keterangan Dokumen"/></textarea>
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
                <h5 class="modal-title" id="editModal">Edit Dokumen</h5><button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
            </div>
        <form action="{{ route('dokumen.edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="modal-body">
            <div class="row">
                <input class="form-control" id="editId" type="hidden" required name="id" placeholder="Nama Dokumen"/>
                <div class="col-md-12">
                    <label class="form-label" for="basic-form-tahun" >Nama Dokumen </label>
                    <input class="form-control" id="editNama" type="text" required name="nama" placeholder="Nama Dokumen"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Kategori </label>
                    <input class="form-control" id="editKategori" type="text" required name="kategori" placeholder="Kategori Dokumen" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="basic-form-tahun" >Tipe Dokumen </label>
                    <select class="form-select" id="editTipe" aria-label="select type" name="type" required>
                        <option disabled selected>Select Type</option>
                        <option value="0">TERBATAS</option>
                        <option value="1">PENTING</option>
                        <option value="2">PERATURAN DAN KEBIJAKAN</option>
                        <option value="3">LAPORAN</option>
                        <option value="4">DOKUMEN PENDUKUNG</option>
                        <option value="5">LAINNYA</option>
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">
                    <label class="form-label" for="basic-form-tahun" >Keterangan </label>
                    <textarea class="form-control" id="editKeterangan" type="text" required name="keterangan" rows="6" placeholder="Keterangan Dokumen"/></textarea>
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
                <a href="" id="editBerkas" target="_blank" class="btn btn-sm btn-primary ">
                    <i class="fa fa-file"></i>
                </a>
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
        $.get("{{ url('dokumen-show') }}/" + id, function (data) {
            $('#editId').val(data.id);
            $('#editNama').val(data.nama);
            $('#editKategori').val(data.kategori);
            $('#editTipe').val(data.type);
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
