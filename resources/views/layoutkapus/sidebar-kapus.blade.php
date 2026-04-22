<ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
        <li class="nav-item"><a class="nav-link " href="{{ route('dashboardprodi2') }}" role="button"><span class="uil fs-0 me-2 uil-chart-pie"></span>Home</a>
                {{-- <ul class="dropdown-menu navbar-dropdown-caret">
            <li><a class="dropdown-item" href="../index-2.html">
                    <div class="dropdown-item-wrapper"><span class="me-2 uil"
                            data-feather="shopping-cart"></span>E commerce</div>
                </a></li>
            <li><a class="dropdown-item" href="../dashboard/project-management.html">
                    <div class="dropdown-item-wrapper"><span class="me-2 uil"
                            data-feather="clipboard"></span>Project management</div>
                </a></li>
            <li><a class="dropdown-item" href="../dashboard/crm.html">
                    <div class="dropdown-item-wrapper"><span class="me-2 uil"
                            data-feather="phone"></span>CRM</div>
                </a></li>
            <li><a class="dropdown-item" href="../apps/social/feed.html">
                    <div class="dropdown-item-wrapper"><span class="me-2 uil"
                            data-feather="share-2"></span>Social feed</div>
                </a></li>
        </ul> --}}
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!" role="button"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                        aria-expanded="false"><span class="uil fs-0 me-2 uil-cube"></span>Referensi</a>
                <ul class="dropdown-menu navbar-dropdown-caret">
                        <li><a class="dropdown-item" href="#">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="message-square"></span>Elemen</div>
                                </a></li>
                        <li><a class="dropdown-item" href="#">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="message-square"></span>Indikator</div>
                                </a></li>
                </ul>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!" role="button"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                        aria-expanded="false"><span
                                class="uil fs-0 me-2 uil-files-landscapes-alt"></span>Penjamu</a>
                <ul class="dropdown-menu navbar-dropdown-caret">
                        @foreach ($userroles as $userrole)
                        @if($userrole->roles_id == 5)
                        <li><a class="dropdown-item" href="{{ route('pembukaansesiaudit') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Pembukaan Sesi Audit</div>
                                </a></li>
                        <li><a class="dropdown-item" href="{{ route('penugasanauditormenu') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Penugasan Auditor</div>
                                </a></li>
                        <li><a class="dropdown-item" href="{{ route('rekapkapus') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Rekap</div>
                                </a></li>
                        @endif
                        @endforeach
                        @if((session()->get('programstudi')) != NULL)
                        <li><a class="dropdown-item" href="{{ route('penjamuprodi') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Penjaminan Mutu</div>
                                </a></li>
                        @endif
                        <li><a class="dropdown-item" href="#">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Rekap</div>
                                </a></li>
                        <li><a class="dropdown-item" href="#">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Grafik</div>
                                </a></li>
                        <li><a class="dropdown-item" href="#">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Rencana Tindak Lanjut (RTL)</div>
                                </a></li>

                </ul>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!" role="button"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                        aria-expanded="false"><span class="uil fs-0 me-2 uil-puzzle-piece"></span>Akreditasi</a>
                <ul class="dropdown-menu navbar-dropdown-caret">
                        <li><a class="dropdown-item" href="#">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Nasional</div>
                                </a></li>
                        <li><a class="dropdown-item" href="#">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Internasional</div>
                                </a></li>

                </ul>
        </li>
        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle lh-1" href="#!" role="button"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                        aria-expanded="false"><span
                                class="uil fs-0 me-2 uil-document-layout-right"></span>Dokumentasi</a>
                <ul class="dropdown-menu navbar-dropdown-caret">
                        <li><a class="dropdown-item" href="#">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="life-buoy"></span>Dokumen Penting</div>
                                </a></li>

                </ul>
        </li>
</ul>