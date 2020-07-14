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

            {{-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif --}}
        {{-- </div> --}}
    </div>
</form>
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