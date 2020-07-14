<div class="card shadow-sm">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          @php
              $str = strtolower('3. VISI, MISI DAN PERUMUSAN');
          @endphp
          {{ ucwords($str) }}
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
              <thead>
                 <th class="text-center">No</th>
                 <th class="text-center">Penjelasan Assessment</th>
                 <th class="text-center">Skor</th>
              </thead>
              <tbody>
                  <td class="text-center">1</td>
                  <td class="text-center" width="75%">Program Penguatan Pendidikan Karakter terintegrasi dalam rumusan visi misi dan dokumen kurikulum Sekolah (visi, misi, silabus, skenario pembelajaran, strategi, konten, media, dan penilaian).</td>
                  <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 9)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="9" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="9" data-target="{{ $assessment->id }}">Edit Assessmen</button>
                      @endif
                    @endif
                 @endforeach
                  </td>
              </tbody>                 
          </table>
          <table class="table table-borderless">
             <thead>
                <th class="text-center">No</th>
                <th class="text-center">Penjelasan Assessment</th>
                <th class="text-center">Skor</th>
             </thead>
             <tbody>
                 <td class="text-center">2</td>
                 <td class="text-center" width="75%">Sekolah mengaitkan nilai-nilai utama PPK yang lain dengan prioritas nilai utama yang dipilih dan dikembangkan (religius, nasionalis, integritas, gotong royong, dan mandiri).</td>
                 <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 10)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="10" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="10" data-target="{{ $assessment->id }}">Edit Assessmen</button>
                      @endif
                    @endif
                 @endforeach 
                 </td>
             </tbody>
         </table>
         
         <table class="table table-borderless">
             <thead>
                <th class="text-center">No</th>
                <th class="text-center">Penjelasan Assessment</th>
                <th class="text-center">Skor</th>
             </thead>
             <tbody>
                 <td class="text-center">3</td>
                 <td class="text-center" width="75%">Rumusan nilai-nilai utama karakter oleh sekolah sejalan dengan semangat globalisasi, mengadopsi nilai-nilai keutamaan lokal, dan sejalan dengan perkembangan anak.</td>
                 <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 11)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="11" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="11" data-target="{{ $assessment->id }}">Edit Assessmen</button>
                      @endif
                    @endif
                 @endforeach
                 </td>
             </tbody>
         </table>
      </div>
    </div>
  </div>

   <!-- Modal for indikator[0] -->
<div class="modal fade" id="modalForm9" tabindex="-1" role="dialog" aria-labelledby="modalForm9Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm9Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_9" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_9" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 9)
                    @if (!empty($item->penjelasan_assessment))
                    <ul>
                      <b>Histori Asesmen</b>
                        <li>
                          Skor Asesmen:  {{ $item->skor_penilaian_assessment }}
                        </li>
                        <input type="hidden" name="indikator" value="{{ $item->skor_penilaian_assessment }}">
                    </ul>
                    {{-- @else
                        <input type="hidden" name="indikator" value="{{ $item->skor_penilaian_assessment }}"> --}}
                    @endif
                @endif
            @endforeach       
            <ul class="lihat-dokumen">
              </ul>
              <table>
                <thead>
                  <th>Penjelasan</th>
                  <th width="35%">Skor</th>
                </thead>
                <tbody>
                  <td>
                    {{-- ada input hidden untuk nilai indikator dan data dokumen --}}
                    {!! Form::hidden('penjelasan_assessment', "Program Penguatan Pendidikan Karakter terintegrasi dalam rumusan visi misi dan dokumen kurikulum Sekolah (visi, misi, silabus, skenario pembelajaran, strategi, konten, media, dan penilaian).") !!}
                    Program Penguatan Pendidikan Karakter terintegrasi dalam rumusan visi misi dan dokumen kurikulum Sekolah (visi, misi, silabus, skenario pembelajaran, strategi, konten, media, dan penilaian).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="9">
                    <input type="radio" name="indikator" id="indikator[0]" value="0" class="form-group">0
                    <input type="radio" name="indikator" id="indikator[0]" value="1" class="form-group">1
                    <input type="radio" name="indikator" id="indikator[0]" value="2" class="form-group">2
                    <input type="radio" name="indikator" id="indikator[0]" value="3" class="form-group">3
                    <input type="radio" name="indikator" id="indikator[0]" value="4" class="form-group">4
                  </td>
                </tbody>
              </table>
              <div class="col-lg-6 col-sm-12">
                {!! Form::label('keterangan' , 'Keterangan Skor: ') !!}
                <br>
                <b>0 - Program Penguatan Pendidikan Karakter tidak terintegrasi dalam rumusan visi dan misi</b>
                <br>
                <b>1 - Program  Penguatan  Pendidikan  Karakter  sebagian  kecil  terintegrasi  dalam rumusan  visi misi dan dokumen Kurikulum Sekolah</b>
                <br>
                <b>2 - Program Penguatan Pendidikan Karakter sebagian terintegrasi dalam rumusanvisi misi</b>
                <br>
                <b>3 - Program Penguatan Pendidikan Karakter sebagian besar terintegrasi dalam  rumusan visi misi dan dokumen Kurikulum Sekolah </b>
                <br>
                <b>4 -  Program Penguatan Pendidikan Karakter semua terintegrasi dalam rumusan visi misi dan dokumen Kurikulum Sekolah</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_9">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="9">Add More</button>
                  <br>
                  {!! Form::file('file[]', ['class' => 'mb-2']) !!}
              </div>
              </div>
            </div>
        </div>
        <div class="progress" hidden>
          <div class="progress-bar progress-bar-striped progress-bar-animated myprogress" role="progressbar" style="width:0%">0%</div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit_form">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>

    <!-- Modal for indikator[0] -->
