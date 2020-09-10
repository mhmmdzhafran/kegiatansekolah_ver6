@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Laman Melakukan Asesmen PPK
@endsection

@section('content')
   
    <div class="row mb-3">
        <div class="col-sm-12 col-lg-7">
            <h2>Asesmen Penguatan Pendidikan Karakter</h2>
        </div>
        {{-- border-radius: 2rem; --}}
        <div class="col-sm-12 col-lg-5">
            <a href="{{ route('kepsek.asesmen.show', $assessment->id) }}" class="btn btn-info rounded-pill float-md-left float-lg-right float-sm-left">Lihat Skor Asesmen</a>
        </div>
    </div>
        {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card shadow mb-4 mb-2">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Informasi Assessmen</h6>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-sm rounded-pill float-md-right float-lg-right float-sm-left" id="edit" style="color:white;">Edit Informasi</button>
                        <br>
                          <label for="nama_sekolah">Nama Sekolah: </label>
                          <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control mb-2" value="{{ $assessment->nama_sekolah }}" disabled>
                          <label for="alamat_sekolah">Alamat: </label>
                          <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="form-control mb-2" value="{{ $assessment->alamat_sekolah }}" disabled>
                          <label for="nama_kepsek">Nama Kepala Sekolah: </label>
                          <input type="text" name="nama_kepsek" id="nama_kepsek" class="form-control mb-2" value="{{ $assessment->nama_kepsek }}" disabled>
                          <label for="no_hp">Nomor HP: </label>
                          <input type="text" name="no_hp" id="no_hp" class="form-control mb-2" value="{{ $assessment->nomor_hp }}" disabled>
                          <label for="email_kepsek">Email: </label>
                          <input type="email" name="email_kepsek" id="email_kepsek" class="form-control" value="{{ $assessment->email_kepsek }}" disabled>
                    </div>
                  </div>
            </div>
        </div>
    </div>   
<div class="container">
    <div class="row">
            <div class="col-lg-12 col-sm-12"> 
                <div class="card shadow mb-4">    
                  <a href="#collapseCardExample" class="d-block card-header py-3 border-bottom-success" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">ASESMEN PENGUATAN PENDIDIKAN KARAKTER</h6>
                  </a>
                {{-- <table class="table table-bordered"> --}}
                    {{-- <thead class="">
                        <th>Isi Assessment</th>
                    </thead> --}}
                    {{-- <tbody>
                        <td> --}}
                          <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <div id="accordion">
                                    @include('_partials/internal/testing_asesmen_indikator')
                                </div>
                            </div>
                          </div>
                        {{-- </td>
                    </tbody>
                </table> --}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Pengubahan Dokumen Asesmen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="" id="ubah_dokumen_asesmen" enctype="multipart/form-data">
              @method('PUT')
              {{ csrf_field() }}
          <div class="modal-body">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <ul id="kurang_indikator_asesmen_dokumen" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                  <div class="lihat_dokumen">
                    {!! Form::label('dokumen_sebelumnya' , 'Dokumen Sebelumnya:') !!}
                    <br>
                  </div>
                  <hr>
                  <div class="form-group">
                        {!! Form::label('dokumen', 'Silahkan Unggah Dokumen Asesmen (ekstensi .pdf dan total seluruh file sebesar 5MB): ') !!}
                        <br>
                        {!! Form::file('ubah_dokumen') !!}
                  </div>
                </div>
              </div>
          </div>
          <div class="progress" hidden>
            <div class="progress-bar progress-bar-striped progress-bar-animated myprogress" role="progressbar" style="width: 0%">0%</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="close_btn" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="submit_dokumen">Ubah Dokumen</button>
          </div>
      </form>
        </div>
      </div>
    </div>


<!-- Modal for pengubahan informasi -->
<div class="modal fade" id="edit_informasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Pengubahan Informasi Assessmen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="pergantian_informasi" autocomplete="off">
            {{ csrf_field() }}
        <div class="modal-body">
            <div class="row">
              <div class="col-lg-12 col-sm-12">
                  <ul id="kurang_indikator" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                  <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen">
                  <div class="form-group">
                    <label for="nama_sekolah">Nama Sekolah:</label>
                    <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="{{ $assessment->nama_sekolah }}">
                  </div>
                  <div class="form-group">
                    <label for="alamat_sekolah">Alamat:</label>
                    <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="form-control" value="{{ $assessment->alamat_sekolah }}">
                  </div>
                  <div class="form-group">
                    <label for="nama_kepsek">Nama Kepala Sekolah:</label>
                    <input type="text" name="nama_kepsek" id="nama_kepsek" class="form-control" value="{{ $assessment->nama_kepsek }}">
                  </div>
                  <div class="form-group">
                    <label for="no_hp">Nomor HP:</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $assessment->nomor_hp }}">
                  </div>
                  <div class="form-group">
                    <label for="email_kepsek">Email:</label>
                    <input type="email" name="email_kepsek" id="email_kepsek" class="form-control" value="{{ $assessment->email_kepsek }}">
                  </div>
              </div>
            </div>
        </div>
    </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary submit">Ubah Informasi</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for konfirmasi delete dokumen -->
<div class="modal fade" id="modalConfirmationDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Pengubahan Data Assessmen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="delete_dokumen">
            {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12 col-sm-12">
              {!! Form::label('dokumen_sebelumnya' , 'Dokumen yang ingin dihapus:') !!}
              <div class="dokumen-asesmen ml-2"></div>
              <hr>
              <h4 class="text-center font-weight-bolder">Apakah Anda ingin menghapus dokumen ini?</h4>
          </div>
          </div>
        </div>
    </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger submit_delete">Hapus Dokumen</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
  @include('_partials/internal/assessment_internal_script')
@endsection

