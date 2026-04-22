<ul class="navbar-nav navbar-nav-top" data-dropdown-on-hover="data-dropdown-on-hover">
        <li class="nav-item"><a class="nav-link " href="{{ route('chooserole') }}" role="button"><span class="uil fs-0 me-2 uil-chart-pie"></span>Home</a>
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
                        {{-- @foreach ($userroles as $userrole) --}}
                        @if(session()->get('roles')->id == 5)
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
                                                        data-feather="compass"></span>Rekapitulasi Penilaian</div>
                                </a></li>
                        @endif

                        @if(session()->get('roles')->id == 2)
                        <li><a class="dropdown-item" href="{{ route('rekapkapus') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Rekapitulasi Penilaian</div>
                                </a></li>
                        @endif

                        @if(session()->get('roles')->id == 3)
                        <li><a class="dropdown-item" href="{{ route('monitorpenilaianlp2mp') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Monitor Penilaian</div>
                                </a></li>
                        @endif

                        @if(session()->get('roles')->id  == 7 || session()->get('roles')->id  == 13)
                        <li><a class="dropdown-item" href="{{ route('validasidekanwadek') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Validasi</div>
                                </a></li>
                        @endif

                        @if(session()->get('roles')->id  == 12)
                        <li><a class="dropdown-item" href="{{ route('daftarpengisianaudit') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Audit</div>
                                </a></li>
                        @endif

                        @if(session()->get('roles')->id  == 14)
                        <li><a class="dropdown-item" href="{{ route('monitorpenilaianwarek') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Monitor Penilaian</div>
                                </a></li>
                        @endif
                        {{-- @endforeach --}}
                        @if((session()->get('programstudi')) != NULL && session()->get('roles')->id == 9)
                        <li><a class="dropdown-item" href="{{ route('penjamuprodi') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Penjaminan Mutu</div>
                                </a></li>
                        <li><a class="dropdown-item" href="#">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Rekap dan Grafik</div>
                                </a></li>

                        <li><a class="dropdown-item" href="{{ route('rtlprodi') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="compass"></span>Rencana Tindak Lanjut (RTL)</div>
                                </a></li>
                        @endif


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
                                class="uil fs-0 me-2 uil-document-layout-right"></span>Dokumen</a>
                <ul class="dropdown-menu navbar-dropdown-caret">
                        <li><a class="dropdown-item" href="{{ route('dokumen') }}">
                                        <div class="dropdown-item-wrapper"><span class="me-2 uil"
                                                        data-feather="life-buoy"></span>Dokumen Penting</div>
                                </a></li>

                </ul>
        </li>
</ul>
