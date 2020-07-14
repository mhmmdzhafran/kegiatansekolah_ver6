@extends('layouts.template_kepsek')

@section('title')
    Pengajuan Kegiatan PPK
@endsection

@section('content')
<h1>Pembuatan Pengajuan Kegiatan PPK</h1>
@if (Session::has('sukses'))
    <hr>
    <b class="bg-success" style="color: white">{{ session('sukses') }}</b>
@elseif(Session::has('warning_ulang'))
    <hr>
    <b class="bg-success" style="color: white">{{ session('warning_ulang') }}</b>
@elseif(Session::has('danger'))
    <hr>
    <b class="bg-success" style="color: white">{{ session('danger') }}</b>
@else
    <hr>
    <b class="bg-warning" style="color: white">{{ session('warning') }}</b>
@endif

<h3 class="bg-danger text-center" style="color:white;">Status: {{ $status_kegiatan->nama }}</h3>

@foreach ($keterangan as $item)
    @if ($item->no == 1)
        @if ($item->keterangan_opsional == '')
            <h4 class="bg-primary text-center" style="color:white">Tidak Ada Keterangan Sukses</h4>
        @elseif($item->keterangan_opsional)
            <h4 class="bg-primary text-center" style="color:white">Keterangan Sukses: {{ $item->keterangan_opsional }}</h4>
        @else
            @continue
        @endif
    @elseif($item->no == 2)
        @if($item->keterangan_wajib_ulang)
            <h4 class="bg-primary text-center" style="color:white">Keterangan Pengajuan Ulang: {{ $item->keterangan_wajib_ulang }}</h4>
        @else
            @continue
        @endif
    @elseif($item->no == 3)
        @if($item->keterangan_wajib)
            <h4 class="bg-primary text-center" style="color:white">Keterangan Menolak: {{ $item->keterangan_wajib }}</h4>
        @else
            @continue
        @endif
    @endif
@endforeach

    <div class="form-group">
        {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('PJ_nama_kegiatan', $pengajuan_kegiatan->PJ_nama_kegiatan , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
        {!! Form::select('nilai_ppk', array('' => $pengajuan_kegiatan->nilai_ppk) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
        {!! Form::select('kegiatan_berbasis', array('' => $pengajuan_kegiatan->kegiatan_berbasis) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('dokumen_kegiatan', 'File yang diupload:') !!}
        <br>
        @if (is_null($dokumen_pengajuan))
            
        @else
            @foreach ($dokumen_pengajuan as $item)
            @if ($item->dokumen_id == 1)
            <i class="fas fa-file-alt"></i>
            <a href="{{ asset('kegiatan/pengajuan_kegiatan/'.$item->nama_dokumen) }}" download="{{ public_path('kegiatan/pengajuan_kegiatan/'.$item->nama_dokumen) }}">{{ $item->nama_dokumen }}</a>
            <br>
            @endif
            @endforeach
        @endif
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                {!! Form::date('mulai_kegiatan', $pengajuan_kegiatan->mulai_kegiatan , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('akhir_kegiatan', 'Akhir dari Kegiatan:') !!}
                {!! Form::date('akhir_kegiatan', $pengajuan_kegiatan->akhir_kegiatan , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
            </div>
        </div>
    </div>
    
@endsection