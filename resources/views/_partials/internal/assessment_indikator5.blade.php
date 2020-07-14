<div class="card shadow-sm">
    <div class="card-header" id="heading5">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
          @php
              $str = "5. DESAIN PROGRAM";
          @endphp
          {{ ucwords(strtolower($str)) }}
        </a>
      </h5>
    </div>
    <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td class="text-center">1</td>
                <td class="text-center" width="75%">Sekolah mengembangkan program PPK secara seimbang antara olah raga, olah pikir, olah rasa, dan olah hati.</td>
                <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 15)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="15" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="15" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Sekolah menggunakan potensi lingkungan sebagai ekstensi ruang pembelajaran sehingga pembelajaran berlangsung dalam kehidupan yang luas.</td>
               <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 16)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="16" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="16" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Sekolah memiliki program unggulan PPK dengan mengintegrasikan nilai-nilai utama PPK dalam setiap aktivitas pembelajaran (intrakurikuler dan kokurikuler).</td>
               <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 17)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="17" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="17" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center" width="75%">Sekolah memiliki program bersifat kesukarelawanan (volunter).</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 18)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="18" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="18" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center" width="75%">Kegiatan-kegiatan ekstrakurikuler mendukung pengembangan branding sekolah.</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 19)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="19" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="19" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center" width="75%">Program PPK sesuai dengan tahap perkembangan usia peserta didik</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 20)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="20" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="20" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
            <td class="text-center" width="75%">Sekolah memiliki kegiatan pembiasaan untuk menanamkan nilai-nilai utama PPK</td>
            <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 21)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="21" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="21" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
