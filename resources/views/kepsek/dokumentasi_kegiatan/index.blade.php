@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Dokumentasi Kegiatan
@endsection

@section('content')
    <h1>Dokumentasi Kegiatan PPK</h1>

    <div class="row">
        <div class="col-sm-12 col-lg-12">
            @if ($folder_dokumentasi)
                @foreach ($folder_dokumentasi as $data_folder)
                <div class="column">
                        <a href="{{ route('kepsek.dokumentasi_kegiatan.show' , $data_folder->id) }}"> 
                    <img src="{{ asset('folder/folder_image.png') }}" alt="{{ $data_folder->nama_folder_dokumentasi }}" srcset="" width="100" height="100" class="mr-5">
                    <p>{{$data_folder->nama_folder_dokumentasi }}</p>
                </a>
                </div>
                @endforeach
            @endif
            {{ $folder_dokumentasi->links() }}
        </div>
    </div>
@endsection