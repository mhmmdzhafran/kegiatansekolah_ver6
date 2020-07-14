<div class="card shadow-sm">
    <div class="card-header" id="heading7">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
          @php
              $str = "7. PENGEMBANGAN BUDAYA SEKOLAH";
          @endphp
          {{ ucwords(strtolower($str)) }}
        </a>
      </h5>
    </div>
    <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td class="text-center">1</td>
                <td class="text-center" width="75%">Sekolah memiliki dan mengembangkan tradisi-tradisi unggulan yang memperkuat budaya sekolah.</td>
            <td class="text-center" width="20%">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 26)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="26" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="26" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Sekolah mengembangkan dan mengapresiasi kearifan lokal.</td>
               <td class="text-center" width="20%">
               @foreach ($json_assessmen as $item)
                @if ($item->no == 27)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="27" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="27" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Sekolah mengembangkan budaya belajar yang menumbuhkan keterampilan abad 21 (berpikir kritis, kreatif, komunikasi dan kolaborasi, literasi multimedia).</td>
               <td class="text-center" width="20%">
               @foreach ($json_assessmen as $item)
               @if ($item->no == 28)
                 @if (empty($item->penjelasan_assessment))
                 <button type="button" class="btn btn-primary btn-sm lihat_form" value="28" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                 @else
                 <button type="button" class="btn btn-warning btn-sm lihat_form" value="28" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center">4</td>
            <td class="text-center" width="75%">Bimbingan konseling memiliki program-program yang relevan yang mendukung penguatan PPK di tingkat kelas, pengembangan budaya sekolah dan pelibatan masyarakat.</td>
            <td class="text-center" width="20%">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 29)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="29" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="29" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
