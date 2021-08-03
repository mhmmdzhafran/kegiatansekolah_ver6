{{--   
    Nama: Muhammad Zhafran Auristianto
    Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
  --}}
@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Proposal Kegiatan
@endsection

@section('content')
    <h1>Proposal Kegiatan PPK</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="pengajuan_kegiatan">
                            <thead>
                                <tr>
                                    <th>ID Kegiatan</th>
                                    <th width="15%">Nama Kegiatan</th>
                                    <th>Nilai PPK</th>                                  
                                    <th>Kegiatan Berbasis</th>
                                    <th>Pengiriman Proposal</th>
                                    <th>Nama Penanggung Jawab</th>
                                    <th width="20%">Status Proposal Kegiatan</th>  
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Data Proposal Kegiatan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('status_kegiatan', 'Status Kegiatan:') !!}
                            <ul class="status_kegiatan">

                            </ul>
                        </div>
                        <div class="form-group">
                            {!! Form::label('status_kegiatan', 'Histori Keterangan Proposal Kegiatan:') !!}
                            <ul class="keterangan_kegiatan">

                            </ul>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6 image_user">
                                
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('nama_pj', 'Nama Penanggung Jawab:') !!}
                                    <input type="text" name="nama_pj" id="nama_pj" value="" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
                            <input type="text" name="PJ_nama_kegiatan" id="PJ_nama_kegiatan" value="" class="form-control" disabled>
                        </div>

                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Nilai PPK:</label>
                          <br>
                          {!! Form::checkbox('nilai_ppk[]', 'Religius', null, ['class' => 'value_nilai_ppk', 'disabled' => 'disabled']) !!} Religius
                          <br>
                          {!! Form::checkbox('nilai_ppk[]', 'Integritas', null, ['class' => 'value_nilai_ppk', 'disabled']) !!} Integritas
                          <br>
                          {!! Form::checkbox('nilai_ppk[]', 'Nasionalis', null, ['class' => 'value_nilai_ppk', 'disabled']) !!} Nasionalis
                          <br>
                          {!! Form::checkbox('nilai_ppk[]', 'Mandiri', null, ['class' => 'value_nilai_ppk', 'disabled']) !!} Mandiri
                          <br>
                          {!! Form::checkbox('nilai_ppk[]', 'Gotong Royong', null, ['class' => 'value_nilai_ppk', 'disabled']) !!} Gotong Royong
                        </div>
                        <div class="form-group">
                            {!! Form::label('kegiatan_berasis', 'Kegiatan Berbasis PPK:') !!}
                            {!! Form::select('kegiatan_berbasis', array('' => 'Choose Options', 'Berbasis Kelas' => 'Berbasis Kelas', 'Berbasis Budaya Sekolah' => 'Berbasis Budaya Sekolah', 'Berbasis Masyarakat' => 'Berbasis Masyarakat') ,null , ['class' => 'form-control kegiatan_berbasis', 'disabled'=>'disabled']) !!}
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                {!! Form::label('lihat-file', "Dokumen Yang Diunggah") !!}
                                <div class="form-group" id="lihat-file"></div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                                        {!! Form::date('mulai_kegiatan', null , ['class' => 'form-control mulai_kegiatan', 'disabled']) !!}    
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6">
                                    <div class="form-group">
                                        {!! Form::label('akhir_kegiatan', 'Akhir dari Kegiatan:') !!}
                                        {!! Form::date('akhir_kegiatan', null , ['class' => 'form-control akhir_kegiatan' , 'disabled']) !!}
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              </div>
                    </div>
                  </div>
            </div>
        </div>
@endsection

