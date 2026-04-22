{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
@php
    $titles = [
        403 => 'Forbidden',
        404 => 'Page Not Found',
        419 => 'Page Expired',
        500 => 'Server Error',
        503 => 'Service Unavailable',
    ];

    $messages = [
        403 => 'You do not have permission to access this page.',
        404 => 'Oops! The page you are looking for could not be found.',
        419 => 'Your session has expired. Please log in again.',
        500 => 'Something went wrong on our servers.',
        503 => 'We are currently undergoing maintenance. Please try again later.',
    ];

    $code = $code ?? 500;
@endphp

<div style="text-align: center; padding: 50px;">
    <h1 style="font-size: 5rem; color: #e3342f;">{{ $code }}</h1>
    <h2>{{ $titles[$code] ?? 'Error' }}</h2>
    <p>{{ $messages[$code] ?? 'An unexpected error occurred.' }}</p>
    <a href="{{ url('/') }}" style="color: #3490dc;">Go back home</a>
</div>
{{-- @endsection --}}