<div class="modal fade" id="modalForm26" tabindex="-1" role="dialog" aria-labelledby="modalForm26Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm26Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_26" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_26" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 26)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memiliki dan mengembangkan tradisi-tradisi unggulan yang memperkuat budaya sekolah.") !!}
                    Sekolah memiliki dan mengembangkan tradisi-tradisi unggulan yang memperkuat budaya sekolah.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="26">
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
                <b>0 - Sekolah tidak memiliki dan mengembangkan tradisi unggulan</b>
                <br>
                <b>1 - Sekolah memiliki dan mengembangkan tradisi-tradisi unggulan yang hanya memperkuat salah satu dimensi saja (kolaborasi, komunikasi, budaya belajar, dan kreativitas)</b>
                <br>
                <b>2 - Sekolah memiliki dan mengembangkan tradisi-tradisi unggulan yang memperkuat kolaborasi dan komunikasi saja</b>
                <br>
                <b>3 - Sekolah memiliki dan mengembangkan tradisi-tradisi unggulan yang memperkuat kolaborasi, komunikasi dan budaya belajar</b>
                <br>
                <b>4 - Sekolah memiliki dan mengembangkan tradisi-tradisi unggulan yang memperkuat kolaborasi, komunikasi, budaya belajar dan penumbuhan kreativitas</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_26">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="26">Add More</button>
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
<div class="modal fade" id="modalForm27" tabindex="-1" role="dialog" aria-labelledby="modalForm27Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm27Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_27" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_27" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 27)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah mengembangkan dan mengapresiasi kearifan lokal.") !!}
                    Sekolah mengembangkan dan mengapresiasi kearifan lokal.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="27">
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
                <b>0 - Sekolah tidak mengembangkan dan mengapresiasi kearifan lokal</b>
                <br>
                <b>1 - Sekolah melakukan analisis tentang kearifan lokal dan belum membuat telaah kritis atasnya</b>
                <br>
                <b>2 - Sekolah melakukan analisis tentang kearifan lokal, menelaah dan mengevaluasinya secara kritis, namun belum mengembangkan dan mengintegrasikandalam pembelajaran</b>
                <br>
                <b>3 - Sekolah melakukan analisis tentang kearifan lokal, menelaah dan mengevaluasinya secara kritis dan mengembangkan program ini dengan mengintegrasikannya pada beberapa unsur pembelajaran</b>
                <br>
                <b>4 - Sekolah melakukan analisis tentang kearifan lokal yang ada di daerahnya, menelaah dan mengevaluasi kearifan lokal secara kritis, dan mengembangkan tradisi dan nilai-nilai kebaikan keutamaan lokal melalui pengembangan program pendidikan di sekolah dan mengintegrasikannya dalam keseluruhan proses belajar mengajar (metode pengajaran, pengelolaan kelas, dan penguatan materi kurikulum) </b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_27">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="27">Add More</button>
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
<div class="modal fade" id="modalForm28" tabindex="-1" role="dialog" aria-labelledby="modalForm28Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm28Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_28" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_28" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 28)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah mengembangkan budaya belajar yang menumbuhkan keterampilan abad 21 (berpikir kritis, kreatif, komunikasi dan kolaborasi, literasi multimedia).") !!}
                    Sekolah mengembangkan budaya belajar yang menumbuhkan keterampilan abad 21 (berpikir kritis, kreatif, komunikasi dan kolaborasi, literasi multimedia).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="28">
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
                <b>0 - Sekolah tidak mengembangkan budaya belajar yang menumbuhkan keterampilan abad-21</b>
                <br>
                <b>1 - Sekolah mengembangkan budaya belajar yang menumbuhkan hanya satu keterampilan abad-21 saja (berpikir kritis/kreatif/komunikatif/kolaborasi/literasi multimedia)</b>
                <br>
                <b>2 - Sekolah mengembangkan budaya belajar yang menumbuhkan keterampilan abad-21, namun tidak terintegrasi dalam pembelajaran</b>
                <br>
                <b>3 - Sekolah mengembangkan budaya belajar yang menumbuhkan keterampilan abad-21 dan terintegrasi di dalam pembelajaran saja, tanpa melibatkan masyarakat</b>
                <br>
                <b>4 - Sekolah mengembangkan budaya belajar yang menumbuhkan keterampilan abad-21 (berpikir kritis, kreatif, komunikasi, kolaborasi dan literasi multimedia), baik di dalam pembelajaran maupun dalam pengembangan budaya sekolah dan kerja sama dengan masyarakat.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_28">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="28">Add More</button>
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
<div class="modal fade" id="modalForm29" tabindex="-1" role="dialog" aria-labelledby="modalForm29Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm29Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_29" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_29" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 29)
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
                    {!! Form::hidden('penjelasan_assessment', "Bimbingan konseling memiliki program-program yang relevan yang mendukung penguatan PPK di tingkat kelas, pengembangan budaya sekolah dan pelibatan masyarakat.") !!}
                    Bimbingan konseling memiliki program-program yang relevan yang mendukung penguatan PPK di tingkat kelas, pengembangan budaya sekolah dan pelibatan masyarakat.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="29">
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
                <b>0 - Bimbingan Konseling tidak membuat program terkait PPK</b>
                <br>
                <b>1 - Bimbingan konseling mengembangkan kegiatan untuk mendampingi pembelajaran di kelas saja</b>
                <br>
                <b>2 - Bimbingan konseling mengembangkan kegiatan untuk peningkatan pembelajaran di kelas dan memiliki program pengembangan budaya sekolah secara jelas</b>
                <br>
                <b>3 - Bimbingan konseling mengembangkan kegiatan untuk peningkatan pembelajaran di kelas dan mengembangkan budaya sekolah secara jelas dan melibatkan pendidik lain</b>
                <br>
                <b>4 - Bimbingan konseling memiliki program-program relevan yang mendukung penguatan PPK di tingkat kelas, pengembangan budaya sekolah, melibatkan pendidik lain dan pelibatan masyarakat. Ini dilihat dari berbagai macam kegiatan yang dilakukan oleh Bimbingan Konseling sekolah.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_29">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="29">Add More</button>
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