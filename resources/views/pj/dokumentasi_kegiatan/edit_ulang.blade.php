@extends('layouts.template_PJ')

@section('title')
    Penanggung Jawab - Pengajuan Ulang Dokumentasi Kegiatan
@endsection

@section('content')
    <h1>Pengajuan Ulang Dokumentasi Kegiatan</h1>

    @if(Session::has('gagal'))
        <b class="bg-warning" style="color:white">{{ Session::get('gagal') }}</b>
    @else
        <b class="bg-danger" style="color: white">{{ Session::get('date_past_ulang') }}</b>
    @endif

    @include('_partials/form_error')

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
                @foreach ($keterangan_dokumentasi_ulang as $keterangan)                
                <tr>
                    @if ($keterangan->no == 1)
                        @continue
                    @elseif($keterangan->no == 2)
                        <td>    
                            &bull; {{ $keterangan->keterangan_wajib_ulang }}
                        </td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
    {!! Form::open(['method' => 'PUT', 'action' => ['PJMengelolaKegiatanController@uploadDokumentasiUlang' , $dokumentasi_kegiatan->id], 'files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('PJ_nama_kegiatan', $dokumentasi_kegiatan->nama_kegiatan , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>

    @foreach ($nilai_ppk_kegiatan_berbasis as $item)
       @if ($item->no == 1)
        <div class="form-group">
            {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
            {!! Form::select('nilai_ppk', array('' => $item->nilai_ppk) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>
        @else       
        <div class="form-group">
            {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
            {!! Form::select('kegiatan_berbasis', array('' => $item->kegiatan_berbasis) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>
    @endif 

    @endforeach

<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="form-group">
    {!! Form::label('dokumentasi_lama', 'Dokumentasi Terdahulu (Click dokumen untuk mengunduh):') !!}
    @php
        $i = 1;
    @endphp
        @foreach ($dokumen_kegiatan as $item)
            @if ($item->dokumen_id == $i)
            <br>
            <i class="fas fa-file-alt"></i>
            <a href="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->data_dokumentasi) }}" download="{{ $item->data_dokumentasi }}">{{ $item->data_dokumentasi }}</a>
            <button type="button" class="btn btn-primary btn-sm mb-2 lihat_file" value="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->data_dokumentasi) }}">Lihat File</button>
            @php
                $i++;
            @endphp
            @endif
        @endforeach
        </div>
    </div>
</div>
    {!! Form::label('dokumentasi_kegiatan_ppk[]', 'Unggah Ulang Dokumentasi Kegiatan:') !!}
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
                {!! Form::date('akhir_kegiatan', $dokumentasi_kegiatan->akhir_kegiatan , ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <p style="color:red">*Note: Dokumen yang terdahulu akan terhapus ketika sudah menggungah Dokumen Baru</p>
        {!! Form::submit('Submit Pengajuan Dokumentasi Ulang', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}
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
    var i=1;  
    $('#add').click(function(){  
         i++;  
         $('#upload-file').append('<input type="file" name="dokumentasi_kegiatan_ppk[]" id="row'+i+'" class="mb-2 mt-2" placeholder="Enter your Name" /><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">X</button>');  
    });  
    $(document).on('click', '.btn_remove', function(){  
         var button_id = $(this).attr("id");   
         $('#'+button_id+'').remove();
         $('#row'+button_id).removeClass('mb-2');  
         $('#row'+button_id).remove();
    });
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