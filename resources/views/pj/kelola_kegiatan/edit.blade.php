@extends('layouts.template_PJ')

@section('title')
Penanggung Jawab - Pengajuan Ulang Kegiatan
@endsection

@section('content')
    <h1>Pengajuan Ulang Kegiatan</h1>
    
    @include('_partials/form_error')

    @if (Session::has('date_akhir_past'))
        <b class="bg-danger" style="color: white">{{ session('date_akhir_past') }}</b>
    @elseif(Session::has('gagal'))
        <b class="bg-warning" style="color: white">{{ session('gagal') }}</b>
    @endif
    
    {{-- show kenapa ada keterangan ulang --}}
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <table class="bg-warning text-white">
                <thead>
                <tr>
                    <th>
                        Keterangan yang ditemukan:
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($keterangan_pengajuan as $keterangan)                
                <tr>
                    @if ($keterangan->no == 1)
                        @continue
                    @elseif($keterangan->no == 2)
                        <td>
                            @if ($keterangan->keterangan_wajib_ulang == "")
                                @continue
                            @else
                                &bull; {{ $keterangan->keterangan_wajib_ulang }}    
                            @endif    
                        </td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-lg-6">
            {{-- kalo misalnya butuh dokumen apa saja yang diinginkan --}}
        </div>
    </div>
    {{--  --}}
    {!! Form::open(['method' => 'PUT', 'action' => ['PJMengelolaKegiatanController@update', $pengajuan_kegiatan->id], 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('PJ_nama_kegiatan', $pengajuan_kegiatan->PJ_nama_kegiatan , ['class' => 'form-control']) !!}
    </div>

    <h5 class="font-weight-bold">Data Pengajuan Lama: </h5>
    <p>{{ $pengajuan_kegiatan->nilai_ppk }}</p>
    <div class="form-group">
        {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
        {!! Form::select('nilai_ppk', array('' => 'Choose Options', 'Religius' => 'Religius', 'Integritas' => 'Integritas', 'Mandiri' => 'Mandiri', 'Nasionalis' => 'Nasionalis', 'Gotong Royong' => 'Gotong Royong') ,null , ['class' => 'form-control']) !!}
    </div>

    <h5 class="font-weight-bold">Data Pengajuan Lama: </h5>
    <p>{{ $pengajuan_kegiatan->kegiatan_berbasis }}</p>
    <div class="form-group">
        {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
        {!! Form::select('kegiatan_berbasis', array('' => 'Choose Options', 'Berbasis Kelas' => 'Berbasis Kelas', 'Berbasis Budaya Sekolah' => 'Berbasis Budaya Sekolah', 'Berbasis Masyarakat' => 'Berbasis Masyarakat') ,null , ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        @foreach ($dokumen_kegiatan as $item)
            @if ($item->dokumen_id == 1)
                {!! Form::hidden('dokumen_kegiatan_lama', $item->nama_dokumen ) !!}
                <h3>Dokumen Lama: </h3> <i class="fas fa-file-alt"></i> <a href="{{ asset('kegiatan/pengajuan_kegiatan/'.$item->nama_dokumen) }}" download="{{ asset('kegiatan/pengajuan_kegiatan/'.$item->nama_dokumen) }}">{{ $item->nama_dokumen }}</a>
                <br>
            @endif
        @endforeach
        {!! Form::label('dokumen_kegiatan', 'Unggah Dokumen Pengajuan Ulang:', ['class' => 'mt-4']) !!}
        <br>
        {!! Form::file('dokumen_kegiatan', null , ['class' => 'form-control']) !!}
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                {!! Form::date('mulai_kegiatan', \Carbon\Carbon::now() , ['class' => 'form-control']) !!}
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