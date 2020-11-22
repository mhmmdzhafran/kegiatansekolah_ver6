@component('mail::message')
Hello, {{ $username }}

Sepertinya Anda Mengakses Lupa Password, Ini Password Sementara Anda! <br>
<div>
    Username:{{ $username }} 
    <br>
    Password Sementara:{{ $data }}
</div>    

@component('mail::button', ['url' => $url])
Akses Aplikasi
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
