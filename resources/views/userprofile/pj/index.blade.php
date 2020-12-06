@extends('layouts.template_PJ')

@section('title')
    Penanggung Jawab - Laman Profil
@endsection

@section('content')
    <h1>Profil Penanggung Jawab {{ ucwords(Auth::user()->name) }}</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" href="#" id="profile">Profil</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('pj.userprofile.getAllNotify')}}" id="notification">Notifikasi 
                        <span class="badge badge-primary badge-pill" id="badge-counter-notification">
                            {{ $counter_notification }}
                        </span>  
                    </a>
                    </li>
                  </ul>
                <div class="card shadow mb-4 mb-2">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Profil Penanggung Jawab {{ Auth::user()->name }}</h6>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-sm rounded-pill float-md-right float-lg-right float-sm-left" id="edit" style="color:white;">Ubah Password</button>
                        <div class="row mt-5">
                            <div class="col-sm-12 col-lg-4">
                                @if (is_null($data_user->photo_user))
                                    <img src="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}" alt="" srcset="" style=" width: 100%; max-width: 400px; height: auto;">
                                @else
                                    <img class="rounded-circle" src="{{ asset('kegiatan/admin/foto_user/'.$data_user->photo_user) }}" alt="" srcset="" width="300" height="300" style="width: 100%">
                                @endif
                            </div>
                            <div class="col-sm-12 col-lg-8">
                                <div class="form-group">
                                    {!! Form::label('nama_PJ' , "Nama Penanggung Jawab:" ) !!}
                                    <input type="text" name="nama_sekolah" id="nama_sekolah" value="{{ $data_user->name }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('username_id' , "Username ID:" ) !!}
                                    <input type="text" name="alamat_sekolah" id="alamat_sekolah" value="{{ $data_user->username_id }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email_user' , "Email User:" ) !!}
                                    <input type="text" name="email_user" id="email_user" value="{{ $data_user->email_user }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('role' , "Jabatan User:" ) !!}
                                    <input type="text" name="nama_kepsek" id="nama_kepsek" value="{{ $role }}" class="form-control"  disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>  

    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_edit" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form action="" id="form_check_pass" method="POST">
                @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pengecekkan Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul class="error_notification d-none" style="background-color: #e53e3e; color: white; border-radius: 10px;"></ul>
                <div class="form-group">
                    {!! Form::label('pass' , "Masukkan Password Anda:" ) !!}
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="modal_ubah_pass" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <form action="" id="form_change_pass" method="POST">
                @csrf
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Pergantian Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul class="error_notification d-none" style="background-color: #e53e3e; color: white; border-radius: 10px;"></ul>
                <div class="form-group">
                    {!! Form::label('pass' , "Masukkan Password Baru Anda:" ) !!}
                    <input type="password" name="passwordBaru" class="form-control">
                </div>
                <div class="form-group">
                    {!! Form::label('pass' , "Masukkan Password Baru Anda Kembali:" ) !!}
                    <input type="password" name="passwordChecker" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
@endsection

