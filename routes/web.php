<?php

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtlController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpmiController;
use App\Http\Controllers\TpmfController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\DekanController;
use App\Http\Controllers\Lp2mpController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\WadekController;
use App\Http\Controllers\WarekController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\PenjamuController;
use App\Http\Controllers\KapusSpmiController;
use App\Http\Controllers\AkreditasiController;
use App\Http\Controllers\UniversitasController;
use App\Http\Controllers\AdminpenjamuController;
use App\Http\Controllers\PenjamucetakController;

// Controller LAM-Teknik
use App\Http\Controllers\LamTeknik\LamTeknikController;
use App\Http\Controllers\LamTeknik\LamTeknikControllerV2;
// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landingpage');
// Login Page
Route::get('/login', function () {
    if (Auth::check()) {
        // Kalau sudah login, redirect ke chooserole
        return redirect()->route('chooserole');
    }
    // Kalau belum login, tampilkan halaman login
    return view('login');
})->name('login');

// Route Middleware First (not login)
Route::post('/loginattempt', [AuthController::class, 'loginattempt'])->name('loginattempt');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/chooserole', [AuthController::class, 'chooserole'])->name('chooserole');
    Route::get('/logoutattempt', [AuthController::class, 'logoutattempt'])->name('logout');
});

// Organize dan Auth Permision Route Prodi
Route::get('/logoutprodi', [AuthController::class, 'logoutprodi'])->name('logoutprodi');
Route::post('/chooseroleattempt', [AuthController::class, 'chooseroleattempt'])->name('chooseroleattempt');

// Kapus SPMI
Route::middleware(['auth'])->group(function () {
    Route::get('/penugasanauditormenu', [KapusSpmiController::class, 'penugasanauditormenu'])->name('penugasanauditormenu'); // Menu Penugasan Auditor pada Role Kapus Penjamu Internal
    Route::get('/pembukaansesiaudit', [KapusSpmiController::class, 'pembukaansesiaudit'])->name('pembukaansesiaudit'); // Menu Pembukaan Sesi Audit pada Role Kapus Penjamu Internal
    Route::post('/penugasanauditorpilih', [KapusSpmiController::class, 'penugasanauditorpilih'])->name('penugasanauditorpilih'); // Penugasan Auditor pada Role Kapus Penjamu Internal
    Route::post('/sesiauditdibuka', [KapusSpmiController::class, 'sesiauditdibuka'])->name('sesiauditdibuka'); // Pembukaan Sesi Audit pada Role Kapus Penjamu Internal
    Route::get('/rekapkapus', [KapusSpmiController::class, 'rekapkapus'])->name('rekapkapus'); // Rekap pada Role Kapus Penjamu Internal
    Route::post('/penjaminanmutuprodikapusspmi', [KapusSpmiController::class, 'penjaminanmutuprodikapusspmi'])->name('penjaminanmutuprodikapusspmi');
});


