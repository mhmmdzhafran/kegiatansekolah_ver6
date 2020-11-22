@component('mail::message')
Hello, {{ $nama_user }}

Akun SIMPPK Anda Telah Dihapus, Silahkan Kontak Admin Jika Terjadi Kesalahan! <br>
<div>
    Nama:{{ $nama_user }} 
    <br>
    Username:{{ $username }}
    <br>
    Sebagai:{{ $peran }}
</div>    

Thanks,<br>
{{ config('app.name') }}
@endcomponent
