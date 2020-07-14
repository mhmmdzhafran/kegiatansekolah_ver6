@extends('layouts.template_PJ')

@section('title')
    Pengajuan Kegiatan PPK
@endsection

@section('content')
<h1>Pembuatan Pengajuan Kegiatan PPK</h1>
@if (Session::has('sukses'))
    <hr>
    <b class="bg-success" style="color: white">{{ session('sukses') }}</b>
@endif

<h3 class="bg-danger text-center" style="color:white;">Status: {{ $status_kegiatan->nama }}</h3>
   
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
        {!! Form::label('dokumen_kegiatan', 'Dokumen Proposal Yang Dikirim:') !!}
        @foreach ($dokumen_kegiatan as $item)
        @if ($item->dokumen_id == 1)
            <br>
            <i class="fas fa-file-alt"></i>
            <a href="{{ asset('kegiatan/pengajuan_kegiatan/'.$item->nama_dokumen) }}" download="{{ $item->nama_dokumen }}">{{ $item->nama_dokumen }}</a>
            <button type="button" class="btn btn-primary btn-sm mb-2 lihat_file" value="{{ asset('kegiatan/pengajuan_kegiatan/'.$item->nama_dokumen) }}">Lihat File</button>
            <br>
        @endif
    @endforeach
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
$(document).on('click','.lihat_file', function(){
    var see_file = $(this).attr('value');
    var docx = see_file.search('.docx');
    var xlsx = see_file.search('.xlsx');
    if (docx !== -1 || xlsx !== -1) {
        window.open(see_file);
    }
    else{
        $("#myModal").modal();
        $("#myModal").modal('handleUpdate');
        $("#myModal iframe").attr({'src':see_file});
    }
});
});  
</script>
@endsection