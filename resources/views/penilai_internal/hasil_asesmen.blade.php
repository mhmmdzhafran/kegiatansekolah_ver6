@extends('layouts.template_internal')

@section('content')
    <h1>Asesmen User {{ Auth::user()->name }}</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="15%">Nama Sekolah</th>
                                    <th>Skor Akhir</th>
                                    <th width="10%">Nama User</th>
                                    <th width="10%">Username</th>
                                    <th width="10%">Dibentuk Tanggal</th>
                                    <th width="10%">Diperbarui Tanggal</th>
                                    <th width="25%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="modalLoading" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm bd-example-modal-sm modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script>    
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("penilai_internal.hasil_asesmen")}}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama_sekolah', name: 'nama_sekolah'},
            {data: 'skor_penilaian_kegiatan_akhir', name: 'skor_penilaian_kegiatan_akhir'},
            {data: 'user.name', name: 'user.name'},
            {data: 'user.email', name: 'user.email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at' , name: 'updated_at'},
            {data: 'Aksi' , name: 'Aksi'}
        ]
    });
    $(document).on('click', ".show", function(){
        var id = $(this).attr('id');
        var value_asesmen = $(this).attr('value');
        if (value_asesmen === "asesmen") {
            var url = '{{route("penilai_internal.edit", "id")}}';   
        } else if(value_asesmen === "lihat_table") {
            var url = '{{route("penilai_internal.show" , "id")}}';
        }
        url = url.replace('id', id);
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function(){
                $("#modalLoading").modal();
            },
            success: function(){
                $("#modalLoading").modal('hide');
                window.location = url;
            },
            error: function(res){
                console.log("error");
            },
        });
    });
    </script>
@endsection

