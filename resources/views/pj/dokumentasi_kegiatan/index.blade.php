@extends('layouts.template_PJ')

@section('title')
    Penanggung Jawab - Pelaporan Dokumentasi Kegiatan
@endsection

@section('content')
<div class="row">
<div class="col-lg-8 col-sm-12">
    <h1>Kelola Dokumentasi Kegiatan PPK</h1>
</div>
<div class="col-sm-12 col-lg-4">
    <button type="button" class="btn btn-primary rounded-pill float-md-left float-lg-right float-sm-left mb-2" id="unggah_baru">Tambah Dokumentasi Baru</button>
</div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive-sm table-responsive-lg">
                        <table class="table table-striped table-bordered" id="dokumentasi_kegiatan">
                            <thead>
                                <tr>
                                    <th>ID Dokumentasi</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Nilai PPK</th>                                  
                                    <th>Kegiatan Berbasis</th>
                                    <th>Timestamp Dokumentasi</th>
                                    <th width="15%">Status Proposal Kegiatan</th>  
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade lihat_dokumentasi" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-xl" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Dokumentasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="button_kelola_dokumentasi">
                        <a class="btn btn-warning btn-sm rounded-pill float float-right button_show_dokumentasi" href="#show_kelola_dokumentasi">Lakukan Pengelolaan Dokumentasi</a>
                      </div>
                      <div class="form-group mt-3">
                        {!! Form::label('status_kegiatan', 'Status Dokumentasi Kegiatan:') !!}
                        <ul class="status_dokumentasi">                            
                        </ul>
                      </div>
                    <div class="form-group">
                        {!! Form::label('nama_kegiatan', 'Nama Kegiatan:') !!}
                        {!! Form::text('nama_kegiatan', null , ['class' => 'form-control nama_kegiatan_terlaksana' , 'disabled' => 'disabled']) !!}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nilai PPK:</label>
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Religius', null, ['class' => 'nilai_ppk', 'disabled' => 'disabled']) !!} Religius
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Integritas', null, ['class' => 'nilai_ppk', 'disabled']) !!} Integritas
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Nasionalis', null, ['class' => 'nilai_ppk', 'disabled']) !!} Nasionalis
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Mandiri', null, ['class' => 'nilai_ppk', 'disabled']) !!} Mandiri
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Gotong Royong', null, ['class' => 'nilai_ppk', 'disabled']) !!} Gotong Royong
                    </div>
                    {{-- <div class="form-group">
                        {!! Form::label('dokumen' , "Data Dokumen Kegiatan:") !!}
                        <ol class="dokumen_kegiatan">

                        </ol>
                    </div> --}}
                    <div class="form-group">
                          {!! Form::label('kegiatan_berasis', 'Kegiatan Berbasis PPK:') !!}
                          {!! Form::select('kegiatan_berbasis', array('' => 'Choose Options', 'Berbasis Kelas' => 'Berbasis Kelas', 'Berbasis Budaya Sekolah' => 'Berbasis Budaya Sekolah', 'Berbasis Masyarakat' => 'Berbasis Masyarakat') ,null , ['class' => 'form-control kegiatan_berbasis_ppk', 'disabled'=>'disabled']) !!}
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                {!! Form::label('awal_kegiatan', 'Kegiatan Dimulai:') !!}
                                {!! Form::date('awal_kegiatan', null , ['class' => 'form-control awal_kegiatan' , 'disabled' => 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            {!! Form::label('akhir_kegiatan', 'Kegiatan Diakhiri:') !!}
                            {!! Form::date('akhir_kegiatan', null , ['class' => 'form-control akhir_dari_kegiatan' , 'disabled' => 'disabled']) !!}
                        </div>
                    </div>
                    <hr>
                    {!! Form::label('text_label_pengelolaan_dokumentasi' , 'Fungsi Pengelolaan Dokumentasi Kegiatan PPK') !!}
                    <div class="card shadow mb-4" id="show_kelola_dokumentasi">
                        
                        <a href="#collapseCardExample" class="d-block card-header py-3 border border-bottom-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                          <h6 class="m-0 font-weight-bold text-primary">Pengelolaan Dokumentasi Kegiatan PPK</h6>
                        </a>
                        
                        <div class="collapse show" id="collapseCardExample">
                          <div class="card-body">
                            {!! Form::label('label_data_pengajuan_dokumentasi' , 'Dokumen Yang Telah Diuggah Saat Fase Dokumentasi berstatus Unggah Dokumentasi') !!}
                            <br>
                            <b class="text-danger">*Jika Data Dokumen Hanya Satu, Maka Dokumen Tersebut Tidak Dapat Dihapus</b>
                            <br>
                            <ol class="kelola_dokumen_kegiatan">

                            </ol>
                            {!! Form::label('label_data_pengajuan_dokumentasi' , 'Dokumentasi Yang Baru Saja Diunggah(Dokumen Dapat Dihapus Sesuai Keinginan User):') !!}        
                            <ol class="kelola_dokumen_baru">

                            </ol>
                            <hr>
                            <ul class="error_notification_upload_baru" style="background-color: #e53e3e; color: white; border-radius: 10px;"></ul>                            
                            <button class="btn btn-success btn-sm rounded-pill float float-right mb-3" id="add_new_dokumentasi">Tambah Dokumen</button>                            
                                <form action="" method="POST" class="form-pengelolaan-kegiatan">
                                    {{ csrf_field() }}
                                    <label for="dokumentasi_baru" style="font-size: 1.25rem" class="font-weight-bolder">Dokumentasi Baru Yang Ingin diupload</label>
                                    <div class="col-sm-6 col-lg-6">
                                        <input type="file"  name="dokumen_dokumentasi_baru[]">
                                        <div class="show_added_dokumentasi"></div>
                                    </div>
                                    <div class="progress mb-3 mt-3" hidden>
                                        <div class="progress-bar progress-bar-striped progress-bar-animated myProgress" role="progressbar" style="width: 0%">0%</div>
                                    </div>
                                    <button type="submit" class="btn btn-primary submit_dokumentasi rounded-pill float float-left mb-3 mt-3">Submit Dokumen Baru</button>
                                </form>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
                  </div>
              </div>
            </div>
          </div>

          <div class="modal fade unggah_dokumentasi" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <form action="" method="POST" class="form_unggah" enctype="multipart/form-data" autocomplete="off">
                    {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Unggah Data Dokumentasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <ul class="error_notification" style="background-color: #e53e3e; color: white; border-radius: 10px">

                    </ul>
                    {{-- <div class="form-group">
                        <ul class="waktu_status_unggah" style="color:white; border-radius: 10px;">

                        </ul>
                    </div> --}}
                    
                    <div class="form-group">
                        {!! Form::label('nama_kegiatan', 'Nama Kegiatan:') !!}
                        {!! Form::text('nama_kegiatan', null , ['class' => 'form-control nama_kegiatan' , 'disabled']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('nilai_ppk' , 'Nilai PPK:') !!}
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Religius', null, ['class' => 'value_nilai_ppk' , 'disabled']) !!} Religius
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Integritas', null, ['class' => 'value_nilai_ppk', 'disabled']) !!} Integritas
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Nasionalis', null, ['class' => 'value_nilai_ppk', 'disabled']) !!} Nasionalis
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
                          <div class="col-sm-12 col-lg-6">
                              {!! Form::label('lihat-file', "Unggah Dokumentasi Kegiatan (ekstensi .pdf dan total seluruh file sebesar 5MB): ") !!}
                              <br>
                              <button class="btn btn-success btn-sm mb-2 add" type="button" id="add">Add More</button>
                              <br>
                              {!! Form::file('dokumentasi_kegiatan_ppk[]') !!}
                              <div class="form-group doc-file" id="doc-file">
                              </div>
                          </div>
                      </div>
                          <div class="row">
                              <div class="col-sm-12 col-lg-6">
                                  <div class="form-group">
                                      {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                                      {!! Form::date('mulai_kegiatan', null , ['class' => 'form-control mulai_kegiatan' , 'disabled']) !!}    
                                  </div>
                              </div>
                              <div class="col-sm-12 col-lg-6">
                                  <div class="form-group">
                                      {!! Form::label('akhir_kegiatan', 'Akhir dari Kegiatan:') !!}
                                      {!! Form::date('akhir_kegiatan', null , ['class' => 'form-control akhir_kegiatan' , 'disabled']) !!}
                                  </div>
                              </div>
                        </div>
                        <div class="progress" hidden>
                            <div class="progress-bar progress-bar-striped progress-bar-animated myProgress" role="progressbar" style="width: 0%">0%</div>
                        </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit_dokumentasi">Unggah Dokumentasi</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
          
          <div class="modal fade" id="unggah_dokumentasi_baru" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data" class="unggah_form_dokumentasi" autocomplete="off">
                    {{ csrf_field() }}
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Unggah Dokumentasi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <ul class="error_notification" style="background-color: #e53e3e; color: white; border-radius: 10px;"></ul>
                    <div class="form-group">
                        {!! Form::label('nama_kegiatan', 'Nama Kegiatan:') !!}
                        {!! Form::text('nama_kegiatan', null , ['class' => 'form-control']) !!}
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('nilai_ppk' , 'Nilai PPK:') !!}
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Religius', null) !!} Religius
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Integritas', null) !!} Integritas
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Nasionalis', null) !!} Nasionalis
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Mandiri', null) !!} Mandiri
                        <br>
                        {!! Form::checkbox('nilai_ppk[]', 'Gotong Royong', null) !!} Gotong Royong
                      </div>
                      <div class="form-group">
                          {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis PPK:') !!}
                          {!! Form::select('kegiatan_berbasis', array('' => 'Choose Options', 'Berbasis Kelas' => 'Berbasis Kelas', 'Berbasis Budaya Sekolah' => 'Berbasis Budaya Sekolah', 'Berbasis Masyarakat' => 'Berbasis Masyarakat') ,null , ['class' => 'form-control kegiatan_berbasis' ]) !!}
                      </div>
                      <div class="row">
                          <div class="col-sm-12 col-lg-6">
                              {!! Form::label('lihat-file', "Unggah Dokumentasi Kegiatan (ekstensi .pdf dan total seluruh file sebesar 5MB): ") !!}
                              <br>
                              <button class="btn btn-success btn-sm mb-2 add" type="button" id="add">Add More</button>
                              <br>
                              {!! Form::file('dokumentasi_kegiatan_ppk[]') !!}
                              <div class="form-group doc-file" id="doc-file">
                              </div>
                          </div>
                      </div>
                          <div class="row">
                              <div class="col-sm-12 col-lg-6">
                                  <div class="form-group">
                                      {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                                      {!! Form::date('mulai_kegiatan', null , ['class' => 'form-control']) !!}    
                                  </div>
                              </div>
                              <div class="col-sm-12 col-lg-6">
                                  <div class="form-group">
                                      {!! Form::label('akhir_kegiatan', 'Akhir dari Kegiatan:') !!}
                                      {!! Form::date('akhir_kegiatan', null , ['class' => 'form-control']) !!}
                                  </div>
                              </div>
                        </div>
                        <div class="progress" hidden>
                            <div class="progress-bar progress-bar-striped progress-bar-animated myProgress" role="progressbar" style="width: 0%">0%</div>
                        </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit_dokumentasi">Unggah Dokumentasi</button>
                  </div>
                </div>
            </form>
              </div>
            </div>
          </div>
          
          <div class="modal modal_edit" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <form action="" method="post" class="edited-dokumen-form" enctype="multipart/form-data">
                @csrf
                {{-- @method("PUT") --}}
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    {!! Form::label('edit_dokumen_dokumentasi' , "Dokumen Dokumentasi Kegiatan Yang Ingin Diganti:" , ['class' => 'font-weight-bolder' , 'style' => 'font-size: 1.25rem']) !!}
                    <div class="show_dokumen_edit"></div>
                    <hr>
                    <ul class="error_notification_upload_edit" style="background-color: #e53e3e; color: white; border-radius: 10px;"></ul>                            
                        <div class="form-group">
                            {!! Form::label('Unggah Dokumen Pengganti(Berekstensi .pdf dan Ukuran File Tidak Lebih Dari 5MB)') !!}
                            <input type="file" name="edited_dokumen">
                        </div>
                        <div class="progress" hidden>
                            <div class="progress-bar progress-bar-striped progress-bar-animated myProgress" role="progressbar" style="width: 0%">0%</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Kembali ke Data Dokumentasi</button>
                            <button type="submit" class="btn btn-warning submit_dokumentasi">Unggah Dokumen Baru</button>
                        </div> 
                    </div>
                </form>
              </div>
            </div>
          </div> 

          <div class="modal modal_delete" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <form action="" class="delete-dokumen-dokumentasi" method="post">
                      @csrf
                      @method("DELETE")
                  
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Apakah Anda Ingin Menghapus Dokumen Ini?</p>
                  <div class="show_dokumen_delete">

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Kembali ke Data Dokumentasi</button>
                  <button type="submit" class="btn btn-danger submit_dokumentasi">Hapus Dokumen Ini</button>
                </div>
            </form>
              </div>
            </div>
          </div> 

    </div>
@endsection

@section('script')
    <script>
        var doc_row = 1;
        var doc_added_dokumentasi_baru = 1;
        var value_checked  = [];
        var kegiatan_berbasis = "";
        var modalState = "";
        var id = "";
        $(".form_unggah")[0].reset();
        $(".form-pengelolaan-kegiatan")[0].reset();
        const modalStartLihatDokumentasi = ".lihat_dokumentasi";
        $("#dokumentasi_kegiatan").DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("pj.dokumentasi_kegiatan.index")}}',
            columns: [
                {data: 'id', name:'id'},
                {data: 'nama_kegiatan', name:'nama_kegiatan'},
                {data: 'nilai_ppk', name:'nilai_ppk'},
                {data: 'kegiatan_berbasis', name: 'kegiatan_berbasis'},
                {data: 'updated_at' , name: 'updated_at'},
                {data: 'statusKegiatan', name: 'statusKegiatan.nama' , orderable: false},
                {data: 'unggah_dokumentasi' , name: 'unggah_dokumentasi', orderable: false}
            ],
            order: [[4, "desc"]]
        });

        // Click Functions

        $(document).on('click', '.status_pengajuan', function(){
            var btn_value = $(this).val();
            id = $(this).attr('id');
            if(btn_value === "sudah_unggah"){
                //show modal
                getDataDokumentasiModal(id);
            }
            else if(btn_value === "unggah_dokumentasi"){
                //show unggah modal
                let id_unggah_dokumentasi = $(this).attr('id');
                // let dateAkhir = $(this).attr('data-target');
                // let dateNow = $(this).attr('data-target2');
                var url = '{{route("pj.dokumentasi_kegiatan.upload" , "id")}}';
                url = url.replace("id", id_unggah_dokumentasi);
                $(".form_unggah").attr('action', url);
                var get_data = '{{route("pj.dokumentasi_kegiatan.edit", "id_edit")}}';
                get_data = get_data.replace('id_edit' , id_unggah_dokumentasi);
                loadingBar('show');
                $.get(get_data, function(res){
                    $(".unggah_dokumentasi").modal();
                    $(".nama_kegiatan").val(res.data_dokumentasi.nama_kegiatan);
                    $(".mulai_kegiatan").val(res.data_dokumentasi.mulai_kegiatan);
                    $(".akhir_kegiatan").val(res.data_dokumentasi.akhir_kegiatan);
                    $.each(res.nilai_ppk_kegiatan, function(key,value){
                        value_checked.push(value.nilai_ppk);
                        $('[value = "'+value.nilai_ppk+'"]').prop('checked', true);  
                    });
                    kegiatan_berbasis = res.data_dokumentasi.kegiatan_berbasis;
                    $(".kegiatan_berbasis").find('[value = "'+res.data_dokumentasi.kegiatan_berbasis+'"]').prop('selected', true);
                    modalState = ".unggah_dokumentasi";
                    // if (dateNow >= dateAkhir) {
                    //     $(".submit_dokumentasi").prop('disabled' , false);
                    //     $(".waktu_status_unggah").append('<li>Dokumentasi Kegiatan Dapat Diunggah!</li>');
                    //     $(".waktu_status_unggah").css({
                    //         "background-color": "#17a2b8"
                    //     });
                    // } else if(dateNow < dateAkhir){
                    //     let dateDifference = $(".status_pengajuan").attr('data-target3');
                    //     $(".submit_dokumentasi").prop('disabled' , true);
                    //     $(".waktu_status_unggah").append('<li>Waktu untuk Mengunggah Dokumentasi: '+dateDifference+' hari</li>');
                    //     $(".waktu_status_unggah").css({
                    //         "background-color": "#e53e3e"
                    //     });
                    // }
                }).done(function(){
                    loadingBar('hide');
                }).fail(function(error){
                    if (error.status === 401) {
                        let loginInfo = JSON.parse(error.responseText);
                        alertNotificationsForLoginAndErrors(error.status, loginInfo.message);
                    } else if(error.status === 404) {
                        let error_info = JSON.parse(error.responseText);
                        alertNotificationsForLoginAndErrors(error.status, error_info.messages);
                    } else {
                        anyErrors(error.status, error.statusText , error);
                    }
                });
            }
        });
        
        $("#unggah_baru").click(function(){
            let url = '{{route("pj.dokumentasi_kegiatan.upload_baru")}}';
            $(".unggah_form_dokumentasi").attr('action', url);
            modalState = "#unggah_dokumentasi_baru";
            $("#unggah_dokumentasi_baru").modal();
        });
        document.getElementById('add_new_dokumentasi').addEventListener('click', function(){
            doc_added_dokumentasi_baru++;
            $(".show_added_dokumentasi").append('<input type="file" name="dokumen_dokumentasi_baru[]" id="row_doc_baru'+doc_added_dokumentasi_baru+'" placeholder="Enter your Name" /><button type="button" name="remove" id="'+doc_added_dokumentasi_baru+'" class="btn btn-danger btn_remove_doc_baru mb-2">X</button>')
        });

        $(document).on('click', '.lihat_file', function(){
            let asset_val = $(this).val();  
            window.open(asset_val);
        });

        $(document).on('click' , '.edit_file' , function(){
            $(".modal_edit").modal();
            $(modalState).modal('hide');
            let fileAsset = $(this).attr('value');
            let fileName = $(this).attr('data-target');
            let fileStatus = $(this).attr('data-target2');
            let fileID = $(this).attr('data-target3');
            document.querySelector('.show_dokumen_edit').innerHTML = "<i class='fa fa-file-alt mr-2'></i>"+fileName+"<button class='btn btn-primary btn-sm lihat_file ml-2 mr-2 mb-2' value='"+fileAsset+"'>Lihat File</button><a href='"+fileAsset+"'class='btn btn-info btn-sm lihat_file ml-2 mr-2 mb-2' download='"+fileName+"'>Unduh Dokumen</a></li>";
            let url_edit_file = '{{route("pj.dokumentasi_kegiatan.editDokumenDokumentasi", ["status_dokumen" => "status_docs" , "id" => "ids" , "id_dokumen" => "id_docs"])}}';
            url_edit_file = url_edit_file.replace('status_docs' , fileStatus);
            url_edit_file = url_edit_file.replace('ids' , id);
            url_edit_file = url_edit_file.replace('id_docs' , fileID);
            $(".edited-dokumen-form").attr('action' , url_edit_file);
        });


        $(document).on('click' , '.delete_dokumen', function(){
            $(".modal_delete").modal();
            $(modalState).modal('hide');
            modalState = ".modal_delete";
            //add file name serta link asset
            let fileAsset = $(this).attr('value');
            let fileName = $(this).attr('data-target');
            let fileStatus = $(this).attr('data-target2');
            let fileID = $(this).attr('data-target3');
            document.querySelector('.show_dokumen_delete').innerHTML = "<i class='fa fa-file-alt mr-2'></i>"+fileName+"<button class='btn btn-primary btn-sm lihat_file ml-2 mr-2 mb-2' value='"+fileAsset+"'>Lihat File</button><a href='"+fileAsset+"'class='btn btn-info btn-sm lihat_file ml-2 mr-2 mb-2' download='"+fileName+"'>Unduh Dokumen</a></li>";
            //add form action
            //{status_dokumen}/{id}/{id_dokumen}
            let url_delete_form = "{{route('pj.dokumentasi_kegiatan.deleteDokumenDokumentasi' , ['status_dokumen' => 'status' , 'id' => 'id_dokumentasi' , 'id_dokumen' => 'id_docs'])}}";
            url_delete_form = url_delete_form.replace('status' , fileStatus);
            url_delete_form = url_delete_form.replace('id_dokumentasi' , id);
            url_delete_form = url_delete_form.replace('id_docs' , fileID);
            let url_form = $('.delete-dokumen-dokumentasi').attr('action' , url_delete_form);
        });

        $(".add").click(function(){
            doc_row++;
            $(".doc-file").append('<input type="file" name="dokumentasi_kegiatan_ppk[]" id="row'+doc_row+'" placeholder="Enter your Name" /><button type="button" name="remove" id="'+doc_row+'" class="btn btn-danger btn_remove mb-2">X</button>');  
        });  

        $(document).on('click', '.btn_remove', function(){  
            let button_id = $(this).attr("id");          
            $(this).remove();

            //karena modal mempunyai class add dan remove yang sama
            $("#row"+button_id).remove();
            $("#row"+button_id).remove();
        });  
        
        $(document).on('click', '.btn_remove_doc_baru', function(){
            let button_remove_doc_baru_id = $(this).attr("id");
            $(this).remove();
            $("#row_doc_baru"+button_remove_doc_baru_id+"").remove();
        });

        // Hidden bootstrap Modals

        $(".modal_edit").on('hidden.bs.modal', function(){
            //add get request
            getDataDokumentasiModal(id);
        });

        $(".modal_delete").on('hidden.bs.modal', function(){
            getDataDokumentasiModal(id);
        });

        $("#unggah_dokumentasi_baru").on('hidden.bs.modal', function(){
            $(".unggah_form_dokumentasi")[0].reset();
            $(".error_notification").empty();
            $(".doc-file").empty();
            modalState = "";
        });

        $(".unggah_dokumentasi").on('hidden.bs.modal', function(){
            //remove chekced value
            $(".error_notification").empty();
            // $(".nama_kegiatan").removeAttr('disabled');
            $(".nama_kegiatan").val('');
            // $(".mulai_kegiatan").removeAttr('disabled');
            $(".mulai_kegiatan").val('');
            $(".akhir_kegiatan").val('');
            // $(".akhir_kegiatan").removeAttr('disabled');
            if (kegiatan_berbasis) {
                $(".kegiatan_berbasis").find('[value = "'+kegiatan_berbasis+'"]').prop('selected', false);
                // $(".kegiatan_berbasis").removeAttr('disabled');
            // } else {
            //     $(".kegiatan_berbasis").find('[value = ""]').prop('selected', true);
            }
            if (value_checked.length > 0) {
                    for (let index = 0; index < value_checked.length; index++) {
                    const element = value_checked[index];
                    $("[value = '"+element+"']").prop('checked', false);
                }   
            }
            // else{
            // $(".value_nilai_ppk").each(function(){
            //         var isChecked = $(this).is(":checked");
            //         if (isChecked) {
            //             $(this).prop('checked', false);
            //         }
            //     });
            // }
            $(".form_unggah")[0].reset();
            // $(".value_nilai_ppk").removeAttr('disabled');
            kegiatan_berbasis = "";
            value_checked.length = 0 ;
            doc_row = 1;
            modalState = "";
            $(".doc-file").empty();
            $(".waktu_status_unggah").empty();
        });

        // $(".unggah_dokumentasi_baru").on('hidden.bs.modal' , function(){
        //     $(".form_unggah_baru")[0].reset();
        // });

        $(".lihat_dokumentasi").on('hidden.bs.modal', function(){
            $(".nama_kegiatan_terlaksana").removeAttr('value');
            $(".awal_kegiatan").removeAttr('value');
            $(".akhir_dari_kegiatan").removeAttr('value');
            $(".kegiatan_berbasis_ppk").find('[value = "'+kegiatan_berbasis+'"]').prop('selected', false);
            for (let index = 0; index < value_checked.length; index++) {
                const element = value_checked[index];
                $("[value = '"+element+"']").prop('checked', false);
            }
            // $(".nilai_ppk").prop('checked', false);
            // $(".dokumen_kegiatan").empty();
            $(".status_dokumentasi").empty();
            $(".show_added_dokumentasi").empty();
            $(".form-pengelolaan-kegiatan")[0].reset();
            $(".error_notification_upload_baru").empty();
            value_checked.length = 0;
            kegiatan_berbasis = "";
            doc_added_dokumentasi_baru = 1;
            modalState = "";
        });

        //Form Functions

        $('form').on('submit', function(e){
            e.preventDefault();
            var form_submit = $(this).attr('action');
            let class_form = $(this).attr('class');
            var data_form = new FormData($(this)[0]);
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $("[name= '_token']").val()
                }
            });
            if (class_form === "form-pengelolaan-kegiatan") {
                $.ajax({
                    url: form_submit,
                    type: 'POST',
                    data: data_form,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        progressBarState("show", modalState);
                        console.log(modalState);
                    },
                    xhr: function(){
                    let xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(event){
                        if (event.lengthComputable) {
                            var percentageComplete = event.loaded / event.total;
                            percentageComplete = parseInt(percentageComplete * 100);
                            $(".myProgress").text(percentageComplete+'%');
                            $(".myProgress").css('width', percentageComplete+'%');
                        }
                    }, false);
                        return xhr;
                    },
                    success: function(res){
                        progressBarState("reset");
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false
                        }).then((result) => {
                            $(modalState).modal('hide');
                        });
                        $("#dokumentasi_kegiatan").DataTable().ajax.reload();
                    },
                    error: function(res){
                        progressBarState("reset" , modalState);
                        //error_notification_upload_baru
                        if (res.status === 401) {
                        let loginInfo = JSON.parse(res.responseText);
                        alertNotificationsForLoginAndErrors(res.status , loginInfo.message);
                    } else if(res.status === 422) {
                        let value_error = JSON.parse(res.responseText);
                        $(".error_notification_upload_baru").append('<h5>Error Pengisian Form:</h5>');
                        $.each(value_error.errors, function(key, value){
                            $(".error_notification_upload_baru").append('<li>'+value+'</li>');
                        });                       
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terdapat Error ketika melakukan unggah Dokumentasi, Silahkan Lihat Error diatas Form'
                        }).then((result) => {
                            if (result.value) {
                                document.querySelector('.error_notification_upload_baru').scrollIntoView(true);
                            }
                        });
                    } else if(res.status === 404){
                        let error_info = JSON.parse(res.responseText);
                        alertNotificationsForLoginAndErrors(res.status , error_info.messages);
                    } else {
                        anyErrors(res.status , res.statusText , res);
                    }
                    }
                });
            } else if(class_form === "edited-dokumen-form"){
                $.ajax({
                url: form_submit,
                type: 'POST',
                data: data_form,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    progressBarState("show" , modalState);
                },
                xhr: function(){
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(event){
                        if (event.lengthComputable) {
                            var percentageComplete = event.loaded / event.total;
                            percentageComplete = parseInt(percentageComplete * 100);
                            $(".myProgress").text(percentageComplete+'%');
                            $(".myProgress").css('width', percentageComplete+'%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(res){
                    progressBarState("reset");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: res.notification
                    }).then((result)=> {
                        $(".modal_edit").modal('hide');
                    });
                    $("#dokumentasi_kegiatan").DataTable().ajax.reload();
                },
                error: function(res){
                    progressBarState("reset" , modalState);
                    if (res.status === 401) {
                        let loginInfo = JSON.parse(res.responseText);
                        alertNotificationsForLoginAndErrors(res.status , loginInfo.message);
                    } else if(res.status === 422) {
                        let value_error = JSON.parse(res.responseText);
                        $(".error_notification_upload_edit").append('<h5>Error Pengisian Form:</h5>');
                        $.each(value_error.errors, function(key, value){
                            $(".error_notification_upload_edit").append('<li>'+value+'</li>');
                        });                       
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terdapat Error ketika melakukan unggah Dokumentasi, Silahkan Lihat Error diatas Form'
                            }).then((result) => {
                                if (result.value) {
                                    document.querySelector('.error_notification_upload_edit').scrollIntoView(true);
                                }
                            });
                        } else if(res.status === 404){
                            let error_info = JSON.parse(res.responseText);
                            alertNotificationsForLoginAndErrors(res.status , error_info.messages);
                        } else {
                            anyErrors(res.status , res.statusText , res);
                        }
                    }   
                });       
            } else {
            $.ajax({
                url: form_submit,
                type: 'POST',
                data: data_form,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    progressBarState("show" , modalState);
                },
                xhr: function(){
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(event){
                        if (event.lengthComputable) {
                            var percentageComplete = event.loaded / event.total;
                            percentageComplete = parseInt(percentageComplete * 100);
                            $(".myProgress").text(percentageComplete+'%');
                            $(".myProgress").css('width', percentageComplete+'%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(res){
                    progressBarState("reset");
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: res.notification
                    }).then((result)=> {
                        $(modalState).modal('hide');
                    });
                    $("#dokumentasi_kegiatan").DataTable().ajax.reload();
                },
                error: function(res){
                    progressBarState("reset" , modalState);
                    if (res.status === 401) {
                        let loginInfo = JSON.parse(res.responseText);
                        alertNotificationsForLoginAndErrors(res.status , loginInfo.message);
                    } else if(res.status === 422) {
                        let value_error = JSON.parse(res.responseText);
                        $(".error_notification").append('<h5>Error Pengisian Form:</h5>');
                        $.each(value_error.errors, function(key, value){
                            $(".error_notification").append('<li>'+value+'</li>');
                        });                       
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terdapat Error ketika melakukan unggah Dokumentasi, Silahkan Lihat Error diatas Form'
                        }).then((result) => {
                            if (result.value) {
                                $(modalState).scrollTop(0);
                            }
                        });
                    } else if(res.status === 404){
                        let error_info = JSON.parse(res.responseText);
                        alertNotificationsForLoginAndErrors(res.status , error_info.messages);
                    } else {
                        anyErrors(res.status , res.statusText , res);
                    }
                }   
            });       
            } 
        });

        //Other Functions

        function progressBarState(condition , valueModal){
            if (condition === 'reset') {
                $(".submit_dokumentasi").attr('disabled', false);
                $(".close_btn").attr('disabled', false);
                $(".progress").attr('hidden', true);
                $(".myProgress").text('0%');
                $(".myProgress").css('width' , '0%');
                $(".close").attr('disabled', false);
                // $(".submit_dokumen_baru").attr('disabled' , false);
                // $(".submit_edit_dokumen").attr('disabled' , false);
                // $(valueModal).attr('data-keyboard' , true);
                // $(valueModal).attr('data-backdrop' , '');
            }
            else if(condition === 'show'){
                $(".submit_dokumentasi").attr('disabled', true);
                $(".close_btn").attr('disabled', true);
                $(".progress").attr('hidden', false);
                $(".myProgress").text('0%');
                $(".myProgress").css('width' , '0%');
                $(".error_notification").empty();
                $(".error_notification_upload_edit").empty();
                $(".error_notification_upload_baru").empty();
                $(".close").attr('disabled', true);
                // $(".submit_dokumen_baru").attr('disabled' , true);
                // $(".submit_edit_dokumen").attr('disabled' , true);
                // $(valueModal).attr('data-keyboard' , false);
                // $(valueModal).attr('data-backdrop' , 'static');
            }
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
            } else if(condition === 'hide'){
                Swal.close();
            }
        }

        function alertNotificationsForLoginAndErrors(status_code, info){
            if (status_code === 401) {
                Swal.fire({
                    icon: 'info',
                    title: 'Please Login',
                    text: info
                }).then((result)=> {
                    window.location = '/';
                });
            }
            else if(status_code === 404){
                Swal.fire({
                    icon: 'error',
                    title: 'Terdapat Error',
                    text: info
                });
            }
        }

        function anyErrors(status, statusText , errors){
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

        function getDataDokumentasiModal(id){
            //add get request
            
            // $(".dokumen_kegiatan").empty();
            $(".kelola_dokumen_kegiatan").empty();
            $(".kelola_dokumen_baru").empty();
            let url = '{{route("pj.dokumentasi_kegiatan.show", ["dokumentasi_kegiatan" => "ids"])}}';
            let url_dokumen_upload_baru = '{{route("pj.dokumentasi_kegiatan.uploadDokumenBaru", ["id_dokumentasi" => "id_doc_baru"])}}'
            let dokumen_asset = '{{asset("kegiatan/dokumentasi_kegiatan/nama_dokumen")}}';
            url = url.replace("ids", id);
            url_dokumen_upload_baru = url_dokumen_upload_baru.replace('id_doc_baru' , id);
            loadingBar('show');
            $.get(url, function(res){         
                $(".form-pengelolaan-kegiatan").attr('action' , url_dokumen_upload_baru);
                $(".lihat_dokumentasi").modal();
                    $(".nama_kegiatan_terlaksana").attr('value', res.dokumentasi_kegiatan.nama_kegiatan);
                    $(".awal_kegiatan").attr('value', res.dokumentasi_kegiatan.mulai_kegiatan);
                    $(".akhir_dari_kegiatan").attr('value', res.dokumentasi_kegiatan.akhir_kegiatan);
                    $.each(res.nilai_ppk_kegiatan, function(key,value){
                           value_checked.push(value.nilai_ppk);
                           $("[value='"+value.nilai_ppk+"']").prop('checked', true);
                    });
                    kegiatan_berbasis = res.dokumentasi_kegiatan.kegiatan_berbasis;
                    $(".kegiatan_berbasis_ppk").find('[value = "'+res.dokumentasi_kegiatan.kegiatan_berbasis+'"]').prop('selected', true);   
                    if (res.status == 6) {
                        //sukses
                        $(".status_dokumentasi").css({
                            "background-color": "#36b9cc",
                            "color": "white",
                            "border-radius": "10px",
                            "padding-bottom": "3rem",
                            "font-weight": 'bold',
                        });
                        $(".status_dokumentasi").append('<li>Dokumen Sudah Diunggah!</li>');
                    }
                    // Dokumen untuk lihat
                    
                    if (res.dokumen.length > 1) {
                        $.each(res.dokumen, function(key,item){            
                            dokumen_asset = dokumen_asset.replace('nama_dokumen', item.nama_dokumen);
                            // $(".dokumen_kegiatan").append("<li><i class='fa fa-file-alt mr-2'></i>"+item.nama_dokumen+"<button class='btn btn-primary btn-sm lihat_file ml-2 mr-2 mb-2' value='"+dokumen_asset+"'>Lihat File</button><a href='"+dokumen_asset+"'class='btn btn-info btn-sm lihat_file ml-2 mr-2 mb-2' download='"+item.nama_dokumen+"'>Unduh Dokumen</a></li>");                        
                            $(".kelola_dokumen_kegiatan").append("<li><i class='fa fa-file-alt mr-2'></i>"+item.nama_dokumen+"<button class='btn btn-primary btn-sm lihat_file ml-2 mr-2 mb-2' value='"+dokumen_asset+"'>Lihat File</button><a href='"+dokumen_asset+"'class='btn btn-info btn-sm lihat_file ml-2 mr-2 mb-2' download='"+item.nama_dokumen+"'>Unduh Dokumen</a><button class='btn btn-warning btn-sm edit_file ml-2 mr-2 mb-2' value='"+dokumen_asset+"' data-target='"+item.nama_dokumen+"' data-target2='"+item.status_unggah_dokumen+"' data-target3='"+item.id+"'>Edit File</button><button type='button' class='btn btn-danger btn-sm delete_dokumen ml-2 mr-2 mb-2' value='"+dokumen_asset+"' data-target='"+item.nama_dokumen+"' data-target2='"+item.status_unggah_dokumen+"' data-target3='"+item.id+"'>Delete Dokumen</button></li>");                        
                        });
                    } else {
                        $.each(res.dokumen, function(key,item){            
                            dokumen_asset = dokumen_asset.replace('nama_dokumen', item.nama_dokumen);
                            // $(".dokumen_kegiatan").append("<li><i class='fa fa-file-alt mr-2'></i>"+item.nama_dokumen+"<button class='btn btn-primary btn-sm lihat_file ml-2 mr-2 mb-2' value='"+dokumen_asset+"'>Lihat File</button><a href='"+dokumen_asset+"'class='btn btn-info btn-sm lihat_file ml-2 mr-2 mb-2' download='"+item.nama_dokumen+"'>Unduh Dokumen</a></li>");                        
                            $(".kelola_dokumen_kegiatan").append("<li><i class='fa fa-file-alt mr-2'></i>"+item.nama_dokumen+"<button class='btn btn-primary btn-sm lihat_file ml-2 mr-2 mb-2' value='"+dokumen_asset+"'>Lihat File</button><a href='"+dokumen_asset+"'class='btn btn-info btn-sm lihat_file ml-2 mr-2 mb-2' download='"+item.nama_dokumen+"'>Unduh Dokumen</a><button class='btn btn-warning btn-sm edit_file ml-2 mr-2 mb-2' value='"+dokumen_asset+"'data-target='"+item.nama_dokumen+"'data-target2='"+item.status_unggah_dokumen+"' data-target3='"+item.id+"'>Edit File</button></li>");                        
                        });
                    }
                    if (res.dokumentasi_baru.length !== 0) {
                        $.each(res.dokumentasi_baru , function(key,item){
                            $(".kelola_dokumen_baru").append("<li><i class='fa fa-file-alt mr-2'></i>"+item.nama_dokumen+"<button class='btn btn-primary btn-sm lihat_file ml-2 mr-2 mb-2' value='"+dokumen_asset+"'>Lihat File</button><a href='"+dokumen_asset+"'class='btn btn-info btn-sm lihat_file ml-2 mr-2 mb-2' download='"+item.nama_dokumen+"'>Unduh Dokumen</a><button class='btn btn-warning btn-sm edit_file ml-2 mr-2 mb-2' value='"+dokumen_asset+"' data-target='"+item.nama_dokumen+"' data-target2='"+item.status_unggah_dokumen+"' data-target3='"+item.id+"'>Edit File</button><button type='button' class='btn btn-danger btn-sm delete_dokumen ml-2 mr-2 mb-2' value='"+dokumen_asset+"' data-target='"+item.nama_dokumen+"' data-target2='"+item.status_unggah_dokumen+"' data-target3='"+item.id+"'>Delete Dokumen</button></li>");                        
                        });
                    } else {
                        $(".kelola_dokumen_baru").append('<li>Tidak Ada Dokumen Kegiatan Baru Yang Diunggah</li>');
                    }
                    modalState = modalStartLihatDokumentasi;
            }).done(function(){
                loadingBar('hide');
            }).fail(function(failResponse){
                loadingBar('hide');
                if (failResponse.status === 401) {
                    let loginInfo = JSON.parse(failResponse.responseText);
                    alertNotificationsForLoginAndErrors(failResponse.status, loginInfo.message);
                } else if(failResponse.status === 404) {
                    let error_info = JSON.parse(failResponse.responseText);
                    alertNotificationsForLoginAndErrors(failResponse.status, error_info.messages);
                } else {
                    anyErrors(failResponse.status, failResponse.statusText , failResponse);
                }
            });
        }
    </script>
@endsection