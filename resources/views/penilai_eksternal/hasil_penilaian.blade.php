@extends('layouts.template_eksternal')

@section('title')
    Penilai Eksternal - Hasil Assessmen
@endsection

@section('content')
    <h1>Hasil Assessmen</h1>
    <div class="col-sm-12">
        <table class="table table-bordered table-striped" id="assessmen">
               <thead>
                <tr>
                    <th width="10%">Nama Assessmen</th>
                    <th width="20%">Nama Sekolah</th>
                    <th width="20%">Nama Kepsek</th>
                    <th width="25%">User yang menilai</th>
                    <th width="30%">Action</th>
                </tr>
               </thead>
           </table>
       </div>
@endsection

@section('script')
<script>
$(document).ready(function(){

    $('#assessmen').DataTable({
     processing: true,
     serverSide: true,
     ajax:{
      url: "{{ route('penilai_eksternal.hasil_penilaian') }}",
     },
     columns:[
      {
       data: 'nama_assessment',
       name: 'nama_assessment'
      },
      {
       data: 'nama_sekolah',
       name: 'nama_sekolah'
      },
      {
        data: 'nama_kepsek',
       name: 'nama_kepsek'
      },
      {
        data: 'user.name',
        name: 'user.name'
      },
      {
       data: 'action',
       name: 'action',
       orderable: false
      }
     ]
    });

    $(document).on('click',  '.edit' ,  function(){
        var value = $(this).attr('id');
        var url = "{{route('penilai_eksternal.show', 'id')}}";
        url = url.replace("id", value);
        window.location.assign(url);
    });
});
</script>
@endsection