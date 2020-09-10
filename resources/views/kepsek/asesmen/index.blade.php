@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Asesmen PPK
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-4">
        <h1>Asesmen PPK</h1>
    </div>
    <div class="col-sm-12 col-lg-8">
        <button type="button" class="btn btn-primary rounded-pill float-md-left float-lg-right float-sm-left" id="create_asesmen">Buat Asesmen Baru</button>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="asesmen-table">
                            <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th>Nama Sekolah</th>
                                    <th>Skor Akhir</th>
                                    <th>Dibentuk Tanggal</th>
                                    <th>Diperbarui Tanggal</th>
                                    <th width="25%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- modal Create --}}
<div class="modal fade" id="createAsesmen" data-keyboard="false" data-backdrop="static" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <!-- Modal content-->
      <form action="" id="create_form_asesmen" method="post" autocomplete="off">
        {{ method_field('POST') }}
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Inisialisasi Data Asesmen PPK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  {{ csrf_field() }}
                  <ul id="error_notification" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                  <div class="form-group">
                    <label for="name_sekolah">Nama Sekolah: </label>
                    <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="alamat_sekolah">Alamat: </label>
                    <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="nama_kepsek">Nama Kepala Sekolah</label>
                      <input type="text" name="nama_kepsek" id="nama_kepsek" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="no_hp">Nomor HP:</label>
                      <input type="text" name="no_hp" id="no_hp" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="email_kepsek">Email: </label>
                    <input type="text" name="email_kepsek" id="email_kepsek" class="form-control">
                  </div>
              </div>
              <div class="modal-footer">
                      <button type="button" class="btn btn-secondary close_form" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary submit_form">Buat Asesmen Baru</button>
              </div>
          </div>
      </form>
    </div>
   </div>
@endsection

@section('script')
<script>    
    // var url = "";
    var url_form = "";
    $('#asesmen-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("kepsek.asesmen.index")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama_sekolah', name: 'nama_sekolah'},
            {data: 'skor_penilaian_kegiatan_akhir', name: 'skor_penilaian_kegiatan_akhir'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at' , name: 'updated_at'},
            {data: 'Aksi' , name: 'Aksi'}
        ],
        order: [[4, "desc"]]
    });
    $("#create_asesmen").click(function(){
        url_form = '{{route("kepsek.asesmen.store")}}';
        $("#create_form_asesmen").attr('action', url_form);
        $("#createAsesmen").modal();
    });
    
    $("#create_form_asesmen").on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("[name='_token']").val()
            }
        });
        $.ajax({
            url: url_form,
            type: 'POST',
            data: $("#create_form_asesmen").serialize(),
            beforeSend: function(){
                loading_bar(true);
                $("#error_notification").empty();
            },
            success: function(res){
                loading_bar(false);
                $("#asesmen-table").DataTable().ajax.reload();
                $("#createAsesmen").modal('hide');
                $("#create_form_asesmen")[0].reset();
                Swal.fire({
                    'icon': 'success',
                    'title': 'Sukses Menyimpan',
                    'text': 'Sukses Mengunggah Informasi Asesmen, Silahkan Melakukan Asesmen PPK'
                }).then((result)=> {
                    var url_asesmen = '{{route("kepsek.asesmen.edit" , "id")}}';
                    url_asesmen = url_asesmen.replace("id" , res.url);
                    window.location = url_asesmen;
                });
            },
            error: function(res){
                loading_bar(false);
                var value_error = $.parseJSON(res.responseText);
                if (res.status === 401) {
                    let loginMessage = value_error.message;
                    alertNotifications(res.status, loginMessage);
                } else if(res.status === 422) {
                    Swal.fire({
                        'icon': 'error',
                        'title': 'Error',
                        'text' : 'Terdapat Error ketika Melakukan Pengunggahan Informasi Asesmen, Error Bisa dilihat diatas form'
                    }).then((result)=>{
                        $("#create_form_asesmen").scrollTop(0);
                    });
                    $("#error_notification").append('<h5>Error Pada Form:</h5>');
                    $.each(value_error.errors, function(key, value){
                        $("#error_notification").append('<li>'+value+'</li>');
                    });   
                } else {
                    anyErrorsNotification(res.status, res.statusText, res);
                }
            }
        });
    });
    $(document).on('click', ".show", function(){
        var id = $(this).attr('id');
        var value_asesmen = $(this).attr('value');
        if (value_asesmen === "asesmen") {
             let url = '{{route("kepsek.asesmen.edit", "id")}}';   
             url = url.replace('id', id);
             $.ajax({
                url: url,
                type: 'GET',
                // beforeSend: function(){
                //     // loading_bar(true);
                // },
                success: function(){
                    // loading_bar(false);
                    window.location = url;
                },
                error: function(error){
                    if (error.status === 401) {
                        let login_info = JSON.parse(error.responseText);
                        let messageNotification = login_info.message;
                        alertNotifications(error.status , messageNotification);
                    } else if(error.status === 404){
                        let notFoundMessage = JSON.parse(error.responseText);
                        let messageNotification = notFoundMessage.messages;
                        alertNotifications(error.status , messageNotification);
                    } else {
                        anyErrorsNotification(error.status , error.statusText , error);
                    }
                }
             });
        } else if(value_asesmen === "lihat_table") {
             let url = '{{route("kepsek.asesmen.show" , "id")}}';
             url = url.replace('id', id);
             console.log(url);
             $.ajax({
                url: url,
                type: 'GET',
                success: function(res){
                    // loading_bar(false);
                    window.location = url;
                },
                error: function(error){
                    if (error.status === 401) {
                        let loginNotification = JSON.parse(error.responseText);
                        let notificationMessage = loginNotification.message;
                        alertNotifications(error.status , notificationMessage);
                    } else if(error.status === 404){
                        let errorNotification = JSON.parse(error.responseText);
                        let notificationErrorMessage = errorNotification.messages;
                        alertNotifications(error.status , notificationErrorMessage);
                    } else {
                        anyErrorsNotification(error.status , error.statusText , error);
                    }
                }
             });
        }
    });
    $("#createAsesmen").on('hidden.bs.modal', function(){
        $("#error_notification").empty();
    });
    function loading_bar(condition){
        if (condition) {
            $(".close_form").attr('disabled', true);
            $(".submit_form").attr('disabled', true);
            Swal.fire({
                title: 'Sedang Memproses',
                html: '<div class="spinner-border" role="status" style="margin:25%"><span class="sr-only"></span></div>',    
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false
            });
        } else {
            $(".close_form").attr('disabled', false);
            $(".submit_form").attr('disabled', false);
            Swal.close();
        }
    }

    function alertNotifications(status , infoError){
        if (status === 401) {
            Swal.fire({
                icon: 'info',
                title: 'Please Login',
                text: infoError
            }).then((result)=>{
                window.location = '/';
            });
        } else if(status === 404){
            Swal.fire({
                icon: 'error',
                title: 'Terdapat Error',
                text: infoError
            });
        }
    }

    function anyErrorsNotification(status, statusText, statusLog){
        if (typeof statusLog.message !== "undefined") {
            Swal.fire({
                icon: 'error',
                title: 'Terdapat Error',
                text: 'System Error Code: '+status+": "+statusText+": "+statusLog.message
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Terdapat Error',
                text: 'System Error Code: '+status+": "+statusText
            });
        }
        console.log(statusLog);
    }
    </script>
@endsection

