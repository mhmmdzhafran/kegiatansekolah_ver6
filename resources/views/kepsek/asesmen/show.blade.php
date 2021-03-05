@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Tabel Skor Penguatan Pendidikan Karakter
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 col-sm-12">
      <h2>Hasil Penilaian Skor Asesmen PPK</h2>
    </div>
    <div class="col-lg-6 col-sm-12">
      <button type="button" class="btn btn-info rounded-pill float float-md-left float-sm-left float-lg-right" id="back_asesmen" data-target="{{$id_asesmen}}">Kembali Asesmen</button>
    </div>
</div>
<div class="form-group">  
  <h4>Nama Sekolah:</h4>
  <input type="text" value="{{$assessmen_internal->nama_sekolah}}" class="form-control form-control-user" disabled autofocus style="border-radius: 20px">
</div>
<div class="card shadow-sm">
    <table class="table table-bordered">
        <thead>
            <th>Penjelasan</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>Rerata</th>
        </thead>
        @php
          $assessment_limit_kategori_1 = 5;
          $counter_limit_asesment_2 = 6;
          $assessment_limit_kategori_2 = 8;
          $counter_limit_asesment_3 = 9;
          $assessment_limit_kategori_3 = 11;
          $counter_limit_asesment_4 = 12;
          $assessment_limit_kategori_4 = 14;
          $counter_limit_asesment_5 = 15;
          $assessment_limit_kategori_5 = 21;
          $counter_limit_asesment_6 = 22;
          $assessment_limit_kategori_6 = 25;
          $counter_limit_asesment_7 = 26;
          $assessment_limit_kategori_7 = 29;
          $counter_limit_asesment_8 = 30;
          $assessment_limit_kategori_8 = 35;
          $counter_limit_asesment_9 = 36;
          $assessment_limit_kategori_9 = 40;
          $counter_limit_asesment_10 = 41;
          $assessment_limit_kategori_10 = 49;
        @endphp

        @include('_partials/skor/skor_akhir_1')

        @include('_partials/skor/skor_akhir_2')

        @include('_partials/skor/skor_akhir_3')
        
        @include('_partials/skor/skor_akhir_4')

        @include('_partials/skor/skor_akhir_5')

        @include('_partials/skor/skor_akhir_6')
        
        @include('_partials/skor/skor_akhir_7')
        
        @include('_partials/skor/skor_akhir_8')
        
        @include('_partials/skor/skor_akhir_9')

        @include('_partials/skor/skor_akhir_10')
        
        <tbody>
            <td class="font-weight-bold text-center">Hasil Akhir</td>
            <td style="background-color: grey"></td>
            <td style="background-color: grey"></td>
            <td style="background-color: grey"></td>
            <td style="background-color: grey"></td>
            <td style="background-color: grey"></td>
            <td style="background-color: grey"></td>
            <td style="background-color: grey"></td>
            <td style="background-color: grey"></td>
            <td style="background-color: grey"></td>
            <td>{{ $assessmen_internal->skor_penilaian_kegiatan_akhir }}</td>
        </tbody>
    </table>
