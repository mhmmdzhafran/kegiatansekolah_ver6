@extends('layouts.template_PJ')

@section('title')
    Penanggung Jawab - Kelola Kegiatan PPK
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <h1>Kelola Proposal Kegiatan PPK</h1>
            {{ csrf_field() }}
        </div>
        <div class="col-sm-12 col-lg-4">
            <button type="button" class="btn btn-primary rounded-pill float-md-left float-lg-right float-sm-left create_proposal">Lakukan Pengajuan Proposal</button>
        </div>
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="pengajuan-table">
                            <thead>
                                <tr>
                                    <th>ID Kegiatan</th>
                                    <th width="20%">Nama Kegiatan</th>
                                    <th>Nilai PPK</th>   
                                    <th>Kegiatan Berbasis</th>                               
                                    <th>Timestamp Proposal</th>
                                    <th width="20%">Status Proposal Kegiatan</th>  
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal -->
     <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModal" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="showModalTitle">Lihat Proposal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('status_kegiatan_ini' , 'Status Proposal Kegiatan: ') !!}
                    <ul class="status-proposal"></ul>
                </div>
                <div class="form-group card bg-info text-white font-weight-bolder">
                    {!! Form::label('keterangan_kegiatan_ini' , 'Histori Keterangan Proposal Kegiatan: ') !!}
                        <ul class="keterangan-show">
                    </ul>
                </div>
                <hr>
                <div class="form-group">
                    {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
                    <input type="text" name="PJ_nama_kegiatan" id="PJ_nama_kegiatan" value="" class="form-control" disabled>
                </div>
            
                <div class="form-group">
                    {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
                    <br>
                    {!! Form::checkbox('nilai_ppk[]', 'Religius', null, ['class' => 'nilai_ppk' , 'disabled']) !!} Religius
                    <br>
                    {!! Form::checkbox('nilai_ppk[]', 'Integritas', null, ['class' => 'nilai_ppk' , 'disabled']) !!} Integritas
                    <br>
                    {!! Form::checkbox('nilai_ppk[]', 'Nasionalis', null, ['class' => 'nilai_ppk' , 'disabled']) !!} Nasionalis
                    <br>
                    {!! Form::checkbox('nilai_ppk[]', 'Mandiri', null, ['class' => 'nilai_ppk' , 'disabled']) !!} Mandiri
                    <br>
                    {!! Form::checkbox('nilai_ppk[]', 'Gotong Royong', null, ['class' => 'nilai_ppk' , 'disabled']) !!} Gotong Royong
                </div>
            
                <div class="form-group">
                    {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
                    <select class="form-control kegiatan_berbasis" disabled>
                        <option value="not_found" disabled>N/A</option>
                        <option value="Berbasis Kelas" disabled>Berbasis Kelas</option>
                        <option value="Berbasis Budaya Sekolah" disabled>Berbasis Budaya Sekolah</option>
                        <option value="Berbasis Masyarakat" disabled>Berbasis Masyarakat</option>
                      </select>
                </div>
                {!! Form::label('dokumen_kegiatan', 'Unggah Proposal Pengajuan Kegiatan: ') !!}
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group" id="upload-file"></div>
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
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

   <!-- Modal -->
   <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="" id="createPengajuanForm" method="post" enctype="multipart/form-data" autocomplete="off">
            {{ method_field('POST') }}
        <div class="modal-header">
            <h5 class="modal-title" id="createModalTitle">Pengajuan Proposal Kegiatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <ul class="error_notification" style="background-color: #e53e3e; color: white; border-radius: 10px">

            </ul>
            <div class="form-group">
              {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
              {!! Form::text('PJ_nama_kegiatan', null , ['class' => 'form-control']) !!}
          </div>
      
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nilai PPK:</label>
            <br>
            {!! Form::checkbox('nilai_ppk[]', 'Religius', null, ['class' => 'value_nilai_ppk']) !!} Religius
            <br>
            {!! Form::checkbox('nilai_ppk[]', 'Integritas', null, ['class' => 'value_nilai_ppk']) !!} Integritas
            <br>
            {!! Form::checkbox('nilai_ppk[]', 'Nasionalis', null, ['class' => 'value_nilai_ppk']) !!} Nasionalis
            <br>
            {!! Form::checkbox('nilai_ppk[]', 'Mandiri', null, ['class' => 'value_nilai_ppk']) !!} Mandiri
            <br>
            {!! Form::checkbox('nilai_ppk[]', 'Gotong Royong', null, ['class' => 'value_nilai_ppk']) !!} Gotong Royong
        </div>
      
          <div class="form-group">
              {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
              {!! Form::select('kegiatan_berbasis', array('' => 'Choose Options', 'Berbasis Kelas' => 'Berbasis Kelas', 'Berbasis Budaya Sekolah' => 'Berbasis Budaya Sekolah', 'Berbasis Masyarakat' => 'Berbasis Masyarakat') ,null , ['class' => 'form-control']) !!}
          </div>
          {!! Form::label('dokumen_kegiatan', 'Unggah Proposal Pengajuan Kegiatan (ekstensi .pdf dan total file sebesar 5MB): ') !!}
          <div class="row">
              <div class="col-sm-12 col-lg-12">
                  <div class="form-group" id="upload-file">
                      {!! Form::file('dokumen_kegiatan') !!}
                  </div>
              </div>
          </div>
          <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                    {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                    {!! Form::date('mulai_kegiatan', \Carbon\Carbon::now() , ['class' => 'form-control']) !!}    
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="form-group">
                    {!! Form::label('akhir_kegiatan', 'Akhir Melaksanakan Kegiatan:') !!}
                    {!! Form::date('akhir_kegiatan', \Carbon\Carbon::tomorrow() , ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="progress" hidden>
            <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%">0%</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_proposal" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary new_proposal">Kirim Proposal</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>


<!-- Modal -->
@include('pj/kelola_kegiatan/form_pengajuan_ulang')

@endsection

@section('script')
    <script>
    var url = "";
    var value_checked =  [];
    var value_kegiatan_berbasis = "";
    var id_pengajuan_ulang = 0;
$('#pengajuan-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("pj.kelola_kegiatan.index")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'PJ_nama_kegiatan', name: 'PJ_nama_kegiatan'},
            {data: 'nilai_ppk', name: 'nilai_ppk'},
            {data: 'kegiatan_berbasis', name:'kegiatan_berbasis'},
            {data: 'updated_at' , name: 'updated_at'},
            {data: 'statusKegiatan', name: 'statusKegiatan.nama', orderable: false},
            {data: 'pengajuan', name:'pengajuan' , orderable: false}
        ],
        order: [[4, "desc"]]
});

    $(document).on('click', '.status_pengajuan', function(){
        var value = $(this).val();
        if (value == "sudah_disetujui" || value == "menolak" || value== "belum_disetujui") {
                var id = $(this).attr('id');
                url = '{{route("pj.kelola_kegiatan.show", "id")}}';
                url = url.replace('id', id);
                $.ajax({
                   url: url,
                   type: 'GET',
                   beforeSend: function(){
                        $("#upload-file").empty();
                        $(".keterangan-show").empty();
                        $(".status-proposal").empty();
                        loadingBar('show');
                   },
                   success: function(res){
                    loadingBar('hide');
                    $("#showModal").modal();
                    var dokumen = $.parseJSON(res.data.dokumen_kegiatan);
                    var nilai_ppk = $.parseJSON(res.data.nilai_ppk);
                    var keterangan = $.parseJSON(res.data.keterangan_json);
                    $("#PJ_nama_kegiatan").attr('value', res.data.PJ_nama_kegiatan);
                    $.each(nilai_ppk, function(key, value){
                        // $("."+res.data.nilai_ppk).prop('checked' , true); 
                        value_checked.push(value.nilai_ppk);
                        $("[value='"+value.nilai_ppk+"']").prop('checked', true);   
                    });
                    // value_kegiatan_berbasis = res.data.kegiatan_berbasis;
                    $(".kegiatan_berbasis").find('[value = "'+res.data.kegiatan_berbasis+'"]').prop('selected', true);

                    keterangan.forEach(element => {
                    if (res.status_proposal.id === 5) {
                         if(element.no === 3){
                           if (element.keterangan_wajib === "" || element.keterangan_wajib === null) {
                            // $(".keterangan-show").append('<li><b>Tidak Ada Keterangan Menolak<b></li>');
                           } else {
                            $(".keterangan-show").append('<li><b>Keterangan Menolak: '+element.keterangan_wajib+'</b></li>');
                           }
                       }
                       else if(element.no === 2){
                            if (element.keterangan_wajib_ulang === "" || element.keterangan_wajib_ulang === null) {
                                // $(".keterangan-show").append('<li><b>Tidak Ada Keterangan Pengajuan Ulang<b></li>');
                            } else {
                                $(".keterangan-show").append('<li><b>Keterangan Pengajuan Ulang: '+element.keterangan_wajib_ulang+'</b></li>');
                            }
                       }
                    }
                    else if(res.status_proposal.id === 3){
                        if(element.no === 2){
                            if (element.keterangan_wajib_ulang === "" || element.keterangan_wajib_ulang === null) {
                                $(".keterangan-show").append('<li><b>Belum Terdapat Keterangan Saat ini<b></li>');
                            } else {
                                $(".keterangan-show").append('<li><b>Keterangan Pengajuan Ulang: '+element.keterangan_wajib_ulang+'</b></li>');
                            }
                       }
                    }
                    else if(res.status_proposal.id === 4) {
                        if(element.no === 2){
                            if (element.keterangan_wajib_ulang !== "" || element.keterangan_wajib_ulang !== null) {
                                $(".keterangan-show").append('<li><b>Keterangan Pengajuan Ulang: '+element.keterangan_wajib_ulang+'</b></li>');
                            }
                       }
                    } 
                    else if(res.status_proposal.id === 1) {
                        if (element.no === 1) {
                           if (element.keterangan_opsional === "" || element.keterangan_opsional === null) {
                               $(".keterangan-show").append('<li><b>Tidak Ada Keterangan Sukses</b></li>');
                           } else {
                            $(".keterangan-show").append('<li><b>Keterangan Sukses: '+element.keterangan_opsional+'</b></li>');
                           }
                       } else if(element.no === 2){
                            if (element.keterangan_wajib_ulang === "" || element.keterangan_wajib_ulang === null) {
                                // $(".keterangan-show").append('<li><b>Tidak Ada Keterangan Pengajuan Ulang<b></li>');
                            } else {
                                $(".keterangan-show").append('<li><b>Keterangan Pengajuan Ulang: '+element.keterangan_wajib_ulang+'</b></li>');
                            }
                       }
                    }
                    //    if (element.no === 1) {
                    //        if (element.keterangan_opsional === "" || element.keterangan_opsional === null) {
                    //            $(".keterangan-show").append('<li><b>Tidak Ada Keterangan Sukses</b></li>');
                    //        } else {
                    //         $(".keterangan-show").append('<li><b>Keterangan Sukses: '+element.keterangan_opsional+'</b></li>');
                    //        }
                    //    } else if(element.no === 2){
                    //         if (element.keterangan_wajib_ulang === "" || element.keterangan_wajib_ulang === null) {
                    //             $(".keterangan-show").append('<li><b>Tidak Ada Keterangan Pengajuan Ulang<b></li>');
                    //         } else {
                    //             $(".keterangan-show").append('<li><b>Keterangan Pengajuan Ulang: '+element.keterangan_wajib_ulang+'</b></li>');
                    //         }
                    //    } else if(element.no === 3){
                    //        if (element.keterangan_wajib === "" || element.keterangan_wajib === null) {
                    //         $(".keterangan-show").append('<li><b>Tidak Ada Keterangan Menolak<b></li>');
                    //        } else {
                    //         $(".keterangan-show").append('<li><b>Keterangan Menolak: '+element.keterangan_wajib+'</b></li>');
                    //        }
                    //    } else {
                    //         $(".keterangan-show").append('<li>Tidak terdapat keterangan</li>');
                    //    }
                    });

                    if (res.status_proposal.id === 1) {
                        $(".status-proposal").css({
                            "background-color": "#d2f4e8",
                            "color": "black",
                            "border-radius": "10px",
                            "padding-bottom": "2rem",
                            "font-weight": 'bold'
                        });
                        
                        $(".status-proposal").append('<li>'+res.status_proposal.nama+'</li>');   
                    }
                    else if(res.status_proposal.id === 5){
                        $(".status-proposal").css({
                            "background-color": "#e74a3b",
                            "color": "black",
                            "border-radius": "10px",
                            "padding-bottom": "2rem",
                            "font-weight": 'bold'
                        });
                        $(".status-proposal").append('<li>'+res.status_proposal.nama+'</li>');   
                    } else if(res.status_proposal.id === 3){
                        $(".status-proposal").css({
                            "background-color": "#d7f1f5",
                            "color": "black",
                            "border-radius": "10px",
                            "padding-bottom": "2rem",
                            "font-weight": 'bold'
                        });
                        $(".status-proposal").append('<li>'+res.status_proposal.nama+'</li>');   
                    }
                    else{
                        $(".status-proposal").css({
                            "background-color": "#858796",
                            "color": "white",
                            "border-radius": "10px",
                            "padding-bottom": "2rem",
                            "font-weight": 'bold'
                        });
                        $(".status-proposal").append('<li>Tidak terdapat Status</li>');   
                    }

                    if (res.status_dokumen) {
                        $.each(dokumen, function(key, value){
                        var asset = '{{asset("kegiatan/pengajuan_kegiatan/asset_kegiatan")}}';
                        asset = asset.replace('asset_kegiatan', value.nama_dokumen);
                        $("#upload-file").append('<iframe src="'+asset+'" height="500" width="1100"></iframe>');
                    });   
                    }
                    $(".mulai_kegiatan").attr('value', res.data.mulai_kegiatan);
                    $(".akhir_kegiatan").attr('value', res.data.akhir_kegiatan);                    
                   },
                    error: function(error){
                        loadingBar('hide');
                        if (error.status === 401) {
                            let info_login = $.parseJSON(error.responseText);
                            backToLogin(error.status , info_login.message);
                        } else if(error.status === 404){
                            let errorMessage = $.parseJSON(error.responseText);
                            notFoundError(error.status, errorMessage.messages);
                        } else {
                            anyErrors(error.status, error.statusText, error);
                        }
                   }
                });
        }
        else if(value === "pengajuan_ulang"){
                var id = $(this).attr('id');
                url = '{{route("pj.kelola_kegiatan.edit", "id")}}';
                url = url.replace('id', id);
                id_pengajuan_ulang = id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function(){
                        loadingBar('show');
                        $("#upload-ulang").empty();
                        $(".keterangan").empty();
                    },
                    success: function(res){
                    loadingBar('hide');
                    $("#pengajuanUlangModal").modal();
                    var dokumen = $.parseJSON(res.data.dokumen_kegiatan);   
                    var nilai_ppk = $.parseJSON(res.data.nilai_ppk);
                    var url2 = '{{route("pj.kelola_kegiatan.update", "id")}}';
                    url2 = url2.replace('id', id);
                    $(".PJ_nama_kegiatan").attr('value', res.data.PJ_nama_kegiatan);
                    $("#pengajuanUlangForm").attr('action', url2);
                    $.each(nilai_ppk, function(key, value){
                        // $("."+res.data.nilai_ppk).prop('checked' , true); 
                        // value_checked.push(value.nilai_ppk);
                        $("[value='"+value.nilai_ppk+"']").prop('checked', true);   
                    });
                    $(".kegiatan_berbasis").find('[value = "'+res.data.kegiatan_berbasis+'"]').prop('selected', true);                    

                    var keterangan = $.parseJSON(res.data.keterangan_json);
                    $.each(keterangan, function(key,value){
                        if (value.keterangan_wajib_ulang != null) {
                            $(".keterangan").append('<li>'+value.keterangan_wajib_ulang+'</li>');
                        }
                    });

                    if (res.status_dokumen) {
                        $.each(dokumen, function(key, value){
                        var asset = '{{asset("kegiatan/pengajuan_kegiatan/asset_kegiatan")}}';
                        asset = asset.replace('asset_kegiatan', value.nama_dokumen);
                        $("#upload-ulang").append('<iframe src="'+asset+'" height="500" width="1100"></iframe>');
                    });   
                    }
                    $(".mulai_kegiatan").val(res.data.mulai_kegiatan);
                    $(".akhir_kegiatan").val(res.data.akhir_kegiatan);             
                    },                    
                    error: function(error){
                        loadingBar('hide');
                        if (error.status === 401) {
                            let info_login = $.parseJSON(error.responseText);
                            backToLogin(error.status, info_login.message);
                        } else if(error.status === 404) {
                            let errorMessage =  JSON.parse(error.responseText);
                            notFoundError(error.status , errorMessage.messages);
                        } else {
                            anyErrors(error.status, error.statusText , error);
                        }
                    }
                });
        }
    });

    // Reset modal state

    $("#showModal").on('hidden.bs.modal', function(){   
        for (let index = 0; index < value_checked.length; index++) {
            const element = value_checked[index];
            $("[value='"+element+"']").prop('checked', false);   
        }
        $(".kegiatan_berbasis").find('[value = ""]').prop('selected', true);
        value_checked.length = 0;
    });

    $("#pengajuanUlangModal").on('hidden.bs.modal', function(){
        $(".value_nilai_ppk").each(function(){
            var isChecked = $(this).is(":checked");
            if (isChecked) {
                $(this).prop('checked', false);
            }
        });
        $(".kegiatan_berbasis").find('[value = ""]').prop('selected', true);
        // $(".mulai_kegiatan").val();
        // $(".akhir_kegiatan").val();
        // $(".PJ_nama_kegiatan").attr('value' ,'');
        $("#pengajuanUlangForm")[0].reset();
    });

    $("#createModal").on('hidden.bs.modal', function(){
        $("#createPengajuanForm")[0].reset();
    });

    $(document).on('click', '.create_proposal', function(){
        $(".error_notification").empty();
        $("#createModal").modal();
        url = '{{route("pj.kelola_kegiatan.store")}}';
        $("#createPengajuanForm").attr('action', url);
    });

    //End Reset


    $('form').on('submit', function(e){
        e.preventDefault();
        var form_id = $(this).attr('id');
        var formData = new FormData($(this)[0]);
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $("[name='_token']").val()
            }
        });
        if (form_id === "createPengajuanForm") {
         $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                progressState('show');
            },
            xhr: function(){  
                var xhr = new XMLHttpRequest(); 
                xhr.upload.addEventListener("progress", function(e){
                    if (e.lengthComputable) {
                        var percentComplete = e.loaded / e.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.myprogress').text(percentComplete + '%');
                        $('.myprogress').css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(res){
                progressState('reset');  
                $("#createModal").modal('hide');
                $("#createPengajuanForm")[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Pengajuan Kegiatan Sukses Diunggah'
                });
                $("#pengajuan-table").DataTable().ajax.reload();
            },
            error: function(res){
                progressState('reset');
                if (res.status === 401) {
                    let info_login = $.parseJSON(res.responseText);
                    backToLogin(res.status, info_login.message);
                } else if(res.status === 422){
                    let error_notifikasi = $.parseJSON(res.responseText);
                    $(".error_notification").css('padding-bottom: 3rem');
                    $.each(error_notifikasi.errors, function(key, value){
                        $(".error_notification").append('<li>'+value+'</li>');
                    });   
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terdapat Error Saat melakukan pengiriman, Silahkan Lihat Error diatas form!'
                    }).then((result)=>{
                        if(result.value){
                            $("#createModal").scrollTop(0);
                        }
                    });
                } else {
                    anyErrors(res.status , res.statusText , res);
                }
            }
        });   
        } else if(form_id === "pengajuanUlangForm") {
            var url = '{{route("pj.kelola_kegiatan.update", "id")}}';
            url = url.replace('id', id_pengajuan_ulang);
            var form = new FormData($(this)[0]);
            $.ajax({
            url: url,
            type: 'POST',
            data: form,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(){
                progressState('show');
            },
            xhr: function(){  
                var xhr = new XMLHttpRequest(); 
                xhr.upload.addEventListener("progress", function(e){
                    if (e.lengthComputable) {
                        var percentComplete = e.loaded / e.total;
                        percentComplete = parseInt(percentComplete * 100);
                        $('.myprogress').text(percentComplete + '%');
                        $('.myprogress').css('width', percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(res){
                progressState('reset');
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: 'Pengajuan Ulang Kegiatan Sukses Diunggah'
                });
                $("#pengajuanUlangModal").modal('hide');
                $("#pengajuan-table").DataTable().ajax.reload();
            },
            error: function(res){
                progressState('reset');
                if (res.status === 401) {
                    let info_login = $.parseJSON(res.responseText);
                    backToLogin(res.status,info_login.message);
                } else if(res.status === 422){
                    $(".error_notification").css('padding-bottom: 3rem');
                    let error_notifikasi = $.parseJSON(res.responseText);
                    if (typeof error_notifikasi.messages === 'string') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Data tidak dapat diunggah',
                            text: error_notifikasi.messages
                        });
                    } else {
                        $.each(error_notifikasi.errors, function(key, value){
                            $(".error_notification").append('<li>'+value+'</li>');
                        }); 
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terdapat Error Saat melakukan pengiriman, Silahkan Lihat Error diatas form!'
                        }).then((result)=>{
                            if(result.value){
                                $("#pengajuanUlangModal").scrollTop(0);
                            }
                        });  
                    }
                } else if(res.status === 404) {
                    let errorNotFound = $.parseJSON(res.responseText);
                    notFoundError(res.status, errorNotFound.messages);
                } else {
                    anyErrors(res.status , res.statusText , res);
                }
            }
        });  
        }
    });  
    
    function progressState(condition){
        if (condition === 'reset') {
            $(".progress").attr('hidden', true);
            $('.myprogress').text('0%');
            $('.myprogress').css('width', '0%');

            //button disabled when progress resets
            $(".new_proposal").attr('disabled', false);
            $(".close_proposal").attr('disabled', false);
            $(".close").attr('disabled', false);    
        }
        else if(condition === 'show'){
            $('.myprogress').text('0%');
            $('.myprogress').css('width', '0%');
            $(".progress").attr('hidden', false);
            $(".error_notification").empty();
            
            //button disabled when progress shows
            $(".new_proposal").attr('disabled', true);
            $(".close_proposal").attr('disabled', true);
            $(".close").attr('disabled', true);
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

    function backToLogin(status, info){
        if (status === 401) {
            Swal.fire({
                icon: 'info',
                title: 'Please Login',
                text: info
            }).then((result)=>{
                window.location = '/';
            });
        }
    }

    function notFoundError(status_not_found , info){
        if (status_not_found === 404) {
            Swal.fire({
                icon: 'error',
                title: 'Error Data tidak ditemukan',
                text: info
            });
        }
    }

    function anyErrors(status, statusText, statusLog){
        if (typeof statusLog.message !== "undefined") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'System Error Code: '+status+': '+statusText+": "+statusLog.message
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'System Error Code: '+status+': '+statusText
            });    
        }
        console.log(statusLog);
    }
    </script>
@endsection