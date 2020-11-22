@component('mail::message')
Hello, {{ $nama_user }}

Akun SIMPPK Telah Diperbarui! Silahkan Lihat Data Baru Anda! <br>
<div>
    Nama:{{ $nama_user }} 
    <br>
    Username:{{ $username }}
    <br>
    Sebagai:{{ $peran }} 
    <br>
    Password Anda:{{ $password }}
</div>    

@component('mail::button', ['url' => $link])
Akses Aplikasi
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
