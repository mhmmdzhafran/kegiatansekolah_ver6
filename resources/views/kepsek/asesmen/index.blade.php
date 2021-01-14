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
            <div class="modal fade deleteAsesmen" role="dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="" class="delete_asesmen_form" method="post">
                        @method('DELETE')
                          <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Penghapusan Data Asesmen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                  {{ csrf_field() }}
                                  <div class="informasi-asesmen"></div>
                                  <hr>
                                  <h4 class="text-center">Apa Anda Yakin Ingin Menghapus Asesmen Ini?</h4>
                                  <input type="hidden" name="id_asesmen" id="id_asesmen" value = "">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" name="" class="btn btn-danger" id="form_delete">Ya, Hapus</button>
                              </div>
                          </div>
                      </form>
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
                            <ul class="error_notification d-none" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
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
                            {{-- <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('mulai_tahun_ajaran', 'Mulai Tahun Ajaran Sekolah:') !!}
                                        {!! Form::date('mulai_ajaran', \Carbon\Carbon::now() , ['class' => 'form-control']) !!}    
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('akhir_tahun_ajaran', 'Akhir Tahun Ajaran Sekolah:') !!}
                                        {!! Form::date('akhir_ajaran', \Carbon\Carbon::now()->addYear() , ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close_form" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary submit_form">Buat Asesmen Baru</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
<script>    
    // var url = "";
    var url_form = "";
    let table = $('#asesmen-table').DataTable({
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

    $("#createAsesmen").on('hidden.bs.modal', function(){
        $(".error_notification").empty();
        $(".error_notification").addClass('d-none');
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
                $(".error_notification").empty();
                $(".error_notification").addClass('d-none');
            },
            success: function(res){
                loading_bar(false);
                $("#asesmen-table").DataTable().ajax.reload();
                $("#createAsesmen").modal('hide');
                $("#create_form_asesmen")[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses Menyimpan',
                    text: 'Sukses Mengunggah Informasi Asesmen, Silahkan Melakukan Asesmen PPK',
                    confirmButtonText: 'Lanjut',
                    onClose: ()=>{
                        Swal.close();
                        let url_asesmen_onclose = '{{route("kepsek.asesmen.edit" , "id")}}';
                        url_asesmen_onclose = url_asesmen_onclose.replace("id" , res.url);
                        window.location.replace(url_asesmen_onclose);    
                    }
                }).then((result)=> {
                    if (result.value) {
                        let url_asesmen = '{{route("kepsek.asesmen.edit" , "id")}}';
                        url_asesmen = url_asesmen.replace("id" , res.url);
                        window.location.replace(url_asesmen);   
                    }
                });
            },
            error: function(res){
                loading_bar(false);
                $(".error_notification").removeClass('d-none');
                var value_error = $.parseJSON(res.responseText);
                if (res.status === 401) {
                    let loginMessage = value_error.message;
                    alertNotifications(res.status, loginMessage);
                } else if(res.status === 422) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text : 'Terdapat Error ketika Melakukan Pengunggahan Informasi Asesmen, Error Bisa dilihat diatas form'
                    }).then((result)=>{
                        $("#create_form_asesmen").scrollTop(0);
                    });
                    // $(".error_notification").append('<h5>Error Pada Form:</h5>');
                    $.each(value_error.errors, function(key, value){
                        $(".error_notification").append('<li class="mb-2">'+value+'</li>');
                    });   
                } else {
                    anyErrorsNotification(res.status, res.statusText, res);
                }
            }
        });
    });

    $(".delete_asesmen_form").on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("[name='_token']").val()
            }
        });
        $.ajax({
            url: $(this).attr('action'),
            type: 'DELETE',
            data: $("#id_asesmen").attr('value'),
            beforeSend: function(){
                loading_bar(true);
            },
            success: function(result){
                loading_bar(false);
                $("#asesmen-table").DataTable().ajax.reload();
                $(".deleteAsesmen").modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses Menghapus',
                    text: 'Sukses Menghapus Data Asesmen PPK!'
                });
            },
            error: function(responseError){
                loading_bar(false);
                let value_error = JSON.parse(responseError.responseText);
                if (responseError.status === 401) {
                    let loginMessage = value_error.message;
                    alertNotifications(responseError.status, loginMessage);
                } else if(responseError.status === 404){
                    let messageNotification = value_error.messages;
                    alertNotifications(responseError.status , messageNotification);
                } else if(responseError.status === 422) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text : $.each(value_error.errors, function(key, value){
                            value;
                        })  
                    });
                    // $(".error_notification").append('<h5>Error Pada Form:</h5>');   
                } else {
                    anyErrorsNotification(responseError.status, responseError.statusText, responseError);
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
                    window.location.replace(url);
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
                    window.location.replace(url);
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

    $(document).on('click', '.delete_asesmen',function(e){
        e.preventDefault();
        $(".informasi-asesmen").empty();
        let url = '{{route("kepsek.asesmen.deleteAsesmenFull", ["id_asesmen" => "id"])}}';
        url = url.replace('id', $(this).attr('id'));
        $(".delete_asesmen_form").attr('action', url);
        $("#id_asesmen").attr('value' , $(this).attr('id'));
        let data = table.row( $(this).parents('tr')).data();
        $(".informasi-asesmen").append('Data Asesmen Yang Ingin Dihapus: <br> <ul class ="alert alert-danger"><li class="mb-2">Nama Sekolah: '+data.nama_sekolah+'</li><li class="mb-2">Dengan Skor Penilaian:' +data.skor_penilaian_kegiatan_akhir+'</li>');
        $(".deleteAsesmen").modal();
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
                window.location.replace('/');
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

