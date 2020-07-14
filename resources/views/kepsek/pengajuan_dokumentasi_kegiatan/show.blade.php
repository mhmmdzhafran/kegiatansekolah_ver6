@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Pengajuan Dokumentasi Kegiatan PPK
@endsection

@section('content')
    <h1>Pengajuan Dokumentasi Kegiatan PPK</h1>
    @if ($status_dokumentasi->nama == "Unggah Dokumentasi")
        <h3 class="bg-info text-center" style="color:white;">Status: Sedang Menunggu Unggahan Dokumentasi</h3>
    @elseif($status_dokumentasi->nama == "Sudah Disetujui")
        <h3 class="bg-success text-center" style="color:white;">Status: {{ $status_dokumentasi->nama }}</h3>
    @elseif($status_dokumentasi->nama == "Pengajuan Ulang")
        <h3 class="bg-danger text-center" style="color:white;">Status: Sedang Pengajuan Ulang</h3>
    @endif
    
@include('_partials/form_error')
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <table class="bg-warning text-white">
            <thead>
            <tr>
                <th>
                    Record Keterangan:
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($keterangan_dokumentasi as $keterangan)                
            <tr>
                @if ($keterangan->no == 1)
                <td>
                    @if ($keterangan->keterangan_opsional == "")
                        &bull; Tidak ada Keterangan Tambahan untuk sukses
                        @continue
                    @elseif($keterangan->keterangan_opsional != "")
                      Keterangan Sukses: <br>  &bull; {{ $keterangan->keterangan_opsional }}
                    @endif
                </td>
                @elseif($keterangan->no == 2)
                    <td>
                        @if ($keterangan->keterangan_wajib_ulang == "")
                            &bull; Tidak ada Keterangan Pengajuan Ulang    
                            @continue   
                        @elseif($keterangan->keterangan_wajib_ulang != "")
                          Keterangan Untuk Pengajuan Ulang: <br>  &bull; {{ $keterangan->keterangan_wajib_ulang }}     
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

    <div class="form-group">
        {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
        {!! Form::text('PJ_nama_kegiatan', $dokumentasi_kegiatan->nama_kegiatan , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    </div>

    @foreach ($nilai_kegiatan_berbasis as $item)
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
        {!! Form::label('dokumen_kegiatan', 'Dokumentasi yang Diunggah:') !!}
        @if ($dokumen) {{--}} Jika dokumen ada {{--}}
            {{-- @php
                $i = 1;
            @endphp --}}
                @foreach ($dokumen as $item)
                    @if ($item->status_unggah_dokumen == "Pengajuan")
                    <br>
                        <i class="fas fa-file-alt"> </i> <a href="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}" download="{{ $item->nama_dokumen }}">{{ $item->nama_dokumen }} </a>
                        <button class="btn btn-primary btn-sm lihat_file mt-2 mb-2" value="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}">Lihat File</button>
                    @endif
                @endforeach
        @else
        <br>
            <p class="ml-2">Belum Terdapat Data</p>
        @endif
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
@endsection

@section('script')
    <script>
        $(document).on('click', '.lihat_file',function(){
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
    </script>
@endsection