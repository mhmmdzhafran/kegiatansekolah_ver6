@extends('layouts.template_error')


@section('content')
<div class="text-center">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5">Page Not Found</p>
    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
    @if (Auth::check())
        @if (Auth::user()->Role->role_title == "Admin")
        <a href="{{ url('/admin/users') }}">&larr; Back to Dashboard</a>
        @elseif(Auth::user()->Role->role_title == "Penanggung Jawab Kegiatan")    
        <a href="{{ url('/penanggung-jawab/mengelola-kegiatan') }}">&larr; Back to Dashboard</a>
        @elseif(Auth::user()->Role->role_title == "Kepala Sekolah")
        <a href="{{ url('/kepala-sekolah/mengelola-kegiatan') }}">&larr; Back to Dashboard</a>
        {{-- @elseif(Auth::user()->Role->role_title == "Penilai Eksternal")
        <a href="{{ url('/penilai-eksternal/home') }}">&larr; Back to Dashboard</a> --}}
        @else
        <a href="{{ url('/') }}">&larr; Back to Login Form</a>
        @endif
    @else
    <a href="{{ url('/') }}">&larr; Please Log in, Your Session is already over</a>
    @endif
</div>    
@endsection