//
Route::middleware(['auth'])->group(function () {
    Route::post('/chooseprodiattempt', [AuthController::class, 'chooseprodiattempt'])->name('chooseprodiattempt');
    Route::get('/dashboardprodi2', [AuthController::class, 'dashboardprodi2'])->name('dashboardprodi2');
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::get('/dashboardprodi', function () {
        return view('pagesprodi.dashboard');
    })->name('dashboardprodi');
    Route::get('/penjamuprodi', [PenjamuController::class, 'penjaminanmutuprodi'])->name('penjamuprodi');
    Route::get('/penjamuelemen/{id}', [PenjamuController::class, 'penjamuelemen'])->name('penjamuelemen');
    Route::get('/penjamuindikator/{id}', [PenjamuController::class, 'penjamuindikator'])->name('penjamuindikator');
    //Route::get('/penjamuindikatorhasil', [PenjamuController::class, 'penjamuindikatorhasil'])->name('penjamuindikatorhasil');
    Route::get('/penjamuindikatorhasil/{id}', [PenjamuController::class, 'penjamuindikatorhasil'])->name('penjamuindikatorhasil');
    Route::get('/penjamuindikatordetail/{id}', [PenjamuController::class, 'penjamuindikatordetail'])->name('penjamuindikatordetail');
    Route::post('/penjamupenilaianindikator', [PenjamuController::class, 'penjamupenilaianindikator'])->name('penjamupenilaianindikator');

    Route::post('/penjamuindikatordetailposts', [PenjamuController::class, 'penjamuindikatordetail_store'])->name('penjamuindikatordetailposts.store');
    Route::put('/penjamuindikatordetailposts/{id}', [PenjamuController::class, 'penjamuindikatordetail_update'])->name('penjamuindikatordetailposts.update');
    Route::post('/penjamuindikatorkualitatif', [PenjamuController::class, 'penjamuindikatorkualitatif_update'])->name('penjamuindikatorkualitatif.update');

    Route::post('/penjamuindikatorsubdetailposts', [PenjamuController::class, 'penjamuindikatorsubdetail_store'])->name('penjamuindikatorsubdetailposts.store');
    Route::put('/penjamuindikatorsubdetailposts/{id}', [PenjamuController::class, 'penjamuindikatorsubdetail_update'])->name('penjamuindikatorsubdetailposts.update');


    Route::post('/penjamukomponenposts', [PenjamuController::class, 'penjamukomponen_store'])->name('penjamukomponenposts.store');
    Route::put('/penjamukomponenposts/{id}', [PenjamuController::class, 'penjamukomponen_update'])->name('penjamukomponenposts.update');

    Route::post('/penilaiancalculate', [PenjamuController::class, 'penilaiancalculate'])->name('penilaiancalculate');
    Route::post('/komponencalculate', [PenjamuController::class, 'komponencalculate'])->name('komponencalculate');
    Route::post('/laporangenerate', [PenjamuController::class, 'laporangenerate'])->name('laporan.generate');
    Route::get('/laporangenerate_excel', [PenjamucetakController::class, 'laporangenerate_excel'])->name('laporan.generate_excel');

    // RTL
    Route::get('/rtlprodi', [RtlController::class, 'rtlprodi'])->name('rtlprodi');
    Route::get('/rtldetail/{id}', [RtlController::class, 'rtldetail'])->name('rtldetail');
    Route::get('/rtlaction/{id}', [RtlController::class, 'rtlaction'])->name('rtlaction');
    Route::post('/rtlposts', [RtlController::class, 'rtlposts_store'])->name('rtlposts.store');
    Route::put('/rtlposts/{id}', [RtlController::class, 'rtlposts_update'])->name('rtlposts.update');
    Route::get('/laporangenerate_rtl', [RtlController::class, 'laporangenerate_rtl'])->name('laporan.generate_rtl');

    Route::match(['get', 'post'], '/changepassword', [AuthController::class, 'changepassword'])->name('changepassword');
});




