@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Pengajuan Dokumentasi Kegiatan
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1>Laporan Kegiatan Penanggung Jawab</h1>
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
                                        <th>ID Kegiatan</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Nilai PPK</th>                                  
                                        <th>Kegiatan Berbasis</th>
                                        <th>Pengiriman Laporan</th>
                                        <th>Nama Penanggung Jawab</th>
                                        <th>Status Proposal Kegiatan</th>  
                                        <th>Aksi</th>
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
                        <h5 class="modal-title" id="exampleModalLabel">Data Laporan Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group tipe_kegiatan d-none">
                            {!! Form::label('tipe_kegiatan', 'Tipe Kegiatan: ') !!}
                            <ul class="pengajuan_kegiatan" style="background-color: #ffc107; color: white; border-radius: 10px; font-weight: bold">

                            </ul>
                        </div>
                        <div class="form-group status_kegiatan_group d-none">
                            {!! Form::label('status_kegiatan', 'Status Kegiatan:') !!}
                            <ul class="status_kegiatan">

                            </ul>
                        </div>
                        <div class="form-group keterangan_kegiatan_group d-none">
                            {!! Form::label('status_kegiatan', 'Histori Keterangan Kegiatan:') !!}
                            <ul class="keterangan_kegiatan" style="background-color: #36b9cc; color: white; border-radius: 10px; font-weight: bold">

                            </ul>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6 image_user">
                                
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('nama_user' , 'Nama Penanggung Jawab') !!}
                                    {!! Form::text('nama_user' , null , ['class' => 'form-control nama_user' , 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <hr>
                        
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
                        <hr>
                        {!! Form::label('text_label_pengelolaan_dokumentasi' , 'Fungsi Pengelolaan Dokumentasi Kegiatan PPK') !!}
                        <div class="card shadow mb-4" id="show_kelola_dokumentasi">
                            <a href="#collapseCardExample" class="d-block card-header py-3 border border-bottom-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                              <h6 class="m-0 font-weight-bold text-primary">Laporan Dan Dokumentasi Kegiatan Yang Diunggah: </h6>
                            </a>   
                            <div class="collapse show" id="collapseCardExample">
                              <div class="card-body">
                                {!! Form::label('label_data_pengajuan_dokumentasi' , 'Laporan Kegiatan Yang Telah Diunggah:') !!}
                                {{-- <b class="text-danger">*Jika Data Dokumen Hanya Satu, Maka Dokumen Tersebut Tidak Dapat Dihapus</b> --}}
                                <br>
                                <ol class="laporan_kegiatan">
    
                                </ol>
                                <hr>
                                {!! Form::label('label_data_pengajuan_dokumentasi' , 'Dokumentasi Yang Telah Diunggah:') !!}        
                                <ol class="dokumentasi_kegiatan">
    
                                </ol>
                                <hr>
                                {!! Form::label('label_data_link_video' , 'Link Video Kegiatan Yang Telah Diunggah:') !!}        
                                <ol class="link_video">
    
                                </ol>
                                {!! Form::label('label_data_link_article' , 'Link Article Kegiatan Yang Telah Diunggah:') !!}        
                                <ol class="link_article">
    
                                </ol>
                              </div>
                            </div>
                          </div>
                        {{-- <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                {!! Form::label('dokumen' , "Laporan Kegiatan:") !!}
                                <table class="table table-bordered d-none" id="docs">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokumen</th>
                                            <th>Status Unggahan</th>
                                            <th>Aksi</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody class="dokumen_kegiatan">
                                        
                                    </tbody>
                                </table>
                                <ol class="dokumen_kegiatan">
        
                                </ol>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                {!! Form::label('image' , "Dokumentasi Kegiatan:") !!}
                                <ol class="dokumen_kegiatan">
        
                                </ol>
                                <table class="table table-bordered d-none" id="img">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Foto</th>
                                            <th>Status Unggahan</th>
                                            <th>Aksi</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody class="foto_kegiatan">
                                        
                                    </tbody>
                                </table>
                                <ol class="dokumen_kegiatan">
        
                                </ol>
                            </div>
                        </div> --}}
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
                {data: 'nama_pj' , name: 'nama_pj'},
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
                getDataKegiatan(url, btn_value);
                // loadingBar('show');
                // $.get(url, function(res){
                //     $("#showDokumentasi").modal();
                //     // console.log(res);
                //     $(".nama_kegiatan").val(res.data_dokumentasi.nama_kegiatan);
                //     var nilai_ppk = $.parseJSON(res.data_dokumentasi.nilai_ppk);
                //     nilai_ppk.forEach(element => {
                //         value_checked.push(element.nilai_ppk);
                //         $("[value = '"+element.nilai_ppk+"']").prop('checked', true);
                //     });
                //     $(".nama_user").val(res.user);
                //     $(".kegiatan_berbasis").find("[value = '"+res.data_dokumentasi.kegiatan_berbasis+"']").prop('selected', true);
                //     $(".awal_kegiatan").val(res.data_dokumentasi.mulai_kegiatan);
                //     $(".akhir_kegiatan").val(res.data_dokumentasi.akhir_kegiatan);
                //     document.getElementById('docs').classList.remove('d-none');
                //     document.getElementById('img').classList.remove('d-none');
                //     $(".dokumen_kegiatan").append('<li>Belum Mengunggah Dokumen</li>');
                // }).done(function(){
                //     loadingBar('hide');
                // }).fail(function(error){
                //     loadingBar('hide');
                //     if (error.status === 404) {
                //         let errors = JSON.parse(error.responseText);
                //         alertNotificationNotFoundAndLogin('error',errors.messages);   
                //     }
                //     else if(error. status === 401){
                //         let errors = JSON.parse(error.responseText);
                //         alertNotificationNotFoundAndLogin('info', errors.message);
                //     }
                //     else{
                //         anyErrors(error.status , error.statusText , error);
                //     }
                // });
            }
            else if(btn_value === "sudah_unggah"){
                var url = '{{route("kepsek.pengajuan_dokumentasi_kegiatan.show", ["dokumentasi_kegiatan" => "ids"])}}';
                url = url.replace("ids", dokumentasi_id);
                getDataKegiatan(url, btn_value);
                // loadingBar('show');
                // $.get(url, function(res){
                //     // console.log(res);
                //     $("#showDokumentasi").modal();
                //     $(".nama_user").val(res.user);
                //     $(".nama_kegiatan").val(res.data_dokumentasi.nama_kegiatan);
                //     var nilai_ppk = $.parseJSON(res.data_dokumentasi.nilai_ppk);
                //     nilai_ppk.forEach(element => {
                //         value_checked.push(element.nilai_ppk);
                //         $("[value = '"+element.nilai_ppk+"']").prop('checked', true);
                //     });
                //     $(".kegiatan_berbasis").find("[value = '"+res.data_dokumentasi.kegiatan_berbasis+"']").prop('selected', true);
                //     $(".awal_kegiatan").val(res.data_dokumentasi.mulai_kegiatan);
                //     $(".akhir_kegiatan").val(res.data_dokumentasi.akhir_kegiatan);
                //     var count_id = 1;
                //     res.dokumen_dokumentasi.forEach(item_dokumen => {
                //         // if (item_dokumen.status_unggah_dokumen === "Pengajuan") {
                //             var asset_url = '{{asset("kegiatan/dokumentasi_kegiatan/asset_dokumen")}}';
                //             asset_url = asset_url.replace("asset_dokumen" , item_dokumen.nama_dokumen);
                //             // $(".dokumen_kegiatan").append('<li> <i class="fa fa-file-alt"></i>'+item_dokumen.nama_dokumen+'<button type="button" class="btn btn-primary btn-sm lihat_file mr-2 ml-2" value="'+asset_url+'">Lihat Dokumen</button><a href="'+asset_url+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+item_dokumen.nama_dokumen+'">Download File</a></li><br>');
                //             if (item_dokumen.status_unggah_dokumen === "Pengajuan") {
                //                 $(".dokumen_kegiatan").append('<tr><td>'+(count_id++)+'</td><td> <i class="fa fa-file-alt mr-2"></i>'+item_dokumen.nama_dokumen+'</td><td>'+item_dokumen.status_unggah_dokumen+'</td><td><button type="button" class="btn btn-primary btn-sm lihat_file mr-2 ml-2" value="'+asset_url+'">Lihat Dokumen</button><a href="'+asset_url+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+item_dokumen.nama_dokumen+'">Download File</a></td></tr>');                                
                //             } else if(item_dokumen.status_unggah_dokumen === "Dokumentasi") {
                //                 $(".dokumen_kegiatan").append('<tr><td>'+(count_id++)+'</td><td> <i class="fa fa-file-alt mr-2"></i>'+item_dokumen.nama_dokumen+'</td><td>'+item_dokumen.status_unggah_dokumen+'</td><td><button type="button" class="btn btn-primary btn-sm lihat_file mr-2 ml-2" value="'+asset_url+'">Lihat Dokumen</button><a href="'+asset_url+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+item_dokumen.nama_dokumen+'">Download File</a></td></tr>');   
                //             }
                //         // }
                //     });
                // }).done(function(){
                //     loadingBar('hide');
                // }).fail(function(error){
                //     loadingBar('hide');
                //     if (error.status === 404) {
                //         let errors = JSON.parse(error.responseText);
                //         alertNotificationNotFoundAndLogin('error',errors.messages);   
                //     }
                //     else if(error.status === 401){
                //         let errors = JSON.parse(error.responseText);
                //         alertNotificationNotFoundAndLogin('info', errors.message);
                //     }
                //     else{
                //         anyErrors(error.status , error.statusText , error);
                //     }
                // });
            } else if(btn_value === "belum_disetujui"){
                var url = '{{route("kepsek.pengajuan_dokumentasi_kegiatan.edit", ["dokumentasi_kegiatan" => "ids"])}}';
                url = url.replace("ids", dokumentasi_id);
                location.replace(url);
            } else if(btn_value === "pengajuan_ulang"){
                var url = '{{route("kepsek.pengajuan_dokumentasi_kegiatan.show", ["dokumentasi_kegiatan" => "ids"])}}';
                url = url.replace("ids", dokumentasi_id);
                getDataKegiatan(url, btn_value);
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
            // document.getElementById('docs').classList.add('d-none');
            // document.getElementById('img').classList.add('d-none');
            $(".laporan_kegiatan").empty();
            $(".dokumentasi_kegiatan").empty();
            $(".status_kegiatan").empty();
            $(".keterangan_kegiatan").empty();
            $(".link_video").empty();
            $(".link_article").empty();
            value_checked.length = 0;
        });
        $(document).on('click', '.lihat_file', function(){
            var value_asset = $(this).val();
            window.open(value_asset);
        });
        //mungkin bisa add function

        function getDataKegiatan(url, statusKegiatanType){
            if (statusKegiatanType === 'unggah_dokumentasi' || statusKegiatanType === 'sudah_unggah' || statusKegiatanType === 'pengajuan_ulang') {
                loadingBar('show');
                $.get(url, function(res){
                    // console.log(res);
                    if (!res.image_state) {
                        let file_loc = '{{asset("logo/logo_smp_islam_sabilurrosyad.png")}}';
                        $(".nama_user").val(res.username);
                        $('.image_user').append('<img class="rounded-circle" src="'+file_loc+'" width="300" height="300">');
                    } else {
                        let file_loc = '{{asset("kegiatan/admin/foto_user/users")}}';
                        file_loc = file_loc.replace('users' , res.user.photo_user);
                        $(".nama_user").val(res.user.name);
                        $('.image_user').append('<img class="rounded-circle" src="'+file_loc+'" width="300" height="300">');
                    }
                    $(".pengajuan_kegiatan").empty();
                    const status_kegiatan = res.status_kegiatan;
                    const keteranganKegiatan = JSON.parse(res.data_dokumentasi.keterangan_dokumentasi);
                    addStatusElement(status_kegiatan.id, status_kegiatan.nama, keteranganKegiatan);
                    $(".nama_kegiatan").val(res.data_dokumentasi.nama_kegiatan);
                    const nilai_ppk = $.parseJSON(res.data_dokumentasi.nilai_ppk);
                    const tipe_kegiatan = res.data_dokumentasi.tipe_kegiatan;
                    if (tipe_kegiatan === 'Pengajuan Historis') {
                        $(".tipe_kegiatan").removeClass('d-none');
                        $(".pengajuan_kegiatan").append('<li>'+tipe_kegiatan+'</li>');
                        $(".keterangan_kegiatan_group").addClass('d-none');
                        $(".keterangan_kegiatan").addClass('d-none');
                        $(".status_kegiatan_group").addClass('d-none');
                        $(".status_kegiatan").addClass('d-none');
                    } else {
                        $(".keterangan_kegiatan_group").removeClass('d-none');
                        $(".keterangan_kegiatan").removeClass('d-none');
                        $(".status_kegiatan_group").removeClass('d-none');
                        $(".status_kegiatan").removeClass('d-none');
                        $(".tipe_kegiatan").addClass('d-none');
                    }
                    nilai_ppk.forEach(element => {
                        value_checked.push(element.nilai_ppk);
                        $("[value = '"+element.nilai_ppk+"']").prop('checked', true);
                    });
                    $(".kegiatan_berbasis").find("[value = '"+res.data_dokumentasi.kegiatan_berbasis+"']").prop('selected', true);
                    $(".awal_kegiatan").val(res.data_dokumentasi.mulai_kegiatan);
                    $(".akhir_kegiatan").val(res.data_dokumentasi.akhir_kegiatan);
                    // document.getElementById('docs').classList.remove('d-none');
                    // document.getElementById('img').classList.remove('d-none');
                    if (statusKegiatanType === 'unggah_dokumentasi') {
                        $(".laporan_kegiatan").append('<li>Belum Mengunggah Laporan Kegiatan</li>');   
                        $(".dokumentasi_kegiatan").append('<li>Belum Mengunggah Dokumentasi Kegiatan</li>');  
                        $(".link_video").append('<li>Belum Mengunggah Link Video Kegiatan</li>');
                        $(".link_article").append('<li>Belum Mengunggah Link Artikel Kegiatan</li>');
                    } else if(statusKegiatanType === 'sudah_unggah' || statusKegiatanType === 'pengajuan_ulang'){
                        // let count_dokumen = 1;
                        // let count_image = 1;
                         res.dokumen_dokumentasi.forEach(item_dokumen => {
                            const fileName = item_dokumen.nama_dokumen;
                            let asset_url = '{{asset("kegiatan/dokumentasi_kegiatan/asset_dokumen")}}';
                            asset_url = asset_url.replace("asset_dokumen" , item_dokumen.nama_dokumen);
                            // $(".dokumen_kegiatan").append('<li> <i class="fa fa-file-alt"></i>'+item_dokumen.nama_dokumen+'<button type="button" class="btn btn-primary btn-sm lihat_file mr-2 ml-2" value="'+asset_url+'">Lihat Dokumen</button><a href="'+asset_url+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+item_dokumen.nama_dokumen+'">Download File</a></li><br>');
                            if (item_dokumen.status_unggah_dokumen === "Pengajuan" || item_dokumen.status_unggah_dokumen === "Pengajuan Historis") {
                                // $(".laporan_kegiatan").append('<tr><td>'+(count_dokumen++)+'</td><td> <i class="fa fa-file-alt mr-2"></i>'+item_dokumen.nama_dokumen+'</td><td>'+item_dokumen.status_unggah_dokumen+'</td><td><button type="button" class="btn btn-primary btn-sm lihat_file mr-2 ml-2" value="'+asset_url+'">Lihat Dokumen</button><a href="'+asset_url+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+item_dokumen.nama_dokumen+'">Download File</a></td></tr>');                                
                                if (fileName.search('.pdf') === -1) {
                                    $(".laporan_kegiatan").append('<li class="mb-2"> <i class="fa fa-file-alt mr-2"></i>'+fileName+'<a href="'+asset_url+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+fileName+'">Download File</a></li>');                                
                                } else if(fileName.search('.docx') === -1 || fileName.search('.doc') === -1) {
                                    $(".laporan_kegiatan").append('<li class="mb-2"> <i class="fa fa-file-alt mr-2"></i>'+fileName+'<button type="button" class="btn btn-primary btn-sm lihat_file mr-2 ml-2" value="'+asset_url+'">Lihat Dokumen</button><a href="'+asset_url+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+fileName+'">Download File</a></li>');                                   
                                }
                            } 
                        });
                        res.image_kegiatan.forEach(item_image => {
                            let asset_url = '{{asset("kegiatan/dokumentasi_kegiatan/asset_dokumen")}}';
                            asset_url = asset_url.replace("asset_dokumen" , item_image.nama_foto_kegiatan);
                            $(".dokumentasi_kegiatan").append('<li class="mb-2"><img class="rounded-circle mb-2 mt-2 mr-2" src="'+asset_url+'" alt="" width="150" height="150">'+item_image.nama_foto_kegiatan+'<button type="button" class="btn btn-primary btn-sm lihat_file mr-2 ml-2" value="'+asset_url+'">Lihat File</button><a href="'+asset_url+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+item_image.nama_foto_kegiatan+'">Download File</a></li>');                                
                        });
                        const linkVideo = JSON.parse(res.data_dokumentasi.add_link_video);
                        if (linkVideo.length > 0) {
                            linkVideo.forEach(element => {
                                $(".link_video").append('<li><i class="fa fa-external-link-alt mr-2"></i><a href="'+element.link_data+'" target="_blank">'+element.link_data+'</a></li>');
                            });
                        } else {
                            $(".link_video").append('<li>Belum Mengunggah Link Video Kegiatan</li>');
                        }
                        const linkArticle = JSON.parse(res.data_dokumentasi.add_link_article);
                        if (linkArticle.length > 0) {
                            linkArticle.forEach(element => {
                                $(".link_article").append('<li><i class="fa fa-external-link-alt mr-2"></i><a href="'+element.link_data+'" target="_blank">'+element.link_data+'</a></li>');
                            });
                        } else {
                            $(".link_article").append('<li>Belum Mengunggah Link Artikel Kegiatan</li>');
                        }
                    }
                }).done(function(){
                    $("#showDokumentasi").modal();
                    loadingBar('hide');
                }).fail(function(responseError){
                    if (error.status === 404) {
                        let errors = JSON.parse(responseError.responseText);
                        alertNotificationNotFoundAndLogin('error',responseError.messages);   
                    }
                    else if(error.status === 401){
                        let errors = JSON.parse(responseError.responseText);
                        alertNotificationNotFoundAndLogin('info', responseError.message);
                    }
                    else{
                        anyErrors(responseError.status , responseError.statusText , responseError);
                    }
                });
            }
        }

        function addStatusElement(id, namaStatus, dataKeterangan){
            const statusElement = document.querySelector('.status_kegiatan');
            const listElement = document.createElement('li');
            if (id === 2) {
                $(".status_kegiatan").css({
                    "background-color": "#e74a3b",
                    "color": "white",
                    "border-radius": "10px",
                    "font-weight": 'bold',
                });
                listElement.innerText = "Belum "+namaStatus;
            } else if(id === 4){
                $(".status_kegiatan").css({
                    "background-color": "#4e73df",
                    "color": "white",
                    "border-radius": "10px",
                    "font-weight": 'bold',
                });
                listElement.innerText = "Sedang "+namaStatus;
                
            }else if(id === 6){
                $(".status_kegiatan").css({
                    "background-color": "#00a85a",
                    "color": "white",
                    "border-radius": "10px",
                    "font-weight": 'bold',
                });
                listElement.innerText = namaStatus;
            }
            addKeteranganElement(dataKeterangan);
            statusElement.appendChild(listElement);
        }

        function addKeteranganElement(keterangan){
            if (keterangan !== null) {
                keterangan.forEach(element => {
                    // console.log(element.no);
                    if (element.no === 1) {
                        if(element.keterangan_opsional === ""){
                            $(".keterangan_kegiatan").append('<li>Tidak Ada Keterangan Sukses</li>');
                        }  else {
                            $(".keterangan_kegiatan").append('<li>Keterangan Persetujuan Laporan Kegiatan:'+element.keterangan_opsional+'</li>');
                        }   
                        // console.log(element.keterangan_opsional);
                    } 
                    else if(element.no === 2){
                        if(element.keterangan_wajib_ulang === ""){
                            $(".keterangan_kegiatan").append('<li>Tidak Ada Keterangan Pengajuan Ulang</li>');
                        }  else {
                            $(".keterangan_kegiatan").append('<li>Keterangan Pengajuan Ulang: '+element.keterangan_wajib_ulang+'</li>');
                        }
                        // console.log(element.keterangan_wajib_ulang);
                    }
                });
            } else {
                const keteranganElement = document.querySelector('.keterangan_kegiatan');
                keteranganList.innerText = "Tidak Ada Data Keterangan";
                keteranganElement.appendChild(keteranganList);
            }
        }

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
                    window.location.replace('/');
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