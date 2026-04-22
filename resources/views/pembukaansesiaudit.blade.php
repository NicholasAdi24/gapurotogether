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

<div class="pb-5">
    <div class="row g-4">
        <!-- <a href="{{route('login')}}" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali
        </a> -->

        <div class="col-12">
            <div class="mb-8" style="text-align: center;">
                <h2 class="mb-2">Pembukaan Sesi Audit</h2>
                <h5 class="text-700 fw-semi-bold">Informasi Pembukaan Sesi Audit dalam Sistem Gapuro</h5>
            </div>

            <form action="{{ route('sesiauditdibuka') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Program Studi</label>
                    <p class="form-control-plaintext">Seluruh Program Studi</p>
                </div>

                {{-- SPMI Periode --}}
                <div class="mb-3">
                    <label for="spmi_periode" class="form-label">SPMI Periode</label>
                    <select class="form-control" name="spmi_periode" id="spmi_periode" required onchange="updatePeriodeInfo()">
                        <option value="">-- Pilih Periode --</option>
                        @foreach ($spmiPeriodes as $periode)
                        <option
                            value="{{ $periode->id }}"
                            data-tahun="{{ $periode->tahun }}"
                            data-status="{{ $periode->status }}">
                            {{ $periode->nama }} ({{ $periode->tahun }})
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tahun --}}
                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <p class="form-control-plaintext" id="tahun-text">-</p>
                    <input type="hidden" name="tahun" id="tahun">
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <p class="form-control-plaintext" id="status-text">-</p>
                    <input type="hidden" name="status" id="status">
                </div>

                {{-- Tombol Submit --}}
                <button type="submit" id="submit-btn" class="btn btn-primary" disabled>Simpan & Buka Sesi</button>
            </form>


            <script>
                function updatePeriodeInfo() {
                    const periodeSelect = document.getElementById('spmi_periode');
                    const tahunText = document.getElementById('tahun-text');
                    const statusText = document.getElementById('status-text');
                    const tahunInput = document.getElementById('tahun');
                    const statusInput = document.getElementById('status');
                    const submitBtn = document.getElementById('submit-btn');

                    const selectedOption = periodeSelect.options[periodeSelect.selectedIndex];
                    const tahun = selectedOption.getAttribute('data-tahun');
                    const status = selectedOption.getAttribute('data-status');

                    // Update tahun
                    tahunText.textContent = tahun ? tahun : '-';
                    tahunInput.value = tahun ? tahun : '';

                    // Update status
                    if (status === '1') {
                        statusText.textContent = "Sudah Dibuka";
                        submitBtn.disabled = true; // Disable tombol jika status 1
                    } else if (status === '0') {
                        statusText.textContent = "Belum Dibuka";
                        submitBtn.disabled = false; // Enable tombol jika status 0
                    } else {
                        statusText.textContent = "-";
                        submitBtn.disabled = true; // Default disable jika belum pilih
                    }

                    statusInput.value = status ? status : '';
                }
            </script>
        </div>
    </div>
</div>

@endsection