@section('script')
    <script>
        // $("input[type=password]").empty();
        document.getElementById('edit').addEventListener('click', function(){
            let url_form = "{{route('pj.userprofile.check')}}";
            $("#modal_edit").modal();
            $("#form_check_pass").attr('action' , url_form);
        });
        $("#modal_edit").on('hidden.bs.modal' , function(){
            //remove attr form
            $("input[type='password']").val('');
            emptyAlertsError();
        });
        $("#modal_ubah_pass").on('hidden.bs.modal', function(){
            $("input[type='password']").val('');
            emptyAlertsError();
        });
        $('form').on('submit', function(e){
            e.preventDefault();
            let form_id = $(this).attr('id');
            let form_url = $(this).attr('action');
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $("[name= '_token']").val()
                }
            });
            if (form_id === "form_check_pass") {
                $.ajax({
                    url: form_url,
                    type: 'POST',
                    data: $("#"+form_id).serialize(),
                    beforeSend: function(){
                        loading_bar(true);
                    },
                    success: function(res){
                        loading_bar(false);
                        console.log(true);
                        $("#modal_edit").modal('hide');
                        let url_form_change_pass = '{{route("pj.userprofile.update")}}';
                        $("#form_change_pass").attr('action' , url_form_change_pass);
                        Swal.fire({
                            icon: 'success',
                            title: 'Password Cocok, Silahkan Ubah Password Anda'
                        }).then((result)=>{
                            $("#modal_ubah_pass").modal();
                        });
                    },
                    error: function(res){
                        loading_bar(false);
                        $(".error_notification").removeClass('d-none');
                        if (res.status === 401) {
                            let loginInfo = JSON.parse(res.responseText);
                            knownNotificationAlerts(401, loginInfo.message);
                        }else if(res.status === 404) {
                            let errorInfo = JSON.parse(res.responseText);
                            knownNotificationAlerts(404, errorInfo.messages);
                        }else if(res.status === 422){
                            let errorValues = JSON.parse(res.responseText);
                            const ErrorMessageCheckPass = "Terdapat Error ketika Mengunggah Data, Silahkan Lihat Error diatas Form";
                            $.each(errorValues.errors, function(key, item){
                                document.querySelector(".error_notification").innerHTML = "<li>"+item+"</li>";
                            });
                            knownNotificationAlerts(422, ErrorMessageCheckPass);
                        } else {
                            unknownErrorsNotification(res.status , res.statusText , res);
                        }
                    }
                });
            } else if(form_id === 'form_change_pass') {
                $.ajax({
                    url: form_url,
                    type: 'POST',
                    data: $("#"+form_id).serialize(),
                    beforeSend: function(){
                        loading_bar(true);
                    },
                    success: function(res){
                        loading_bar(false);
                        $("#modal_ubah_pass").modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Ubah Password Sukses, Silahkan Menunggu Browser Untuk Melakukan Refresh',
                            timer: 1000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            allowEnterKey: false,
                            allowEscapeKey: false,
                            allowOutsideClick: false
                        }).then((result)=>{
                            location.reload(true);
                        });
                    },
                    error: function(res){
                        loading_bar(false);
                        $(".error_notification").removeClass('d-none');
                        if (res.status === 401) {
                            let loginInfo = JSON.parse(res.responseText);
                            knownNotificationAlerts(401, loginInfo.message);
                        }else if(res.status === 404) {
                            let errorInfo = JSON.parse(res.responseText);
                            knownNotificationAlerts(404, errorInfo.messages);
                        }else if(res.status === 422){
                            let errorValues = JSON.parse(res.responseText);
                            let errorMessages = errorValues.errors;
                            const messageError = "Terdapat Error ketika Mengunggah Data, Silahkan Lihat Error diatas Form";
                            $.each(errorMessages , function(key, item){
                                $(".error_notification").append('<li>'+item+'</li>');
                            });
                            knownNotificationAlerts(422, messageError);
                        } else {
                            unknownErrorsNotification(res.status , res.statusText , res);
                        }
                    }
                });
            }
           
        });

    //Functions

    function knownNotificationAlerts(requestStatus, messages){
        if (requestStatus === 422 || requestStatus === 404) {
            Swal.fire({
                icon: 'error',
                title: messages
            });            
        } else if(requestStatus === 401) {
            Swal.fire({
                icon: 'info',
                title: 'Please Login',
                text: infoLogin
            }).then((result)=>{
                window.location.replace('/');
            });
        }
    }

    function unknownErrorsNotification(status, statusText, errors){
        if (typeof errors.message !== "undefined") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'System Error Code: '+status+': '+statusText+": "+errors.message
            });
        } else {
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'System Error Code: '+status+': '+statusText
            });
        }
        console.log(errors);
    }
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
            emptyAlertsError();
        }
        else{
            Swal.close();
            $(".error_notification").empty();
        }
    }

    function emptyAlertsError(){
        $(".error_notification").empty();
        $(".error_notification").addClass('d-none');
    }
    </script>
@endsection