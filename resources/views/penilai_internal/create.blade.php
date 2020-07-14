@extends('layouts.template_internal')

@section('content')
    <h1>Assessmen Internal</h1>

    {{-- <div class="row">
        <div class="col-lg-12 col-sm-12">        
            <ul class="kurang_indikator" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
        </div>
    </div> --}}
    {{-- <form  id="data_assessmen" name="data_assessmen" class="form-horizontal">
        {{ csrf_field() }} --}}
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Informasi Assessmen</h6>
                    </div>
                    <form  id="data_assessmen" name="data_assessmen" class="form-horizontal">
                        {{ csrf_field() }}
                    <div class="card-body">
                        <div class="information">
                            <ul class="kurang_indikator" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                        </div>
                        Nama Sekolah: <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control">
                        Alamat: <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="form-control">
                        Nama Kepala Sekolah: <input type="text" name="nama_kepsek" id="nama_kepsek" class="form-control">
                        Nomor HP: <input type="text" name="no_hp" id="no_hp" class="form-control">
                        Email: <input type="text" name="email_kepsek" id="email_kepsek" class="form-control">
                        <div class="col-sm-12 col-lg-12">
                            <div class="wrapper" style="text-align: center">
                                <button type="submit" class="btn btn-primary rounded-pill mt-4 mb-4" id="submit">Submit Assessment</button>          
                            </div>
                        </div>
                    </div>
                    </form>
                  </div>
            </div>
        </div>
    </div> 
    
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
            $("#submit").on('click', function(e){
                e.preventDefault();
                $(".kurang_indikator").empty();
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $("[name = '_token']").val()
                    }
                });
                $.ajax({
                    url: '/penilai-internal/assessment/store',
                    type: 'POST',
                    data: $("#data_assessmen").serialize(),
                    success: function(result){
                        var url = "{{route('penilai_internal.edit', 'id')}}";
                        url = url.replace('id', result.url);
                        $("#kurang_indikator").empty();
                        $(".success").empty();
                        $("#exampleModalCenter").modal();
                        $(".success").append("Data berhasil dimasukkan, silahkan melanjutkan assessmen!");
                        $(".submit").attr("href", url);
                    },
                    error: function(result){
                        $(".kurang_indikator").empty();
                        var error = $.parseJSON(result.responseText);
                        $.each(error.errors, function(key, value){
                            $(".kurang_indikator").append('<li>'+value+'</li>');
                        });
                        window.scrollTo(0,0);
                    }
                });
            });
        });
    </script>
@endsection