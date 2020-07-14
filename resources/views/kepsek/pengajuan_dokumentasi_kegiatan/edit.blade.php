@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Penerimaan Dokumentasi Kegiatan
@endsection

@section('content')
    <h1>Penerimaan Dokumentasi Kegiatan</h1>
    {{-- session --}}
    @if(Session::has('warning'))
      <b class="bg-warning" style="color:white">{{ Session::get('sukses') }}</b>
    @elseif(Session::has('danger'))
      <b class="bg-danger" style="color:white">{{ Session::get('danger') }}</b>
    @endif
    {{-- end session --}}
    @include('_partials/form_error')

    <h3 class="bg-danger text-center" style="color:white;">Status: {{ $status_dokumentasi->nama }}</h3>

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
                          Tidak Ada Keterangan Sukses
                          @continue
                      @else
                        &bull; {{ $keterangan->keterangan_opsional }}    
                      @endif    
                     </td>
                  @elseif($keterangan->no == 2)
                      <td>
                          @if ($keterangan->keterangan_wajib_ulang == "")
                            Tidak Ada Keterangan Pengajuan Ulang
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
        @else       
        <div class="form-group">
            {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
            {!! Form::select('kegiatan_berbasis', array('' => $item->kegiatan_berbasis) ,null , ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        </div>
    @endif 

    @endforeach

    <div class="form-group">
        {!! Form::label('dokumen_kegiatan', 'Dokumentasi Yang Diunggah:') !!}
        <br>
        {{-- @php
            // $i = 1;
        @endphp --}}
        @foreach ($dokumen as $item)
            {{-- @if ($item->id == $i) --}}
                <i class="fas fa-file-alt"> </i> <a href="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}" download="{{ $item->nama_dokumen }}">{{ $item->nama_dokumen }} </a>
                <button type="button" class="btn btn-primary btn-sm mb-2 lihat_file" value="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}">Lihat File</button>
                <br>
                {{-- @php
                    $i++;
                @endphp --}}
            {{-- @else
                
            @endif --}}
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
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
            <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#exampleModalCenter">
                Menerima Kegiatan
              </button>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="form-group">
            <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#exampleModalCenter2">
                Melakukan Pengajuan Ulang
              </button>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'PUT', 'action' => ['KepalaSekolahMengelolaKegiatanController@updateDokumentasi' , $dokumentasi_kegiatan->id], 'files'=>true]) !!}
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Untuk Kegiatan yang berjudul:</label>
                    <h4>{{ $dokumentasi_kegiatan->nama_kegiatan }}</h4>
                </div>
                <div class="form-group">
                    {!! Form::hidden('id_keterangan', 1)!!}
                    {!! Form::label('keterangan', 'Keterangan(Opsional):') !!}
                    {!! Form::textarea('keterangan', null , ['class' => 'form-control']) !!}
                </div>
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!! Form::submit('Menerima Kegiatan', ['class' => 'btn btn-success ']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(['method' => 'PUT', 'action' => ['KepalaSekolahMengelolaKegiatanController@updateDokumentasi' , $dokumentasi_kegiatan->id], 'files'=>true]) !!}
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Untuk Kegiatan yang berjudul:</label>
              <h4>{{ $dokumentasi_kegiatan->nama_kegiatan }}</h4>
            </div>
            <div class="form-group">
                {!! Form::hidden('id_keterangan', 2)!!}
                {!! Form::label('keterangan_wajib_ulang', 'Keterangan(Wajib):') !!}
                {!! Form::textarea('keterangan_wajib_ulang', null , ['class' => 'form-control' , 'required' => 'required']) !!}
            </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!! Form::submit('Lakukan Pengajuan Ulang Kegiatan', ['class' => 'btn btn-warning','required' => 'required']) !!}
          {!! Form::close() !!}
        </div>
      </div>
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