@extends('layouts.template')

@section('title')
    Admin - Pengguna PPK
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <h1>Pengguna PPK</h1>
        </div>
        <div class="col-sm-12 col-lg-8">
            <button class="btn btn-primary rounded-pill float-md-left float-lg-right float-sm-left create_user">Buat Pengguna Baru</button>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th width="10%">Role</th>
                                    <th width="10%">Dibentuk Tanggal</th>
                                    <th width="10%">Diperbarui Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="DeleteModal"  role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog " role="document">
              <!-- Modal content-->
              <form action="" id="deleteForm" method="post">
                {{-- @method("DELETE") --}}
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Penghapusan User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          {{ csrf_field() }}
                          <p class="user_data"></p>
                          <input type="hidden" name="id_value" id="ids" value = "">
                      </div>
                      <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                              <button type="submit" name="" class="btn btn-danger">Yes, Delete</button>
                      </div>
                  </div>
              </form>
            </div>
        </div>
           
          <div class="modal fade" id="createModal"  role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog " role="document">
              <!-- Modal content-->
              <form action="" id="createUserForm" method="post" autocomplete="off">
                {{-- {{ method_field('POST') }} --}}
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pembuatan User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          {{ csrf_field() }}
                          <ul class="error_notification d-none" style="background-color: #e53e3e; color: white; border-radius: 10px">
    
                          </ul>
                          <div class="form-group">
                            {!! Form::label('name', 'Name:') !!}
                            {!! Form::text('name', null , ['class' => 'form-control']) !!}
                        </div>
                    
                        <div class="form-group">
                            {!! Form::label('username_id', 'Username:') !!}
                            {!! Form::text('username_id', null , ['class' => 'form-control']) !!}
                        </div>
    
                        <div class="form-group">
                            {!! Form::label('email_user', 'Email User:') !!}
                            {!! Form::email('email_user', null , ['class' => 'form-control']) !!}
                        </div>
                    
                        <div class="form-group">
                            {!! Form::label('role_id', 'Role:') !!}
                            {!! Form::select('role_id', array('' => 'Choose Options') + $roles ,null , ['class' => 'form-control']) !!}
                        </div>
    
                        <div class="form-group">
                            {!! Form::label('image_user', 'Upload Foto User:') !!}
                            <div class="form-group text-center">
                                <img src="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}" alt="" srcset="" width="250" height="250" style="border-radius: 50%; border: 1px solid black" class="change_foto mb-2">
                                {!! Form::file('photo_user', ['class' => 'file_img ml-5' , 'id' => '1']) !!}
                            </div>
                        </div>
    
                        <div class="form-group">
                            {!! Form::label('password', 'Masukkan Password:') !!}
                            {!! Form::password('password', ['class' => 'form-control password']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('passwordChecker', 'Masukkan Password Kembali:') !!}
                            {!! Form::password('passwordChecker', ['class' => 'form-control passwordChecker']) !!}
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary bentuk_user">Buat User Baru</button>
                      </div>
                  </div>
              </form>
            </div>
        </div>
    
        <div class="modal fade" id="editForm"  role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog " role="document">
              <!-- Modal content-->
              <form action="" id="editUserForm" autocomplete="off">
                {{-- @method("PUT") --}}
                {{ csrf_field() }}
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Pengubahan User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          
                          <ul class="error_notification d-none" style="background-color: #e53e3e; color: white; border-radius: 10px">
    
                          </ul>
                          <div class="form-group">
                            {!! Form::label('name', 'Name:') !!}
                            <input type="text" name="name" value="" class="form-control nama_user">
                        </div>
                    
                        <div class="form-group">
                            {!! Form::label('username_id', 'Username:') !!}
                            <input type="text" name="username_id" value="" class="form-control username_id">                        
                        </div>
    
                        <div class="form-group">
                            {!! Form::label('email_user', 'Email User:') !!}
                            {!! Form::email('email_user', null , ['class' => 'form-control email_user']) !!}
                        </div>
                    
                        <div class="form-group">
                            {!! Form::label('role_id', 'Role:') !!}
                            {!! Form::select('role_id', array('' => 'Choose Options') + $roles ,null , ['class' => 'form-control role_user']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('last_file','File Sebelumnya: ') !!}
                            <ol class="load-file"></ol>
                        </div>
                        {!! Form::label('image_user','Upload Foto User: ') !!}
                        <div class="form-group text-center">
                            <img src="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}" alt="" srcset="" width="250" height="250" style="border-radius: 50%; border: 1px solid black" class="change_foto mb-2">
                            {!! Form::file('photo_user', ['class' => 'file_img ml-5' , 'id' => '2']) !!}
                        </div>
    
                        <div class="form-group">
                            {!! Form::label('password', 'Masukkan Password:') !!}
                            {!! Form::password('password', ['class' => 'form-control password']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('passwordChecker', 'Masukkan Password Kembali:') !!}
                            {!! Form::password('passwordChecker', ['class' => 'form-control passwordChecker']) !!}
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning edit_user">Edit User</button>
                      </div>
                  </div>
              </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    var url = "";
    var modalState = "";
    const fileIMG = document.getElementsByClassName('file_img');
    const photo = document.querySelectorAll('.change_foto');
    let sourceFile = '';
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("admin.user.index")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'username_id', name: 'username_id'},
            {data: 'email_user', name: 'email_user'},
            {data: 'role.role_title', name: 'role.role_title'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at' , name: 'updated_at'},
            {data: 'Aksi' , name: 'Aksi' , orderable: false}
        ]
    });
    
    loadImage();

    $(document).on('click', '.create_user', function(){
        $(".error_notification").empty();
        url = "{{route('admin.user.store')}}";
        $("#createModal").modal();
        $("#createFormUser").attr('action', url);
        modalState = "#createModal";        
    });

    $(document).on('click', '.edit', function(){        
        var value = $(this).attr('id');
        url_edit = '{{route("admin.user.edit", "id")}}';
        url_edit = url_edit.replace("id", value);
        $("#error_notification").empty();
        url = '{{route("admin.user.update", "id")}}';
        url = url.replace('id', value);
        $("#editUserForm").attr('action', url);        
        // let data_table = table.row($(this).parents('tr')).data();
        // $(".nama_user").prop('value' , data_table.name);
        // $(".email_user").prop('value', data_table.email_user);
        // $(".username_id").prop('value' , data_table.username_id);
        // $(".role_user").find("[value='"+data_table.role.id+"']").prop('selected' , true);
        // $("#editForm").modal();
        modalState = "#editForm";
        loading_bar(true);
        $.get(url_edit, function(res){
            let users = res.data;
            let picture = res.data_foto;
            $(".nama_user").prop('value' , users.name);
            $(".email_user").prop('value', users.email_user);
            $(".username_id").prop('value' , users.username_id);
            $(".role_user").find("[value='"+users.role_id+"']").prop('selected' , true);
            if (picture !== null) {
                let fileLoc = '{{asset("kegiatan/admin/foto_user/images")}}';
                fileLoc = fileLoc.replace('images' , picture);
                sourceFile = fileLoc;
                $('.load-file').append('<li><i class="fas fa-file-alt mr-2"></i>'+picture+'<button type="button" class="btn btn-sm btn-primary preview-image mr-2 ml-2">Lihat Foto</button><a href="'+sourceFile+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+picture+'">Download File</a></li>');
                for (let index = 0; index < photo.length; index++) {
                    const element = photo[index];
                    element.src = fileLoc;
                }    
            } else {
                $('.load-file').append('<li><i class="fas fa-file-alt mr-2"></i>Tidak Terdapat Foto</li>');
            }
            
        }).done(function(){
            loading_bar(false);
            $("#editForm").modal();
        }).fail(function(error){
            loading_bar(false);
            if (error.status === 401) {
                let response_error = JSON.parse(error.responseText);
                backToLogin(401, response_error.message);
            } else if(error.status === 404) {
                let response_error = JSON.parse(error.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error Saat Pengambilan Data',
                    text: response_error.messages
                });
            } else {
                anyErrors(error.status, error.statusText , error);
            }
        });
    });

    $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        url = '{{route("admin.user.destroy", "id")}}';
        url = url.replace("id", id);
        $("#ids").attr("value", id);
        $("#deleteForm").attr('action' , url);
        let data = table.row( $(this).parents('tr')).data();
        document.querySelector('.user_data').innerHTML = "Apakah Anda Yakin Ingin Menghapus: <br> <ul class='alert alert-danger'><li>Nama: "+data.name+"</li><li>Username: "+data.username_id+"</li><li>Email: "+data.email_user+"</li><li>Dengan Peran: "+data.role.role_title+"</li></ul>";
        $("#DeleteModal").modal();
        modalState = "#DeleteModal";
    });

    $(document).on('click', ".preview-image", function(){
        window.open(sourceFile);
    });

    $("#editForm").on('hidden.bs.modal', function(){
        $("#editUserForm")[0].reset();
        $(".error_notification").empty();
        $('.load-file').empty();
        $(".error_notification").addClass('d-none');
        sourceFile = '';
        resetPhoto();
    });
    $("#createModal").on('hidden.bs.modal', function(){
        $("#createUserForm")[0].reset();
        $(".error_notification").empty();
        $(".error_notification").addClass('d-none');
        resetPhoto();
    });

     $('form').on('submit', function(e){
        e.preventDefault();
        var choice = $(this).attr('id');
        const getForm = document.getElementById(choice);
        const formData = new FormData(getForm);
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("[name='_token']").val()
            }
        });
        if (choice === "createUserForm") {
            console.log(formData);
            $.ajax({
                url: url,
                type:'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $(".error_notification").empty();
                    $(".error_notification").addClass('d-none');
                    loading_bar(true);
                },
                success: function(result){
                    $(".error_notification").empty();
                    $(".error_notification").addClass('d-none');
                    loading_bar(false);
                    $(modalState).modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: "Berhasil",
                        text: result.store_message
                    });
                    $("#createUserForm")[0].reset();
                    $('#users-table').DataTable().ajax.reload();
                },
                error: function(result){
                    loading_bar(false);
                    $(".error_notification").empty();
                    $(".error_notification").removeClass('d-none');
                    if (result.status === 401) {
                        let info_login = JSON.parse(result.responseText);
                        backToLogin(401, info_login.message);
                    } else if(result.status === 422){
                        let error_notification = $.parseJSON(result.responseText);
                            $.each(error_notification.errors, function(key, value){
                                $(".error_notification").append('<li>'+value+'</li>');
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terdapat Error',
                                text: 'Terdapat Error saat mengunggah Form, Silahkan cek diatas Form'
                            }).then((result)=>{
                                $(modalState).scroll(0);
                            });
                    } else {
                       anyErrors(result.status, result.statusText , result);
                    }
                }
            });   
        } else if(choice === "editUserForm") {   
            $.ajax({
                url: url,
                type:'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $(".error_notification").empty();
                    $(".error_notification").addClass('d-none');
                    loading_bar(true);
                },
                success: function(result){
                    $(".error_notification").empty();
                    $(".error_notification").addClass('d-none');
                    loading_bar(false);
                    $(modalState).modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: "Berhasil",
                        text: result.store_message
                    });                    
                    $('#users-table').DataTable().ajax.reload();
                },
                error: function(result){
                    loading_bar(false);
                    $(".error_notification").empty();
                    $(".error_notification").removeClass('d-none');
                    if (result.status === 401) {
                        let info_login = JSON.parse(result.responseText);
                        backToLogin(401, info_login.message);
                    } else if(result.status === 404){
                        let info_not_found = JSON.parse(result.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Terdapat Error',
                            text : info_not_found.messages
                        });
                    } else if(result.status === 422) {
                        let error_notification = JSON.parse(result.responseText);   
                            $.each(error_notification.errors, function(key, value){
                                $(".error_notification").append('<li>'+value+'</li>');
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terdapat Error',
                                text: 'Terdapat Error saat mengunggah Form, Silahkan cek diatas Form'
                            }).then((result)=>{
                                $(modalState).scroll(0);
                            });
                    } else {
                       anyErrors(result.status , result.statusText , result);
                    }
                }
            });   
        }
        else if(choice === "deleteForm"){
         let action = $("#deleteForm").attr('action');
         let id = $("#ids").attr("value");
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        $.ajax({
            url: action,
            type: 'POST',
            data: id,
            beforeSend: function(){
                loading_bar(true);
                $(modalState).modal('hide');
            },
            success: function(result){
                // $("#success_delete").empty();
                loading_bar(false);
                Swal.fire({
                    icon: 'success',
                    title: "Berhasil",
                    text: result.notification
                });
                $('#users-table').DataTable().ajax.reload();
                // location.reload(true);
            },
            error: function(result){
                loading_bar(false);
                if (result.status === 401) {
                    let info_login = JSON.parse(result.responseText);
                    backToLogin(401, info_login.message);
                } else if(result.status === 404){
                    let info_not_found = JSON.parse(result.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terdapat Error',
                        text : info_not_found.notification
                    }).then((result)=>{
                        $(modalState).modal('show');
                    });
                } else if(result.status === 422){
                    let errorValues = JSON.parse(result.responseText);
                    let errorMessage = errorValues.notification;
                    Swal.fire({
                        icon: 'error',
                        title: 'Terdapat Error',
                        text : errorMessage
                    }).then((result)=>{
                        $(modalState).modal('show');
                    }); 
                } else {
                   anyErrors(result.status , result.statusText , result);
                }
            }
        });
        }
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
        } else{
            Swal.close();
        }
    }

    function backToLogin(reqType,infoLogin){
        if (reqType === 401) {
            Swal.fire({
                icon: 'info',
                title: 'Please Login',
                text: infoLogin
            }).then((result)=>{
                window.location.replace('/');
            });
        }
    }

    function anyErrors(status, statusText, errors){
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

    function resetPhoto(){
        let photo = document.querySelectorAll('.change_foto');
        for (let index = 0; index < photo.length; index++) {
            const element = photo[index];
            element.src = "{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}";
        }
    }
    function loadImage(){
        for (let index = 0; index < fileIMG.length; index++) {
            const element = fileIMG[index];
            element.addEventListener('change', (e) => {
                for (let index = 0; index < photo.length; index++) {
                    const element = photo[index];
                    element.src = URL.createObjectURL(e.target.files[0]);
                }
            });
        }
    }
    </script>
@endsection

