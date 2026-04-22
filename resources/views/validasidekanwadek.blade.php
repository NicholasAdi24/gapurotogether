@extends('master-kapus')

@section('content')
<script src="{{asset('templates/vendors/echarts/echarts.min.js')}}"></script>
<script src="{{asset('templates/assets/js/echarts-example.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeButtons = document.querySelectorAll('.btn-close[data-session-key]');
        closeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const sessionKey = btn.getAttribute('data-session-key');
                fetch("{{ route('clear-session') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            key: sessionKey
                        })
                    })
                    .then(response => response.json())
                    .then(data => console.log('Session cleared:', data))
                    .catch(error => console.error('Error clearing session:', error));
            });
        });
    });
</script>


<div class="pb-5">
    <div class="row g-4">
        <div class="col-12">
            <div class="mb-8" style="text-align: center;">
                <h2 class="mb-2">Daftar Program Studi</h2>
                <h4 class="mb-2 text-700 fw-semi-bold">Informasi Daftar Program Studi</h4>
            </div>

            @if($userroles->first()->roles_id == 7)
            <div class="d-flex justify-content-end align-items-center mb-4">
                <button
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#validasiModal">
                    Validasi Seluruh Program Studi
                </button>
            </div>
            <div class="modal fade" id="validasiModal" tabindex="-1" aria-labelledby="validasiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('validasiseluruhprodidekan') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="validasiModalLabel">Validasi Periode SPMI</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="spmi_periodes_id" class="form-label">Pilih Periode SPMI</label>
                                    <select class="form-select" id="spmi_periodes_id" name="spmi_periodes_id" required>
                                        <option value="">-- Pilih Periode --</option>
                                        @foreach ($spmiperiodes as $periode)
                                        <option value="{{ $periode->id }}">
                                            {{ $periode->nama }} ({{ $periode->tahun }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="fakultas_id" value="{{ $fakultas_id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Validasi</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (session('suksesvalidasiseluruhprodidekan'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('suksesvalidasiseluruhprodidekan') }}
                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                    data-session-key="suksesvalidasiseluruhprodidekan"></button>
            </div>
            @endif

            @if (session('gagalvalidasiseluruhprodidekan'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('gagalvalidasiseluruhprodidekan') }}
                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                    data-session-key="gagalvalidasiseluruhprodidekan"></button>
            </div>
            @endif

            <table class="table table-bordered" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Program Studi</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>

                        <td>{{ $item->nama_prodi ?? '-' }}</td>
                        <td>
                            @foreach($item->spmipenilaianprodi as $penilaian)
                            {{ $penilaian->spmiperiode->nama ?? 'Periode Tidak Ada' }} = @php
                            switch ($penilaian->status ?? 0) {
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

                            {!! $status !!}<br>
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('penjaminanmutuprodidekan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="prodi_id" value="{{ $item->id }}">
                                <button class="btn btn-primary w-100 fw-bold mb-3">
                                    Penjaminan Mutu
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @elseif($userroles->first()->roles_id == 13)
            <div class="d-flex justify-content-end align-items-center mb-4">
                <button
                    class="btn btn-success"
                    data-bs-toggle="modal"
                    data-bs-target="#validasiModal">
                    Validasi Seluruh Program Studi
                </button>
            </div>
            <div class="modal fade" id="validasiModal" tabindex="-1" aria-labelledby="validasiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('validasiseluruhprodiwadek') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="validasiModalLabel">Validasi Periode SPMI</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="spmi_periodes_id" class="form-label">Pilih Periode SPMI</label>
                                    <select class="form-select" id="spmi_periodes_id" name="spmi_periodes_id" required>
                                        <option value="">-- Pilih Periode --</option>
                                        @foreach ($spmiperiodes as $periode)
                                        <option value="{{ $periode->id }}">
                                            {{ $periode->nama }} ({{ $periode->tahun }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="fakultas_id" value="{{ $fakultas_id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Validasi</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (session('suksesvalidasiseluruhprodiwadek'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('suksesvalidasiseluruhprodiwadek') }}
                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                    data-session-key="suksesvalidasiseluruhprodiwadek"></button>
            </div>
            @endif

            @if (session('gagalvalidasiseluruhprodiwadek'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('gagalvalidasiseluruhprodiwadek') }}
                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                    data-session-key="gagalvalidasiseluruhprodiwadek"></button>
            </div>
            @endif

            <table class="table table-bordered" style="text-align: center;">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Program Studi</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>

                        <td>{{ $item->nama_prodi ?? '-' }}</td>
                        <td>
                            @foreach($item->spmipenilaianprodi as $penilaian)
                            {{ $penilaian->spmiperiode->nama ?? 'Periode Tidak Ada' }} = @php
                            switch ($penilaian->status ?? 0) {
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

                            {!! $status !!}<br>
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('penjaminanmutuprodiwadek') }}" method="POST">
                                @csrf
                                <input type="hidden" name="prodi_id" value="{{ $item->id }}">
                                <button class="btn btn-primary w-100 fw-bold mb-3">
                                    Penjaminan Mutu
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @endif

            <!-- Tombol Mengatur Halaman -->
            <div class="d-flex justify-content-center mt-3">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>


@endsection