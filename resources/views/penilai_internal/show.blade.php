@extends('layouts.template_internal')

@section('title')
    Kepala Sekolah - Tabel Skor Penguatan Pendidikan Karakter
@endsection

@section('content')
    <h3> <a href="{{ route('penilai_internal.edit' , $assessmen_internal->id) }}" class="back"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Back</a> Hasil Penilaian Skor untuk Sekolah {{ $assessmen_internal->nama_sekolah }}</h3>
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
        @include('_partials/skor/skor_akhir_1')

        @include('_partials/skor/skor_akhir_2')

        @include('_partials/skor/skor_akhir_3')
        
        @include('_partials/skor/skor_akhir_4')

        @include('_partials/skor/skor_akhir_5')

        @include('_partials/skor/skor_akhir_6')
        
        @include('_partials/skor/skor_akhir_7')
        
        @include('_partials/skor/skor_akhir_8')
        
        @include('_partials/skor/skor_akhir_9')

        {@include('_partials/skor/skor_akhir_10')
        
        <tbody>
            <td class="font-weight-bold text-center">Hasil Akhir</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $assessmen_internal->skor_penilaian_kegiatan_akhir }}</td>
        </tbody>
    </table>

<!-- Modal for melihat detail assessmen -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalTitle">Penjelasan Assessmen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <b class="belum_asesmen mb-0" style="color:red"></b>
          <b class="detail_asesmen mb-0" style="color:black"></b>
          <br>  
          <b class="detail mb-0" style="color:black"></b>
          <br>  
          <b class="show_text"></b>
          <div class="show-dokumen ml-2">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary lakukan_asesmen">Lakukan Asesmen</button>
        </div>
        
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script>
        $(document).on('click','.lihat_indikator', function(){
            $(".detail").empty();
            var value = $(this).attr('value');
            var id = $(this).attr("id");
            var id_asesmen = $(this).attr("data-target");
            var skor_asesmen = $(this).attr("data-target2");
            var url = "{{route('penilai_internal.ambilDoc', ['id_asesmen' => 'ids', 'id' => 'id_indikator'])}}";
            url = url.replace('ids', id_asesmen);
            url = url.replace('id_indikator' , id);
            var url_load = "{{route('penilai_internal.edit', ['id_asesmen' => 'id'])}}";
            url_load = url_load.replace('id', id_asesmen);
            $.ajax({
                url: url,
                type: 'GET',
                dataType:"json",
                beforeSend: function(){ 
                  $(".show_text").empty();
                  $(".show-dokumen").empty();
                  $(".detail").empty();     
                  $(".detail_asesmen").empty();
                  $(".belum_asesmen").empty();
                  $("#myModal").modal();
                },
                success: function(res){
                  if (res.data.length == 0) {
                    $(".belum_asesmen").append("Belum Melakukan Asesmen! <br>");
                    $(".show_text").append('Belum terdapat bukti dokummen'); 
                  } else {
                    $(".detail").append(value);
                    $(".detail_asesmen").append("Skor Asesmen Sementara");
                    $.each(res.data, function(key,value){
                      var dokumen_link = "{{asset('kegiatan/asesmen_internal/link')}}";
                      dokumen_link = dokumen_link.replace('link', value.nama_dokumen_asesmen);
                      $(".show-dokumen").append('<li> <i class="fa fa-file-alt"></i> '+value.nama_dokumen_asesmen+'</li> <button class="btn btn-primary btn-sm lihat_file" type="button" value="'+dokumen_link+'">Lihat File</button>');
                    });
                    $(".show_text").append('Bukti Dokumen Asesmen'); 
                  }
                  $(".lakukan_asesmen").on('click', function(){
                    window.location = url_load;
                  });
                },
                error: function(res){
                  $(".detail_asesmen").append("Tidak terdapat Asesmen");
                  var value_error = $.parseJSON(res.responseText);
                  $(".detail").append(value_error.errors);
                  $(".lakukan_asesmen").on('click', function(){
                    window.location = "/penilai-internal/assessment/1/edit";
                  });
                }
            });
        });
        $(document).on('click', '.lihat_file' ,  function(){
          var value = $(this).attr('value');
          window.open(value);
        });
    </script>
@endsection