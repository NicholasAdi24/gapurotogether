@extends('master2')

@section('content')


<div class="pb-5">
    <div class="row g-4">
        <div class="col-12">

            <div class="mb-8">
                <h2 class="mb-2">Change Password</h2>
                <h5 class="text-700 fw-semi-bold">Halaman perubahan Password</h5>
            </div>

            <div class="row align-items-center g-4">
                <div class="card mb-5">
                    <div class="card-header hover-actions-trigger position-relative mb-7"
                        style="min-height: 130px; ">
                        <div class="bg-holder rounded-top"
                            style="background-image: linear-gradient(0deg, #000000 -3%, rgba(0, 0, 0, 0) 83%), url({{asset('templates/assets/img/generic/59.png') }}">
                            <input class="d-none" id="upload-feed-cover-image" type="file" /><label
                                class="cover-image-file-input" for="upload-feed-cover-image"></label>
                            <div class="hover-actions end-0 bottom-0 pe-1 pb-2 text-white"><span
                                    class="fa-solid fa-camera me-2 overlay-icon"> </span></div>
                        </div><input class="d-none" id="upload-feed-porfile-picture" type="file" /><label
                            class="avatar avatar-4xl status-online feed-avatar-profile cursor-pointer"
                            for="upload-feed-porfile-picture"><img
                                class="rounded-circle img-thumbnail bg-white shadow-sm"
                                src="{{asset('templates/assets/img/team/Undipcek.png') }}" width="200"
                                alt="" /></label>
                    </div> <!-- Bagian Card -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if(session('status'))
                                    <div class="alert alert-success">{{ session('status') }}</div>
                                @endif
                                <form method="POST" action="{{ route('changepassword') }}">
                                @csrf

                                <div class="mb-3">
                                    <label>Email</label>
                                    <input class="form-control" id="basic-form-name" type="text" name="email" placeholder="Name" value="{{ session()->get('user')->email }}" readonly/>
                                </div>
                                <div class="mb-3">
                                    <label>Old Password</label>
                                    <input class="form-control" id="basic-form-name" type="password" name="old_password" placeholder="Old Password" required />
                                    @error('old_password') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                                <div class="mb-3">
                                    <label>New Password</label>
                                    <input class="form-control" id="basic-form-name" type="password" name="new_password" placeholder="New Password" required />
                                    @error('new_password') <span class="text-danger">{{ $message }}</span> @enderror

                                </div>
                                <div class="mb-3">
                                    <label>Konfirmasi Password Baru</label>
                                    <input type="password" name="new_password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Change Password</button>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr class="bg-200 mb-6 mt-4" />
        </div>
    </div>
</div>
    @endsection