</div>
<!-- Modal for melihat detail assessmen -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalTitle">Skor Indikator Assessmen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="show_penjelasan"></div>
          <b class="belum_asesmen mb-0" style="color:red"></b>
          <b class="detail_asesmen mb-0" style="color:black"></b>
          <br>  
          <b class="detail" style="color:black"></b>
          <br>
          <div class="detail_saran mt-2 mb-3 font-weight-bolder" style="color: black;">
            {{-- <b class="detail_saran" style="color:black"></b> --}}
          </div>
          <b class="show_dokumen_text"></b>
          <div class="show-dokumen ml-2"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success lakukan_asesmen">Lakukan Asesmen</button>
        </div>
        
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script>
      var id_asesmen = "";
        $(document).on('click','.lihat_indikator', function(){
            $(".show-dokumen").empty();
            $(".detail").empty();
            $(".detail_saran").empty();     
            $(".detail_asesmen").empty();
            $(".belum_asesmen").empty();
            $(".show_penjelasan").empty();
            $(".show_dokumen_text").empty();
            $(".detail_saran").removeClass('alert alert-info alert-heading');
            
            // var value = $(this).attr('value');
            var id = $(this).attr("id");
            id_asesmen = $(this).attr("data-target");
            var skor_asesmen = $(this).attr("data-target2");
            var url = "{{route('kepsek.asesmen.ambilSkor', ['id_asesmen' => 'ids', 'id_indikator' => 'id_indikator_asesmen', 'skor_indikator' => 'skor_asesmen'])}}";
            url = url.replace('ids', id_asesmen);
            url = url.replace('id_indikator_asesmen' , id);
            url = url.replace('skor_asesmen' , skor_asesmen);
            var url_load = "{{route('kepsek.asesmen.edit', ['asesmen_ppk' => 'id'])}}";
            url_load = url_load.replace('id', id_asesmen);
            $.ajax({
                url: url,
                type: 'GET',
                dataType:"json",
                beforeSend: function(){ 
                  loading_bar('show');
                },
                success: function(res){
                  loading_bar('hide');
                  $("#myModal").modal();
                  $(".show_penjelasan").append('<b style="color:black">Penjelasan Asesmen:</b><br><h5>'+res.penjelasan_asesmen+'</h5><hr>');
                  $(".show_dokumen_text").append('Bukti Dokumen Asesmen<br>');  
                  if (res.status_asesmen == "") {
                    $(".belum_asesmen").append("Belum Melakukan Asesmen! <br>");
                    $(".show_dokumen_text").append('Belum terdapat bukti dokumen'); 
                  } else {
                    $(".detail").append(res.keterangan_skor);
                    $(".detail_saran").addClass('alert alert-info alert-heading');
                    $(".detail_saran").append("Saran Yang Diberikan: <br>");
                    $(".detail_saran").append(res.saran);
                    $(".detail_asesmen").append("Skor Asesmen Sementara");
                    if (res.data_dokumen.length == 0) {
                      $(".show_dokumen_text").append('Belum terdapat bukti dokummen'); 
                    } else {
                      $.each(res.data_dokumen, function(key,value){
                        let dokumen_link = "{{asset('storage/asesmen_internal/link')}}";
                        dokumen_link = dokumen_link.replace('link', value.nama_dokumen_asesmen);
                        $(".show-dokumen").append('<li> <i class="fa fa-file-alt"></i> '+value.nama_dokumen_asesmen+'</li> <button class="btn btn-primary btn-sm lihat_file mb-3" type="button" value="'+dokumen_link+'">Lihat File</button> <a href="'+dokumen_link+'" class="btn btn-info btn-sm mb-3" download="'+value.nama_dokumen_asesmen+'">Download File</a>');
                      });
                    }
                    document.querySelector('.lihat_file').addEventListener('click', function(){
                      let value = $(this).attr('value');
                      window.open(value);
                    });
                  }
                  $(".lakukan_asesmen").on('click', function(){
                    window.location.replace(url_load);
                  });
                },
                error: function(res){
                  loading_bar('hide');
                  if (res.status === 401) {
                    let login_notif = $.parseJSON(res.responseText);
                    alertNotifications(res.status, login_notif.message);
                  } else if(res.status === 404){
                    let value_error = $.parseJSON(res.responseText);
                    alertNotifications(res.status , value_error.messages);
                  } else{
                    anyError(res.status , res.statusText , res);
                  }
                }
            });
        });
        $("#back_asesmen").click(function(){
          let id_back_asesmen = $(this).attr('data-target');
            window.location.replace("/kepala-sekolah/asesmen-ppk/"+id_back_asesmen+"/edit");
        });

        function alertNotifications(status, error){
          if (status === 401) {
            // let back_to_login = "/kepala-sekolah/asesmen-ppk/"+id_asesmen+"/edit";
            let back_to_login = '/';
            Swal.fire({
              icon: 'info',
              title: 'Please Login',
              text: error
            }).then((result)=>{
              window.location.replace(back_to_login);
            });
          } else if(status === 404){
            Swal.fire({
              icon: 'error',
              title: 'Terdapat Error Saat mengambil data',
              text: error
            });
          }
        }

        function anyError(status, statusText, errors){
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

        function loading_bar(condition){
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
    </script>
@endsection