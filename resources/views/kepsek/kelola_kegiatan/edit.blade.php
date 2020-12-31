@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Pengajuan Kegiatan
@endsection

@section('content')
<b style="font-size: 5vh"><a class="btn btn-info rounded-pill float float-left" id="back-button" href="{{route("kepsek.kelola_kegiatan.index")}}"><i class="fas fa-arrow-alt-circle-left mr-2"></i>Back</a></b><br>
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
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
  <div class="histori_kegiatan alert alert-info alert-heading font-weight-bolder d-none"></div>
</div>
<hr>
   <input type="hidden" name="id" value="{{ $id }}">
    @if (!is_null($pengajuan_kegiatan->user()->first()))
    <div class="row">
      <div class="col-6">
        @if (is_null($pengajuan_kegiatan->user->photo_user))
          <img class="rounded-circle" src="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}" alt="" srcset="" width="300" height="300">    
        @else
          <img class="rounded-circle" src="{{ asset('kegiatan/admin/foto_user/'.$pengajuan_kegiatan->user->photo_user) }}" alt="" srcset="" width="300" height="300">
        @endif
      </div>
      <div class="col-6">
        <div class="form-group">
          {!! Form::label('nama_user', 'Nama Penanggung Jawab:') !!}
          {!! Form::text('nama_user', $pengajuan_kegiatan->user->name , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>
      </div>
  </div>
    @else
    <div class="row">
      <div class="col-6">
        <img class="rounded-circle" src="{{ asset('logo/logo_smp_islam_sabilurrosyad.png') }}" alt="" srcset="" width="300" height="300">
      </div>
      <div class="col-6">
        <div class="form-group">
          {!! Form::label('nama_user', 'Nama Penanggung Jawab:') !!}
          {!! Form::text('nama_user', $data_user , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>
      </div>
    </div>
    @endif
   <hr>
    
    <div class="form-group">
        {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('PJ_nama_kegiatan', $pengajuan_kegiatan->PJ_nama_kegiatan , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>

    {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
    <br>
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>

    <div class="form-group d-none" id="nilai_ppk_groups">
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
          <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        <div id="file_upload" class="d-none">

        </div>
      </div>
      {{-- <div class="col-lg-12 col-sm-12">
        <div id="show_docs" hidden>
          
        </div>
      </div> --}}
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
          <ul class="keterangan_error d-none">

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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
          <ul class="keterangan_error d-none">

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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
          <ul class="keterangan_error d-none">

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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          {!! Form::submit('Menolak Kegiatan', ['class' => 'btn btn-danger btn_keterangan_wajib']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  {{-- {!! Form::close() !!} --}}
@endsection

@section('script')
<script>
      // var state = true;
      $("textarea").each(function(){
        $(this).val('');
      });
      const backButtonElement = document.getElementById('back-button');
      var url_back_to = '{{route("kepsek.kelola_kegiatan.index")}}';
      let statusData = true;
      // var url_redirect = "";
      var modal_state = "";
      $("#file_upload").empty();
      var url = '{{route("kepsek.pengajuan_dokumentasi_kegiatan.get_kegiatan", ["dokumentasi_kegiatan" => "id_kegiatan", "type_kegiatan" => "tipe_kegiatan"])}}';
      url = url.replace("id_kegiatan", $("[name='id']").val());
      url = url.replace("tipe_kegiatan", "Proposal");

      $.get(url, function(res){
        var data_nilai_ppk = $.parseJSON(res.data.nilai_ppk);
        statusData = res.status;
        $.each(data_nilai_ppk, function(key, value){
          $("[value = '"+value.nilai_ppk+"']").attr('checked', value.nilai_ppk);
        });
        $.each(res.keterangan, function(key, value){
          if (value.no === 2) {
            if(value.keterangan_wajib_ulang !== "") {
              $(".histori_kegiatan").removeClass('d-none');
              var label = '{!! Form::label("histori_keterangan" , "Histori Keterangan Pengajuan Ulang Kegiatan:") !!}';
              $(".histori_kegiatan").append('<h4>'+label+'</h4><ul><li>'+value.keterangan_wajib_ulang+'</li></ul>');              
            }
          }
        });
        if (statusData) {
            $.each(res.data_dokumen, function(key,value){
              var url_dokumen = "{{asset('kegiatan/pengajuan_kegiatan/nama_dokumen')}}";
              url_dokumen = url_dokumen.replace('nama_dokumen', value.nama_dokumen);
              $("#file_upload").append('<i class="fas fa-file-alt"></i> <a href="'+url_dokumen+'" class="mr-2" target="_blank">'+value.nama_dokumen+'</a><button class="btn btn-primary btn-sm lihat_file mr-2" value="'+url_dokumen+'">Lihat File</button><a href="'+url_dokumen+'" download="'+value.nama_dokumen+'" class="btn btn-info btn-sm mr-2">Download File</a><br>');
            });  
        } else {
          $("#file_upload").append('<ol><li>'+res.data_dokumen+'</li></ol>');
        }
      }).done(function(){
        const spinner = document.getElementsByClassName('spinner-border');
        const nilaiPPK = document.getElementById('nilai_ppk_groups');
        document.getElementById('file_upload').classList.remove('d-none');
        nilaiPPK.classList.remove('d-none');
        for (let index = 0; index < spinner.length; index++) {
          const element = spinner[index];
          element.classList.add('d-none');
        }
        if (statusData) {
          $(document).on('click', '.lihat_file', function(){
            var value_doc = $(this).val();
            window.open(value_doc);
              // $("#show_docs").empty();
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
        }
      }).fail(function(error){
        if (error.status === 401) {
          let response_error = $.parseJSON(error.responseText);
          notificationAlerts(error.status, response_error.message, 'login');
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
        } else {
          notificationAlerts(error.status, error, 'getData');
        }
      });

      $(document).on('click', '.button_show', function(){
        modal_state = $(this).attr('data-target');
        $(modal_state).modal();
      });
      
      $('form').on('submit', function(e){
        e.preventDefault();
        // $(".keterangan_error").empty();
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
            // url_redirect = '{{route("kepsek.kelola_kegiatan.index")}}';
            loadingBar(false);  
            $(modal_state).modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Sukses Mengambil Keputusan Proposal Kegiatan',
              text: res.status_data,
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false
            }).then((result)=>{
                if (result.value) {
                  // window.location = url_redirect;
                  window.location.replace(url_back_to);
                  modal_state = "";
                }
            });
          },
          error: function(res){
            loadingBar(false);
            if (res.status === 401) {
              let error = JSON.parse(res.responseText);
              notificationAlerts(res.status, error.message, 'login');
            } else if(res.status === 422) {
              let error = $.parseJSON(res.responseText);
                Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "Terdapat Error, Silahkan lihat diatas form!",
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
                $(".keterangan_error").append('<li class="mb-2">'+value+'</li>');
              });
            } else{
              $.each(error.errors, function(key, value){
                  $(".keterangan_error").append('<li class="mb-2">'+value+'</li>');
                });
              }
            } else if(res.status === 404){
              if (typeof error.messages === 'string') {
                Swal.fire({
                  icon: 'error',
                  title: 'Error Data Tidak Ditemukan',
                  text: error.messages
                });
              } else {
                // Swal.fire({
                //   icon: 'error',
                //   title: 'Error',
                //   text: "Status Code: "+res.status+": "+res.statusText
                // });
                notificationAlerts(statusCode, res, 'form');
              }
            } else {
              notificationAlerts(statusCode, res, 'form');
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
          $(".keterangan_error").empty();
          $(".keterangan_error").addClass('d-none');
        }
        else{
          Swal.close();
          $(".keterangan_error").removeClass('d-none');
        }
      }

      backButtonElement.addEventListener('click', (e) => {
        e.preventDefault();
        const links = backButtonElement.getAttribute('href');
        window.location.replace(links);
      });

      $("#modal_success").on('hidden.bs.modal', function(){
        resetKeterangan('modal', 'success');
      });
      $("#modal_menolak").on('hidden.bs.modal', function(){
        resetKeterangan('modal', 'menolak');
      });
      $("#modal_pengajuan_ulang").on('hidden.bs.modal', function(){
        resetKeterangan('modal', 'pengajuan_ulang');
      });

      function characterCount(str , stateKeterangan) {
        var lng = str.length;
        if (stateKeterangan === "keterangan_wajib" ) {
          document.querySelector('.count_keterangan_wajib').innerHTML = lng + ' / 255 Karakter'
          if (lng > 255) {
            $(".error_count_wajib").html('Keterangan melebihi '+lng+' / 255 Karakter');
            $(".error_count_wajib").prop('hidden', false);
            $(".btn_keterangan_wajib").prop('disabled' , true);
          } else {
            // $(".error_count_wajib").empty();
            // $(".error_count_wajib").prop('hidden', true);
            // $(".btn_keterangan_wajib").prop('disabled' , false);
            resetKeterangan('counter', stateKeterangan);
          } 
        } else if(stateKeterangan === "keterangan_ulang"){
          document.querySelector('.count_keterangan_ulang').innerHTML = lng + ' / 255 Karakter'
          if (lng > 255) {
            $(".error_count_ulang").html('Keterangan melebihi '+lng+' / 255 Karakter');
            $(".error_count_ulang").prop('hidden', false);
            $(".btn_keterangan_ulang").prop('disabled', true);
          } else {
            // $(".error_count_ulang").empty();
            // $(".error_count_ulang").prop('hidden', true);
            // $(".btn_keterangan_ulang").prop('disabled', false);
            resetKeterangan('counter', stateKeterangan);
          } 
        } else if(stateKeterangan === 'keterangan_opsional'){
          document.querySelector('.count_keterangan_opsional').innerHTML = lng + ' / 255 Karakter'
          if (lng > 255) {
            $(".error_count_opsional").html('Keterangan melebihi '+lng+' / 255 Karakter');
            $(".error_count_opsional").prop('hidden', false);
            $(".btn_keterangan_opsional").prop('disabled', true);
          } else {
            // $(".error_count_opsional").empty();
            // $(".error_count_opsional").prop('hidden', true);
            // $(".btn_keterangan_opsional").prop('disabled', false);
            resetKeterangan('counter', stateKeterangan);
          } 
        }
      }

      function notificationAlerts(statusCode, statusMessage, type){
        if (statusCode === 401 && type === 'login') {
          Swal.fire({
            icon: 'info',
            title: 'Please Login',
            text: statusMessage
          }).then((result)=>{
              window.location = '/';
          });
        } else {
           if (type === 'getData') {
            Swal.fire({
              icon: 'error',
              title : 'Error',
              text: 'System Error Code: '+statusMessage.status+": "+statusMessage.statusText,
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false
            }).then((result) =>{
              window.location = url_back_to;
            });
           } else if(type === 'form') {
            Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: "Status Code: "+statusMessage.status+": "+statusMessage.statusText
            });
           }
          //  console.log(statusMessage);
        }
      }

      function resetKeterangan(type, keteranganType){
        if (type === 'modal') {
          $(".keterangan_error").empty();
          $(".keterangan_error").addClass('d-none');
          document.querySelector('.keterangan').value = '';
          modal_state = "";
          if (keteranganType === 'success') {
            $(".count_keterangan_opsional").html('0 / 255 Karakter');
            $(".error_count_opsional").prop('hidden', true);
            // $(".btn_keterangan_opsional").prop('disabled', false);
          } else if(keteranganType === 'menolak'){
            $(".count_keterangan_wajib").html('0 / 255 Karakter');
            $(".error_count_wajib").prop('hidden', true);
          } else if(keteranganType === 'pengajuan_ulang'){
            $(".count_keterangan_ulang").html('0 / 255 Karakter');
            $(".error_count_ulang").prop('hidden', true);
          }
          $("textarea").each(function(){
            $(this).val('');
          });
        } else if(type === 'counter') {
          if (keteranganType === 'keterangan_wajib') {
            $(".error_count_wajib").empty();
            $(".error_count_wajib").prop('hidden', true);
            $(".btn_keterangan_wajib").prop('disabled' , false);
          } else if(keteranganType === 'keterangan_ulang'){
            $(".error_count_ulang").empty();
            $(".error_count_ulang").prop('hidden', true);
            $(".btn_keterangan_ulang").prop('disabled', false);
          } else if(keteranganType === 'keterangan_opsional'){
            $(".error_count_opsional").empty();
            $(".error_count_opsional").prop('hidden', true);
            $(".btn_keterangan_opsional").prop('disabled', false);
          }
        }
      }
      
    </script>
@endsection
