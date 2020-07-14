<div class="card shadow-sm">
    <div class="card-header" id="heading6">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
          @php
              $str = "BERBASIS KELAS";
          @endphp
          {{ "6. PPK ".ucwords(strtolower($str)) }}
        </a>
      </h5>
    </div>
    <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
          <thead>
             <th class="text-center">No</th>
             <th class="text-center">Penjelasan Assessment</th>
             <th class="text-center">Skor</th>
          </thead>
          <tbody>
              <td class="text-center">1</td>
              <td class="text-center" width="75%">Guru mengintegrasikan nilai-nilai utama PPK dalam desain rencana pelaksanaan pembelajaran (RPP).</td>
              <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 22)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="22" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="22" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
             <td class="text-center">Guru mengembangkan skenario pembelajaran yang dapat memperkuat nilai-nilai karakter.</td>
             <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 23)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="23" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="23" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
             <td class="text-center">Guru mengaitkan isi materi pembelajaran dengan persoalan kehidupan sehari-hari.</td>
             <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 24)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="24" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="24" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
          <td class="text-center" width="75%">Sekolah mengembangkan kapasitas guru secara berkelanjutan (pelatihan, lesson studies, berbagi pengalaman, dan lain-lain).</td>
          <td width="20%" class="text-center">
            @foreach ($json_assessmen as $item)
            @if ($item->no == 25)
              @if (empty($item->penjelasan_assessment))
              <button type="button" class="btn btn-primary btn-sm lihat_form" value="25" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
              @else
              <button type="button" class="btn btn-warning btn-sm lihat_form" value="25" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
  <div class="modal fade" id="modalForm22" tabindex="-1" role="dialog" aria-labelledby="modalForm22Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm22Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_22" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_22" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 22)
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
                    {!! Form::hidden('penjelasan_assessment', "Guru mengintegrasikan nilai-nilai utama PPK dalam desain rencana pelaksanaan pembelajaran (RPP).") !!}
                    Guru mengintegrasikan nilai-nilai utama PPK dalam desain rencana pelaksanaan pembelajaran (RPP).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="22">
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
                <b>0 - Tidak ada guru yang mengintegrasikan nilai utama PPK dalam RPP</b>
                <br>
                <b>1 - 25 persen gurumengintegrasikan nilai-nilai PPK di dalam RPP melalui skenario pembelajaran terstruktur disertai model evaluasi yang relevan</b>
                <br>
                <b>2 - 50 persen gurumengintegrasikan nilai-nilai PPK di dalam RPP melalui skenario pembelajaran terstruktur disertai model evaluasi yang relevan</b>
                <br>
                <b>3 - 75 persen gurumengintegrasikan nilai-nilai PPK di dalam RPP melalui skenario pembelajaran terstruktur disertai model evaluasi yang relevan</b>
                <br>
                <b>4 - Semua guru mengintegrasikan nilai-nilai PPK di dalam RPP melalui skenario pembelajaran terstruktur disertai model evaluasi yang relevan</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_22">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="22">Add More</button>
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
<div class="modal fade" id="modalForm23" tabindex="-1" role="dialog" aria-labelledby="modalForm23Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm23Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_23" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_23" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 23)
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
                    {!! Form::hidden('penjelasan_assessment', "Guru mengembangkan skenario pembelajaran yang dapat memperkuat nilai-nilai karakter.") !!}
                    Guru mengembangkan skenario pembelajaran yang dapat memperkuat nilai-nilai karakter.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="23">
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
                <b>0 - Guru tidak mengembangkan skenario pembelajaran yang inovatif</b>
                <br>
                <b>1 - Guru mengembangkan skenario pembelajaran yang kreatif dan inovatif, tetapi belum mengaitkan dengan kegiatan intrakurikuler dan kokurikuler, atau ekstrakurikuler</b>
                <br>
                <b>2 - Guru mengembangkan skenario pembelajaran yang kreatif dan inovatif, mengaitkan kegiatan intrakurikuler dan kokurikuler</b>
                <br>
                <b>3 - Guru mengembangkan skenario pembelajaran yang kreatif dan inovatif, mengaitkan kegiatan intrakurikuler dan kokurikuler, bahkan ekstrakurikuler</b>
                <br>
                <b>4 - Guru mengembangkan skenario pembelajaran yang kreatif dan inovatif, mengaitkan kegiatan intrakurikuler dan kokurikuler, bahkan ekstrakurikuler, serta mengaitkan dengan konteks kehidupan nyata.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_23">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="23">Add More</button>
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
<div class="modal fade" id="modalForm24" tabindex="-1" role="dialog" aria-labelledby="modalForm24Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm24Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_24" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_24" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 24)
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
                    {!! Form::hidden('penjelasan_assessment', "Guru mengaitkan isi materi pembelajaran dengan persoalan kehidupan sehari-hari.") !!}
                    Guru mengaitkan isi materi pembelajaran dengan persoalan kehidupan sehari-hari.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="24">
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
                <b>0 - Guru tidak mengaitkan isi pembelajaran dengan persoalan kehidupan sehari-hari</b>
                <br>
                <b>1 - Guru mengaitkan isi pembelajaran dengan persoalan-persoalan kehidupan sehari-hari </b>
                <br>
                <b>2 - Guru mengaitkan isi pembelajaran dengan persoalan-persoalan kehidupan sehari-hari sesuai dengan perkembangan usia siswa</b>
                <br>
                <b>3 - Guru mengaitkan isi pembelajaran dengan persoalan-persoalan kehidupan sehari-hari dan memperkaya dengan tugas-tugas pemecahan masalah sehari-hari.</b>
                <br>
                <b>4 - Guru mengaitkan isi pembelajaran dengan persoalan-persoalan kehidupan sehari-hari dan memperkaya dengan tugas-tugas pemecahan masalah sehari-hari sesuai dengan perkembangan usia siswa.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_24">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="24">Add More</button>
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
<div class="modal fade" id="modalForm25" tabindex="-1" role="dialog" aria-labelledby="modalForm25Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm25Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_25" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_25" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 25)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah mengembangkan kapasitas guru secara berkelanjutan (pelatihan, lesson studies, berbagi pengalaman, dan lain-lain).") !!}
                    Sekolah mengembangkan kapasitas guru secara berkelanjutan (pelatihan, lesson studies, berbagi pengalaman, dan lain-lain).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="25">
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
                <b>0 - Sekolah tidak melakukan pengembangan kapasitas guru</b>
                <br>
                <b>1 - Sekolah melakukan pelatihan guru dalam pengembangan pembelajaran atas undangan dari luar</b>
                <br>
                <b>2 - Sekolah melakukan pelatihan guru dalam pengembangan pembelajaran atas inisiatif sekolah</b>
                <br>
                <b>3 - Sekolah melakukan pengembangan guru dalam pengembangan pembelajaran secara berkelanjutan atas inisiatif sekolah</b>
                <br>
                <b>4 - Sekolah memiliki rencana dan sistem manajemen pengembangan guru dalam pembelajaran secara berkelanjutan atas inisiatif sekolah, dan dilaksanakan secara efektif</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_25">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="25">Add More</button>
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