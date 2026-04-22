@extends('app')
<!-- Agustinus update -->
@section('content')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main style="--phoenix-scroll-margin-top: 1.2rem;">
    <div class="bg-white sticky-top landing-navbar" data-navbar-shadow-on-scroll="data-navbar-shadow-on-scroll">
        <nav class="navbar navbar-expand-lg container-small px-3 px-lg-7 px-xxl-3"><a
                class="navbar-brand flex-1 flex-lg-grow-0" href="{{ route('landingpage') }}">
                <div class="d-flex align-items-center"><img src="{{asset('templates/assets/img/icons/logo new.png') }}"
                        alt="phoenix" width="27" />
                    <p class="logo-text ms-2">GAPURO</p>
                </div>
            </a>
            <div class="d-lg-none">
                <div class="theme-control-toggle fa-icon-wait px-2"><input
                        class="form-check-input ms-0 theme-control-toggle-input" type="checkbox"
                        data-theme-control="phoenixTheme" value="dark" id="themeControlToggleSm" /><label
                        class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggleSm"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                            data-feather="moon"></span></label><label
                        class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggleSm"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Switch theme"><span class="icon"
                            data-feather="sun"></span></label></div>
            </div><button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="border-bottom border-bottom-lg-0 mb-2">
                    <div class="search-box d-inline d-lg-none">
                        <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input
                                class="form-control search-input search rounded-pill my-4" type="search"
                                placeholder="Search" aria-label="Search" />
                            <span class="fas fa-search search-box-icon"></span>
                        </form>
                    </div>
                </div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item
                    border-bottom border-bottom-lg-0"><a
                            class="nav-link lh-1 py-0 fs--1 fw-bold py-3 active" aria-current="page"
                            href="#">Beranda</a></li>
                    <li class="nav-item border-bottom border-bottom-lg-0"><a
                            class="nav-link lh-1 py-0 fs--1 fw-bold py-3" href="#feature">Profil</a></li>
                    <li class="nav-item border-bottom border-bottom-lg-0"><a
                            class="nav-link lh-1 py-0 fs--1 fw-bold py-3" href="#tujuan">Tujuan</a></li>
                    <li class="nav-item"><a class="nav-link lh-1 py-0 fs--1 fw-bold py-3" href="#team">Struktur
                            Organisasi</a></li>
                    <li class="nav-item"><a class="nav-link lh-1 py-0 fs--1 fw-bold py-3" href="#dataakreditasi">Data
                            Akreditasi</a></li>
                </ul>
                <div class="d-grid d-lg-flex align-items-center">
                    <div class="nav-item d-flex align-items-center d-none d-lg-block pe-2">
                        <div class="theme-control-toggle fa-icon-wait px-2"><input
                                class="form-check-input ms-0 theme-control-toggle-input" type="checkbox"
                                data-theme-control="phoenixTheme" value="dark" id="themeControlToggle" /><label
                                class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                                for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Switch theme"><span class="icon" data-feather="moon"></span></label><label
                                class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                                for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Switch theme"><span class="icon" data-feather="sun"></span></label></div>
                    </div><a class="text-700 hover-text-1100 px-2 d-none d-lg-inline lh-sm" href="#"
                        data-bs-toggle="modal" data-bs-target="#searchBoxModal"><span data-feather="search"
                            style="height: 20px; width: 20px;"></span></a><a
                        class="btn btn-link text-900 order-1 order-lg-0 ps-4 me-lg-2"
                        href="{{ route('login') }}">Sign in</a><a
                        class="btn btn-phoenix-primary order-0" href="../authentication/simple/sign-up.html"><span
                            class="fw-bold">Sign Up</span></a>
                </div>
            </div>
        </nav>
    </div>
    {{-- --}}
    <section class="bg-white pb-8" id="home">
        <div class="container-small hero-header-container px-lg-7 px-xxl-3">
            <div class="row align-items-center">
                <div class="col-12 col-lg-auto order-0 order-md-1 text-end order-1">
                    <div class="position-relative p-5 p-md-7 d-lg-none">
                        <div class="bg-holder"
                            style="background-image:url({{asset('templates/assets/img/bg/bg-23.png') }}') }};background-size:contain;">
                        </div>
                        <!--/.bg-holder-->
                        <div class="position-relative"><img class="w-100 shadow-lg d-dark-none rounded-2"
                                src="{{asset('templates/assets/img/bg/bg-31.png') }}" alt="hero-header" /><img
                                class="w-100 shadow-lg d-light-none rounded-2"
                                src="{{asset('templates/assets/img/bg/bg-30.png') }}" alt="hero-header" /></div>
                    </div>
                    <div class="hero-image-container position-absolute top-0 bottom-0 end-0 d-none d-lg-block">
                        <div class="position-relative h-100 w-100">
                            <div
                                class="position-absolute h-100 top-0 d-flex align-items-center end-0 hero-image-container-bg">
                                <img class="pt-7 pt-md-0 w-100" src="{{asset('templates/assets/img/bg/bg-1-2.png') }}"
                                    alt="hero-header" />
                            </div>
                            <div class="position-absolute h-100 top-0 d-flex align-items-center end-0"><img
                                    class="pt-7 pt-md-0 w-100 shadow-lg d-dark-none rounded-2"
                                    src="{{asset('templates/assets/img/bg/bg-28.png') }}" alt="hero-header" /><img
                                    class="pt-7 pt-md-0 w-100 shadow-lg d-light-none rounded-2"
                                    src="{{asset('templates/assets/img/bg/bg-29.png') }}" alt="hero-header" /></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 text-lg-start text-center pt-8 pb-6 order-0 position-relative">
                    <h1 class="fs-5 fs-lg-6 fs-md-7 fs-lg-6 fs-xl-7 fs fw-black mb-4"><span
                            class="text-primary me-3">GAPURO</span><br /></h1>
                    <h2 class="fs-3 fs-lg-4 fs-md-5 fs-lg-4 fs-xl-5 fs fw-black mb-2">(Garda Penjaminan Mutu Universitas Diponegoro)</h2>
                    {{-- <h3 class="fs-3 fs-lg-4 fs-md-5 fs-lg-4 fs-xl-5 fs fw-black mb-2">Universitas Diponegoro</h3> --}}
                    <p class="mb-5">Sistem Informasi Penjaminan Mutu Akademik Universitas Diponegoro yang berfungsi
                        untuk membantu dalam penilaian mutu akademik terhadap prodi yang berada di Universitas
                        Diponegoro.</p><a class="btn btn-lg btn-primary rounded-pill me-3" href="#!" role="button">Data
                        Akreditasi</a><a class="btn btn-link me-2 fs-0 p-0" href="{{ route('login') }}" role="button">Sign In <span
                            class="fa-solid fa-angle-right ms-2 fs--1"></span></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================-->

    <!-- ============================================-->



    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="pt-15 pb-0" id="feature">
        <div class="container-small px-lg-7 px-xxl-3">
            <div class="position-relative z-index-2">
                <div class="row">
                    <div class="col-lg-6 text-center text-lg-start pe-xxl-3">
                        <h2 class="text-primary fw-bolder mb-4">Visi dan Misi Penjaminan Mutu</h2>
                        <h2 class="mb-3 text-black lh-base"> Visi </h2>
                        <p class="mb-5">Menjadi Agen Pembaharu Pendidikan Melalui Pengembangan Sistem Pendidikan yang
                            handal
                            Visi akan dicapai melalui pembaharuan sub sistem pendidikan yaitu tujuan teknologi,
                            struktur, psiko-sosial dan managerial. </p>
                        <p>Kerangka kerja yang digunakan adalah prinsip good governance dan SPICES (Student Centered,
                            Problem based, Integrated, Community based, Elective program, Early elinical exposure, Self
                            directed learning).</p>
                        <h2 class="mb-3 text-black lh-base"> Misi </h2>
                        <p class="mb-5">Merumuskan tujuan pendidikan dengan hasil analisis kebutuhan berdasarkan
                            perkembangan masyarakat.
                            Mengembangkan teknologi pembelajaran.
                            Mendorong aspek-aspek psiko-sosial agar kondusif bagi tujuan pengembangan.
                            Mengembangkan struktur yang lebih bersifat organis sebagai organisasi pembelajaran.
                            Mengelola 4 (empat) subsistem tersebut di atas dengan hasil perkembangan sosial & teknologi.
                        </p>
                        <a class="btn btn-lg btn-outline-primary rounded-pill me-2" href="#!" role="button">Find out
                            more<i class="fa-solid fa-angle-right ms-2"></i></a>
                    </div>
                    <div class="col-sm-6 col-lg-3 mt-7 text-center text-lg-start">
                        <div class="h-100 d-flex flex-column justify-content-between">
                            <div class="border-start-lg border-dashed ps-4"><img class="mb-4"
                                    src="{{asset('templates/assets/img/icons/illustrations/bolt.png') }}" width="48"
                                    height="48" alt="" />
                                <div>
                                    <h5 class="fw-bolder mb-2">Penjaminan Mutu Internal</h5>
                                    <p class="fw-semi-bold lh-sm">Penjaminan Mutu Internal adalah ...</p>
                                </div>
                                <div><a class="btn btn-link me-2 p-0 fs--1" href="#!" role="button">Check Demo<span
                                            class="fa-solid fa-angle-right ms-2"></span></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 mt-7 text-center text-lg-start">
                        <div class="h-100 d-flex flex-column">
                            <div class="border-start-lg border-dashed ps-4"><img class="mb-4"
                                    src="{{asset('templates/assets/img/icons/illustrations/pie.png') }}" width="48"
                                    height="48" alt="" />
                                <div>
                                    <h5 class="fw-bolder mb-2">Penjaminan Mutu Eksternal</h5>
                                    <p class="fw-semi-bold lh-sm">Penjaminan Mutu Eksternal adalah ... </p>
                                </div>
                                <div><a class="btn btn-link me-2 p-0 fs--1" href="#!" role="button">Check Demo<i
                                            class="fa-solid fa-angle-right ms-2"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-0" id="tujuan">
        <div class="container-small px-lg-7 px-xxl-3">
            <div class="position-relative z-index-2">
                <div
                    class="row mt-12 align-items-center justify-content-between text-center text-lg-start mb-6 mb-lg-0">
                    <div class="col-lg-5"><img class="feature-image img-fluid mb-9 mb-lg-0 d-dark-none"
                            src="{{asset('templates/assets/img/spot-illustrations/22_2.png') }}" alt="" /><img
                            class="feature-image img-fluid mb-9 mb-lg-0 d-light-none"
                            src="{{asset('templates/assets/img/spot-illustrations/dark_22.png') }}" alt="" /></div>
                    <div class="col-lg-6">
                        <h6 class="text-primary mb-2 ls-2">FUNCTION</h6>
                        <h3 class="fw-bolder mb-3">Fungsi Lembaga</h3>
                        <p class="mb-4 px-md-7 px-lg-0">Memonitor dan mengembangkan pelaksanaan Audit Mutu Pembelajaran
                            dan Akreditasi Akademik.
                            Melakukan Pengembangan Aktifitas Internasional melalui Pelatihan.
                            Melakukan Pengembangan Informasi dan Teknologi Pendidikan
                            Melakukan Pengembangan Standarisasi Mutu Akademik
                            Melakukan Pengembangan Sistem Pendidikan
                            Melakukan Pengembangan Model Penjaminan Mutu Pendidikan</p><a
                            class="btn btn-link me-2 p-0 fs--1" href="#!" role="button">Check Demo<i
                                class="fa-solid fa-angle-right ms-2"></i></a>
                    </div>
                </div>
                <div class="row mt-2 align-items-center justify-content-between text-center text-lg-start mb-6 mb-lg-0">
                    <div class="col-lg-5 order-0 order-lg-1"><img
                            class="feature-image img-fluid mb-9 mb-lg-0 d-dark-none"
                            src="{{asset('templates/assets/img/spot-illustrations/23_2.png') }}" height="394"
                            alt="" /><img class="feature-image img-fluid mb-9 mb-lg-0 d-light-none"
                            src="{{asset('templates/assets/img/spot-illustrations/dark_23.png') }}" height="394"
                            alt="" /></div>
                    <div class="col-lg-6">
                        <h6 class="text-primary mb-2 ls-2">GOALS</h6>
                        <h3 class="fw-bolder mb-3">TUJUAN</h3>
                        <p class="mb-4 px-md-7 px-lg-0">Mengembangkan LP2MP sebagai pusat penelitian dan pengkajian
                            metode pembelajaran serta penjaminan mutu pendidikan tinggi.
                            Mengembangkan LP2MP sebagai pusat konsultasi dan pelayanan pengembangan pembelajaran.
                            Mengembangkan LP2MP sebagai pusat pelatihan bagi dosen dan karyawan untuk meningkatkan
                            kompetensinya.
                            Mengembangkan kerjasama dengan Lembaga Pemerintah dan Non Pemerintah dibidang pengembangan
                            dan penjaminan mutu pendidikan.</p><a class="btn btn-link me-2 p-0 fs--1" href="#!"
                            role="button">Check Demo<i class="fa-solid fa-angle-right ms-2"></i></a>
                    </div>
                </div>
                <div class="row mt-2 align-items-center justify-content-between text-center text-lg-start mb-6 mb-lg-0">
                    <div class="col-lg-5"><img class="feature-image img-fluid mb-9 mb-lg-0 d-dark-none"
                            src="{{asset('templates/assets/img/spot-illustrations/24_2.png') }}" height="394"
                            alt="" /><img class="feature-image img-fluid mb-9 mb-lg-0 d-light-none"
                            src="{{asset('templates/assets/img/spot-illustrations/dark_24.png') }}" height="394"
                            alt="" /></div>
                    <div class="col-lg-6 text-center text-lg-start">
                        <h6 class="text-primary mb-2 ls-2">REPORTS</h6>
                        <h3 class="fw-bolder mb-3">TUJUAN AUDIT AIMA</h3>
                        <p class="mb-4 px-md-7 px-lg-0">Tujuan Penyelenggaraan Audit AIMA
                            Menjamin Tercapainya Tujuan Pendidikan Tinggi
                            Menjamin Mutu Pembelajaran
                            Menjamin terselenggaranya proses kegiatan akademik
                            Mendorong PT Undip dapat Melampaui SN DIKTI
                            Menumbuhkan Budaya Mutu bagi Semua Pelaku di Lingkungan Undip</p><a
                            class="btn btn-link me-2 p-0 fs--1" href="#!" role="button">Check Demo<i
                                class="fa-solid fa-angle-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->


    <div class="position-relative">
        <div class="bg-holder world-map-bg"
            style="background-image:url({{asset('templates/assets/img/bg/bg-13.png') }});"></div>
        <!--/.bg-holder-->
        <div class="bg-holder z-index-2 opacity-25"
            style="background-image:url({{asset('templates/assets/img/bg/bg-right-21.png') }});background-size:auto;background-position:right;">
        </div>
        <!--/.bg-holder-->
        <div class="bg-holder z-index-2 mt-9 opacity-25"
            style="background-image:url({{asset('templates/assets/img/bg/bg-left-21.png') }});background-size:auto;background-position:left;">
        </div>
        <!--/.bg-holder-->
        <svg class="w-100 text-white position-relative" preserveAspectRatio="none" viewBox="0 0 1920 368" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M1920 0.44L0 367.74V0H1920V0.44Z" fill="currentColor"></path>
        </svg>
        <section class="overflow-hidden z-index-2">
            <div class="container-small light px-lg-7 px-xxl-3">
                <div class="position-relative">
                    <div class="row mb-6">
                        <div class="col-xl-6 text-center text-md-start">
                            <h2 class="text-white mb-2">Program Studi</h2>
                            <h1 class="fs-md-5 fs-xl-6 fw-black text-gradient-info text-uppercase mb-4 mb-md-0">
                                Universitas Diponegoro</h1>
                        </div>
                        <div class="col-xl-6 text-center text-md-start">
                            <p class="text-white">Universitas Diponegoro adalah salah satu Perguruan Tinggi Negeri
                                berbadan hukum terbaik di Indonesia, berlokasi di provinsi Jawa Tengah kota Semarang,
                                sesuai dengan SK Nomor 106/SK/BAN-PT/Ak.Ppj/PT/II/2023 yang dikeluarkan oleh Badan
                                Akreditasi Nasional Perguruan Tinggi (BAN-PT) mempunyai predikat Unggul.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 text-center text-md-start mb-6 mb-xl-0">
                            <div class="d-md-flex justify-content-md-between">
                                <div class="mb-6 mb-md-0 me-4">
                                    <h1 class="display-1 text-white fw-bolder"
                                        data-countup='{"endValue":125,"duration":10,"suffix":"+"}'>0 <span>+</span>
                                    </h1>
                                    <p class="text-white">Program Studi<br class="d-md-none d-lg-block" />than 125+
                                        sales.</p>
                                </div>
                                <div class="mb-6 mb-md-0 me-4">
                                    <h1 class="display-1 text-white fw-bolder"
                                        data-countup='{"endValue":308,"duration":10,"suffix":"k"}'>0</h1>
                                    <p class="text-white">Akreditasi Unggul<br
                                            class="d-md-none d-lg-block" />subscribers.</p>
                                </div>
                                <div class="mb-6 mb-md-0 me-4">
                                    <h1 class="display-1 text-white fw-bolder"
                                        data-countup='{"endValue":12,"duration":0.5}'>0</h1>
                                    <p class="text-white">Akreditasi Intrasional<br class="d-md-none d-lg-block" />far
                                        with great success. </p>
                                </div>
                                <div class="mb-6 mb-md-0 me-4">
                                    <h1 class="display-1 text-white fw-bolder"
                                        data-countup='{"endValue":12,"duration":0.5}'>0</h1>
                                    <p class="text-white">Akreditasi Intrasional<br class="d-md-none d-lg-block" />far
                                        with great success. </p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section><svg class="text-white w-100 position-relative" viewBox="0 0 1920 368" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0 368L1920 0.730011L1920 368L0 368Z" fill="currentColor"></path>
        </svg>
    </div>


    <!-- ============================================-->
    <!-- <section> begin ============================-->

    <!-- ============================================-->

    {{-- <section id="team">
        <div class="bg-holder z-index-2"
            style="background-image:url({{asset('templates/assets/img/bg/bg-left-17.png') }});background-size:auto;background-position:left center;">
        </div>
        <!--/.bg-holder-->
        <div class="bg-holder z-index-2"
            style="background-image:url({{asset('templates/assets/img/bg/bg-right-17.png') }});background-size:auto;background-position:right center;">
        </div>
        <!--/.bg-holder-->
        <div class="position-absolute top-0 end-0 start-0"><svg class="w-100 text-white" preserveAspectRatio="none"
                viewBox="0 0 1920 368" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1920 0.44L0 367.74V0H1920V0.44Z" fill="currentColor"></path>
            </svg></div>
        <div class="position-absolute bottom-0 end-0 start-0"><svg class="text-white w-100" viewBox="0 0 1920 368"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 368L1920 0.730011L1920 368L0 368Z" fill="currentColor"></path>
            </svg></div>
        <div class="container-small position-relative py-1 px-lg-7 px-xxl-3" style="z-index:10">
            <div class="row">
                <div class="col-12 mb-4 text-center text-sm-start">
                    <h4 class="text-primary fw-bolder mb-3">Team</h4>
                    <h2>Our small team behind our success</h2>
                </div>
                <div class="col-md-6 text-center text-sm-start">
                    <p>We have a small but strong development team to follow up on the development process. Reach
                        out to us for further information.</p>
                </div>
                <div class="col-md-6 text-center text-sm-start">
                    <p>The team is ready to answer all your questions within minutes. The efficient team is always
                        at your beck and call.</p>
                </div>
            </div>
            <div class="row align-items-center ps-lg-11 pe-lg-9">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="text-center mt-5 position-relative">
                        <div class="team-avatar-container d-inline-block position-relative">
                            <div class="bg-holder"
                                style="background-image:url({{asset('templates/assets/img/bg/bg-21.png') }});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="img-fluid rounded mb-3 position-relative"
                                src="{{asset('templates/assets/img/team/62.webp') }}" alt="..." />
                        </div>
                        <h4>John Smith</h4>
                        <h6 class="mb-3 fw-semi-bold">CEO, Global Cheat</h6><a href="#!"><span
                                class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-linkedin-in text-primary"></span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="text-center mt-5 position-relative">
                        <div class="team-avatar-container d-inline-block position-relative">
                            <div class="bg-holder"
                                style="background-image:url({{asset('templates/assets/img/bg/bg-21.png') }});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="img-fluid rounded mb-3 position-relative"
                                src="{{asset('templates/assets/img/team/63.webp') }}" alt="..." />
                        </div>
                        <h4>Marc Chiasson</h4>
                        <h6 class="mb-3 fw-semi-bold">Vice President</h6><a href="#!"><span
                                class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-linkedin-in text-primary"></span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="text-center mt-5 position-relative">
                        <div class="team-avatar-container d-inline-block position-relative">
                            <div class="bg-holder"
                                style="background-image:url({{asset('templates/assets/img/bg/bg-21.png') }});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="img-fluid rounded mb-3 position-relative"
                                src="{{asset('templates/assets/img/team/64.webp') }}" alt="..." />
                        </div>
                        <h4>Lilah Lola</h4>
                        <h6 class="mb-3 fw-semi-bold">Marketing Manager</h6><a href="#!"><span
                                class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-linkedin-in text-primary"></span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="text-center mt-5 position-relative">
                        <div class="team-avatar-container d-inline-block position-relative">
                            <div class="bg-holder"
                                style="background-image:url({{asset('templates/assets/img/bg/bg-21.png') }});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="img-fluid rounded mb-3 position-relative"
                                src="{{asset('templates/assets/img/team/65.webp') }}" alt="..." />
                        </div>
                        <h4>Thomas Doe</h4>
                        <h6 class="mb-3 fw-semi-bold">UX Designer</h6><a href="#!"><span
                                class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-linkedin-in text-primary"></span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="text-center mt-5 position-relative">
                        <div class="team-avatar-container d-inline-block position-relative">
                            <div class="bg-holder"
                                style="background-image:url({{asset('templates/assets/img/bg/bg-21.png') }});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="img-fluid rounded mb-3 position-relative"
                                src="{{asset('templates/assets/img/team/66.webp') }}" alt="..." />
                        </div>
                        <h4>Alan Casey</h4>
                        <h6 class="mb-3 fw-semi-bold">Front End Developer</h6><a href="#!"><span
                                class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-linkedin-in text-primary"></span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="text-center mt-5 position-relative">
                        <div class="team-avatar-container d-inline-block position-relative">
                            <div class="bg-holder"
                                style="background-image:url({{asset('templates/assets/img/bg/bg-21.png') }});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="img-fluid rounded mb-3 position-relative"
                                src="{{asset('templates/assets/img/team/67.webp') }}" alt="..." />
                        </div>
                        <h4>Narokin Hijita</h4>
                        <h6 class="mb-3 fw-semi-bold">CEO, Global Cheat</h6><a href="#!"><span
                                class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-linkedin-in text-primary"></span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="text-center mt-5 position-relative">
                        <div class="team-avatar-container d-inline-block position-relative">
                            <div class="bg-holder"
                                style="background-image:url({{asset('templates/assets/img/bg/bg-21.png') }});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="img-fluid rounded mb-3 position-relative"
                                src="{{asset('templates/assets/img/team/68.webp') }}" alt="..." />
                        </div>
                        <h4>Narokin Hijita</h4>
                        <h6 class="mb-3 fw-semi-bold">CEO, Global Cheat</h6><a href="#!"><span
                                class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-linkedin-in text-primary"></span></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="text-center mt-5 position-relative">
                        <div class="team-avatar-container d-inline-block position-relative">
                            <div class="bg-holder"
                                style="background-image:url({{asset('templates/assets/img/bg/bg-21.png') }});background-size:contain;">
                            </div>
                            <!--/.bg-holder-->
                            <img class="img-fluid rounded mb-3 position-relative"
                                src="{{asset('templates/assets/img/team/69.webp') }}" alt="..." />
                        </div>
                        <h4>Narokin Hijita</h4>
                        <h6 class="mb-3 fw-semi-bold">CEO, Global Cheat</h6><a href="#!"><span
                                class="fa-brands fa-facebook text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-twitter text-primary me-3"></span></a><a href="#!"><span
                                class="fa-brands fa-linkedin-in text-primary"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- ============================================-->
    <!-- <section> begin ============================-->
    <section class="bg-white pb-0" id="dataakreditasi">
        <div class="container-small px-lg-7 px-xxl-3">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="card py-md-9 px-md-13 border-0 z-index-1 shadow-lg cta-card">
                        <div class="bg-holder"
                            style="background-image:url({{asset('templates/assets/img/bg/bg-18.png') }});background-position:right;background-size:auto;">
                        </div>
                        <!--/.bg-holder-->
                        <div class="card-body position-relative"><img class="img-fluid mb-5 d-dark-none"
                                src="{{asset('templates/assets/img/spot-illustrations/27.png') }}" width="210"
                                alt="..." /><img class="img-fluid mb-5 d-light-none"
                                src="{{asset('templates/assets/img/spot-illustrations/dark_27.png') }}" width="210"
                                alt="..." />
                            <div class="d-flex align-items-center fw-bold justify-content-center mb-3">
                                <p class="mb-0">2008 Premium Icons </p><span class="text-primary fa-solid fa-circle"
                                    data-fa-transform="shrink-12"></span>
                                <p class="mb-0">Included FREE with it</p>
                            </div>
                            <h1 class="fs-2 fs-sm-4 fs-lg-6 fw-bolder lh-sm mb-3">Akses<span
                                    class="gradient-text-primary mx-2">Akreditasi</span><span>Program Studi</span></h1>
                            <form class="d-flex justify-content-center mb-3 px-xxl-12">
                                <button class="btn btn-primary" type="submit">Daftar Akreditasi</button>
                            </form>
                            <p>Best support in the world, Only Phoenix can ensure </p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of .container-->
    </section><!-- <section> close ============================-->
    <!-- ============================================-->

    <div class="position-relative">
        <div class="bg-holder footer-bg"
            style="background-image:url({{asset('templates/assets/img/bg/bg-19.png') }});background-size:auto;"></div>
        <!--/.bg-holder-->
        <div class="bg-holder"
            style="background-image:url({{asset('templates/assets/img/bg/bg-right-20.png') }});background-position:right;background-size:auto;">
        </div>
        <!--/.bg-holder-->
        <div class="bg-holder"
            style="background-image:url({{asset('templates/assets/img/bg/bg-left-20.png') }});background-position:left;background-size:auto;">
        </div>
        <!--/.bg-holder-->
        <div class="position-relative"><svg class="w-100 text-white" preserveAspectRatio="none" viewBox="0 0 1920 368"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1920 0.44L0 367.74V0H1920V0.44Z" fill="currentColor"></path>
            </svg>

            <!-- ============================================-->
            <!-- <section> begin ============================-->
            <section class="footer-default">
                <div class="container-small px-lg-7 px-xxl-3">
                    <div class="row position-relative">
                        <div class="col-12 col-sm-12 col-lg-5 mb-4 order-0 order-sm-0"><a href="#"><img class="mb-3"
                                    src="{{asset('templates/assets/img/icons/logo-white.png') }}" height="48"
                                    alt="" /></a>
                            <h3 class="text-white light">phoenix</h3>
                            <p class="text-white opacity-50 light">All over the world. Alice in <br />wonderland and
                                other places.</p>
                        </div>
                        <div class="col-lg-7">
                            <div class="row justify-content-between">
                                <div class="col-6 col-sm-4 col-lg-3 mb-3 order-2 order-sm-1">
                                    <div class="border-dashed border-start border-primary-300 ps-3"
                                        style="--phoenix-border-opacity: .2;">
                                        <h5 class="fw-bolder mb-2 text-light light">Help</h5>
                                        <ul class="list-unstyled mb-3">
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">About</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Contact</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Developers</a></li>
                                        </ul>
                                    </div>
                                    <div class="border-dashed border-start border-primary-300 ps-3"
                                        style="--phoenix-border-opacity: .2;">
                                        <h5 class="lh-lg fw-bolder mb-2 text-light light">Follow</h5>
                                        <ul class="list-unstyled mb-2">
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Facebook</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Twitter</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Linkedin</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-lg-3 mb-3 order-3 order-sm-2">
                                    <div class="border-dashed border-start border-primary-300 ps-3"
                                        style="--phoenix-border-opacity: .2;">
                                        <h5 class="lh-lg fw-bold text-light mb-2 light">Support</h5>
                                        <ul class="list-unstyled mb-md-2">
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Privacy</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Community</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Contact</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light" href="#!">Blog</a>
                                            </li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light" href="#!">FAQ</a>
                                            </li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Project</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light" href="#!">Team</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-4 col-lg-3 mb-3 order-3 order-sm-2">
                                    <div class="border-dashed border-start border-primary-300 ps-3"
                                        style="--phoenix-border-opacity: .2;">
                                        <h5 class="lh-lg fw-bold text-light mb-2 light"> Info</h5>
                                        <ul class="list-unstyled mb-md-2">
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Personal</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light" href="#!">NFT
                                                    System</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Agency</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">Contact</a></li>
                                            <li class="mb-1"><a class="text-500 hover-text-100 light"
                                                    href="#!">About</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end of .container-->
            </section><!-- <section> close ============================-->
            <!-- ============================================-->

        </div>
    </div>

</main><!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->
@endsection