// penjaminanmutukomponendetailposts
// Auditor
Route::middleware(['auth'])->group(function () {
    Route::get('/daftarpengisianaudit', [AuditController::class, 'daftarpengisianaudit'])->name('daftarpengisianaudit'); // Daftar Program Studi untuk diisi oleh Auditor
    Route::get('/daftarpengisianauditselesai', [AuditController::class, 'daftarpengisianauditselesai'])->name('daftarpengisianauditselesai'); // Daftar Program Studi Selesai untuk diisi oleh Auditor
    Route::post('/listakreditasi', [AuditController::class, 'listakreditasi'])->name('listakreditasi'); // Daftar Akreditasi Program Studi
    Route::post('/penjaminanmutuauditor', [AuditController::class, 'penjaminanmutuauditor'])->name('penjaminanmutuauditor'); // Menu Penjaminan Mutu
    Route::post('/penjaminanmutuauditorselesai', [AuditController::class, 'penjaminanmutuauditorselesai'])->name('penjaminanmutuauditorselesai'); // Penjaminan Mutu Selesai
    Route::post('/penjaminanmutuauditorbatalselesai', [AuditController::class, 'penjaminanmutuauditorbatalselesai'])->name('penjaminanmutuauditorbatalselesai'); // Penjaminan Mutu Tidak jadi Selesai


    Route::get('/auditindikatordetail/{id}', [AuditController::class, 'auditindikatordetail'])->name('auditindikatordetail');
    Route::put('/auditindikatordetailposts/{id}', [AuditController::class, 'auditindikatordetail_update'])->name('auditindikatordetailposts.update');

    Route::put('/auditindikatorsubdetailposts', [AuditController::class, 'auditindikatorsubdetail_store'])->name('auditindikatorsubdetailposts.store');
    Route::put('/auditindikatorsubdetailposts/{id}', [AuditController::class, 'auditindikatorsubdetail_update'])->name('auditindikatorsubdetailposts.update');

    Route::post('/auditkomponenposts', [AuditController::class, 'auditkomponen_store'])->name('auditkomponenposts.store');
    Route::post('/penjamukomponenauditposts', [AuditController::class, 'penjamukomponenaudit_store'])->name('penjamukomponenauditposts.store');
    Route::put('/penjamukomponenauditposts/{id}', [AuditController::class, 'penjamukomponenaudit_update'])->name('penjamukomponenauditposts.update');


    Route::post('/penilaiancalculateauditor', [AuditController::class, 'penilaiancalculateauditor'])->name('penilaiancalculateauditor');
    // Route::post('/komponencalculateauditor', [AuditController::class, 'komponencalculate'])->name('komponencalculateauditor');
    Route::post('/komponencalculateauditor', [AuditController::class, 'komponencalculateauditor'])->name('komponencalculateauditor');

    Route::post('/kalkulasiauditor', [AuditController::class, 'kalkulasiauditor'])->name('kalkulasiauditor'); // Kalkulasi Penilaian oleh Auditor
    Route::post('/kuncinilaiauditor', [AuditController::class, 'kuncinilaiauditor'])->name('kuncinilaiauditor'); // Kunci Penilaian oleh Auditor
    Route::post('/prosesalauditor', [AuditController::class, 'prosesalauditor'])->name('prosesalauditor'); // Kunci Penilaian oleh Auditor
    Route::post('/bukakuncinilaiauditor', [AuditController::class, 'bukakuncinilaiauditor'])->name('bukakuncinilaiauditor'); // Buka Kunci Penilaian oleh Auditor
    Route::post('/kuncimutuauditor', [AuditController::class, 'kuncimutuauditor'])->name('kuncimutuauditor'); // Kunci Mutu Penilaian oleh Auditor

    Route::post(
        '/penjamuindikatorkualitatifauditor',
        [AuditController::class, 'penjamuindikatorkualitatifauditor_update']
    )->name('penjamuindikatorkualitatifauditor_update');
});



