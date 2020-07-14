<div class="card shadow-sm">
    <div class="card-header" id="heading10">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
          @php
              $str = "10. EVALUASI";
          @endphp
          {{ ucwords(strtolower($str))." PPK" }}
        </a>
      </h5>
    </div>
    <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td class="text-center">1</td>
                <td class="text-center" width="75%">Sekolah memiliki instrumen untuk mengukur dan mendokumentasikan keberhasilan program PPK.</td>
                <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 41)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="41" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="41" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Kepala sekolah, guru, orang tua dan komite sekolah melakukan kegiatan monitoring PPK secara rutin dan berkelanjutan.</td>
               <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 42)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="42" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="42" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Sekolah memiliki mekanisme umpan balik di antara peserta didik untuk memperbaiki perilaku individu dan budaya sekolah.</td>
               <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 43)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="43" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="43" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center" width="75%">Sekolah menindaklanjuti hasil monitoring untuk memperbaiki pelaksanaan kegiatan PPK.</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 44)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="44" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="44" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center">5</td>
            <td class="text-center" width="75%">Sekolah menggunakan dokumentasi dan data-data pendukung (presensi siswa, catatan harian sekolah, notulensi rapat, dan lain-lain) untuk menilai pelaksanaan dan keberhasilan program PPK.</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 45)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="45" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="45" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center">6</td>
            <td class="text-center" width="75%">Sekolah melibatkan seluruh sumber daya manusia yang tersedia dalam PPK.</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 46)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="46" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="46" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center">7</td>
            <td class="text-center" width="75%">Sekolah menggunakan sarana dan prasarana (lapangan olah raga, alat-alat kesenian, dan lain-lain) secara efektif.</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 47)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="47" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="47" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center">8</td>
            <td class="text-center" width="75%">Sekolah memanfaatkan berbagai media pembelajaran PPK (papan sekolah aman, poster, spanduk, website, buletin, mading, dan lain-lain).</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 48)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="48" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="48" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center">9</td>
            <td class="text-center" width="75%">Gerakan PPK meningkatkan prestasi akademik dan membangun budaya belajar mandiri.</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 49)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="49" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="49" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
