<div class="card shadow-sm">
    <div class="card-header" id="heading8">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
          @php
              $str = "8. PARTISIPASI MASYARAKAT";
          @endphp
          {{ ucwords(strtolower($str)) }}
        </a>
      </h5>
    </div>
    <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td class="text-center">1</td>
                <td class="text-center" width="75%">Sekolah mengembangkan kapasitas orangtua, paguyuban wali murid dan komite sekolah agar mereka dapat berfungsi secara efektif dalam mendukung dan memperkuat program PPK di sekolah melalui dukungan pikiran, tenaga, materi, dan finansial. </td>
                <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 30)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="30" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="30" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Komite sekolah berperan aktif dalam mendukung program PPK.</td>
               <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 31)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="31" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="31" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Ada pelibatan masyarakat (paguyuban orang tua siswa, komite sekolah, tokoh masyarakat, pelaku seni dan budaya, DU/DI, perguruan tinggi, ikatan alumni, media,  dan lembaga pemerintah) dalam kegiatan Penguatan Pendidikan Karakter.</td>
               <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 32)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="32" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="32" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center" width="75%">Masyarakat aktif memberikan umpan balik dalam rangka evaluasi dan perbaikan pelaksanaan PPK.</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 33)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="33" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="33" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center" width="75%">Sekolah memanfaatkan sumber-sumber pembelajaran di luar lingkungan sekolah secara maksimal dan efektif.</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 34)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="34" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="34" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center" width="75%">Sekolah memiliki sumber-sumber pendanaan dari masyarakat untuk mengembangkan PPK. </td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 35)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="35" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="35" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
