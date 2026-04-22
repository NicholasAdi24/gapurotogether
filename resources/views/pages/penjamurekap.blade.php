@extends('master')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- Buttons extension -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Buttons scripts -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- Export dependencies -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Select 2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    table.dataTable {
    width: 100% !important;
    table-layout: auto;
}

.dataTables_wrapper {
    overflow-x: auto; /* Only scroll if table is really too wide */
}

/* Buat tampilan Select2 sama dengan Bootstrap select */
/* === Samakan Select2 multiple agar seperti .form-select Bootstrap === */
.select2-container .select2-selection--multiple {
    min-height: 38px; /* tinggi sama dengan form-select */
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    padding: 4px 8px;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
    line-height: 1.5;
    background-color: #fff;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    color: #212529;
    padding: 0 6px;
    margin-top: 2px;
    font-size: 0.875rem;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
}

.select2-container--default .select2-selection--multiple:focus,
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #86b7fe !important;
    box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
}

/* Supaya lebar penuh seperti select biasa */
.select2-container {
    width: 100% !important;
}

</style>
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<h2 class="mb-2 lh-sm">REKAP PENJAMU</h2>

<div class="mt-4">
    <div class="row g-4">
        <div class="col-12 col-xl-12 order-1 order-xl-0">
            <div class="mb-12">
                <div class="card shadow-none border border-300 mb-3" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom border-300 bg-soft">
                        <div class="row g-3 justify-content-between align-items-end">
                            <div class="col-12 col-md">
                                <h4 class="text-900 mb-0" data-anchor="data-anchor">Daftar Rekap Penjamu</h4>
                                <p class="mb-0 mt-2 text-800">Daftar <code>Rekap Penjaminan Mutu</code> Di Universitas Diponegoro
                                </p>
                            </div>

                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="p-4 code-to-copy">
                            <form method="GET" action="{{ route('rekapkapus') }}" class="mb-3">
                                <div class="row align-items-end">
                                    <div class="col-md-4">
                                        <label for="periode">Periode</label>
                                        <select id="filterPeriode" name="periode" class="form-control">
                                            <option value="">-- Semua Periode --</option>
                                            @foreach ($allPeriode as $periode)
                                            <option value="{{ $periode->id }}" >
                                                {{ $periode->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="fakultas">Fakultas</label>
                                        <select id="filterFakultas" name="fakultas" class="form-control" >
                                            <option value="">-- Semua Fakultas --</option>
                                            @foreach ($allFakultas as $fakultas)
                                            <option value="{{ $fakultas->id }}" >
                                                {{ $fakultas->nama_fakultas }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>



                                    {{-- <div class="col-md-4">
                                        <label for="search">Cari Program Studi</label>
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}" placeholder="Ketik nama program studi..."
                                            oninput="submitWithDelay(this.form)">
                                    </div> --}}
                                    <div class="col-md-8">
                                        <label for="fakultas">Status</label>
                                        <select id="filterStatus" class="form-select" style="width:200px; margin-bottom:10px;" multiple>
                                            <option value="">Semua Status</option>
                                            <option value="1">Telah Diisi oleh Prodi</option>
                                            <option value="2">Telah Dikalkulasi oleh Prodi</option>
                                            <option value="3">Telah Dikunci oleh Prodi</option>
                                            <option value="4">Telah Divalidasi oleh Wadek 1</option>
                                            <option value="5">Telah Divalidasi oleh Dekan</option>
                                            <option value="6">Proses Audit</option>
                                            <option value="7">Telah Diisi oleh Auditor</option>
                                            <option value="8">Telah Dikalkulasi oleh Auditor</option>
                                            <option value="9">Telah Dikunci Nilai oleh Auditor</option>
                                            <option value="10">Proses AL</option>
                                            <option value="0">Belum Diisi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <a href="{{ route('rekapkapus') }}" class="btn btn-danger">Reset</a>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm fs--1 mb-0" id="PenilaianprodiTable">
                                    <thead>
                                        <tr>
                                            <th class="sort border-top ps-3" data-sort="nomor">No</th>
                                            <th class="sort border-top" data-sort="kode">Fakultas</th>
                                            <th class="sort border-top" data-sort="tahun">Prodi</th>
                                            <th class="sort border-top" data-sort="kriteria">Nilai Prodi <br></th>
                                            <th class="sort border-top" data-sort="keterangan">Nilai Auditor</th>
                                            <th class="sort border-top" data-sort="status">status</th>
                                            <th class="sort text-end align-middle pe-0 border-top" scope="col">
                                                Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">


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

<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->
<script>

$(document).ready(function () {

    let table = $('#PenilaianprodiTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('adminrekappenjamu') }}",
            data: function (d) {
                d.status = $('#filterStatus').val(); // ini array // kirim filter status ke server
                d.fakultas = $('#filterFakultas').val(); // kirim filter fakultas ke server
                d.periode = $('#filterPeriode').val(); // kirim filter periode ke server
            }

        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'programstudi.getfakultas.nama_fakultas', name: 'programstudi.getfakultas.nama_fakultas' },
            { data: 'programstudi.nama_prodi', name: 'programstudi.nama_prodi' },
            { data: 'nilai_prodi_final', name: 'nilai_prodi_final' },
            { data: 'nilai_auditor_final', name: 'nilai_auditor_final' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],

        dom: 'lBfrtip', // show buttons above table
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        pageLength: 10, // default
        lengthMenu: [ [10, 50, 100], [10, 50, 100] ], // dropdown options
        destroy: true // if re-initializing
    });

    // gunakan on('change') agar lebih konsisten
    $('#filterStatus, #filterFakultas, #filterPeriode').on('change', function () {
        table.ajax.reload(null, false); // false biar tidak reset pagination
        console.log($('#filterStatus').val())
    });
});
$('#filterStatus').select2({
    placeholder: 'Pilih Status',
    allowClear: true,
    width: '100%'
    // dropdownAutoWidth: true
});


</script>
@endsection