<div class="modal fade" id="modalForm10" tabindex="-1" role="dialog" aria-labelledby="modalForm10Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm10Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_10" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_10" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 10)
                    @if (!empty($item->penjelasan_assessment))
                    <ul>
                      <b>Histori Asesmen</b>
                        <li>
                          Skor Asesmen:  {{ $item->skor_penilaian_assessment }}
                        </li>
                        <input type="hidden" name="indikator" value="{{ $item->skor_penilaian_assessment }}">
                    </ul>
                    {{-- @else
                        <input type="hidden" name="indikator" value="{{ $item->skor_penilaian_assessment }}"> --}}
                    @endif
                @endif
            @endforeach       
            <ul class="lihat-dokumen">
            </ul>
              <table>
                <thead>
                  <th>Penjelasan</th>
                  <th width="35%">Skor</th>
                </thead>
                <tbody>
                  <td>
                    {{-- ada input hidden untuk nilai indikator dan data dokumen --}}
                    {!! Form::hidden('penjelasan_assessment', "Sekolah mengaitkan nilai-nilai utama PPK yang lain dengan prioritas nilai utama yang dipilih dan dikembangkan (religius, nasionalis, integritas, gotong royong, dan mandiri).") !!}
                    Sekolah mengaitkan nilai-nilai utama PPK yang lain dengan prioritas nilai utama yang dipilih dan dikembangkan (religius, nasionalis, integritas, gotong royong, dan mandiri).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="10">
                    <input type="radio" name="indikator" id="indikator[0]" value="0" class="form-group">0
                    <input type="radio" name="indikator" id="indikator[0]" value="1" class="form-group">1
                    <input type="radio" name="indikator" id="indikator[0]" value="2" class="form-group">2
                    <input type="radio" name="indikator" id="indikator[0]" value="3" class="form-group">3
                    <input type="radio" name="indikator" id="indikator[0]" value="4" class="form-group">4
                  </td>
                </tbody>
              </table>
              <div class="col-lg-6 col-sm-12">
                {!! Form::label('keterangan' , 'Keterangan Skor: ') !!}
                <br>
                <b>0 - Sekolah tidak mengaitkan nilai utama dengan prioritas nilai sekolah</b>
                <br>
                <b>1 - Sekolah mengaitkan sebagian kecil nilai-nilai utama PPK lain dengan prioritas nilai utama yang dipilih dan dikembangkan</b>
                <br>
                <b>2 - Sekolah mengaitkan sebagian nilai-nilai utama PPK lain dengan prioritas nilai utama yang dipilih dan dikembangkan</b>
                <br>
                <b>3 - Sekolah mengaitkan sebagian besar nilai-nilai utama PPK lain dengan prioritas nilai utama yang dipilih dan dikembangkan</b>
                <br>
                <b>4 - Sekolah mengaitkan semua nilai-nilai utama PPK lain dengan prioritas nilai utama yang dipilih dan dikembangkan</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_10">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="10">Add More</button>
                  <br>
                  {!! Form::file('file[]', ['class' => 'mb-2']) !!}
              </div>
              </div>
            </div>
        </div>
        <div class="progress" hidden>
          <div class="progress-bar progress-bar-striped progress-bar-animated myprogress" role="progressbar" style="width:0%">0%</div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit_form">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>

     <!-- Modal for indikator[0] -->
