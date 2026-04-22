<nav class="navbar navbar-vertical navbar-expand-lg" style="display:none;">
    <script>
        var navbarStyle = window.config.config.phoenixNavbarStyle;
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('body').classList.add(`navbar-${navbarStyle}`);
        }

    </script>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <!-- scrollbar removed-->
        <div class="navbar-vertical-content">
            <ul class="navbar-nav flex-column" id="navbarVerticalNav">
                <li class="nav-item">
                    <!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1" href="{{ route('dashboard') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="pie-chart"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">Dashboard</span></span></div>
                        </a>
                    </div>

                </li>
                <li class="nav-item">
                    <!-- label-->
                    <p class="navbar-vertical-label">Penjaminan Mutu Internal</p>
                    <hr class="navbar-vertical-line" /><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1" href="{{ route('dashboard') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="clipboard"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">Hasil Audit</span></span></div>
                        </a>
                    </div><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1" href="{{ route('adminrekappenjamu') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="clipboard"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">Rekap Penjamu</span></span></div>
                        </a>
                    </div><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link label-1" href="{{ route('dashboard') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="clipboard"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">Grafik Evaluasi</span></span></div>
                        </a>
                    </div><!-- parent pages-->

                    <!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1"
                            href="#nv-customization2" role="button" data-bs-toggle="collapse" aria-expanded="false"
                            aria-controls="nv-customization2">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span
                                    class="nav-link-icon"><span data-feather="bookmark"></span></span><span
                                    class="nav-link-text">Elemen & Indikator</span>
                            </div>
                        </a>

                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse"
                                id="nv-customization2">
                                <li class="collapsed-nav-item-title d-none">Elemen & Indikator</li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('spmielemen') }}" data-bs-toggle=""
                                        aria-expanded="false">
                                        <div class="d-flex align-items-center"><span
                                                class="nav-link-text">Elemen</span></div>
                                    </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('spmiindikator') }}" data-bs-toggle=""
                                        aria-expanded="false">
                                        <div class="d-flex align-items-center"><span
                                                class="nav-link-text">Indikator</span></div>
                                    </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('spmibobot') }}" data-bs-toggle=""
                                        aria-expanded="false">
                                        <div class="d-flex align-items-center"><span
                                                class="nav-link-text">Bobot</span></div>
                                    </a><!-- more inner pages-->
                                </li>

                            </ul>
                        </div>
                        <div class="nav-item-wrapper">
                        <a class="nav-link label-1" href="{{ route('dokumenadmin') }}" role="button" data-bs-toggle=""
                            aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="file"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">Dokumen Penting</span></span></div>
                        </a>
                    </div><!-- parent pages-->
                    </div>


                </li>
                <li class="nav-item">
                    <!-- label-->
                    <p class="navbar-vertical-label">Penjaminan Mutu Eksternal</p>
                    <hr class="navbar-vertical-line" /><!-- parent pages-->
                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="../pages/starter.html" role="button"
                            data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="compass"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">Histogram Akreditasi</span></span></div>
                        </a></div><!-- parent pages-->
                        <div class="nav-item-wrapper"><a class="nav-link label-1" href="../pages/starter.html" role="button"
                            data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="compass"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">Rekap Akreditasi</span></span></div>
                        </a></div><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1" href="#nv-faq"
                            role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-faq">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span
                                    class="nav-link-icon"><span data-feather="help-circle"></span></span><span
                                    class="nav-link-text">Daftar Akreditasi</span><span
                                    class="fa-solid fa-circle text-info ms-1 new-page-indicator"
                                    style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-faq">
                                <li class="collapsed-nav-item-title d-none">Universitas</li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('akreditasiuniv') }}"
                                        data-bs-toggle="" aria-expanded="false">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Universitas</span></div>
                                    </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('akreditasinasional') }}"
                                        data-bs-toggle="" aria-expanded="false">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Nasional</span><span
                                                class="badge ms-2 badge badge-phoenix badge-phoenix-info ">Penting</span>
                                        </div>
                                    </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('akreditasiinternasional') }}"
                                    data-bs-toggle="" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-text">Internasional</span><span
                                            class="badge ms-2 badge badge-phoenix badge-phoenix-info ">Penting</span>
                                    </div>
                                </a><!-- more inner pages-->
                            </li>
                            </ul>
                        </div>
                    </div><!-- parent pages-->

                </li>
                <li class="nav-item">
                    <!-- label-->
                    <p class="navbar-vertical-label">SETTINGS</p>
                    <hr class="navbar-vertical-line" /><!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1" href="#nv-faq3"
                            role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-faq3">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span
                                    class="nav-link-icon"><span data-feather="life-buoy"></span></span><span
                                    class="nav-link-text">Universitas</span><span
                                    class="fa-solid fa-circle text-info ms-1 new-page-indicator"
                                    style="font-size: 6px"></span>
                            </div>
                        </a>
                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-faq3">
                                <li class="collapsed-nav-item-title d-none">Faq</li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('fakultas') }}"
                                        data-bs-toggle="" aria-expanded="false">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Fakultas</span></div>
                                    </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="../pages/faq/faq-tab.html"
                                        data-bs-toggle="" aria-expanded="false">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">Departemen</span><span
                                                class="badge ms-2 badge badge-phoenix badge-phoenix-info ">Penting</span>
                                        </div>
                                    </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('programstudi') }}"
                                    data-bs-toggle="" aria-expanded="false">
                                    <div class="d-flex align-items-center"><span class="nav-link-text">Program Studi</span><span
                                            class="badge ms-2 badge badge-phoenix badge-phoenix-info ">Penting</span>
                                    </div>
                                </a><!-- more inner pages-->
                            </li>
                            </ul>
                        </div>
                    </div><!-- parent pages-->
                    <!-- parent pages-->
                    <div class="nav-item-wrapper">
                        <a class="nav-link dropdown-indicator label-1"
                            href="#nv-customization" role="button" data-bs-toggle="collapse" aria-expanded="false"
                            aria-controls="nv-customization">
                            <div class="d-flex align-items-center">
                                <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span
                                    class="nav-link-icon"><span data-feather="settings"></span></span><span
                                    class="nav-link-text">Website</span>
                            </div>
                        </a>

                        <div class="parent-wrapper label-1">
                            <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse"
                                id="nv-customization">
                                <li class="collapsed-nav-item-title d-none">Customization</li>
                                <li class="nav-item"><a class="nav-link"
                                        href="../documentation/customization/configuration.html" data-bs-toggle=""
                                        aria-expanded="false">
                                        <div class="d-flex align-items-center"><span
                                                class="nav-link-text">Struktur Organisasi</span></div>
                                    </a><!-- more inner pages-->
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="../documentation/customization/styling.html" data-bs-toggle=""
                                        aria-expanded="false">
                                        <div class="d-flex align-items-center"><span
                                                class="nav-link-text">Berita</span></div>
                                    </a><!-- more inner pages-->
                                </li>

                            </ul>
                        </div>
                    </div>
                        <div class="nav-item-wrapper">
                            <a class="nav-link dropdown-indicator label-1" href="#nv-faq2"
                                role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="nv-faq2">
                                <div class="d-flex align-items-center">
                                    <div class="dropdown-indicator-icon"><span class="fas fa-caret-right"></span></div><span
                                        class="nav-link-icon"><span data-feather="users"></span></span><span
                                        class="nav-link-text">Authentication</span><span
                                        class="fa-solid fa-circle text-info ms-1 new-page-indicator"
                                        style="font-size: 6px"></span>
                                </div>
                            </a>
                            <div class="parent-wrapper label-1">
                                <ul class="nav collapse parent" data-bs-parent="#navbarVerticalCollapse" id="nv-faq2">
                                    <li class="collapsed-nav-item-title d-none">Authentication</li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('user') }}"
                                            data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center"><span class="nav-link-text">Users</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('role') }}"
                                            data-bs-toggle="" aria-expanded="false">
                                            <div class="d-flex align-items-center"><span class="nav-link-text">Role</span><span
                                                    class="badge ms-2 badge badge-phoenix badge-phoenix-info ">Penting</span>
                                            </div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('userrole') }}"
                                        data-bs-toggle="" aria-expanded="false">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">UserRole</span><span
                                                class="badge ms-2 badge badge-phoenix badge-phoenix-info ">Penting</span>
                                        </div>
                                        </a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('userprodi') }}"
                                        data-bs-toggle="" aria-expanded="false">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">UserProdi</span><span
                                                class="badge ms-2 badge badge-phoenix badge-phoenix-info ">Penting</span>
                                        </div>
                                        </a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('userfakultas') }}"
                                        data-bs-toggle="" aria-expanded="false">
                                        <div class="d-flex align-items-center"><span class="nav-link-text">UserFakultas</span><span
                                                class="badge ms-2 badge badge-phoenix badge-phoenix-info ">Penting</span>
                                        </div>
                                        </a>
                                    </li>
                                    </a><!-- more inner pages-->
                                </li>
                                </ul>
                            </div>
                        </div><!-- parent pages-->




                    <div class="nav-item-wrapper"><a class="nav-link label-1" href="../showcase.html" role="button"
                            data-bs-toggle="" aria-expanded="false">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                        data-feather="monitor"></span></span><span class="nav-link-text-wrapper"><span
                                        class="nav-link-text">Assign Menu</span></span></div>
                        </a></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="navbar-vertical-footer"><button
            class="btn navbar-vertical-toggle border-0 fw-semi-bold w-100 white-space-nowrap d-flex align-items-center"><span
                class="uil uil-left-arrow-to-left fs-0"></span><span class="uil uil-arrow-from-right fs-0"></span><span
                class="navbar-vertical-footer-text ms-2">Collapsed View</span></button></div>
</nav>