// Dekan
Route::middleware(['auth'])->group(function () {
    Route::get('/validasidekanwadek', [DekanController::class, 'validasidekanwadek'])->name('validasidekanwadek'); // Daftar Validasi
    Route::post('/validasisatuandekan', [DekanController::class, 'validasisatuandekan'])->name('validasisatuandekan'); // Validasi
    Route::post('/validasisatuanbataldekan', [DekanController::class, 'validasisatuanbataldekan'])->name('validasisatuanbataldekan'); // Batal Validasi
    Route::post('/validasisemuadekan', [DekanController::class, 'validasisemuadekan'])->name('validasisemuadekan'); // Validasi Semua
    Route::post('/validasisemuabataldekan', [DekanController::class, 'validasisemuabataldekan'])->name('validasisemuabataldekan'); // Batal Validasi Semua
    Route::post('/penjaminanmutuprodidekan', [DekanController::class, 'penjaminanmutuprodidekan'])->name('penjaminanmutuprodidekan');
    Route::post('/validasiseluruhprodidekan', [DekanController::class, 'validasiseluruhprodidekan'])->name('validasiseluruhprodidekan');
    Route::post('/clear-session', function (Request $request) {
        $key = $request->input('key');
        session()->forget($key);
        return response()->json(['success' => true]);
    })->name('clear-session');

    // Wakil Dekan 1
    Route::post('/validasisatuanwadek', [WadekController::class, 'validasisatuanwadek'])->name('validasisatuanwadek'); // Validasi
    Route::post('/validasisatuanbatalwadek', [WadekController::class, 'validasisatuanbatalwadek'])->name('validasisatuanbatalwadek'); // Batal Validasi
    Route::post('/validasisemuawadek', [WadekController::class, 'validasisemuawadek'])->name('validasisemuawadek'); // Validasi Semua
    Route::post('/validasisemuabatalwadek', [WadekController::class, 'validasisemuabatalwadek'])->name('validasisemuabatalwadek'); // Batal Validasi Semua
    Route::post('/penjaminanmutuprodiwadek', [WadekController::class, 'penjaminanmutuprodiwadek'])->name('penjaminanmutuprodiwadek');
    Route::post('/validasiseluruhprodiwadek', [WadekController::class, 'validasiseluruhprodiwadek'])->name('validasiseluruhprodiwadek');
    Route::post('/clear-session', function (Request $request) {
        $key = $request->input('key');
        session()->forget($key);
        return response()->json(['success' => true]);
    })->name('clear-session');
});

// TPMF
Route::middleware(['auth'])->group(function () {
    Route::post('/penjaminanmutuproditpmf', [TpmfController::class, 'penjaminanmutuproditpmf'])->name('penjaminanmutuproditpmf');
});

// LP2MP
Route::middleware(['auth'])->group(function () {
    Route::get('/monitorpenilaianlp2mp', [Lp2mpController::class, 'monitorpenilaianlp2mp'])->name('monitorpenilaianlp2mp'); // Rekap pada Role Ketua/Pimpinan LP2MP
    Route::post('/penjaminanmutuprodilp2mp', [Lp2mpController::class, 'penjaminanmutuprodilp2mp'])->name('penjaminanmutuprodilp2mp');
});

// WAREK
Route::middleware(['auth'])->group(function () {
    Route::get('/monitorpenilaianwarek', [WarekController::class, 'monitorpenilaianwarek'])->name('monitorpenilaianwarek'); // Rekap pada Role Warek
    Route::post('/penjaminanmutuprodiwarek', [WarekController::class, 'penjaminanmutuprodiwarek'])->name('penjaminanmutuprodiwarek');
});

// Prodi
Route::middleware(['auth'])->group(function () {
    Route::post('/kalkulasiprodi', [ProdiController::class, 'kalkulasiprodi'])->name('kalkulasiprodi'); // Kalkulasi Penilaian oleh Prodi
    Route::post('/kuncinilaiprodi', [ProdiController::class, 'kuncinilaiprodi'])->name('kuncinilaiprodi'); // Kunci Penilaian oleh Prodi
    Route::post('/bukakuncinilaiprodi', [ProdiController::class, 'bukakuncinilaiprodi'])->name('bukakuncinilaiprodi'); // Buka Kunci Penilaian oleh Prodi
});