<div class="modal fade" id="modalForm11" tabindex="-1" role="dialog" aria-labelledby="modalForm11Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm11Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_11" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_11" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 11)
                    @if (!empty($item->penjelasan_assessment))
                    <ul>
                      <b>Histori Asesmen</b>
                        <li>
                          Skor Asesmen:  {{ $item->skor_penilaian_assessment }}
                        </li>
                        <input type="hidden" name="indikator" value="{{ $item->skor_penilaian_assessment }}">
                    </ul>
                    {{-- @else
                        <input type="hidden" name="indikator" value="{{ $item->skor_penilaian_assessment }}"> --}}
                    @endif
                @endif
            @endforeach       
            <ul class="lihat-dokumen">
            </ul>
              <table>
                <thead>
                  <th>Penjelasan</th>
                  <th width="35%">Skor</th>
                </thead>
                <tbody>
                  <td>
                    {{-- ada input hidden untuk nilai indikator dan data dokumen --}}
                    {!! Form::hidden('penjelasan_assessment', "Rumusan nilai-nilai utama karakter oleh sekolah sejalan dengan semangat globalisasi, mengadopsi nilai-nilai keutamaan lokal, dan sejalan dengan perkembangan anak.") !!}
                    Rumusan nilai-nilai utama karakter oleh sekolah sejalan dengan semangat globalisasi, mengadopsi nilai-nilai keutamaan lokal, dan sejalan dengan perkembangan anak.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="11">
                    <input type="radio" name="indikator" id="indikator[0]" value="0" class="form-group">0
                    <input type="radio" name="indikator" id="indikator[0]" value="1" class="form-group">1
                    <input type="radio" name="indikator" id="indikator[0]" value="2" class="form-group">2
                    <input type="radio" name="indikator" id="indikator[0]" value="3" class="form-group">3
                    <input type="radio" name="indikator" id="indikator[0]" value="4" class="form-group">4
                  </td>
                </tbody>
              </table>
              <div class="col-lg-6 col-sm-12">
                {!! Form::label('keterangan' , 'Keterangan Skor: ') !!}
                <br>
                <b>0 - Sekolah tidak melakukan perumusan nilai-nilai utama karakter</b>
                <br>
                <b>1 - Rumusan nilai-nilai utama karakter sesuai dengan semangat globalisasi, atau nilai-nilai keutamaan lokal</b>
                <br>
                <b>2 - Rumusan nilai-nilai utama karakter sesuai dengan semangat globalisasi, dan nilai-nilai keutamaan lokal</b>
                <br>
                <b>3 - Rumusan nilai-nilai utama karakter sesuai dengan semangat globalisasi, nilai-nilai keutamaan lokal, dan perkembangan anak.</b>
                <br>
                <b>4 - Rumusan nilai-nilai utama karakter menyelaraskan nilai-nilai keutamaan lokal dengan semangat globalisasi, dan perkembangan anak.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_11">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="11">Add More</button>
                  <br>
                  {!! Form::file('file[]', ['class' => 'mb-2']) !!}
              </div>
              </div>
            </div>
        </div>
        <div class="progress" hidden>
          <div class="progress-bar progress-bar-striped progress-bar-animated myprogress" role="progressbar" style="width:0%">0%</div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit_form">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>