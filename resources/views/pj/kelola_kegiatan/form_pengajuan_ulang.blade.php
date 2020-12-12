<div class="modal fade" id="pengajuanUlangModal" tabindex="-1" role="dialog" aria-labelledby="pengajuanUlangModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <form action="" id="pengajuanUlangForm" enctype="multipart/form-data" autocomplete="off">
            @method('PUT')
        <div class="modal-header">
            <h5 class="modal-title" id="pengajuanUlangModal">Pengajuan Ulang Proposal Kegiatan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <ul class="error_notification d-none" style="background-color: #e53e3e; color: white; border-radius: 10px;"></ul>
            <div class="form-group">
                {!! Form::label('keterangan' , 'Keterangan Yang Diberikan: ') !!}
                <ul class="keterangan" style="background-color: #36b9cc; color: white; border-radius: 10px;"></ul>
            </div>
                <div class="form-group">
                {!! Form::label('PJ_nama_kegiatan', 'Nama Kegiatan:') !!}
                {!! Form::text('PJ_nama_kegiatan', null , ['class' => 'form-control PJ_nama_kegiatan']) !!}
            </div>
        
            <div class="form-group">
                {!! Form::label('nilai_ppk', 'Nilai PPK:') !!}
                <br>
                {!! Form::checkbox('nilai_ppk[]', 'Religius', null, ['class' => 'value_nilai_ppk']) !!} Religius
                <br>
                {!! Form::checkbox('nilai_ppk[]', 'Integritas', null, ['class' => 'value_nilai_ppk']) !!} Integritas
                <br>
                {!! Form::checkbox('nilai_ppk[]', 'Nasionalis', null, ['class' => 'value_nilai_ppk']) !!} Nasionalis
                <br>
                {!! Form::checkbox('nilai_ppk[]', 'Mandiri', null, ['class' => 'value_nilai_ppk']) !!} Mandiri
                <br>
                {!! Form::checkbox('nilai_ppk[]', 'Gotong Royong', null, ['class' => 'value_nilai_ppk']) !!} Gotong Royong
            </div>
        
            <div class="form-group">
                {!! Form::label('kegiatan_berbasis', 'Kegiatan Berbasis:') !!}
                {!! Form::select('kegiatan_berbasis', array('' => 'Choose Options', 'Berbasis Kelas' => 'Berbasis Kelas', 'Berbasis Budaya Sekolah' => 'Berbasis Budaya Sekolah', 'Berbasis Masyarakat' => 'Berbasis Masyarakat') ,null , ['class' => 'form-control kegiatan_berbasis']) !!}
            </div>
            {!! Form::label('dokumen_kegiatan_terdahulu', 'Dokumen Proposal Terdahulu: ') !!}
            <div id="upload-ulang">
            </div>
            {!! Form::label('dokumen_kegiatan', 'Unggah Proposal Pengajuan Kegiatan (ekstensi .pdf dan total file sebesar 5MB): ') !!}
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <div class="form-group" id="upload-file">
                        {!! Form::file('dokumen_kegiatan') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('mulai_kegiatan', 'Mulai Melaksanakan Kegiatan:') !!}
                        {!! Form::date('mulai_kegiatan', null , ['class' => 'form-control mulai_kegiatan']) !!}    
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group">
                        {!! Form::label('akhir_kegiatan', 'Akhir Melaksanakan Kegiatan:') !!}
                        {!! Form::date('akhir_kegiatan', null , ['class' => 'form-control akhir_kegiatan']) !!}
                    </div>
                </div>
        </div>
        <div class="progress" hidden>
            <div class="progress-bar progress-bar-success myprogress progress-bar-striped progress-bar-animated" role="progressbar" style="width:0%">0%</div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close_proposal" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary new_proposal">Kirim Proposal Ulang</button>
          </div>
        </div>
    </form>
      </div>
    </div>
  </div>