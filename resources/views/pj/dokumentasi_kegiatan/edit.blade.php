@extends('layouts.template_PJ')

@section('title')
    Penanggung Jawab - Pengajuan Dokumentasi Kegiatan PPK
@endsection

@section('content')
    <h1>Pengajuan Dokumentasi Kegiatan PPK</h1>
    @if (Session::has('date_akhir_past'))
        <b class="bg-danger" style="color: white">{{ session('date_akhir_past') }}</b>
    @elseif(Session::has('tidak_update'))
        <b class="bg-warning" style="color:white">{{ session('tidak_update') }}</b>
    @elseif(Session::has('gagal'))
        <b class="bg-warning" style="color:white">{{ session('gagal') }}</b>
    @elseif(Session::has('no_file'))
        <b class="bg-danger" style="color:white">{{ session('no_file') }}</b>
    @endif

    @include('_partials/form_error')

    {!! Form::open(['method' => 'PUT', 'action' =>['PJMengelolaKegiatanController@uploadDokumentasi' , $dokumentasi_kegiatan->id], 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('PJ_nama_kegiatan', $dokumentasi_kegiatan->nama_kegiatan , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>

    @foreach ($nilai_ppk_kegiatan_berbasis as $data)
        @if ($data->no == 1)

        <div class="form-group">
            {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
            {!! Form::select('nilai_ppk', array('' => $data->nilai_ppk) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>

        @elseif($data->no == 2)
        <div class="form-group">
            {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
            {!! Form::select('kegiatan_berbasis', array('' => $data->kegiatan_berbasis) ,null , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
        </div>

        @endif
    @endforeach

    {{-- <div class="form-group">
        
        {!! Form::label('dokumentasi_kegiatan_ppk', 'Insert a File:') !!}
        {!! Form::file('dokumentasi_kegiatan_ppk', null , ['class' => 'form-control']) !!}
    </div> --}}
    {!! Form::label('dokumentasi_kegiatan_ppk[]', 'Unggah Dokumentasi Kegiatan:') !!}
    <br>
    {!! Form::label('warning', '*Note: Jika terdapat dengan file yang sama, maka file tersebut akan ditimpa dengan file yang baru!', ['style' => 'color: red']) !!}
    <div class="col-sm-12 col-lg-6">
        <div class="form-group" id="upload-file">
            <button type="button" name="add" id="add" class="btn btn-success btn-sm mb-2">Add More</button>
            <br>
            {!! Form::file('dokumentasi_kegiatan_ppk[]') !!}
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                {!! Form::hidden('mulai_kegiatan', $dokumentasi_kegiatan->mulai_kegiatan) !!}
                {!! Form::date('mulai_kegiatan', $dokumentasi_kegiatan->mulai_kegiatan , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
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

@section('script')
<script>
$(document).ready(function(){  
    var i=1;  
    $('#add').click(function(){  
         i++;  
         $('#upload-file').append('<input type="file" name="dokumentasi_kegiatan_ppk[]" id="row'+i+'" placeholder="Enter your Name" /><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button>');  
    });  
    $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#'+button_id+'').remove();  
         $('#row'+button_id).remove();
    });  
});  
</script>
@endsection