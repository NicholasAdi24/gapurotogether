@extends('app')

@section('content')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->

<main class="main" id="top">
    <div class="container-fluid bg-300 dark__bg-1200">
        <div class="bg-holder bg-auth-card-overlay" style="background-image:url({{asset('templates/assets/img/bg/37.png') }};"></div>
        <!--/.bg-holder-->
        <div class="row flex-center position-relative min-vh-100 g-0 py-5">
            <div class="col-11 col-sm-10 col-xl-8">
                <div class="card border border-200 auth-card">
                    <div class="card-body pe-md-0">
                        <div class="row align-items-center gx-0 gy-7">
                            <div
                                class="col-auto bg-100 dark__bg-1100 rounded-3 position-relative overflow-hidden auth-title-box">
                                <div class="bg-holder" style="background-image:url({{asset('templates/assets/img/bg/38.png') }};">
                                </div>
                                <!--/.bg-holder-->
                                <div
                                    class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 pb-md-7">
                                    <h3 class="mb-3 text-black fs-1">GAPURO</h3>
                                    <p class="text-700">Sistem Penjaminan Mutu</p>
                                    <ul class="list-unstyled mb-0 w-max-content w-md-auto mx-auto">
                                        <li class="d-flex align-items-center"><span
                                                class="uil uil-check-circle text-success me-2"></span><span
                                                class="text-700 fw-semi-bold">Fast</span></li>
                                        <li class="d-flex align-items-center"><span
                                                class="uil uil-check-circle text-success me-2"></span><span
                                                class="text-700 fw-semi-bold">Simple</span></li>
                                        <li class="d-flex align-items-center"><span
                                                class="uil uil-check-circle text-success me-2"></span><span
                                                class="text-700 fw-semi-bold">Responsive</span></li>
                                    </ul>
                                </div>
                                <div class="position-relative z-index--1 mb-6 d-none d-md-block text-center mt-md-15">
                                    <img class="auth-title-box-img d-dark-none"
                                        src="{{asset('templates/assets/img/spot-illustrations/auth.png') }}" alt="" /><img
                                        class="auth-title-box-img d-light-none"
                                        src="{{asset('templates/assets/img/spot-illustrations/auth-dark.png') }}" alt="" />
                                </div>
                            </div>
                            <div class="col mx-auto">
                                <div class="auth-form-box">
                                    <div class="text-center mb-7"><a
                                            class="d-flex flex-center text-decoration-none mb-4"
                                            href="{{ route('landingpage') }}">
                                            <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block"><img
                                                    src="{{asset('templates/assets/img/icons/logo new.png') }}" alt="phoenix" width="58" />
                                            </div>
                                        </a>
                                        <h3 class="text-1000">Sign In</h3>
                                        <p class="text-700">Get access to your account</p>
                                        <form action="{{ route('loginattempt') }}" method="post">
                                            @csrf
                                            @if ($errors->has('emailPassword'))
                                            <span class="text-danger">{{ $errors->first('emailPassword') }}</span>
                                            @endif
                                            <div class="mb-3 text-start"><label class="form-label" for="email">Email
                                                    address</label>
                                                <div class="form-icon-container"><input class="form-control form-icon-input"
                                                        id="email" type="email" placeholder="name@example.com" name="email" /><span
                                                        class="fas fa-user text-900 fs--1 form-icon"></span></div>
                                            </div>
                                            <div class="mb-3 text-start"><label class="form-label" for="password">Password</label>
                                                <div class="form-icon-container"><input class="form-control form-icon-input"
                                                        id="password" type="password" placeholder="Password" name="password" /><span
                                                        class="fas fa-key text-900 fs--1 form-icon"></span></div>
                                            </div>




                                            <div class="mb-3 text-start"><label class="form-label" for="password">Captcha</label>
                                                <!-- show captcha image -->
                                                <img id="captchaImage" src="{{ captcha_src() }}" alt="captcha">
                                                <button type="button" id="reloadCaptcha" class="btn btn-outline-primary"><i class="fas fa-sync-alt"></i></button>
                                            </div>
                                            <div class="mb-3 text-start"><label class="form-label" for="password">Captcha</label>
                                                <!-- or show src directly: <img src="{{ captcha_src() }}" alt="captcha"> -->
                                                <p>
                                                    <div class="form-icon-container">
                                                        <input type="text" name="captcha" class="form-control form-icon-input" placeholder="Jumlahkan Angka pada Captcha" ><span
                                                        class="fas fa-lock text-900 fs--1 form-icon"></span>
                                                    </div>
                                                    @error('captcha')
                                                    <br>
                                                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                                                    @enderror
                                                </p>
                                                {{-- <div class="form-check mb-0"><input class="form-check-input"
                                                id="basic-checkbox" type="checkbox" checked="checked" /><label
                                                class="form-check-label mb-0" for="basic-checkbox">Remember
                                                me</label></div> --}}
                                            </div>
                                                {{-- <div class="col-auto"><a class="fs--1 fw-semi-bold"
                                                href="forgot-password.html">Forgot Password?</a></div> --}}


                                            <button class="btn btn-primary w-100 mb-3">Sign In</button>
                                            {{-- <div class="text-center"><a class="fs--1 fw-bold" href="sign-up.html">Create an
                                            account</a></div> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</main>
<script>
    // Reload button
    document.getElementById('reloadCaptcha').addEventListener('click', function () {
        fetch("{{ route('captcha.refresh') }}")
            .then(res => res.json())
            .then(data => {
                document.getElementById('captchaImage').src = data.captcha + "&t=" + Date.now();
            });
    });

    // Auto-refresh on server validation error
    @if (session('captcha_reload'))
        document.getElementById('captchaImage').src = "{{ session('captcha_reload') }}" + "&t=" + Date.now();
    @endif
</script>
<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->

@endsection
