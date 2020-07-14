@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Pengajuan Dokumentasi Kegiatan
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>Dokumentasi Kegiatan Penanggung Jawab</h1>
        </div>
    </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dokumentasi_kegiatan">
                                <thead>
                                    <tr>
                                        <th>ID Dokumentasi</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Nilai PPK</th>                                  
                                        <th>Kegiatan Berbasis</th>
                                        <th>Timestamp Dokumentasi</th>
                                        <th width="10%">Nama Penanggung Jawab</th>
                                        <th width="15%">Status Proposal Kegiatan</th>  
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="showDokumentasi" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat Data Dokumentasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('nama_user' , 'Nama Penanggung Jawab') !!}
                            {!! Form::text('nama_user' , null , ['class' => 'form-control nama_user' , 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('nama_kegiatan' , 'Nama Kegiatan') !!}
                            {!! Form::text('nama_kegiatan' , null , ['class' => 'form-control nama_kegiatan' , 'disabled']) !!}
                        </div>
                        <div class="form-group">
                                {!! Form::label('nilai_ppk' , 'Nilai PPK:') !!}
                                <br>
                                {!! Form::checkbox('nilai_ppk[]', 'Religius', null, ['class' => 'value_nilai_ppk' , 'disabled']) !!} Religius
                                <br>
                                {!! Form::checkbox('nilai_ppk[]', 'Integritas', null, ['class' => 'value_nilai_ppk' , 'disabled']) !!} Integritas
                                <br>
                                {!! Form::checkbox('nilai_ppk[]', 'Nasionalis', null, ['class' => 'value_nilai_ppk' , 'disabled']) !!} Nasionalis
                                <br>
                                {!! Form::checkbox('nilai_ppk[]', 'Mandiri', null, ['class' => 'value_nilai_ppk' , 'disabled']) !!} Mandiri
                                <br>
                                {!! Form::checkbox('nilai_ppk[]', 'Gotong Royong', null, ['class' => 'value_nilai_ppk' , 'disabled']) !!} Gotong Royong
                        </div>
                        <div class="form-group">
                            {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis PPK:') !!}
                            {!! Form::select('kegiatan_berbasis', array('' => 'Choose Options', 'Berbasis Kelas' => 'Berbasis Kelas', 'Berbasis Budaya Sekolah' => 'Berbasis Budaya Sekolah', 'Berbasis Masyarakat' => 'Berbasis Masyarakat') ,null , ['class' => 'form-control kegiatan_berbasis' , 'disabled']) !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                {!! Form::label('dokumen' , "Data Dokumen Kegiatan:") !!}
                                <ol class="dokumen_kegiatan">
        
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('awal_kegiatan', 'Kegiatan Dimulai:') !!}
                                    {!! Form::date('awal_kegiatan', null , ['class' => 'form-control awal_kegiatan' , 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    {!! Form::label('akhir_kegiatan', 'Kegiatan Diakhiri:') !!}
                                    {!! Form::date('akhir_kegiatan', null , ['class' => 'form-control akhir_kegiatan' , 'disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
        </div>
@endsection
@section('script')
    <script>
        var value_checked = [];
        $("#dokumentasi_kegiatan").DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("kepsek.pengajuan_dokumentasi_kegiatan.index")}}',
            columns: [
                {data: 'id', name:'id'},
                {data: 'nama_kegiatan', name:'nama_kegiatan'},
                {data: 'nilai_ppk', name: 'nilai_ppk'},
                {data: 'kegiatan_berbasis', name:'kegiatan_berbasis'},
                {data: 'updated_at' , name:'updated_at'},
                {data: 'user' , name: 'user'},
                {data: 'statusKegiatan', name: 'statusKegiatan.nama' , orderable: false},
                {data: 'unggah_dokumentasi', name:'unggah_dokumentasi', orderable: false}
            ],
            order: [[4, "desc"]]
        });
        //add scripts here
        $(document).on('click' , '.status_pengajuan', function(){
            var btn_value = $(this).val();
            var dokumentasi_id = $(this).attr('id');
            if (btn_value === "unggah_dokumentasi") {
                var url = '{{route("kepsek.pengajuan_dokumentasi_kegiatan.show", ["dokumentasi_kegiatan" => "ids"])}}';
                url = url.replace("ids", dokumentasi_id);
                loadingBar('show');
                $.get(url, function(res){
                    $("#showDokumentasi").modal();
                    // console.log(res);
                    $(".nama_kegiatan").val(res.data_dokumentasi.nama_kegiatan);
                    var nilai_ppk = $.parseJSON(res.data_dokumentasi.nilai_ppk);
                    nilai_ppk.forEach(element => {
                        value_checked.push(element.nilai_ppk);
                        $("[value = '"+element.nilai_ppk+"']").prop('checked', true);
                    });
                    $(".nama_user").val(res.user);
                    $(".kegiatan_berbasis").find("[value = '"+res.data_dokumentasi.kegiatan_berbasis+"']").prop('selected', true);
                    $(".awal_kegiatan").val(res.data_dokumentasi.mulai_kegiatan);
                    $(".akhir_kegiatan").val(res.data_dokumentasi.akhir_kegiatan);
                    $(".dokumen_kegiatan").append('<li>Belum Mengunggah Dokumen</li>');
                }).done(function(){
                    loadingBar('hide');
                }).fail(function(error){
                    loadingBar('hide');
                    if (error.status === 404) {
                        let errors = JSON.parse(error.responseText);
                        alertNotificationNotFoundAndLogin('error',errors.messages);   
                    }
                    else if(error.status === 401){
                        let errors = JSON.parse(error.responseText);
                        alertNotificationNotFoundAndLogin('info', errors.message);
                    }
                    else{
                        anyErrors(error.status , error.statusText , error);
                    }
                });
            }
            else if(btn_value === "sudah_unggah"){
                var url = '{{route("kepsek.pengajuan_dokumentasi_kegiatan.show", ["dokumentasi_kegiatan" => "ids"])}}';
                url = url.replace("ids", dokumentasi_id);
                loadingBar('show');
                $.get(url, function(res){
                    // console.log(res);
                    $("#showDokumentasi").modal();
                    $(".nama_user").val(res.user);
                    $(".nama_kegiatan").val(res.data_dokumentasi.nama_kegiatan);
                    var nilai_ppk = $.parseJSON(res.data_dokumentasi.nilai_ppk);
                    nilai_ppk.forEach(element => {
                        value_checked.push(element.nilai_ppk);
                        $("[value = '"+element.nilai_ppk+"']").prop('checked', true);
                    });
                    $(".kegiatan_berbasis").find("[value = '"+res.data_dokumentasi.kegiatan_berbasis+"']").prop('selected', true);
                    $(".awal_kegiatan").val(res.data_dokumentasi.mulai_kegiatan);
                    $(".akhir_kegiatan").val(res.data_dokumentasi.akhir_kegiatan);
                    res.dokumen_dokumentasi.forEach(item_dokumen => {
                        if (item_dokumen.status_unggah_dokumen === "Pengajuan") {
                            var asset_url = '{{asset("kegiatan/dokumentasi_kegiatan/asset_dokumen")}}';
                            asset_url = asset_url.replace("asset_dokumen" , item_dokumen.nama_dokumen);
                            $(".dokumen_kegiatan").append('<li> <i class="fa fa-file-alt"></i>'+item_dokumen.nama_dokumen+'<button type="button" class="btn btn-primary btn-sm lihat_file mr-2 ml-2" value="'+asset_url+'">Lihat Dokumen</button><a href="'+asset_url+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+item_dokumen.nama_dokumen+'">Download File</a></li><br>');
                        }
                    });
                }).done(function(){
                    loadingBar('hide');
                }).fail(function(error){
                    loadingBar('hide');
                    if (error.status === 404) {
                        let errors = JSON.parse(error.responseText);
                        alertNotificationNotFoundAndLogin('error',errors.messages);   
                    }
                    else if(error.status === 401){
                        let errors = JSON.parse(error.responseText);
                        alertNotificationNotFoundAndLogin('info', errors.message);
                    }
                    else{
                        anyErrors(error.status , error.statusText , error);
                    }
                });
            }
        });

        $("#showDokumentasi").on('hidden.bs.modal', function(){
            for (let index = 0; index < value_checked.length; index++) {
                const element = value_checked[index];
                $("[value = '"+element+"']").prop('checked' , false);
            }
            $(".kegiatan_berbasis").find("[value = '']").prop('selected', true);
            $(".nama_user").val();
            $(".nama_kegiatan").val();
            $(".awal_kegiatan").val();
            $(".akhir_kegiatan").val();
            $(".dokumen_kegiatan").empty();
            value_checked.length = 0;
        });
        $(document).on('click', '.lihat_file', function(){
            var value_asset = $(this).val();
            window.open(value_asset);
        });
        //mungkin bisa add function
        function alertNotificationNotFoundAndLogin(status, error){
            if (status === 'error') {
                if (typeof error === 'string') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terdapat Error',
                        text: error
                    });
                }   
            }
            else if(status === 'info'){
                Swal.fire({
                    icon: 'info',
                    title: 'Please Login',
                    text: error
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
                    text: 'System Error Code: '+status+": "+statusText+": "+errors.message
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'System Error Code: '+status+": "+statusText
                });    
            }
            console.log(errors);
        }

        function loadingBar(condition){
            if (condition === 'show') {
                Swal.fire({
                    title: 'Sedang Memproses',
                    html: '<div class="spinner-border" role="status" style="margin:25%"><span class="sr-only"></span></div>',    
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    allowEnterKey: false,
                    showConfirmButton: false
                });
            } else if(condition === 'hide') {
                Swal.close();
            }
        }
    </script>
@endsection