// Organize dan Auth Permission Super Admin
Route::middleware(['auth'])->group(function () {
    // user
    Route::get('/user', [AuthController::class, 'Getuser'])->name('user');
    Route::get('/user-show/{id}', [AuthController::class, 'show'])->name('users.show');
    Route::post('/user-store', [AuthController::class, 'store'])->name('users.store');
    Route::put('/user-edit/{id}', [AuthController::class, 'edit'])->name('users.edit');
    Route::delete('/user-destroy/{id}', [AuthController::class, 'destroy'])->name('users.destroy');
    // userrole
    Route::get('/userrole', [AuthController::class, 'Getuserrole'])->name('userrole');
    Route::post('/userrole-store', [AuthController::class, 'userrolesstore'])->name('userroles.store');
    Route::get('/userrole-show/{id}', [AuthController::class, 'userrolesshow'])->name('userroles.show');
    Route::put('/userrole-edit/{id}', [AuthController::class, 'userrolesedit'])->name('userroles.edit');
    Route::delete('/userrole-destroy/{id}', [AuthController::class, 'userrolesdestroy'])->name('userroles.destroy');
    // userprodi
    Route::get('/userprodi', [AuthController::class, 'Getuserprodi'])->name('userprodi');
    Route::post('/userprodi-store', [AuthController::class, 'userprodisstore'])->name('userprodis.store');
    Route::get('/userprodi-show/{id}', [AuthController::class, 'userprodisshow'])->name('userprodis.show');
    Route::put('/userprodi-edit/{id}', [AuthController::class, 'userprodisedit'])->name('userprodis.edit');
    Route::delete('/userprodi-destroy/{id}', [AuthController::class, 'userprodisdestroy'])->name('userprodis.destroy');
    // userfakultas
    Route::get('/userfakultas', [AuthController::class, 'Getuserfakultas'])->name('userfakultas');
    Route::post('/userfakultas-store', [AuthController::class, 'userfakultassstore'])->name('userfakultass.store');
    Route::get('/userfakultas-show/{id}', [AuthController::class, 'userfakultassshow'])->name('userfakultass.show');
    Route::put('/userfakultas-edit/{id}', [AuthController::class, 'userfakultassedit'])->name('userfakultass.edit');
    Route::delete('/userfakultas-destroy/{id}', [AuthController::class, 'userfakultassdestroy'])->name('userfakultass.destroy');

    // akreditasi univ
    Route::get('/akreditasiuniv', [AkreditasiController::class, 'GetAkreduniv'])->name('akreditasiuniv');
    // akreditasi nasional
    Route::get('/akreditasinasional', [AkreditasiController::class, 'GetAkredprodinasional'])->name('akreditasinasional');
    // akreditasi internasional
    Route::get('/akreditasiinternasional', [AkreditasiController::class, 'GetAkredprodiinternasional'])->name('akreditasiinternasional');
    // list akreditasi id
    Route::get('/akreditasi/{id}', [AkreditasiController::class, 'GetAkred'])->name('akreditasi');
    Route::post('/akreditasi-store', [AkreditasiController::class, 'store'])->name('akreditasi.store');
    Route::post('/akreditasi-edit', [AkreditasiController::class, 'edit'])->name('akreditasi.edit');
    Route::get('/akreditasi-destroy/{id}', [AkreditasiController::class, 'destroy'])->name('akreditasi.destroy');
    Route::get('/akreditasi-show/{id}', [AkreditasiController::class, 'show'])->name('akreditasi.show');
    //Dokumen
    Route::get('/dokumenadmin', [DokumenController::class, 'Getdokumen'])->name('dokumenadmin');
    Route::get('/dokumen', [DokumenController::class, 'Getprodidokumen'])->name('dokumen');
    Route::post('/dokumen-store', [DokumenController::class, 'store'])->name('dokumen.store');
    Route::post('/dokumen-edit', [DokumenController::class, 'edit'])->name('dokumen.edit');
    Route::get('/dokumen-destroy/{id}', [DokumenController::class, 'destroy'])->name('dokumen.destroy');
    Route::get('/dokumen-show/{id}', [DokumenController::class, 'show'])->name('dokumen.show');


    // Rekap Penjamu
    Route::get('/adminrekappenjamu', [AdminpenjamuController::class, 'adminrekappenjamu'])->name('adminrekappenjamu');

    Route::get('/role', [AuthController::class, 'Getrole'])->name('role');
    Route::get('/fakultas', [UniversitasController::class, 'GetFakultas'])->name('fakultas');
    Route::get('/programstudi', [UniversitasController::class, 'GetProgramstudi'])->name('programstudi');
    Route::get('/spmielemen', [SpmiController::class, 'GetSpmielemen'])->name('spmielemen');
    Route::get('/spmielemenid/{id}', [SpmiController::class, 'GetSpmielemenid'])->name('spmielemenid');
    Route::get('/spmiindikator', [SpmiController::class, 'GetSpmiindikator'])->name('spmiindikator');
    Route::get('/spmibobot', [SpmiController::class, 'GetSpmibobot'])->name('spmibobot');
    Route::get('/spmiindikatordetail/{id}', [SpmiController::class, 'GetSpmiindikatorid'])->name('spmiindikatordetail');
});

