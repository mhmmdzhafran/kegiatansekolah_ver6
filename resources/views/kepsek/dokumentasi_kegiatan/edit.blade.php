@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Edit Dokumen Kegiatan {{ $dokumentasi->nama_kegiatan }}
@endsection

@section('content')
    <h1>Edit Dokumen Kegiatan</h1>

    @include('_partials/form_error')
    @if (Session::has('danger'))
    <ul class="bg-danger">
        <li style="color: white">
            {{ Session::get('danger') }}   
        </li>
    </ul>
    @elseif(Session::has('warning'))
    <ul class="bg-warning">
        <li style="color:white">
            {{ Session::get('warning') }}   
        </li>
    </ul>
    @elseif(Session::has('success'))
    <h4 class="bg-success" style="color:white">File Sukses Diupload</h4>
    @endif
    @if ($dokumen_extension == "png" || $dokumen_extension == "jpeg" || $dokumen_extension == "pdf" )
        <h3>Preview Dokumen</h3>
        <iframe src="{{ asset('kegiatan/dokumentasi_kegiatan/'.$dokumen->nama_dokumen) }}" frameborder="0" width="1000" height="250"></iframe>   
        <h4>Pergantian Data Dokumentasi</h4>
        <b>Dokumen Sebelumnya: </b> 
        <br>
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <i class="fas fa-file-alt"></i> <a href="{{ asset('kegiatan/dokumentasi_kegiatan/'.$dokumen->nama_dokumen) }}" download="{{ $dokumen->nama_dokumen }}">{{ $dokumen->nama_dokumen }}</a>
            </div>
        </div>
        {!! Form::open(['method' => 'PUT', 'action' => ['KepalaSekolahDokumentasiController@update', $id_doc, $id_documentation], 'files' => true]) !!}
        {!! Form::file("dokumen_kegiatan", ['class' => 'mt-2 mb-2']) !!}
        <br>
        {!! Form::submit("Ganti Dokumen", ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::close() !!}
    @else
    <hr>
        <h4>Pergantian Data Dokumentasi</h4>
        <b>Dokumen Sebelumnya: </b> 
        <i class="fas fa-file-alt"></i> <a href="{{ asset('kegiatan/dokumentasi_kegiatan/'.$dokumen->nama_dokumen) }}" download="{{ $dokumen->nama_dokumen }}">{{ $dokumen->nama_dokumen }}</a>
        {!! Form::open(['method' => 'PUT', 'action' => ['KepalaSekolahDokumentasiController@update', $id_doc, $id_documentation], 'files' => true]) !!}
        {!! Form::file("dokumen_kegiatan", ['class' => 'mt-2 mb-2']) !!}
        <br>
        {!! Form::submit("Ganti Dokumen", ['class' => 'btn btn-primary btn-sm']) !!}
        {!! Form::close() !!}
    @endif
@endsection