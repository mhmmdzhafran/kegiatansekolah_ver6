@extends('layouts.template_internal')

@section('content')
   
    <div class="row mb-3">
        <div class="col-sm-12 col-lg-5">
            <h2>Assessmen Internal</h2>
        </div>
        {{-- border-radius: 2rem; --}}
        <div class="col-sm-12 col-lg-7">
            <a href="{{ route('penilai_internal.show', $assessment->id) }}" class="btn btn-info float-md-left float-lg-right float-sm-left">Lihat Skor Asesmen</a>
        </div>
        {{-- <div class="col-lg-12 col-sm-12">        
            <ul class="kurang_indikator" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
        </div> --}}
    </div>
        {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Informasi Assessmen</h6>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-sm float-md-right float-lg-right float-sm-left" id="edit" style="color:white;">Edit Informasi</button>
                        <br>
                        Nama Sekolah: <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="{{ $assessment->nama_sekolah }}" disabled>
                        Alamat: <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="form-control" value="{{ $assessment->alamat_sekolah }}" disabled>
                        Nama Kepala Sekolah: <input type="text" name="nama_kepsek" id="nama_kepsek" class="form-control" value="{{ $assessment->nama_kepsek }}" disabled>
                        Nomor HP: <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $assessment->nomor_hp }}" disabled>
                        Email: <input type="email" name="email_kepsek" id="email_kepsek" class="form-control" value="{{ $assessment->email_kepsek }}" disabled>
                    </div>
                  </div>
            </div>
        </div>
    </div>   
    <br>
<div class="container">
    <div class="row">
            <div class="col-lg-12 col-sm-12"> 
                <div class="card shadow mb-4">    
                <table class="table table-bordered">
                    <thead class="">
                        <th>Isi Assessment</th>
                    </thead>
                    <tbody>
                        <td>
                            <div class="card-body">
                                <div id="accordion">
                                    @include('_partials/internal/assessment_indikator1') 
                                    @include('_partials/internal/assessment_indikator2')
                                    @include('_partials/internal/assessment_indikator3')
                                    @include('_partials/internal/assessment_indikator4')
                                    @include('_partials/internal/assessment_indikator5')
                                    @include('_partials/internal/assessment_indikator6')
                                    @include('_partials/internal/assessment_indikator7')
                                    @include('_partials/internal/assessment_indikator8')
                                    @include('_partials/internal/assessment_indikator9')
                                    @include('_partials/internal/assessment_indikator10')
                                </div>
                            </div>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Ajax sukses -->
<div class="modal fade" id="ModalSuccess" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ModalSuccessTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalSuccessTitle">Modal title</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-lg-12 col-sm-12">
            <div class="modal_success">
            <img src="{{ asset('success/success_indicator.gif') }}" alt="" width="300" height="300">
            </div>
        <p class="success" style="text-align: center"></p>
        </div>
            </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <a href="#" class="btn btn-primary" id="modalSubmit">Baik</a>
        </div>
      </div>
    </div>
  </div>

<!-- Modal for pengubahan informasi -->
<div class="modal fade" id="edit_informasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Pengubahan Data Assessmen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" id="pergantian_informasi">
            {{ csrf_field() }}
        <div class="modal-body">
            <div class="row">
            <div class="col-lg-12 col-sm-12">
                <ul id="kurang_indikator" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                <ul id="sukses_indikator" style="background-color: #32CD32; color: white; border-radius: 10px"></ul>
                <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen">
                Nama Sekolah: <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="{{ $assessment->nama_sekolah }}">
                Alamat: <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="form-control" value="{{ $assessment->alamat_sekolah }}">
                Nama Kepala Sekolah: <input type="text" name="nama_kepsek" id="nama_kepsek" class="form-control" value="{{ $assessment->nama_kepsek }}">
                Nomor HP: <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $assessment->nomor_hp }}">
                Email: <input type="email" name="email_kepsek" id="email_kepsek" class="form-control" value="{{ $assessment->email_kepsek }}">
        </div>
            </div>
        </div>
    </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary submit">Save changes</button>
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
                <h2>Apakah Anda ingin menghapus dokumen ini?</h2>
        </div>
            </div>
        </div>
    </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary submit_delete">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade modalLoading" id="modalLoading" tabindex="-1" role="dialog" aria-labelledby="modalLoadingCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm bd-example-modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <div class="d-flex justify-content-center">
              <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
              </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
  @include('_partials/internal/assessment_internal_script')
@endsection