<div class="modal fade" id="modalForm30" tabindex="-1" role="dialog" aria-labelledby="modalForm30Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm30Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_30" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_30" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 30)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah mengembangkan kapasitas orangtua, paguyuban wali murid dan komite sekolah agar mereka dapat berfungsi secara efektif dalam mendukung dan memperkuat program PPK di sekolah melalui dukungan pikiran, tenaga, materi, dan finansial.") !!}
                    Sekolah mengembangkan kapasitas orangtua, paguyuban wali murid dan komite sekolah agar mereka dapat berfungsi secara efektif dalam mendukung dan memperkuat program PPK di sekolah melalui dukungan pikiran, tenaga, materi, dan finansial.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="30">
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
                <b>0 - Komite sekolah dan orang tua tidak memperoleh pengembangan kapasitas dalam rangka PPK di sekolah</b>
                <br>
                <b>1 - Komite sekolah/orang tua hanya memperoleh informasi dan sosialisasi saja tentang PPK</b>
                <br>
                <b>2 - Sekolah hanya memberi sosialisasi tentang PPK pada orang tua dan komite sekolah namun belum melibatkan mereka dalam keseluruhan program</b>
                <br>
                <b>3 - Sekolah mengembangkan kapasitas orangtua, paguyuban wali murid dan komite sekolah hanya dari sisi finansial saja</b>
                <br>
                <b>4 - Sekolah mengembangkan kapasitas orangtua, paguyuban wali murid dan komite sekolah agar mereka dapat berfungsi secara efektif dalam mendukung dan memperkuat program PPK di sekolah melalui dukungan pikiran, tenaga, materi, dan finansial </b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_30">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="30">Add More</button>
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
<div class="modal fade" id="modalForm31" tabindex="-1" role="dialog" aria-labelledby="modalForm31Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm31Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_31" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_31" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 31)
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
                    {!! Form::hidden('penjelasan_assessment', "Komite sekolah berperan aktif dalam mendukung program PPK.") !!}
                    Komite sekolah berperan aktif dalam mendukung program PPK.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="31">
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
                <b>0 - Komite Sekolah tidak berperan secara aktif</b>
                <br>
                <b>1 - Komite sekolah ada, namun hanya berfungsi sebagai pelengkap administrasi tata kelola sekolah saja</b>
                <br>
                <b>2 - Komite sekolah berperanan secara aktif mendukung program PPK dengan mempergunakan sumber daya internal yang mereka miliki saja</b>
                <br>
                <b>3 - Komite sekolah berperanan secara aktif mendukung program PPK dengan mempergunakan sumber daya internal yang mereka miliki, dan memiliki usaha untuk mencari dukungan dari masyarakat di luar sekolah</b>
                <br>
                <b>4 - Komite sekolah memiliki peranan aktif dalam mendukung program PPK dengan mempergunakan sumberdaya internal yang mereka miliki, menjadi penghubung antara sekolah dan masyarakat, dan mendukung kinerja Kepala Sekolah dan mampu merealisasikan kolaborasi itu melalui program-program PPK yang didesain oleh sekolah</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_31">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="31">Add More</button>
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
<div class="modal fade" id="modalForm32" tabindex="-1" role="dialog" aria-labelledby="modalForm32Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm32Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_32" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_32" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 32)
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
                    {!! Form::hidden('penjelasan_assessment', "Ada pelibatan masyarakat (paguyuban orang tua siswa, komite sekolah, tokoh masyarakat, pelaku seni dan budaya, DU/DI, perguruan tinggi, ikatan alumni, media,  dan lembaga pemerintah) dalam kegiatan Penguatan Pendidikan Karakter.") !!}
                    Ada pelibatan masyarakat (paguyuban orang tua siswa, komite sekolah, tokoh masyarakat, pelaku seni dan budaya, DU/DI, perguruan tinggi, ikatan alumni, media,  dan lembaga pemerintah) dalam kegiatan Penguatan Pendidikan Karakter.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="32">
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
                <b>0 - Tidak ada pelibatan masyarakat</b>
                <br>
                <b>1 - Sekolah hanya melibatkan orangtua dalam pengembangan PPK ( minimal 1 unsur masyarakat)</b>
                <br>
                <b>2 - Sekolah melibatkan orang tua, Komite dan tokoh masyarakat (minimal 3 unsur masyarakat)</b>
                <br>
                <b>3 - Sekolah melibatkan orang tua, komite sekolah, tokoh masyarakat, dan perguruan tinggi (minimal 4 unsur masyarakat)</b>
                <br>
                <b>4 - Seluruh potensi partisipasi pengembangan PPK yang tersedia di dalam masyarakat (paguyuban orang tua siswa, komite sekolah, tokoh masyarakat, pelaku seni dan budaya, DU/DI, perguruan tinggi, ikatan alumni, media, dan lembaga pemerintah, dan lain-lain) telah dipergunakan secara maksimal untuk keberhasilan program PPK di sekolah dengan melibatkan seluruh pemangku kepentingan pendidikan yang ada.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_32">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="32">Add More</button>
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
<div class="modal fade" id="modalForm33" tabindex="-1" role="dialog" aria-labelledby="modalForm33Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm33Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_33" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_33" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 33)
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
                    {!! Form::hidden('penjelasan_assessment', "Masyarakat aktif memberikan umpan balik dalam rangka evaluasi dan perbaikan pelaksanaan PPK.") !!}
                    Masyarakat aktif memberikan umpan balik dalam rangka evaluasi dan perbaikan pelaksanaan PPK.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="33">
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
                <b>0 - Tidak ada mekanisme umpak balik dalam rangka evaluasi dan perbaikan pelaksanaan PPK</b>
                <br>
                <b>1 - Masyarakat yang terlibat aktif memberikan umpan balik dalam rangka evaluasi PPK di sekolah hanya Komite sekolah</b>
                <br>
                <b>2 - Masyarakat yang terlibat aktif memberikan umpan balik dalam rangka evaluasi PPK disekolah selain Komites Sekolah, juga melibatkan orang tua secara pribadi maupun paguyuban orang tua/wali murid</b>
                <br>
                <b>3 - Masyarakat yang terlibat aktif memberikan umpan balik dalam rangka evaluasi PPK disekolah selain komite sekolah, melibatkan orang tua secara pribadi, paguyuban orang tua/wali murid, juga melibatkan perguruan tinggi/organisasi masyarakat sipil/DU/DI, media massa, dan lain-lain, meskipun belum terstruktur dalam sistemsekolah.</b>
                <br>
                <b>4 - Masyarakat (seluruh pemangku kepentingan pendidikan) sesuai dengan tugas peranannya masing-masing, aktif memberikan umpan balik dalam rangka evaluasi dan perbaikan pelaksanaan PPK di unit sekolah melalui mekanisme yang terstruktur dan dilakukan secara rutin</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_33">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="33">Add More</button>
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
<div class="modal fade" id="modalForm34" tabindex="-1" role="dialog" aria-labelledby="modalForm34Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm34Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_34" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_34" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 34)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memanfaatkan sumber-sumber pembelajaran di luar lingkungan sekolah secara maksimal dan efektif.") !!}
                    Sekolah memanfaatkan sumber-sumber pembelajaran di luar lingkungan sekolah secara maksimal dan efektif.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="34">
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
                <b>0 - Sekolah tidak memanfaatkan sumber-sumber pembelajaran di luar lingkungan sekolah</b>
                <br>
                <b>1 - Sekolah hanya memanfaatkan satu sumber pembelajaran di luar lingkungan sekolah (misal, museum, sanggar seni, dan lain-lain)</b>
                <br>
                <b>2 - Sekolah memanfaatkan minimal tiga sumber pembelajaran di luar lingkungan sekolah</b>
                <br>
                <b>3 - Sekolah memanfaatkan minimal lima sumber pembelaaran di luar lingkungan sekolah dan dimanfaatkan secara maksimal dan efektif dalam rangka pengembangan program PPK </b>
                <br>
                <b>4 - Seluruh potensi sumber-sumber pembelajaran yang ada di luar sekolah telah dimanfaatkan secara maksimal dan efektif dalam rangka pengembangan program PPK</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_34">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="34">Add More</button>
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
<div class="modal fade" id="modalForm35" tabindex="-1" role="dialog" aria-labelledby="modalForm35Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm35Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_35" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_35" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 35)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memiliki sumber-sumber pendanaan dari masyarakat untuk mengembangkan PPK. ") !!}
                    Sekolah memiliki sumber-sumber pendanaan dari masyarakat untuk mengembangkan PPK. 
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="35">
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
                <b>0 - Sekolah Tidak memiliki sumber-sumber pendanaan PPK dari masyarakat</b>
                <br>
                <b>1 - Sekolah hanya mengandalkan dana PPK dari orang tua dan pemerintah</b>
                <br>
                <b>2 - Sekolah mengandalkan dana PPK dari orang tua dan pemerintah, serta kerja sama dengan komite sekolah untuk mencari dana yang dibutuhkan namun belum tersistem/spontan</b>
                <br>
                <b>3 - Sekolah mengandalkan dana PPK dari orang tua, pemerintah dan kolaborasi dengan komite sekolah secara tersistem untuk mengembangkan lembaga pendidikan</b>
                <br>
                <b>4 - Sekolah memiliki banyak sumber pendanaan untuk mengembangkan PPK dari masyarakat, keterlibatan masyarakat dalam pengembangan PPK dibuat dalam sebuah perjanjian kerja sama yang transparan dan akuntabel.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_35">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="35">Add More</button>
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
