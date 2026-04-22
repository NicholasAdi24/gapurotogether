@extends('master-kapus')

@section('content')
<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('click', function(e) {
        // VALIDASI SATUAN
        if (e.target.classList.contains('btn-confirm-validasi')) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data akan divalidasi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, validasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // BATAL VALIDASI SATUAN
        if (e.target.classList.contains('btn-confirm-batal')) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin batal validasi?',
                text: "Data akan dibatalkan dari status validasi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // VALIDASI SEMUA
        if (e.target.classList.contains('btn-validasi-semua')) {
            e.preventDefault();
            Swal.fire({
                title: 'Validasi seluruh penilaian?',
                text: "Semua indikator akan divalidasi sekaligus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, validasi semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // BATAL VALIDASI SEMUA
        if (e.target.classList.contains('btn-batal-validasi-semua')) {
            e.preventDefault();
            Swal.fire({
                title: 'Batalkan seluruh validasi?',
                text: "Semua validasi indikator akan dibatalkan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, batalkan semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // KALKULASI PRODI
        if (e.target.classList.contains('btn-kalkulasi-prodi')) {
            e.preventDefault();
            Swal.fire({
                title: 'Lakukan kalkulasi nilai prodi?',
                text: "Nilai akan dikalkulasi dan disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, kalkulasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }

        // KALKULASI AUDITOR
        if (e.target.classList.contains('btn-kalkulasi-auditor')) {
            e.preventDefault();
            Swal.fire({
                title: 'Lakukan kalkulasi nilai auditor?',
                text: "Nilai auditor akan dihitung dan disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, kalkulasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.closest('form').submit();
                }
            });
        }
    });
</script>
<script>
    let typingTimer;

    function submitWithDelay(form) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => {
            form.submit();
        }, 1000);
    }
</script>


<div class="pb-5">
    <div class="row g-4">
        <!-- <a href="{{route('login')}}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali
        </a> -->
        <div class="col-12">
            <div class="mb-8" style="text-align: center;">
                <h2 class="mb-2">Rekapitulasi Penilaian</h2>
                <h5 class="text-700 fw-semi-bold">Informasi Rekapitulasi Penilaian dalam Sistem Gapuro</h5>
            </div>

            <form method="GET" action="{{ route('rekapkapus') }}" class="mb-3">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label for="fakultas">Fakultas</label>
                        <select name="fakultas" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Semua Fakultas --</option>
                            @foreach ($allFakultas as $fakultas)
                            <option value="{{ $fakultas->id }}" {{ request('fakultas') == $fakultas->id ? 'selected' : '' }}>
                                {{ $fakultas->nama_fakultas }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="periode">Periode</label>
                        <select name="periode" class="form-control" onchange="this.form.submit()">
                            <option value="">-- Semua Periode --</option>
                            @foreach ($allPeriode as $periode)
                            <option value="{{ $periode->id }}" {{ request('periode') == $periode->id ? 'selected' : '' }}>
                                {{ $periode->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="search">Cari Program Studi</label>
                        <input type="text" name="search" class="form-control"
                            value="{{ request('search') }}" placeholder="Ketik nama program studi..."
                            oninput="submitWithDelay(this.form)">
                    </div>
                </div>
                <div class="mt-2">
                    <a href="{{ route('rekapkapus') }}" class="btn btn-danger">Reset</a>
                </div>
            </form>


            <table class="table table-bordered" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Fakultas</th>
                        <th>Program Studi</th>
                        <th>Periode</th>
                        <th>Tahun</th>
                        <th>Nilai Prodi Final</th>
                        <th>Nilai Auditor Final</th>
                        <th>Skor Final</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->programstudi->getfakultas->nama_fakultas ?? '-' }}</td>
                        <td>{{ $item->programstudi->nama_prodi ?? '-' }}</td>
                        <td>{{ $item->spmiperiode->nama ?? '-' }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>{{ $item->nilai_prodi_final }}</td>
                        <td>{{ $item->nilai_auditor_final }}</td>
                        <td>{{ $item->skor_final }}</td>
                        <td class="align-middle" style="width:1%; white-space: nowrap;">
                            @php
                            switch ($item->status ?? 0) {
                            case 1:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-info">TELAH DIISI OLEH PRODI</span>';
                            break;
                            case 2:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">TELAH DIKALKULASI OLEH PRODI</span>';
                            break;
                            case 3:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKUNCI NILAI OLEH PRODI</span>';
                            break;
                            case 4:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-success">TELAH DIVALIDASI OLEH WADEK 1</span>';
                            break;
                            case 5:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-info">TELAH DIVALIDASI OLEH DEKAN</span>';
                            break;
                            case 6:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-primary">PROSES AUDIT</span>';
                            break;
                            case 7:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIISI OLEH AUDITOR</span>';
                            break;
                            case 8:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKALKULASI OLEH AUDITOR</span>';
                            break;
                            case 9:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-warning">TELAH DIKUNCI NILAI OLEH AUDITOR</span>';
                            break;
                            default:
                            $status = '<span class="badge badge-phoenix ms-auto fs--2 badge-phoenix-danger">BELUM DIISI</span>';
                            break;
                            }
                            @endphp
                            {!! $status !!}
                        </td>
                        <td>
                            <form action="{{ route('penjaminanmutuprodikapusspmi') }}" method="POST">
                                @csrf
                                <input type="hidden" name="prodi_id" value="{{ $item->programstudis_id}}">
                                <input type="hidden" name="nama_prodi" value="{{ $item->programstudi->nama_prodi }}">
                                <button class="btn btn-primary w-100 fw-bold mb-3">
                                    Lihat Detail
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tombol Mengatur Halaman -->
            <div class="d-flex justify-content-center mt-3">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>


@endsection