@section('script')
    <script>
        var value_checked = [];
        $("#pengajuan_kegiatan").DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("kepsek.kelola_kegiatan.index")}}',
            columns:[
                {data: 'id', name:'id'},
                {data: 'PJ_nama_kegiatan', name:'PJ_nama_kegiatan', width: '5%'},
                {data: 'nilai_ppk', name:'nilai_ppk'},
                {data: 'kegiatan_berbasis', name: 'kegiatan_berbasis'},
                {data: 'updated_at' , name: 'updated_at'},
                {data: 'nama_pj' , name: 'nama_pj' },
                {data: 'statusKegiatan', name: 'statusKegiatan.nama', orderable: false},
                {data: 'action_btn' , name: 'action_btn', orderable: false}
            ],
            order: [[4, "desc"]]
        });
        $(document).on('click', '.data_pengajuan', function(){
            $(".keterangan_kegiatan").empty();
            $(".status_kegiatan").empty();
            $("#lihat-file").empty();
            $(".image_user").empty();
            var value_btn = $(this).attr('value');
            var id = $(this).attr('id');
            if (value_btn === "sudah_disetujui" || value_btn === "menolak" || value_btn === "pengajuan_ulang") {
                //show
                var url = '{{route("kepsek.kelola_kegiatan.show", "id")}}';
                url = url.replace("id", id);
                loadingBar('show');
                $.get(url, function(res){
                    if (!res.image_status || res.user.photo_user === null) {
                        let file_loc = '{{asset("logo/logo_smp_islam_sabilurrosyad.png")}}';
                        $("#nama_pj").attr('value' , res.username);
                        $('.image_user').append('<img class="rounded-circle" src="'+file_loc+'" width="300" height="300">');
                    } else {
                        let file_loc = '{{asset("storage/photo_user_simppk/users")}}';
                        file_loc = file_loc.replace('users' , res.user.photo_user);
                        $("#nama_pj").attr('value' , res.user.name);
                        $('.image_user').append('<img class="rounded-circle" src="'+file_loc+'" width="300" height="300">');
                    }
                    //untuk data pengajuan => res.data
                    $("#PJ_nama_kegiatan").attr('value' , res.data.PJ_nama_kegiatan);
                    var data_ppk = $.parseJSON(res.data.nilai_ppk);
                    // $(".value_nilai_ppk").find('[value = "'+res.data.nilai_ppk+'"]').attr('selected', 'selected');    
                    $.each(data_ppk, function(key, value){
                        value_checked.push(value.nilai_ppk);
                        $("[value = '"+value.nilai_ppk+"']").prop('checked', true);
                    });
                    $(".kegiatan_berbasis").find('[value = "'+res.data.kegiatan_berbasis+'"]').prop('selected', true);
                    $(".mulai_kegiatan").attr('value', res.data.mulai_kegiatan);
                    $(".akhir_kegiatan").attr('value', res.data.akhir_kegiatan);
                    var keterangan = $.parseJSON(res.data.keterangan_json);
                    $(".keterangan_kegiatan").css({
                            "background-color": "#36b9cc",
                            "color": "white",
                            "border-radius": "10px",
                            // "padding-bottom": "3rem",
                            "font-weight": 'bold'
                        });
                    $.each(keterangan, function(key, value){
                        if (value.no === 1) {
                            if (value.keterangan_opsional === null || value.keterangan_opsional === "") {
                                $(".keterangan_kegiatan").append('<li>Tidak Terdapat Keterangan Saat Disetujui</li>');
                            }
                            else{
                                $(".keterangan_kegiatan").append('<li> Keterangan Pengajuan Sukses: '+value.keterangan_opsional+'</li>');
                            }
                        }
                        else if(value.no === 2){
                            if (value.keterangan_wajib_ulang === null || value.keterangan_wajib_ulang === "") {
                                $(".keterangan_kegiatan").append('<li>Tidak Terdapat Keterangan Saat Melakukan Pengajuan Ulang</li>');
                            }
                            else{
                                $(".keterangan_kegiatan").append('<li> Keterangan Saat Pengajuan Ulang: '+value.keterangan_wajib_ulang+'</li>');
                            }
                        }
                        else if(value.no === 3){
                            if(value.keterangan_wajib){
                                $(".keterangan_kegiatan").append('<li> Keterangan Menolak: '+value.keterangan_wajib+'</li>');
                            }
                        }
                        else{
                            $(".keterangan_kegiatan").append('<li>Tidak terdapat keterangan</li>');
                        }
                    });
                    //untuk data status kegiatan => res.status_kegiatan
                    if (res.status_kegiatan.id === 1) {
                        $(".status_kegiatan").css({
                            "background-color": "#00a85a",
                            "color": "white",
                            "border-radius": "10px",
                            // "padding-bottom": "3rem",
                            "font-weight": 'bold'
                        });
                        
                        $(".status_kegiatan").append('<li>'+res.status_kegiatan.nama+'</li>');   
                    }
                    else if(res.status_kegiatan.id === 5){
                        $(".status_kegiatan").css({
                            "background-color": "#e74a3b",
                            "color": "white",
                            "border-radius": "10px",
                            // "padding-bottom": "3rem",
                            "font-weight": 'bold'
                        });
                        $(".status_kegiatan").append('<li>'+res.status_kegiatan.nama+'</li>');   
                    }
                    else if(res.status_kegiatan.id === 4){
                        $(".status_kegiatan").css({
                            "background-color": "#f6c23e",
                            "color": "white",
                            "border-radius": "10px",
                            // "padding-bottom": "3rem",
                            "font-weight": 'bold'
                        });
                        $(".status_kegiatan").append('<li>Sedang Melakukan '+res.status_kegiatan.nama+'</li>');   
                    }
                    else{
                        $(".status_kegiatan").css({
                            "background-color": "#858796",
                            "color": "white",
                            "border-radius": "10px",
                            // "padding-bottom": "3rem",
                            "font-weight": 'bold'
                        });
                        $(".status_kegiatan").append('<li>Tidak terdapat Status</li>');   
                    }
                    
                    //untuk status dokumen => res.status_dokumen
                    if (res.status_dokumen) {
                        // var dokumen = $.parseJSON(res.data.dokumen_kegiatan);
                        var asset = '{{asset("storage/pengajuan_kegiatan/asset_kegiatan")}}';
                        asset = asset.replace('asset_kegiatan', res.data.dokumen_kegiatan);
                        $("#lihat-file").append('<iframe src="'+asset+'" height="500" width="1100"></iframe>');
                        // $.each(dokumen, function(key,value){
                        // });
                    } else {
                        $("#lihat-file").append('<ol><li class="mb-2">Tidak Terdapat Proposal Kegiatan</li></ol>');
                    }
                }).done(function(){
                    $("#showModal").modal();
                    loadingBar('hide');
                }).fail(function(error){
                    loadingBar('hide');
                    if (error.status === 401) {
                        let errors = JSON.parse(error.responseText);
                        let loginMessage = errors.message;
                        alertNotificationLoginAndError(error.status , loginMessage);
                    } else if(error.status === 404) {
                        // let errors = JSON.parse(error.responseText);
                        let errorMessage = error.messages;
                        alertNotificationLoginAndError(error.status , errorMessage);
                    } else {
                        anyErrors(error.status , error.statusText, error);
                    }
                });
            } else if(value_btn === "belum_disetujui") {
                var url = '{{route("kepsek.kelola_kegiatan.edit", "id")}}';
                url = url.replace("id", id );
                // console.log(url);
                $.get(url, function(){
                    window.location = url;
                }).fail(function(error){
                    //404
                    if (error.status === 404) {
                        let errors = JSON.parse(error.responseText);
                        let errorMessage = errors.messages;
                        alertNotificationLoginAndError(error.status, errorMessage);
                    } else if(error.status === 401) {
                        window.location = '/';
                    } else {
                        //anyError
                        anyErrors(error.status, error.statusText , error);
                    }                    
                });
            }
        });
        $("#showModal").on('hidden.bs.modal', function(){            
            for (let index = 0; index < value_checked.length; index++) {
                const element = value_checked[index];  
                $("[value = '"+element+"']").prop('checked', false);
            }
            value_checked.length = 0;
        });

        //Functions

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

        function alertNotificationLoginAndError(statusCode , messageNotification){
            if (statusCode === 401) {
                Swal.fire({
                    icon: 'info',
                    title: 'Please Login',
                    text: messageNotification
                }).then((result)=>{
                    window.location = '/';
                });
            } else if(statusCode === 404){
                Swal.fire({
                    icon: 'error',
                    title: 'Terdapat Error saat mengambil data',
                    text: messageNotification
                });  
            }
        }

        function anyErrors(statusCode, statusText, statusLog){
            if (typeof statusLog.message !== "undefined") {
                Swal.fire({
                    icon: 'error',
                    title: 'Terdapat Error',
                    text: 'System Error Code: '+statusCode+": "+statusText+": "+statusLog.message
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Terdapat Error',
                    text: 'System Error Code: '+statusCode+": "+statusText
                });
            }
            console.log(statusLog);
        }
    </script>
@endsection