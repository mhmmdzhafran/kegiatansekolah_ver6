@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Pengajuan Kegiatan
@endsection

@section('content')
<b style="font-size: 5vh"><a class="btn btn-info rounded-pill float float-left" href="{{route("kepsek.kelola_kegiatan.index")}}"><i class="fas fa-arrow-alt-circle-left mr-2"></i>Back</a></b><br>
<div class="row">
  <div class="col-12">
    <h2 class="text-center">Penerimaan Proposal Kegiatan Penguatan Pendidikan Karakter</h2>
  </div>
</div>
<div class="form-group">
  <div class="status_kegiatan alert alert-danger">
    <h4>{!! Form::label('status_dari_kegiatan' , 'Status Pengajuan Kegiatan:') !!}</h4>
    <ul>
      <li>{{ $status_kegiatan->nama }}</li>
    </ul>
  </div>
  <div class="histori_kegiatan alert alert-info alert-heading font-weight-bolder" hidden>

  </div>
</div>
<hr>
   <input type="hidden" name="id" value="{{ $id }}">
   <div class="form-group">
    {!! Form::label('nama_user', 'Nama Penanggung Jawab:') !!}
    {!! Form::text('nama_user', $data_user , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
   </div>
    <div class="form-group">
        {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('PJ_nama_kegiatan', $pengajuan_kegiatan->PJ_nama_kegiatan , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
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
            <br>
    </div>

    <div class="form-group">
        {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
        {!! Form::select('kegiatan_berbasis', array('' => $pengajuan_kegiatan->kegiatan_berbasis) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('dokumen_kegiatan', 'Dokumen Proposal Yang Dikirim:') !!}
        <div class="col-lg-12 col-sm-12">

        <div id="file_upload">

        </div>
      </div>
      <div class="col-lg-12 col-sm-12">
        <div id="show_docs" hidden>
          
        </div>
      </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                {!! Form::date('mulai_kegiatan', $pengajuan_kegiatan->mulai_kegiatan , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('akhir_kegiatan', 'Akhir dari Kegiatan:') !!}
                {!! Form::date('akhir_kegiatan', $pengajuan_kegiatan->akhir_kegiatan , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="form-group">
            <button type="button" class="btn btn-success btn-md rounded-pill button_show"  data-target="#modal_success">
                Menerima Kegiatan
              </button>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="form-group">
            <button type="button" class="btn btn-warning btn-md rounded-pill button_show" data-target="#modal_pengajuan_ulang">
                Melakukan Pengajuan Ulang
              </button>
            </div>
        </div>
        
        <div class="col-sm-12 col-lg-4">
            <div class="form-group">
            <button type="button" class="btn btn-danger btn-md rounded-pill button_show"  data-target="#modal_menolak">
                Menolak Kegiatan
              </button>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="modal_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Pengajuan Kegiatan Diterima</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="keterangan_error">

          </ul>
            {!! Form::open(['method' => 'PUT', 'action' => ['KepalaSekolahMengelolaKegiatanController@update' , $pengajuan_kegiatan->id], 'files'=>true, "id" => 'modal_success']) !!}
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Untuk Kegiatan yang berjudul:</label>
                    <h4>{{ $pengajuan_kegiatan->PJ_nama_kegiatan }}</h4>
                </div>
                <div class="form-group">
                    {!! Form::hidden('id_keterangan', 1)!!}
                    {{-- {!! Form::hidden('mulai_kegiatan', $pengajuan_kegiatan->mulai_kegiatan) !!}
                    {!! Form::hidden('user_id', $pengajuan_kegiatan->user_id) !!} --}}
                    {!! Form::label('keterangan', 'Keterangan(Opsional):') !!}
                    {!! Form::textarea('keterangan', null , ['class' => 'form-control keterangan', 'onkeyup' => 'characterCount(this.value, "keterangan_opsional")']) !!}
                    <div class="error_count_opsional alert alert-danger mt-2" hidden></div>
                    <div class="float-right count_keterangan_opsional">0 / 255 Karakter</div>
                </div>
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!! Form::submit('Menerima Kegiatan', ['class' => 'btn btn-success btn_keterangan_opsional']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="modal_pengajuan_ulang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Pengajuan Ulang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="keterangan_error">

          </ul>
            {!! Form::open(['method' => 'PUT', 'action' => ['KepalaSekolahMengelolaKegiatanController@update' , $pengajuan_kegiatan->id], 'files'=>true, "id" => 'modal_pengajuan_ulang']) !!}
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Untuk Kegiatan yang berjudul:</label>
              <h4>{{ $pengajuan_kegiatan->PJ_nama_kegiatan }}</h4>
            </div>
            <div class="form-group">
                {!! Form::hidden('id_keterangan', 2)!!}
                {!! Form::label('keterangan_wajib_ulang', 'Keterangan(Wajib):') !!}
                {!! Form::textarea('keterangan', null , ['class' => 'form-control keterangan', 'onkeyup' => 'characterCount(this.value , "keterangan_ulang")']) !!}
                <div class="error_count_ulang alert alert-danger mt-2" hidden></div>
                <div class="float-right count_keterangan_ulang">0 / 255 Karakter</div>
            </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!! Form::submit('Lakukan Pengajuan Ulang Kegiatan', ['class' => 'btn btn-warning btn_keterangan_ulang']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  
<div class="modal fade" id="modal_menolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Pengajuan Ditolak</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="keterangan_error">

          </ul>
            {!! Form::open(['method' => 'PUT', 'action' => ['KepalaSekolahMengelolaKegiatanController@update' , $pengajuan_kegiatan->id], 'files'=>true, "id" => 'modal_menolak']) !!}
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Untuk Kegiatan yang berjudul:</label>
                    <h4>{{ $pengajuan_kegiatan->PJ_nama_kegiatan }}</h4>
                </div>
                <div class="form-group">
                    {!! Form::hidden('id_keterangan', 3)!!}
                    {!! Form::label('keterangan_wajib', 'Keterangan(Wajib):') !!}
                    {!! Form::textarea('keterangan', null , ['class' => 'form-control keterangan', 'onkeyup' => 'characterCount(this.value , "keterangan_wajib")']) !!}
                    <div class="error_count_wajib alert alert-danger mt-2" hidden></div>
                    <div class="float-right count_keterangan_wajib">0 / 255 Karakter</div>
                </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!! Form::submit('Menolak Kegiatan', ['class' => 'btn btn-danger btn_keterangan_wajib']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
@endsection

@section('script')
<script>
      // var state = true;

      $("textarea").each(function(){
        $(this).val('');
      });
      var url_redirect = "";
      var modal_state = "";
      $("#file_upload").empty();
      var url = '{{route("pj.kelola_kegiatan.data_kegiatan", "id")}}';
      url = url.replace("id", $("[name='id']").val());

      $.get(url, function(res){
        var data_nilai_ppk = $.parseJSON(res.data.nilai_ppk);

        $.each(data_nilai_ppk, function(key, value){
          $("[value = '"+value.nilai_ppk+"']").attr('checked', value.nilai_ppk);
        });
        $.each(res.keterangan, function(key, value){
          if (value.no === 2) {
            if(value.keterangan_wajib_ulang !== "") {
              $(".histori_kegiatan").attr('hidden', false);
              var label = '{!! Form::label("histori_keterangan" , "Histori Keterangan Pengajuan Ulang Kegiatan:") !!}';
              $(".histori_kegiatan").append('<h4>'+label+'</h4><ul><li>'+value.keterangan_wajib_ulang+'</li></ul>');              
            }
          }
        });
        $.each(res.data_dokumen, function(key,value){
          var url_dokumen = "{{asset('kegiatan/pengajuan_kegiatan/nama_dokumen')}}";
          url_dokumen = url_dokumen.replace('nama_dokumen', value.nama_dokumen);
          $("#file_upload").append('<i class="fas fa-file-alt"></i> <a href="'+url_dokumen+'" class="mr-2" target="_blank">'+value.nama_dokumen+'</a><button class="btn btn-primary btn-sm lihat_file mr-2" value="'+url_dokumen+'">Lihat File</button><a href="'+url_dokumen+'" download="'+value.nama_dokumen+'" class="btn btn-info btn-sm mr-2">Download File</a><br>');
        });
      }).fail(function(error){
        var url_back_to = '{{route("kepsek.kelola_kegiatan.index")}}';
        if (error.status === 401) {
          let response_error = $.parseJSON(error.responseText);
          Swal.fire({
            icon: 'info',
            title: 'Please Login',
            text : response_error.message
          }).then((result)=>{
            window.location = '/';
          });
        } else if(error.status === 404) {
          let response_error = $.parseJSON(error.responseText);
            Swal.fire({
              icon: 'error',
              title: 'Error Saat Pengambilan Data',
              text: response_error.messages,
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false
              }).then((result)=>{
                window.location = url_back_to;
            });
        } else{
          Swal.fire({
            icon: 'error',
            title : 'Error',
            text: 'System Error Code: '+error.status+": "+error.statusText
          }).then((result) =>{
            window.location = url_back_to;
          });
          console.log(error);
        }
      });
      $(document).on('click', '.lihat_file', function(){
        $("#show_docs").empty();
          var value_doc = $(this).val();
          window.open(value_doc);
          // if (state === true) {
          //   $("#show_docs").attr('hidden', false);
          //   $("#show_docs").append('<iframe src="'+value_doc+'" height="500" width="1000"></iframe>');
          //   state = false;
          // } else{
          //   $("#show_docs").attr('hidden', true);
          //   $("#show_docs").empty();
          //   state = true;
          // }
      });

      $(document).on('click', '.button_show', function(){
        modal_state = $(this).attr('data-target');
        $(modal_state).modal();
      });
      
      $('form').on('submit', function(e){
        e.preventDefault();
        $(".keterangan_error").empty();
        var modal = $(this).attr('id');
        var url_form = $(this).attr('action');
        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN': $("[name = '_token']").val()
          }
        });
        $.ajax({
          url: url_form,
          type: 'PUT',
          data: $(this).serialize(),
          beforeSend: function(){
            loadingBar(true);
          },
          success: function(res){
            console.log(res);
            url_redirect = '{{route("kepsek.kelola_kegiatan.index")}}';
            loadingBar(false);  
            Swal.fire({
              icon: 'success',
              title: 'Sukses',
              text: res.status_data,
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false
            }).then((result)=>{
                if (result.value) {
                  $(modal_state).modal('hide');
                  window.location = url_redirect;
                  modal_state = "";
                }
            });
          },
          error: function(res){
            loadingBar(false);
            if (res.status === 401) {
              let error = JSON.parse(res.responseText);
              Swal.fire({
                icon: 'info',
                title: 'Please Login',
                text: error.message
              }).then((result)=>{
                  window.location = '/';
              });
            } else if(res.status === 422) {
              let error = $.parseJSON(res.responseText);
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "Terdapat Error, silahkan lihat diatas form!",
              }).then((result)=>{
                if (result.value) {
                  $("#"+modal).scrollTop(0);
                }
              });            
              $(".keterangan_error").css({
                "background-color": "#e53e3e",
                "color": "white", 
                "border-radius": "10px"
              });
            if (error.state) {
              $.each(error.errors, function(key, value){
                $(".keterangan_error").append('<b>Terdapat Error: </b><li>'+value+'</li>');
              });
            }
            else{
              $.each(error.errors, function(key, value){
                  $(".keterangan_error").append('<b>Terdapat Error: </b><li>'+value+'</li>');
                });
              }
            } else if(res.status === 404){
              if (typeof error.messages === 'string') {
                Swal.fire({
                  icon: 'error',
                  title: 'Error Data Tidak Ditemukan',
                  text: error.messages
                });
              }
              else{
                Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: "Status Code: "+res.status+": "+res.statusText
                });
              }
            } else {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: "Status Code: "+res.status+": "+res.statusText
                });
            }
          }
      });
    });
      function loadingBar(condition){
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
      };
      $("#modal_success").on('hidden.bs.modal', function(){
        $(".keterangan_error").empty();
        document.querySelector('.keterangan').value = '';
        $(".count_keterangan_opsional").html('0 / 255 Karakter');
        $(".error_count_opsional").prop('hidden', true);
        // $(".btn_keterangan_opsional").prop('disabled', false);
        modal_state = "";
      });
      $("#modal_menolak").on('hidden.bs.modal', function(){
        $(".keterangan_error").empty();
        document.querySelector('.keterangan').value = '';
        $(".count_keterangan_wajib").html('0 / 255 Karakter');
        $(".error_count_wajib").prop('hidden', true);
        modal_state = "";
      });
      $("#modal_pengajuan_ulang").on('hidden.bs.modal', function(){
        $(".keterangan_error").empty();
        document.querySelector('.keterangan').value = '';
        $(".count_keterangan_ulang").html('0 / 255 Karakter');
        $(".error_count_ulang").prop('hidden', true);
        modal_state = "";
      });

      function characterCount(str , stateKeterangan) {
        var lng = str.length;
        if (stateKeterangan ==="keterangan_wajib" ) {
          document.querySelector('.count_keterangan_wajib').innerHTML = lng + ' / 255 Karakter'
          if (lng > 255) {
            $(".error_count_wajib").html('Keterangan melebihi '+lng+' / 255 Karakter');
            $(".error_count_wajib").prop('hidden', false);
            $(".btn_keterangan_wajib").prop('disabled' , true);
          } else {
            $(".error_count_wajib").empty();
            $(".error_count_wajib").prop('hidden', true);
            $(".btn_keterangan_wajib").prop('disabled' , false);
          } 
        } else if(stateKeterangan === "keterangan_ulang"){
          document.querySelector('.count_keterangan_ulang').innerHTML = lng + ' / 255 Karakter'
          if (lng > 255) {
            $(".error_count_ulang").html('Keterangan melebihi '+lng+' / 255 Karakter');
            $(".error_count_ulang").prop('hidden', false);
            $(".btn_keterangan_ulang").prop('disabled', true);
          } else {
            $(".error_count_ulang").empty();
            $(".error_count_ulang").prop('hidden', true);
            $(".btn_keterangan_ulang").prop('disabled', false);
          } 
        } else if(stateKeterangan === 'keterangan_opsional'){
          document.querySelector('.count_keterangan_opsional').innerHTML = lng + ' / 255 Karakter'
          if (lng > 255) {
            $(".error_count_opsional").html('Keterangan melebihi '+lng+' / 255 Karakter');
            $(".error_count_opsional").prop('hidden', false);
            $(".btn_keterangan_opsional").prop('disabled', true);
          } else {
            $(".error_count_opsional").empty();
            $(".error_count_opsional").prop('hidden', true);
            $(".btn_keterangan_opsional").prop('disabled', false);
          } 
        }
      }
      
    </script>
@endsection
