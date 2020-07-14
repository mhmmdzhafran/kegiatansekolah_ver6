@extends('layouts.template_eksternal')

@section('title')
    
@endsection

@section('content')
    <h1>Assessment Eksternal</h1>
    {{-- {!! Form::open(['method' => 'POST', 'action' => 'PenilaiEksternalController@store']) !!} --}}
    <div class="row">
        <div class="col-lg-12 col-sm-12">

        
    <ul class="kurang_indikator" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
</div>
</div>
    <form  id="userForm" name="userForm" class="form-horizontal">
        {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <table class="table table-bordered">
                    <thead>
                        <th>Isi Data Assessment</th>
                    </thead>
                    <tbody>
                        <td>
                       Nama Sekolah: <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control">
                        Alamat: <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="form-control">
                        Nama Kepala Sekolah: <input type="text" name="nama_kepsek" id="nama_kepsek" class="form-control">
                        Nomor HP: <input type="text" name="no_hp" id="no_hp" class="form-control">
                        Email: <input type="email" name="email_kepsek" id="email_kepsek" class="form-control">
                    </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>   
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12"> 
                <table class="table table-bordered">
                    <thead class="">
                        <th>Isi Assessment</th>
                    </thead>
                    <tbody>
                        <td>
                            <div id="accordion">
                                @include('_partials/assessment_indikator1')

                                @include('_partials/assessment_indikator2')
       
                                @include('_partials/assessment_indikator3')
        
                                @include('_partials/assessment_indikator4')

                                @include('_partials/assessment_indikator5')
          
                                @include('_partials/assessment_indikator6')

                                @include('_partials/assessment_indikator7')

                                @include('_partials/assessment_indikator8')
          
                                @include('_partials/assessment_indikator9')
          
                                @include('_partials/assessment_indikator10')
                            </div>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12 submit">
            <button type="submit" class="btn btn-primary rounded-pill mt-4 mb-4" id="submit">Submit Assessment</button>          
        </div>
    </div>
</div>
</form>
{{-- {!! Form::close() !!}       --}}

<!-- Modal for Ajax -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-lg-12 col-sm-12">
            <div class="modal_success">
            <img src="{{ asset('success/success_indicator.gif') }}" alt="" width="300" height="300">
            </div>
        <p class="success" style="text-align: center"></p>
        </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="#" class="btn btn-primary submit">Save changes</a>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            var link_assessment = "";
            $(document).on('click', '#submit', function(e){
                //add ajax functionality here 
                e.preventDefault();
                $(".kurang_indikator").empty();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('[name="_token"]').val()
                        }
                });
                $.ajax({
                    url: "/penilai-eksternal/assessment/store",
                    type: "POST",
                    data: 
                        $("#userForm").serialize(),
                    success: function(result){
                        if(result.message.includes("berhasil")){
                            $(".success").empty();
                            $("#exampleModalCenter").modal();
                           var nama_sekolah =  $("#nama_sekolah").val();
                           $(".success").append("Berhasil Melakukan Assessment, silahkan lihat Skor Dari sekolah " + nama_sekolah);
                            //add link to button
                            link_assessment = '{{route("penilai_eksternal.show" , "id")}}';
                            link_assessment = link_assessment.replace("id" , result.data);
                            $(".submit").attr("href", link_assessment);
                        }
                    },
                    error: function(result){        
                        $(".kurang_indikator").empty();
                        var json = $.parseJSON(result.responseText);
                        $.each(json.errors, function(key, value){
                            $(".kurang_indikator").append('<li class="font-weight-bold">'+value+'</li>');
                        });
                        $(window).scrollTop(0); 
                    }
                });
            });
            $("#exampleModalCenter").on('hidden.bs.modal', function(){
                window.location.replace(link_assessment);
            });
        });
    </script>
@endsection