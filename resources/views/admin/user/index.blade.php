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
            <button class="btn btn-primary rounded-pill float-md-left float-lg-right float-sm-left create_user">Buat Pengguna</button>
        </div>
        {{-- <div class="col-sm-12 col-lg-12">
            @if (Session::has('created_user'))
                <b class="bg-success" style="color: white">{{ session('created_user') }}</b>
            @endif
            <div class="danger">
                <ul class="bg-danger font-weight-bolder" id="danger_delete" style="color:white; border-radius: 10px"></ul>
            </div>
        </div> --}}
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
                      <ul class="error_notification" style="background-color: #e53e3e; color: white; border-radius: 10px">

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
                        {!! Form::label('role_id', 'Role:') !!}
                        {!! Form::select('role_id', array('' => 'Choose Options') + $roles ,null , ['class' => 'form-control']) !!}
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
            @method("PUT")
            {{ csrf_field() }}
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pengubahan User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      
                      <ul class="error_notification" style="background-color: #e53e3e; color: white; border-radius: 10px">

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
                        {!! Form::label('role_id', 'Role:') !!}
                        {!! Form::select('role_id', array('' => 'Choose Options') + $roles ,null , ['class' => 'form-control role_user']) !!}
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
                          <button type="submit" class="btn btn-primary edit_user">Edit User</button>
                  </div>
              </div>
          </form>
        </div>
       </div>
@endsection
@section('script')
<script>
    var url = "";
    var modalState = "";
    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("admin.user.index")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'username_id', name: 'username_id'},
            {data: 'role.role_title', name: 'role.role_title'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at' , name: 'updated_at'},
            {data: 'Aksi' , name: 'Aksi' , orderable: false}
        ]
    });

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
        let data_table = table.row($(this).parents('tr')).data();
        $(".nama_user").prop('value' , data_table.name);
        $(".username_id").prop('value' , data_table.username_id);
        $(".role_user").find("[value='"+data_table.role.id+"']").prop('selected' , true);
        $("#editForm").modal();
        modalState = "#editForm";
        // $.get(url_edit, function(res){
        //     $("#editForm").modal();
        //     $(".nama_user").attr('value', res.data.name);
        //     $(".email_user").attr('value', res.data.email);
        // }).fail(function(error){
        //     if (error.status === 401) {
        //         let response_error = JSON.parse(error.responseText);
        //         backToLogin(401, response_error.message);
        //     } else if(error.status === 404) {
        //         let response_error = $.parseJSON(error.responseText);
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Error Saat Pengambilan Data',
        //             text: response_error.messages
        //         });
        //     } else {
        //         anyErrors(error.status, error.statusText , error);
        //     }
        // });
    });

    $(document).on('click', '.delete', function(){
        var id = $(this).attr('id');
        url = '{{route("admin.user.destroy", "id")}}';
        url = url.replace("id", id);
        $("#ids").attr("value", id);
        $("#deleteForm").attr('action' , url);
        let data = table.row( $(this).parents('tr')).data();
        document.querySelector('.user_data').innerHTML = "Apakah Anda Yakin Ingin Menghapus: <br> <ul class='alert alert-danger'><li>Nama: "+data.name+"</li><li>Username: "+data.username_id+"</li><li>Dengan Peran: "+data.role.role_title+"</li></ul>";
        $("#DeleteModal").modal();
        modalState = "#DeleteModal";
    });

    $("#editForm").on('hidden.bs.modal', function(){
        $("#editUserForm")[0].reset();
    });
    $("#createModal").on('hidden.bs.modal', function(){
        $("#createUserForm")[0].reset();
    });

     $('form').on('submit', function(e){
        e.preventDefault();
        var choice = $(this).attr('id');
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("[name='_token']").val()
            }
        });
        if (choice === "createUserForm") {
            $.ajax({
                url: url,
                type:'POST',
                data: $('#createUserForm').serialize(),
                beforeSend: function(){
                    $(".error_notification").empty();
                    loading_bar(true);
                },
                success: function(result){
                    $(".error_notification").empty();
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
                type:'PUT',
                data: $('#editUserForm').serialize(),
                beforeSend: function(){
                    $(".error_notification").empty();
                    loading_bar(true);
                },
                success: function(result){
                    $(".error_notification").empty();
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
        }
        else{
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
                window.location = '/';
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
    </script>
@endsection

