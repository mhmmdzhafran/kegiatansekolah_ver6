@extends('layouts.template_PJ')

@section('title')
    Penanggung Jawab - Detail Folder Kegiatan
@endsection

@section('content')
    <h1>Data Dokumentasi Kegiatan</h1>

    <div class="col-lg-12">
        <a href="{{ route('pj.kelola_dokumentasi.create', ['id_doc' => $doc_id ]) }}" class="btn btn-success btn-lg rounded-pill mb-2">Unggah Dokumentasi</a>
        <h4 class="mt-3">Informasi Kegiatan:</h4>
        <table class="table table-responsive-lg table-striped table-bordered mb-5">
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Nilai PPK</th>
                    <th>Kegiatan Berbasis</th>
                    <th>Mulai Kegiatan</th>
                    <th>Akhir Kegiatan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $nama_kegiatan }}</td>
                    @foreach ($nilai_kegiatan_berbasis as $data_kegiatan)
                    @if ($data_kegiatan->no == 1)
                        <td>{{ $data_kegiatan->nilai_ppk }}</td>
                    @elseif($data_kegiatan->no == 2)
                        <td> {{ $data_kegiatan->kegiatan_berbasis }}</td>
                    @endif
                    @endforeach
                    <td>{{ $mulai_kegiatan }}</td>
                    <td>{{ $akhir_kegiatan }}</td>
                </tr>
            </tbody>
        </table>   
        <h4 class="mt-3">Dokumentasi Kegiatan:</h4>
        <table class="table table-responsive-lg table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Dokumen Kegiatan</th>
                    <th>Dibuat Tanggal</th>
                    <th>Diperbarui Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($dokumen)
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($dokumen as $item)
                    <tr>
                        <td>
                            {{ $i }}
                        </td>
                        <td>
                             {{-- @if ($item->dokumen_id == $i) --}}
                                @if (substr($item->nama_dokumen, -3) == 'png' || substr($item->nama_dokumen, -4) == 'jpeg')
                                    <img src="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}" alt="{{ $item->nama_dokumen }}" srcset="" width="100" height="100">
                                    <a href="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}">{{ substr($item->nama_dokumen, 22) }}</a>     
                                @else
                                    <a href="{{ asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}">{{ substr($item->nama_dokumen, 11) }}</a>     
                                @endif
                            {{-- @endif --}}
                        </td>
                        <td>
                            {{ $mulai_kegiatan }}
                        </td>
                        <td>
                            {{ $akhir_kegiatan }}
                        </td>
                        <td>
                            @if ($item->status_unggah_dokumen == "Pengajuan")
                            <button class="btn btn-primary btn-sm lihat_file" value="{{asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}">Lihat File</button>
                            @else
                            <button class="btn btn-primary btn-sm lihat_file" value="{{asset('kegiatan/dokumentasi_kegiatan/'.$item->nama_dokumen) }}">Lihat File</button>
                            <a href="{{ route('pj.kelola_dokumentasi.edit', ['id_doc'=> $doc_id, 'id_documentation' => $item->id]) }}" class="btn btn-info btn-sm">Ubah File</a>
                            <button class="btn btn-danger btn-sm danger" value="{{ $item->id }}">Delete File</button>
                            @endif
                            <input type="hidden" name="" value="{{ $doc_id }}" class="id_doc">
                            <input type="hidden" name="" value="{{$item->nama_dokumen}}" class="nama_doc">
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        {{ $dokumen->links() }}
    </div>

<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" id="myModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="delete_file" method="post">
        <div class="modal-body">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <h4>Apakah anda yakin ingin melakukan penghapusan File:</h4>
            <b class="nama_doc"></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary cancel" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger submit" data-dismiss="modal" id="">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script>
        $(document).on('click', '.lihat_file', function(){
            var value = $(this).attr("value");
            window.open(value); 
        });
        $(document).on('click', '.danger', function(){
            var value_delete = $(this).attr("value");
            var id_doc = $(".id_doc").attr("value");
            $("#myModal").modal();
            var url_delete = '{{ route("pj.kelola_dokumentasi.destroy",["id_doc" =>"id_docs", "id_documentation" => "ids"]) }}';
            url_delete = url_delete.replace("id_docs", id_doc);
            url_delete = url_delete.replace("ids", value_delete);
            $('#delete_file').attr('action', url_delete);
        });
        $(document).on('click', '.submit', function(){
            $('#delete_file').submit();
        });
    </script>
@endsection