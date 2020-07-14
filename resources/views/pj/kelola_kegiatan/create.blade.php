@extends('layouts.template_PJ')

@section('title')
    Pengajuan Kegiatan PPK
@endsection

@section('content')
<h1>Pembuatan Pengajuan Kegiatan PPK</h1>

    @include('_partials/form_error')

    @if (Session::has('date_akhir_past'))
        <b class="bg-danger" style="color: white">{{ session('date_akhir_past') }}</b>
    @elseif(Session::has('danger'))
        <b class="bg-danger" style="color: white">{{ session('danger') }}</b>
    @elseif(Session::has('warning'))
        <b class="bg-warning" style="color: white">{{ session('warning') }}</b>
    @endif

    {!! Form::open(['method' => 'POST', 'action' =>'PJMengelolaKegiatanController@store', 'files'=> true]) !!}
    
    <div class="form-group">
        {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('PJ_nama_kegiatan', null , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
        {!! Form::select('nilai_ppk', array('' => 'Choose Options', 'Religius' => 'Religius', 'Integritas' => 'Integritas', 'Mandiri' => 'Mandiri', 'Nasionalis' => 'Nasionalis', 'Gotong Royong' => 'Gotong Royong') ,null , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
        {!! Form::select('kegiatan_berbasis', array('' => 'Choose Options', 'Berbasis Kelas' => 'Berbasis Kelas', 'Berbasis Budaya Sekolah' => 'Berbasis Budaya Sekolah', 'Berbasis Masyarakat' => 'Berbasis Masyarakat') ,null , ['class' => 'form-control']) !!}
    </div>
    {!! Form::label('dokumen_kegiatan', 'Unggah Proposal Pengajuan Kegiatan: ') !!}
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="form-group" id="upload-file">
            {{-- <button type="button" name="add" id="add" class="btn btn-success btn-sm">Add More</button>  --}}
            {!! Form::file('dokumen_kegiatan') !!}
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                {!! Form::date('mulai_kegiatan', $currentTime , ['class' => 'form-control']) !!}    
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('akhir_kegiatan', 'Akhir dari Kegiatan:') !!}
                {!! Form::date('akhir_kegiatan', \Carbon\Carbon::tomorrow() , ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::submit('Submit Pengajuan', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@endsection

{{-- @section('script')
<script>
$(document).ready(function(){  
    var i=1;  
    $('#add').click(function(){  
         i++;  
         $('#upload-file').append('<input type="file" name="dokumen_kegiatan[]" id="row'+i+'" placeholder="Enter your Name" /><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>');  
    });  
    $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#'+button_id+'').remove();  
         $('#row'+button_id).remove();
    });  
});  
</script>
@endsection --}}