<div class="modal fade" id="modalForm15" tabindex="-1" role="dialog" aria-labelledby="modalForm15Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm15Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_15" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_15" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 15)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah mengembangkan program PPK secara seimbang antara olah raga, olah pikir, olah rasa, dan olah hati.") !!}
                    Sekolah mengembangkan program PPK secara seimbang antara olah raga, olah pikir, olah rasa, dan olah hati.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="15">
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
                <b>0 - Sekolah belum mengembangkan program PPK </b>
                <br>
                <b>1 - Sekolah mengembangkan program olah pikir</b>
                <br>
                <b>2 - Sekolah mengembangkan program olah pikir dan olah raga</b>
                <br>
                <b>3 - Sekolah mengembangkan program olah pikir, olah raga, dan olah hati</b>
                <br>
                <b>4 - Sekolah mengembangkan program olah pikir, olah raga, olah hati, dan olah rasa secara serasi dan seimbang, melalui kegiatan pembelajaran dan ekstrakulikuler</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                 <div class="form-group" id="upload-file_15">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="15">Add More</button>
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
<div class="modal fade" id="modalForm16" tabindex="-1" role="dialog" aria-labelledby="modalForm16Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm16Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_16" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_16" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 16)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah menggunakan potensi lingkungan sebagai ekstensi ruang pembelajaran sehingga pembelajaran berlangsung dalam kehidupan yang luas.") !!}
                    Sekolah menggunakan potensi lingkungan sebagai ekstensi ruang pembelajaran sehingga pembelajaran berlangsung dalam kehidupan yang luas.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="16">
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
                <b>0 - Sekolah belum memanfaatkan potensi lingkungan sebagai sumber belajar</b>
                <br>
                <b>1 - Sekolah memanfaatkan potensi lingkungan fisik dalam sekolah sebagai sumber belajar</b>
                <br>
                <b>2 - Sekolah memanfaatkan potensi lingkungan fisik dan sosio-kultural di dalam sekolah sebagai sumber belajar</b>
                <br>
                <b>3 - Sekolah memanfaatkan potensi lingkungan fisik baik di dalam maupun di luar sekolah sebagai sumber belajar</b>
                <br>
                <b>4 -  Sekolah memanfaatkan potensi lingkungan fisik dan sosio-kultural baik di dalam maupun di luar sekolah sebagai sumber belajar</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                 <div class="form-group" id="upload-file_16">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="16">Add More</button>
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
<div class="modal fade" id="modalForm17" tabindex="-1" role="dialog" aria-labelledby="modalForm17Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm17Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_17" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_17" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 17)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memiliki program unggulan PPK dengan mengintegrasikan nilai-nilai utama PPK dalam setiap aktivitas pembelajaran (intrakurikuler dan kokurikuler).") !!}
                    Sekolah memiliki program unggulan PPK dengan mengintegrasikan nilai-nilai utama PPK dalam setiap aktivitas pembelajaran (intrakurikuler dan kokurikuler).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="17">
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
                <b>0 - Sekolah tidak memiliki program unggulan</b>
                <br>
                <b>1 - Sekolah memiliki program unggulan</b>
                <br>
                <b>2 - Sekolah memiliki program unggulan, terintegrasi dalam pembelajaran di kelas, namun belum mengintegrasikan nilai-nilai utama PPK</b>
                <br>
                <b>3 - Sekolah memiliki program unggulan PPK yang terintegrasi dalam pembelajaran di dalam kelas</b>
                <br>
                <b>4 - Sekolah memiliki program unggulan PPK yang terintegrasi dalam keseluruhan aktivitas pembelajaran (intrakurikuler dan ko-kurikuler)</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                 <div class="form-group" id="upload-file_17">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="17">Add More</button>
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
<div class="modal fade" id="modalForm18" tabindex="-1" role="dialog" aria-labelledby="modalForm18Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm18Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_18" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_18" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 18)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memiliki program bersifat kesukarelawanan (volunter).") !!}
                    Sekolah memiliki program bersifat kesukarelawanan (volunter).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="18">
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
                <b>0 - Sekolah tidak memiliki program kesukarelawanan</b>
                <br>
                <b>1 - Sekolah memiliki program kesukarelawanan rutin yang berasal dari inisiatif peserta didik untuk melakukan kegiatan di lingkungan sekolah</b>
                <br>
                <b>2 - Sekolah memiliki program kesukarelawanan rutin yang berasal dari inisiatif peserta didik untuk melakukan kegiatan di dalam dan di luar sekolah</b>
                <br>
                <b>3 - Sekolah memiliki program kesukarelawanan rutin yang berasal dari inisiatif peserta didik untuk melakukan kegiatan di dalam dan di luar sekolah, sekolah juga memiliki program yang ditawarkan pada peserta didik namun peminatnya masih sedikit</b>
                <br>
                <b>4 - Sekolah memiliki program kesukarelawanan rutin yang berasal dari inisiatif peserta didik untuk melakukan kegiatan di dalam sekolah dan di luar sekolah, memiliki tawaran kegiatan kesukarelawanan terprogram dan memiliki banyak peminat </b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                 <div class="form-group" id="upload-file_18">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="18">Add More</button>
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
<div class="modal fade" id="modalForm19" tabindex="-1" role="dialog" aria-labelledby="modalForm19Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm19Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        <div class="modal-body">
          <form action="" id="form_19" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_19" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 19)
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
                    {!! Form::hidden('penjelasan_assessment', "Kegiatan-kegiatan ekstrakurikuler mendukung pengembangan branding sekolah.") !!}
                    Kegiatan-kegiatan ekstrakurikuler mendukung pengembangan branding sekolah.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="19">
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
                <b>0 - Kegiatan-kegiatan ekstrakurikuler tidak terkait dengan pengembangan branding</b>
                <br>
                <b>1 - kegiatan ekstrakurikuler dilakukan berdasarkan kebiasaan rutin semata-mata</b>
                <br>
                <b>2 - Kegiatan ekstrakurikuler dilakukan dengan memperhatikan minat peserta didik, namun belum berkembang maksimal karena keterbatasan sumber dana dan pelatih, dan belum terarah pada pengembangan branding sekolah</b>
                <br>
                <b>3 - Kegiatan-ekstrakurikuler dilakukan dengan memperhatikan minat, bakat dan talenta peserta didik dan didukung sumber dana dan pelatih yang baik namun belum terarah pada pengembangan branding sekolah</b>
                <br>
                <b>4 - Kegiatan-kegiatan ekstrakurikuler, baik yang bersifat akademik, seni, budaya, olah raga diarahkan untuk menumbuhkan minat, bakat, dan talenta peserta didik yang mendukung terbentuknya branding sekolah</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                 <div class="form-group" id="upload-file_19">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="19">Add More</button>
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
<div class="modal fade" id="modalForm20" tabindex="-1" role="dialog" aria-labelledby="modalForm20Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm20Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_20" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_20" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 20)
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
                    {!! Form::hidden('penjelasan_assessment', "Program PPK sesuai dengan tahap perkembangan usia peserta didik") !!}
                    Program PPK sesuai dengan tahap perkembangan usia peserta didik
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="20">
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
                <b>0 - Sekolah mendesain program PPK tidak menyesuaikan dengan perkembangan peserta didik</b>
                <br>
                <b>1 - Sekolah mendesain program PPK hanya menyesuaikan perkembangan fisik/emosi/sosial/kognitif/moral peserta didik semata</b>
                <br>
                <b>2 - Sekolah mendesain program PPK dengan menyesuaikan perkembangan fisik dan emosional saja</b>
                <br>
                <b>3 - Sekolah mendesain program PPK dengan menyesuaikan tahap perkembangan fisik, emosional, dan sosial peserta didik</b>
                <br>
                <b>4 - Sekolah mendesain program PPK dengan menyesuaikan tahap perkembangan peserta didik (fisik, emosi, sosial, kognitif dan moral) yang terwujud dalam bentuk-bentuk kegiatan PPK, lama alokasi waktu dan relevansi program sesuai dengan tahap perkembangan peserta didik</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                 <div class="form-group" id="upload-file_20">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="20">Add More</button>
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
<div class="modal fade" id="modalForm21" tabindex="-1" role="dialog" aria-labelledby="modalForm21Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm21Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_21" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_21" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 21)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memiliki kegiatan pembiasaan untuk menanamkan nilai-nilai utama PPK") !!}
                    Sekolah memiliki kegiatan pembiasaan untuk menanamkan nilai-nilai utama PPK
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="21">
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
                <b>0 - Tidak memiliki kegiatan pembiasaan</b>
                <br>
                <b>1 - Sekolah memiliki minimal satu kegiatan pembiasaan nilai-nilai utama PPK</b>
                <br>
                <b>2 - Sekolah memiliki dua kegiatan pembiasaan nilai-nilai utama PPK</b>
                <br>
                <b>3 - Sekolah memiliki empat kegiatan pembiasaan nilai-nilai utama PPK</b>
                <br>
                <b>4 - Sekolah memiliki kegiatan pembiasaan untuk menanamkan keseluruhan nilai-nilai utama PPK (religius, nasionalis, mandiri, gotong-royong dan integritas), kegiatan pembiasaan ini dilakukan oleh seluruh komunitas sekolah</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                 <div class="form-group" id="upload-file_21">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="21">Add More</button>
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