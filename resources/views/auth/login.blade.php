{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

{{--   
    Nama: Muhammad Zhafran Auristianto
    Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
  --}}
@extends('layouts.template_login')

@section('content_form')
<form method="POST" action="{{ route('login') }}" class="user" autocomplete="off">
    {{-- @csrf --}}
    {{ csrf_field() }}
    <div class="form-group">
        {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label> --}}

        {{-- <div class="col-md-6"> --}}
            <input id="username_id" type="text" class="form-control form-control-user @error('username_id') is-invalid @enderror" name="username_id" value="{{ old('username_id') }}" required placeholder="Masukkan User ID" autofocus>

            @error('username_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        {{-- </div> --}}
    </div>

    <div class="form-group">
        {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

        {{-- <div class="col-md-6"> --}}
            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
            {{-- <i class="fas fa-eye"></i> --}}
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        {{-- </div> --}}
    </div>

    {{-- <div class="form-group row">
        <div class="col-md-6 offset-md-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
        </div>
    </div> --}}

    <div class="form-group">
        {{-- <div class="col-md-8 offset-md-4"> --}}
            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Login') }}
            </button>
        {{-- </div> --}}
    </div>
</form>
    <div class="row">
        <div class="col-sm-12 col-lg-12 text-center">
            {{-- @if (Route::has('password.request'))
            <a class="btn btn-link btn-sm" href="{{ route('password.request') }}">
                {{ __('Lupa Password?') }}
            </a>
        @endif --}}
        {{-- @if (Route::has('password.request')) --}}
        <button class="btn btn-link" id="forget_password">
            {{ __('Lupa Password?') }}
        </button>
    {{-- @endif --}}
        </div>
    </div>

    <div class="modal fade" id="modal_forget_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <form action="{{ route('password.changeTempPass') }}" method="post" id="change_pass_form">
                @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Form Password Sementara</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('user_id' , 'Masukkan Username Anda: ') !!}
                    <input type="text" name="username_id_user" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Dapatkan Password Sementara</button>
            </div>
        </form>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('forget_password').addEventListener('click', function(){
            $("#modal_forget_pass").modal();
        });
        $("#change_pass_form").on('submit', function(e){
            e.preventDefault();
            let form_url = $(this).attr('action');
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $("[name= '_token']").val()
                }
            });
            $.ajax({
                url: form_url,
                type: 'POST',
                data: $("#change_pass_form").serialize(),
                beforeSend: function(){
                    loading_bar(true);
                },
                success: function(res){
                    loading_bar(false);
                    console.log(res);
                    $('#modal_forget_pass').modal('hide');
                    $('[name = "username_id_user"]').empty();
                    if (res.data === '') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses Mendapatkan Password Sementara!',
                            text: 'Silahkan Lihat Email Anda',
                            timer: 1000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            allowEnterKey: false,
                            allowEscapeKey: false,
                            allowOutsideClick: false
                        }).then((result) => {
                            location.reload(true);
                        });    
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses Mendapatkan Password Sementara!',
                            text: 'Password Sementara Anda: '+res.data
                        }).then((result) => {
                            location.reload(true);
                        });
                    }
                    
                },
                error: function(res){
                    loading_bar(false);
                    if (res.status === 422) {
                        let errorValues = JSON.parse(res.responseText);                        
                        errorNotifications(422, errorValues);
                    } else {
                        errorNotifications(res.status , res)
                    }
                }
            });
        });

        function loading_bar(condition){
        if (condition) {
            Swal.fire({
                title: 'Sedang Diproses',
                html: '<div class="spinner-border" role="status" style="margin:25%"><span class="sr-only"></span></div>',    
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false
            });   
        }
        else{
            Swal.close();
        }
    }

    function errorNotifications(requestType, message){
        if (requestType === 422) {
            let messageType = "";
            $.each(message.errors, function(key, value){
                messageType = value;
            });
            Swal.fire({
                icon: 'error',
                title: 'Terdapat Error',
                text: messageType
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'System Error Code: '+message.status+': '+message.statusText
            });
            console.log(message);
        }
    }
    </script>
@endsection

{{-- @section('scripts') --}}
    {{-- <script>
        var checbox = document.getElementById('psw').addEventListener('click' , function(){
            let hidden_psw = document.getElementById('password');
            if (hidden_psw.type === 'password') {
                hidden_psw.type = 'text';
                changeImage(true);
            } else if(hidden_psw.type === 'text') {
                hidden_psw.type = 'password';
                changeImage(false);
            }
        });

        function changeImage(stateChecbox){
            if (stateCheckbox === true) {
                //change logo to eye slash
            }
            else{
                //change logo back to eye
            }   
        }
    </script> --}}
{{-- @endsection --}}