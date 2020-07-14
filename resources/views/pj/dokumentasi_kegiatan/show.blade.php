@extends('layouts.template_PJ')

@section('title')
    Penanggung Jawab - Status Dokumentasi Kegiatan
@endsection

@section('content')
    <h1>Status Dokumentasi Kegiatan</h1>
@if ($status_kegiatan->nama == "Sudah Disetujui")
    <h3 class="bg-success text-center" style="color:white">Status: {{ $status_kegiatan->nama }}</h3>
    @foreach ($keterangan as $item)
    
    @if ($item->no == 1)
        @if($item->keterangan_opsional == '')
        <h4 class="bg-primary text-center" style="color:white">Keterangan: Tidak Ada Keterangan</h4>
        @else
        <h4 class="bg-primary text-center" style="color:white">Keterangan: {{ $item->keterangan_opsional }} </h4>
        @endif
    @endif
    
    @endforeach

@elseif($status_kegiatan->nama == "Belum Disetujui")
    <h3 class="bg-danger text-center" style="color:white;">Status: {{ $status_kegiatan->nama }}</h3>
@endif
    <div class="form-group">
        {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('PJ_nama_kegiatan', $dokumentasi_kegiatan->nama_kegiatan , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>
@foreach ($nilai_ppk_kegiatan as $item)
    @if ($item->no == 1)
    <div class="form-group">
        {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
        {!! Form::select('nilai_ppk', array('' => $item->nilai_ppk) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>
    @elseif($item->no == 2)
    <div class="form-group">
        {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
        {!! Form::select('kegiatan_berbasis', array('' => $item->kegiatan_berbasis) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>
    @endif
@endforeach

    <div class="form-group">
        {!! Form::label('dokumen_kegiatan', 'Dokumen Yang Diunggah:') !!}
        <br>
        {{-- @php
            $i = 1;
        @endphp --}}
        @foreach ($dokumen as $item)
            @if ($item->status_unggah_dokumen == "Pengajuan")
            <i class="fas fa-file-alt"> </i> <a href="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}" download="{{ $item->nama_dokumen }}">{{ $item->nama_dokumen }} </a>
            <button type="button" class="btn btn-primary btn-sm mb-2 lihat_file" value="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}">Lihat File</button>
                <br>
                
            @endif
        @endforeach
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                {!! Form::date('mulai_kegiatan', $dokumentasi_kegiatan->mulai_kegiatan , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
                {!! Form::label('akhir_kegiatan', 'Akhir dari Kegiatan:') !!}
                {!! Form::date('akhir_kegiatan', $dokumentasi_kegiatan->akhir_kegiatan , ['class' => 'form-control' , 'disabled' => 'disabled']) !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        {{-- {!! Form::label('url', 'URL Dokumentasi') !!} --}}
        {{-- {!! Form::file('dokumen_kegiatan', null , ['class' => 'form-control']) !!} --}}
    </div>
@endsection

 <!-- Modal to show file -->
 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                    <div class="modal-body">
                        <iframe src="" width="450" height="500"></iframe>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>    
                </div>
            </div>

@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.lihat_file', function(){
                var value = $(this).attr('value');
                var docx = value.search('.docx');
                var xlsx = value.search('.xlsx');
                if (docx !== -1 || xlsx !== -1) {
                    window.open(value);
                } else {
                    $('#myModal').modal();
                    $('#myModal iframe').attr({src: value});
                }
            });
        });
    </script>
@endsection