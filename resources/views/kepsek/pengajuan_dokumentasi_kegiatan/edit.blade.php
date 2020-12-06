@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Penerimaan Dokumentasi Kegiatan
@endsection

@section('content')
<b style="font-size: 5vh"><a class="btn btn-info rounded-pill float float-left" id="back-button" href="{{route("kepsek.pengajuan_dokumentasi_kegiatan.index")}}"><i class="fas fa-arrow-alt-circle-left mr-2"></i>Back</a></b><br>
    <div class="row">
      <div class="col-12">
        <h2 class="text-center">Penerimaan Laporan Kegiatan Penguatan Pendidikan Karakter</h2>
      </div>
    </div>
    <div class="form-group">
      <input type="hidden" name="id-doc-evt" value="{{ $dokumentasi_kegiatan->id }}">
      <div class="status_kegiatan alert alert-danger">
        <h4>{!! Form::label('status_dari_kegiatan' , 'Status Pengajuan Kegiatan:') !!}</h4>
        <ul>
          <li>{{ $status_dokumentasi->nama }}</li>
        </ul>
      </div>
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <div class="histori_kegiatan alert alert-info alert-heading font-weight-bolder d-none"></div>
    </div>
    <hr>
    <div class="form-group">
      {!! Form::label('nama_pj', 'Nama Penanggung Jawab:') !!}
      {!! Form::text('nama_pj', $user_name , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('nama_kegiatan', $dokumentasi_kegiatan->nama_kegiatan , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>
    {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
    <br>
    
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
    </div>

    <div class="form-group d-none" id="nilai_ppk_group">      
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
            {!! Form::select('kegiatan_berbasis', array('' => $dokumentasi_kegiatan->kegiatan_berbasis) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>


        <div class="form-group mb-2">
          {!! Form::label('dokumen_kegiatan', 'Laporan Kegiatan Yang Dikirim:') !!}
          <div class="col-lg-12 col-sm-12">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          <ol id="file_upload" class="d-none">
  
          </ol>
        </div>
        {{-- <div class="col-lg-12 col-sm-12">
          <div id="show_docs" hidden>
            
          </div>
        </div> --}}
      </div>
      <div class="form-group">
        {!! Form::label('foto_kegiatan', 'Dokumentasi Kegiatan Yang Dikirim:') !!}
        <div class="col-lg-12 col-sm-12">
          <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        <div id="img_upload" class="d-none">

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
                {!! Form::date('mulai_kegiatan', $dokumentasi_kegiatan->mulai_kegiatan , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('akhir_kegiatan', 'Akhir dari Kegiatan:') !!}
                {!! Form::date('akhir_kegiatan', $dokumentasi_kegiatan->akhir_kegiatan , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
            <button type="button" class="btn btn-success btn-md rounded-pill button_show" data-toggle="modal" data-target="#modal_menerima">
                Menerima Laporan Kegiatan
              </button>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
            <button type="button" class="btn btn-warning btn-md rounded-pill button_show" data-toggle="modal" data-target="#modal_ajukan_ulang">
                Melakukan Pengajuan Ulang
              </button>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="modal_menerima" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Persetujuan Laporan Kegiatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="keterangan_error d-none">

          </ul>
            {!! Form::open(['method' => 'PUT', 'action' => ['KepalaSekolahMengelolaKegiatanController@updateDokumentasi' , $dokumentasi_kegiatan->id], 'files'=>true , 'id' => 'menerima']) !!}
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Untuk Kegiatan yang berjudul:</label>
                    <h4>{{ $dokumentasi_kegiatan->nama_kegiatan }}</h4>
                </div>
                <div class="form-group">
                    {!! Form::hidden('id_keterangan', 1)!!}
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
<div class="modal fade" id="modal_ajukan_ulang" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Pengajuan Ulang Laporan Kegiatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'PUT', 'action' => ['KepalaSekolahMengelolaKegiatanController@updateDokumentasi' , $dokumentasi_kegiatan->id], 'files'=>true , 'id' => 'pengajuan_ulang']) !!}
            <div class="form-group">
              <ul class="keterangan_error d-none">

              </ul>
              <label for="recipient-name" class="col-form-label">Untuk Kegiatan yang berjudul:</label>
              <h4>{{ $dokumentasi_kegiatan->nama_kegiatan }}</h4>
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

 {{-- <!-- Modal to show file -->
 <div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                  <div class="modal-body">
                      <iframe src="" width="450" height="500"></iframe>
                  </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                  </div>    
              </div>
          </div> --}}
          
@endsection

@section('script')
    <script>  
      $("textarea").each(function(){
        $(this).val('');
      });
      let modalState = "";
      let url_get_data = '/kepala-sekolah/get-kegiatan/dokumentasi_kegiatan/type_kegiatan/';
      const value = document.getElementsByName('id-doc-evt').item(0).getAttribute('value');
      const backButtonElement = document.getElementById('back-button');
      let statusData = true;
      url_get_data = url_get_data.replace('dokumentasi_kegiatan' , value);
      url_get_data = url_get_data.replace('type_kegiatan' , 'dokumentasi');
      $.get(url_get_data, function(res){
        console.log(res);
        statusData = res.status;
        const keterangan = res.keterangan_dokumentasi;
        const nilai_ppk = JSON.parse(res.data.nilai_ppk);

        keterangan.forEach(element => {
          if (element.no === 2) {
            if (element.keterangan_wajib_ulang !== "") {
              document.querySelector('.histori_kegiatan').classList.remove('d-none');
              $('.histori_kegiatan').append("Keterangan Yang Telah Dikirim: "+element.keterangan_wajib_ulang); 
            }
          }
        });

        nilai_ppk.forEach(element => {
          $("[value = '"+element.nilai_ppk+"']").attr('checked' , true);
        });
        if (!statusData) {
          $("#file_upload").append('<li class="mb-2">'+res.dokumen+'</li>');
          $("#img_upload").append(res.image);
        } else {
          const dokumen_kegiatan = res.dokumen;    
          if (dokumen_kegiatan.length > 0) {
            dokumen_kegiatan.forEach(element => {      
              const fileName = element.nama_dokumen;
              let assets = '{{asset("kegiatan/dokumentasi_kegiatan/docs")}}';
              assets = assets.replace('docs' , fileName);
              if (fileName.search('.docx') === -1 || fileName.search('.doc') === -1) {
                $("#file_upload").append('<li class="mb-2"><i class="fas fa-file-alt mr-2"></i>'+fileName+'<button class="btn btn-primary btn-sm lihat_file ml-2 mr-2" value="'+assets+'">Lihat File</button><a href="'+assets+'" download="'+fileName+'" class="btn btn-info btn-sm mr-2">Download File</a></li>');
              } else if(fileName.search('.pdf') === -1){
                $("#file_upload").append('<li class="mb-2"><i class="fas fa-file-alt mr-2"></i>'+fileName+'<a href="'+assets+'" download="'+fileName+'" class="btn btn-info btn-sm ml-2">Download File</a></li>');
              }
            });  
          } else {
            $("#file_upload").append('<li class="mb-2">'+dokumen_kegiatan+'</li>');
          }
        
          const image_kegiatan = res.image;
          if (image_kegiatan.length > 0) {
            image_kegiatan.forEach(element => {
              const imgName = element.nama_foto_kegiatan;
              let assets = '{{asset("kegiatan/dokumentasi_kegiatan/image")}}';
              assets = assets.replace('image' , imgName);
              $("#img_upload").append('<img class="rounded-circle mb-2 mt-2 mr-2" src="'+assets+'" alt="" width="150" height="150">'+imgName+'<button type="button" class="btn btn-primary btn-sm lihat_file mr-2 ml-2" value="'+assets+'">Lihat File</button><a href="'+assets+'" class="btn btn-info btn-sm ml-2 mr-2" download="'+imgName+'">Download File</a><br>');
            });  
          } else {
            $("#img_upload").append('<ol><li class="mb-2">'+image_kegiatan+'</li></ol>');
          } 
        }
      }).done(function(){
        const spinner = document.getElementsByClassName('spinner-border');
        const nilaiPPK = document.getElementById('nilai_ppk_group');
        document.getElementById('img_upload').classList.remove('d-none');
        document.getElementById('file_upload').classList.remove('d-none');
        nilaiPPK.classList.remove('d-none');
        for (let index = 0; index < spinner.length; index++) {
          const element = spinner[index];
          element.classList.add('d-none');
        }
        if (statusData) {
          const lihatDokumen = document.getElementsByClassName('lihat_file');
          for (let index = 0; index < lihatDokumen.length; index++) {
            const element = lihatDokumen[index];
            element.addEventListener('click', () => {
              window.open(element.getAttribute('value'));
            });
          }
        }
      }).fail(function(responseError){
        if (responseError.status === 401 || responseError.status === 404) {
          let jsonResponse = JSON.parse(responseError.responseText);
          errorNotifications(responseError.status, jsonResponse, 'getData');
        } else {
          errorNotifications(responseError.status, responseError, 'getData');
        }
      });

      backButtonElement.addEventListener('click', (e) => {
        e.preventDefault();
        const link = backButtonElement.getAttribute('href');
        window.location.replace(link);
      });

      $(document).on('click', '.button_show', function(){
        modalState = $(this).attr('data-target');
        $(modalState).modal();
      });

      $("#modal_menerima").on('hidden.bs.modal', function(){
        resetKeterangan('modal', 'menerima');
      });

      $("#modal_pengajuan_ulang").on('hidden.bs.modal', function(){
        resetKeterangan('modal', 'pengajuan_ulang');
      });

      $('form').on('submit', function(e){
        e.preventDefault();
        const form_value = $(this).attr('id');
        const url = $(this).attr('action');
        $.ajaxSetup({
          headers:{
            'X-CSRF-TOKEN': $("[name = '_token']").val()
          }
        });
        $.ajax({
          url: url,
          type: 'PUT',
          data: $(this).serialize(),
          beforeSend: function(){
            loadingBar(true);
          },
          success: function(response){
            console.log(response);
            loadingBar(false);
            $(modalState).modal('hide');
            Swal.fire({
              icon: 'success',
              title: 'Sukses Mengambil Keputusan Laporan Kegiatan',
              text: response.message,
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false
            }).then((result)=>{
              window.location.replace('/kepala-sekolah/dokumentasi-kegiatan');
            });
          },
          error: function(responseError){
            console.log(responseError);
            loadingBar(false);
            if (responseError.status === 401) {
              const jsonLoginInfo = JSON.parse(responseError.responseText);
              errorNotifications(responseError.status, jsonLoginInfo, 'login');
            } else if(responseError.status === 404){
              const jsonDataNotFound = JSON.parse(responseError.responseText);
              if (typeof jsonDataNotFound.messages === 'string') {
                Swal.fire({
                  icon: 'error',
                  title: 'Error Data Tidak Ditemukan',
                  text: jsonDataNotFound.messages
                });
              } else{
                errorNotifications(response.status, responseError, 'form');
              }
            } else if(responseError.status === 422){
               const jsonErrorData = JSON.parse(responseError.responseText);
               Swal.fire({
                 icon: 'error',
                 title: 'Error',
                 text: "Terdapat Error, silahkan lihat diatas form!",
               }).then((result) => {
                if (result.value) {
                  $(modalState).scrollTop(0);
                }
               });
               $(".keterangan_error").css({
                  "background-color": "#e53e3e",
                  "color": "white", 
                  "border-radius": "10px"
               });
               $.each(jsonErrorData.errors, function(key, value){
                  $(".keterangan_error").append('<li class="mb-2">'+value+'</li>');
               });
            } else {
              errorNotifications(response.status, responseError, 'form');
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

      function characterCount(str , stateKeterangan) {
        var lng = str.length;
        if(stateKeterangan === "keterangan_ulang"){
          document.querySelector('.count_keterangan_ulang').innerHTML = lng + ' / 255 Karakter'
          if (lng > 255) {
            $(".error_count_ulang").html('Keterangan melebihi '+lng+' / 255 Karakter');
            $(".error_count_ulang").prop('hidden', false);
            $(".btn_keterangan_ulang").prop('disabled', true);
          } else {
            resetKeterangan('counter' , stateKeterangan);
          } 
        } else if(stateKeterangan === 'keterangan_opsional'){
          document.querySelector('.count_keterangan_opsional').innerHTML = lng + ' / 255 Karakter'
          if (lng > 255) {
            $(".error_count_opsional").html('Keterangan melebihi '+lng+' / 255 Karakter');
            $(".error_count_opsional").prop('hidden', false);
            $(".btn_keterangan_opsional").prop('disabled', true);
          } else {
            resetKeterangan('counter' , stateKeterangan);
          } 
        }
      }

      function errorNotifications(status, errorMessage, type){
        const url = '{{route("kepsek.pengajuan_dokumentasi_kegiatan.index")}}';
        if (status === 401 && type === 'login') {
          Swal.fire({
              icon: 'info',
              title: 'Please Login',
              text : errorMessage.message,
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false
            }).then((result)=>{
              window.location = '/';
            });
        } else if (type === 'getData') {
          if(status === 404){
            if (typeof errorMessage.messages === 'string') {
              Swal.fire({
                  icon: 'error',
                  title: 'Error Saat Pengambilan Data',
                  text: errorMessage.messages,
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: false
                }).then((result)=>{
                  window.location = url;
              });  
            } else {
              Swal.fire({
                  icon: 'error',
                  title: 'Error Saat Pengambilan Data',
                  text: 'System Error Code: '+errorMessage.status+": "+errorMessage.statusText,
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                  allowEnterKey: false
                }).then((result)=>{
                  window.location = url;
              });  
            }
          } else {
            Swal.fire({
              icon: 'error',
              title : 'Error',
              text: 'System Error Code: '+errorMessage.status+": "+errorMessage.statusText,
              allowOutsideClick: false,
              allowEscapeKey: false,
              allowEnterKey: false
            }).then((result) =>{
              window.location = url;
            });
            // console.log(responseError);
            // return url;
          }  
        } else if(type === 'form'){
            if (status === 404) {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "Status Code: "+errorMessage.status+": "+errorMessage.statusText
              });
            } else {
              Swal.fire({
                  icon: 'error',
                  title: 'Error',
                  text: "Status Code: "+errorMessage.status+": "+errorMessage.statusText
              });
            }
        }
      }

      function resetKeterangan(type, keteranganType){
        if (type === 'modal') {
          $(".keterangan_error").empty();
          $(".keterangan_error").addClass('d-none');
          document.querySelector('.keterangan').value = '';
          modalState = "";
          if (keteranganType === 'menerima') {  
            $(".count_keterangan_opsional").html('0 / 255 Karakter');
            $(".error_count_opsional").prop('hidden', true);
          } else if(keteranganType === 'pengajuan_ulang'){
            $(".count_keterangan_ulang").html('0 / 255 Karakter');
            $(".error_count_ulang").prop('hidden', true);
          }
          $("textarea").each(function(){
            $(this).val('');
          });
        } else if(type === 'counter'){
          if (keteranganType === 'keterangan_opsional') {
            $(".error_count_opsional").empty();
            $(".error_count_opsional").prop('hidden', true);
            $(".btn_keterangan_opsional").prop('disabled', false);
          } else if(keteranganType === 'keterangan_ulang') {
            $(".error_count_ulang").empty();
            $(".error_count_ulang").prop('hidden', true);
            $(".btn_keterangan_ulang").prop('disabled', false);
          }
        }
      }
    </script>
@endsection