<div class="modal fade" id="modalForm41" tabindex="-1" role="dialog" aria-labelledby="modalForm41Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm41Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_41" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_41" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 41)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memiliki instrumen untuk mengukur dan mendokumentasikan keberhasilan program PPK.") !!}
                    Sekolah memiliki instrumen untuk mengukur dan mendokumentasikan keberhasilan program PPK.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="41">
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
                <b>0 - Sekolah tidak memiliki instrumen untuk mengukur dan mendokumentasikan PPK</b>
                <br>
                <b>1 - Sekolah hanya memiliki satu instrumen atau melakukan dokumentasi saja terhadap kegiatan PPK</b>
                <br>
                <b>2 - Sekolah memiliki instrumen penilaian yang indikator keberhasilannya dibuat jelas dan dapat dievaluasi secara objektif, namun belum terdokumentasi dengan baik</b>
                <br>
                <b>3 - Sekolah memiliki beberapa instrumen penilaian yang indikator keberhasilannya dibuat jelas dan dapaat dievaluasi secara objektif, sudah terdokumentasi dengan baik, namun belum lengkap </b>
                <br>
                <b>4 - Sekolah memiliki berbagai macam instrumen penilaian yang baik dan dokumentasi lengkap (proposal, evaluasi pelaksanaan, laporan pertanggungjawaban, foto, video, dan lain-lain) dalam setiap kegiatan pengembangan PPK</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_41">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="41">Add More</button>
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
<div class="modal fade" id="modalForm42" tabindex="-1" role="dialog" aria-labelledby="modalForm42Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm42Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_42" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_42" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 42)
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
                    {!! Form::hidden('penjelasan_assessment', "Kepala sekolah, guru, orang tua dan komite sekolah melakukan kegiatan monitoring PPK secara rutin dan berkelanjutan.") !!}
                    Kepala sekolah, guru, orang tua dan komite sekolah melakukan kegiatan monitoring PPK secara rutin dan berkelanjutan.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="42">
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
                <b>0 - Kepala Sekolah, guru, orangtua dan komite sekolah tidak melakukan monitoring PPK</b>
                <br>
                <b>1 - Hanya kepala sekolah saja yang melakukan kegiatan monitoring PPK secara rutin dan berkelanjutan</b>
                <br>
                <b>2 - Hanya kepala sekolah dan guru saja yang melakukan kegiatan rutin monitoring secara berkelanjutan</b>
                <br>
                <b>3 - Hanya Kepala Sekolah, guru saja dan Komite sekolah yang melakukan kegiatan rutin monitoring</b>
                <br>
                <b>4 - Kepala sekolah, guru, orang tua dan Komite sekolah secara rutin dan berkelanjutanterlibat dalam memonitor dan mengevaluasi pelaksanaan PPK di sekolah</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_42">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="42">Add More</button>
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
<div class="modal fade" id="modalForm43" tabindex="-1" role="dialog" aria-labelledby="modalForm43Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm43Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_43" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_43" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 43)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memiliki mekanisme umpan balik di antara peserta didik untuk memperbaiki perilaku individu dan budaya sekolah.") !!}
                    Sekolah memiliki mekanisme umpan balik di antara peserta didik untuk memperbaiki perilaku individu dan budaya sekolah.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="43">
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
                <b>0 - Siswa tidak dilibatkan dalam evaluasi PPK</b>
                <br>
                <b>1 - Sekolah memiliki mekanisme umpan balik secara spontan </b>
                <br>
                <b>2 - Sekolah memiliki mekanisme umpan balik secara teratur dan siswa merasa nyaman melakukannya</b>
                <br>
                <b>3 - Sekolah memiliki mekanisme umpan balik secara teratur dan siswa merasa nyaman melakukannya, masukan rekan sebaya mendukung perubahan perilaku</b>
                <br>
                <b>4 - Sekolah memberi kesempatan pada masing-masing peserta didik untuk memberikan masukan satu sama lain untuk memperbaiki perilaku individu melalui mekanisme yang ramah dan bersahabat, siswa merasa nyaman memberikan kritik, masukan dan evaluasi terhadap budaya yang ada di lingkungan pendidikan, dan budaya perbaikan diri terus menerus terjadi di lingkungan sekolah</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_43">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="43">Add More</button>
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
<div class="modal fade" id="modalForm44" tabindex="-1" role="dialog" aria-labelledby="modalForm44Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm44Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_44" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_44" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 44)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah menindaklanjuti hasil monitoring untuk memperbaiki pelaksanaan kegiatan PPK.") !!}
                    Sekolah menindaklanjuti hasil monitoring untuk memperbaiki pelaksanaan kegiatan PPK.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="44">
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
                <b>0 - Sekolah tidak merespons hasil monitoring dan evaluasi</b>
                <br>
                <b>1 - Sekolah menindaklanjuti monitoring dan evaluasi ala kadarnya, tanpa perencanaan</b>
                <br>
                <b>2 - Sekolah menindaklanjuti monitoring dan evaluasi secara rutin dan menentukan langkah-langkah perubahan</b>
                <br>
                <b>3 - Sekolah menindaklanjuti monitoring dan evaluasi, menentukan langkah-langkah perubahan, membuat prioritas perbaikan</b>
                <br>
                <b>4 - Sekolah menindaklanjuti hasil monitoring dan evaluasi secara rutin, menentukan langkah-langkah perubahan, membuat prioritas-prioritas perbaikan, dan memiliki sistem pertanggungjawaban yang dapat dikontrol oleh komunitas sekolah</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}      
                <div class="form-group" id="upload-file_44">  
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="44">Add More</button>
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
<div class="modal fade" id="modalForm45" tabindex="-1" role="dialog" aria-labelledby="modalForm45Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm45Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_45" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_45" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 45)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah menggunakan dokumentasi dan data-data pendukung (presensi siswa, catatan harian sekolah, notulensi rapat, dan lain-lain) untuk menilai pelaksanaan dan keberhasilan program PPK.") !!}
                    Sekolah menggunakan dokumentasi dan data-data pendukung (presensi siswa, catatan harian sekolah, notulensi rapat, dan lain-lain) untuk menilai pelaksanaan dan keberhasilan program PPK.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="45">
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
                <b>0 - Sekolah tidak memiliki dokumentasi pelaksanaan PPK</b>
                <br>
                <b>1 - Sekolah hanya memiliki sebagian dokumentasi program dan tidak digunakan untuk menilai PPK</b>
                <br>
                <b>2 - Sekolah memiliki beberapa dokumentasi program PPK namun belum menggunakan secara maksimal sebagai data pendukung untuk menilai PPK</b>
                <br>
                <b>3 - Sekolah memiliki banyak dokumen (cetak, tertulis) program PPK danmempergunakannya untuk menilai keberhasilan PPK</b>
                <br>
                <b>4 - Sekolah memiliki berbagai macam format dokumentasi (cetak, tertulis, multimedia) untuk mendokumentasi kan setiap kegiatan PPK dan mempergunakan data-data pendukung untuk menilai pelaksanaan dan keberhasilan program PPK.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_45">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="45">Add More</button>
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
<div class="modal fade" id="modalForm46" tabindex="-1" role="dialog" aria-labelledby="modalForm46Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm46Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_46" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_46" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 46)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah melibatkan seluruh sumber daya manusia yang tersedia dalam PPK.") !!}
                    Sekolah melibatkan seluruh sumber daya manusia yang tersedia dalam PPK.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="46">
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
                <b>0 - Sekolah hanya melibatkan guru dan tidak melibatkan pemangku kepentingan lain </b>
                <br>
                <b>1 - Sekolah melibatkan personalia di internal sekolah saja (guru, siswa, tenaga kependidikan, karyawan)</b>
                <br>
                <b>2 - Sekolah melibatkan personalia di internal sekolah dan eksternal sekolah (orang tua, masyarakat) namun keterlibatan masyarakat ini masih merupakan inisiatif sekolah</b>
                <br>
                <b>3 - Sekolah melibatkan personalia di internal sekolah dan eksternal sekolah (orangtua, masyarakat), ada program-program PPK yang muncul dari inisiatif dari sekolah dan masyarakat</b>
                <br>
                <b>4 - Seluruh sumber daya manusia di sekolah (pendidik, tenaga kependidikan, karyawan, siswa, orang tua, masyarakat) terlibat secara aktif dan dilibatkan dalam pengembangan penguatan pendidikan karakter melalui berbagai macam inisiatif yang memperkaya pengalaman belajar peserta didik</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_46">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="46">Add More</button>
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
<div class="modal fade" id="modalForm47" tabindex="-1" role="dialog" aria-labelledby="modalForm47Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm47Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_47" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_47" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 47)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah menggunakan sarana dan prasarana (lapangan olah raga, alat-alat kesenian, dan lain-lain) secara efektif.") !!}
                    Sekolah menggunakan sarana dan prasarana (lapangan olah raga, alat-alat kesenian, dan lain-lain) secara efektif.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="47">
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
                <b>0 - Sekolah tidak memanfaatkan sarana dan prasarana yang ada </b>
                <br>
                <b>1 - Sekolah hanya memanfaatkan satu sarana dan prasarana yang ada bagi peserta didik</b>
                <br>
                <b>2 - Sekolah memanfaatkan sarana dan prasarana untuk peserta didik dan guru</b>
                <br>
                <b>3 - Sekolah memanfaatkan sarana dan prasarana untuk peserta didik, guru dan anggota komunitas sekolah serta menjaga dan merawat sarana dan prasarana tersebut secara rutin</b>
                <br>
                <b>4 - Sekolah memanfaatkan dan mempergunakan sarana dan prasarana yang ada bagi peserta didik, guru, orang tua dan masyarakat secara efektif untuk mendukung pelaksanaan PPK di sekolah</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_47">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="47">Add More</button>
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
<div class="modal fade" id="modalForm48" tabindex="-1" role="dialog" aria-labelledby="modalForm48Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm48Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_48" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_48" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 48)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memanfaatkan berbagai media pembelajaran PPK (papan sekolah aman, poster, spanduk, website, buletin, mading, dan lain-lain).") !!}
                    Sekolah memanfaatkan berbagai media pembelajaran PPK (papan sekolah aman, poster, spanduk, website, buletin, mading, dan lain-lain).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="48">
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
                <b>0 - Tidak ada media satupun yang dimanfaatkan untuk media pembelajaran PPK</b>
                <br>
                <b>1 - Sekolah hanya memanfaatkan maksimal 2 media saja untuk pembelajaran PPK</b>
                <br>
                <b>2 - Sekolah memanfaatkan maksimal 5 media untuk pembelajaran PPK</b>
                <br>
                <b>3 - Sekolah memanfaatkan maksimal 8 media untuk pembelajaran PPK</b>
                <br>
                <b>4 - Di lingkungan sekolah tampak dengan jelas berbagai macam media dimanfaatkan untuk pengembangan PPK, mulai dari papan nama sekolah aman, poster, spanduk, website, buletin, majalan dinding, taman, dan lain-lain.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_48">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="48">Add More</button>
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
<div class="modal fade" id="modalForm49" tabindex="-1" role="dialog" aria-labelledby="modalForm49Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm49Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_49" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_49" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 49)
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
                    {!! Form::hidden('penjelasan_assessment', "Gerakan PPK meningkatkan prestasi akademik dan membangun budaya belajar mandiri.") !!}
                    Gerakan PPK meningkatkan prestasi akademik dan membangun budaya belajar mandiri.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="49">
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
                <b>0 - Tidak terjadi peningkatan, stagnan, atau malah menurun</b>
                <br>
                <b>1 - Terjadi peningkatan prestasi akademis pada sebagian kecil siswa (25 persen)</b>
                <br>
                <b>2 - Terjadi peningkatan prestasi akademis pada separuh siswa (50 persen)</b>
                <br>
                <b>3 - Terjadi peningkatan prestasi akademis pada sebagian besar siswa (75 persen)</b>
                <br>
                <b>4 - Terjadi peningkatan kualitas pembelajaran di sekolah secara signifikan (100 persen). Ini dibuktikan dengan adanya kenaikan nilai masing-masing individu dan naiknya nilai rerata kelas per mata pelajaran, dan ditandai dengan bertumbuhnya gairah belajar dalam diri peserta didik.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_49">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="49">Add More</button>
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