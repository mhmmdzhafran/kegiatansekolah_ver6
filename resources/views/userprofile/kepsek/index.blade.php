@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Profil
@endsection

@section('content')
    <h1>Profil Kepala Sekolah {{ Auth::user()->name }}</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card shadow mb-4 mb-2">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Profil Penanggung Jawab {{ Auth::user()->name }}</h6>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-sm rounded-pill float-md-right float-lg-right float-sm-left" id="edit" style="color:white;">Ubah Password</button>
                        <div class="row mt-5">
                            <div class="col-sm-12 col-lg-3">
                                <img src="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}" alt="" srcset="" style=" width: 100%; max-width: 400px; height: auto;">
                            </div>
                            <div class="col-sm-12 col-lg-9">
                                <div class="form-group">
                                    {!! Form::label('nama_PJ' , "Nama Kepala Sekolah:" ) !!}
                                    <input type="text" name="nama_kepala_sekolah" id="nama_kepala_sekolah" value="{{ $data_user->name }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('username_id' , "Username ID:" ) !!}
                                    <input type="text" name="username_id" id="username_id" value="{{ $data_user->username_id }}" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('role' , "Jabatan User:" ) !!}
                                    <input type="text" name="role" id="role" value="{{ $role }}" class="form-control"  disabled>
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
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul class="error_notification" style="background-color: #e53e3e; color: white; border-radius: 10px;"></ul>
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
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul class="error_notification" style="background-color: #e53e3e; color: white; border-radius: 10px;"></ul>
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
        $("input[type=password]").empty();
        document.getElementById('edit').addEventListener('click', function(){
            let url_form = "{{route('pj.userprofile.check')}}";
            $("#modal_edit").modal();
            $("#form_check_pass").attr('action' , url_form);
        });
        $("#modal_edit").on('hidden.bs.modal' , function(){
            //remove attr form
            $("input[type=password]").empty();
        });
        $("#modal_ubah_pass").on('hidden.bs.modal', function(){
            $("input[type=password]").empty();
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
                        $(".error_notification").empty();
                    },
                    success: function(res){
                        loading_bar(false);
                        $(".error_notification").empty();
                        Swal.fire({
                            icon: 'success',
                            title: 'Ubah Password Sukses, Silahkan Menunggu Browser Untuk Melakukan Refresh'
                        }).then((result)=>{
                            $("#modal_ubah_pass").modal('hide');
                            location.reload(true);
                        });
                    },
                    error: function(res){
                        loading_bar(false);
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
                window.location = '/';
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
        }
        else{
            Swal.close();
        }
    }
    </script>
@endsection