// routes/web.php
Route::get('/refresh-captcha', function () {
    return response()->json([
        'captcha' => captcha_src()
    ]);
})->name('captcha.refresh');


// Lembaga LAM TEKNIK v1
// Route::post('/penilaiancalculatelamteknik', [LamTeknikController::class, 'penilaiancalculatelamteknik'])->name('penilaiancalculatelamteknik');
// Route::post('/penilaiancalculateauditorlamteknik', [LamTeknikController::class, 'penilaiancalculateauditorlamteknik'])->name('penilaiancalculateauditorlamteknik');
// Route::post('/komponencalculatelamteknik', [LamTeknikController::class, 'komponencalculatelamteknik'])->name('komponencalculatelamteknik');
// Route::post('/komponencalculateauditorlamteknik', [LamTeknikController::class, 'komponencalculateauditorlamteknik'])->name('komponencalculateauditorlamteknik');

// Lembaga LAM TEKNIK v2
Route::post('/v2/penilaiancalculatelamteknik', [LamTeknikControllerV2::class, 'penilaiancalculatelamteknik'])->name('v2.penilaiancalculatelamteknik');
Route::post('/v2/penilaiancalculateauditorlamteknik', [LamTeknikControllerV2::class, 'penilaiancalculateauditorlamteknik'])->name('v2.penilaiancalculateauditorlamteknik');
Route::post('/v2/komponencalculatelamteknik', [LamTeknikControllerV2::class, 'komponencalculatelamteknik'])->name('v2.komponencalculatelamteknik');
Route::post('/v2/komponencalculateauditorlamteknik', [LamTeknikControllerV2::class, 'komponencalculateauditorlamteknik'])->name('v2.komponencalculateauditorlamteknik');

// Route V1 (Tetap sama)
Route::controller(LamTeknikController::class)->group(function () {
    Route::post('/penilaiancalculatelamteknik',        'penilaiancalculatelamteknik')->name('penilaiancalculatelamteknik');
    Route::post('/penilaiancalculateauditorlamteknik', 'penilaiancalculateauditorlamteknik')->name('penilaiancalculateauditorlamteknik');
    Route::post('/komponencalculatelamteknik',         'komponencalculatelamteknik')->name('komponencalculatelamteknik');
    Route::post('/komponencalculateauditorlamteknik',  'komponencalculateauditorlamteknik')->name('komponencalculateauditorlamteknik');
});

// Route V2 (Lebih rapi dengan Prefix)
// Route::controller(LamTeknikControllerV2::class)
//     ->prefix('v2') // Menambahkan '/v2' di depan semua URL
//     ->name('v2.')  // Menambahkan 'v2.' di depan semua nama route
//     ->group(function () {
//         // Hasil URL: /v2/penilaiancalculatelamteknik
//         // Hasil Name: v2.penilaiancalculatelamteknik
//         Route::post('/penilaiancalculatelamteknik',        'penilaiancalculatelamteknik')->name('penilaiancalculatelamteknik');
//         Route::post('/penilaiancalculateauditorlamteknik', 'penilaiancalculateauditorlamteknik')->name('penilaiancalculateauditorlamteknik');
//         Route::post('/komponencalculatelamteknik',         'komponencalculatelamteknik')->name('komponencalculatelamteknik');
//         Route::post('/komponencalculateauditorlamteknik',  'komponencalculateauditorlamteknik')->name('komponencalculateauditorlamteknik');
//     });
