<div class="card shadow-sm">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          1. Assessment Awal
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        {{-- foreach --}}
       <table class="table table-borderless">
           <thead>
              <th class="text-center">No</th>
              <th class="text-center">Penjelasan Assessment</th>
              <th class="text-center">Skor</th>
           </thead>
           <tbody>
             {{-- foreach --}}
               <td class="text-center">
                 1
                </td>
               <td class="text-center" width="75%">
                 Sekolah mengidentifikasi sumber-sumber belajar dan sarana prasarana di dalam dan luar sekolah.
              </td>
              {{-- end for each --}}
               <td width="20%" class="text-center">
                 @foreach ($json_assessmen as $item)
                    @if ($item->no == 1)
                      @if (empty($item->penjelasan_assessment))
                        <button type="button" class="btn btn-primary btn-sm lihat_form" value="1" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>    
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="1"  data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
              <td class="text-center" width="75%">Sekolah mengidentifikasi sumber daya manusia yang tersedia di sekolah dan luar sekolah.</td>
              <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 2)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="2"  data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="2"  data-target="{{ $assessment->id }}">Edit Assessmen</button>
                  @endif
                @endif
             @endforeach
              </td>
          </tbody>
          
      </table>
      {{-- endforeach --}}
      <table class="table table-borderless">
          <thead>
             <th class="text-center">No</th>
             <th class="text-center">Penjelasan Assessment</th>
             <th class="text-center">Skor</th>
          </thead>
          <tbody>
              <td class="text-center">3</td>
              <td class="text-center" width="75%">Sekolah mengidentifikasi potensi budaya dan karakteryang ada di sekolah dan luar sekolah.</td>
              <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 3)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="3"  data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="3"  data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
              <td class="text-center" width="75%">Sekolah mengidentifikasi sumber-sumber pembiayaan PPK.</td>
              <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 4)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="4"  data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="4"  data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
              <td class="text-center" width="75%">Sekolah mengidentifikasi tata kelola sekolah</td>
              <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 5)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="5"  data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="5"  data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
<div class="modal fade" id="modalForm1" tabindex="-1" role="dialog" aria-labelledby="modalForm1Title" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalForm1Title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="" id="form_1" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method("PUT")
          <div class="row">
          <div class="col-lg-12 col-sm-12">
            <ul id="error_indikator_1" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
            @foreach ($json_assessmen as $item)
                    @if ($item->no == 1)
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
              {{-- @if ($dokumen->where('body_indikator_dokumen', '=' , 1)->count() > 1)
              <b>Mengelola File Asesmen</b>
                @foreach ($dokumen as $dokumentasi_asesmen)
                  @if ($dokumentasi_asesmen->body_indikator_dokumen == 1)
                   <li>
                     <i class="fas fa-file-alt"></i> {{ $dokumentasi_asesmen->nama_dokumen_asesmen }} 
                     <button class="btn btn-primary btn-sm ml-2 lihat_file" value="{{ asset('kegiatan/asesmen_internal/'.$dokumentasi_asesmen->nama_dokumen_asesmen)  }}" type="button">Lihat File</button>
                     <button class="btn btn-danger btn-sm ml-2 delete_file" value="{{ ($dokumentasi_asesmen->nama_dokumen_asesmen)  }}" data-target="1" data-target2="{{ $assessment->id }}" type="button">Delete File</button>
                     </li>   
                  @endif
                @endforeach
              @elseif($dokumen->where('body_indikator_dokumen', '=' , 1)->count() == 1)
              <b>Mengelola File Asesmen</b>
                  @foreach ($dokumen as $dokumentasi_asesmen)
                    @if ($dokumentasi_asesmen->body_indikator_dokumen == 1)
                    <li>
                      <i class="fas fa-file-alt"></i> {{ $dokumentasi_asesmen->nama_dokumen_asesmen }} 
                      <button class="btn btn-primary btn-sm ml-2 lihat_file" value="{{ asset('kegiatan/asesmen_internal/'.$dokumentasi_asesmen->nama_dokumen_asesmen)  }}" type="button">Lihat File</button>
                   </li>   
                @endif
              @endforeach
              @else

            @endif --}}
              </ul>
            <table>
              <thead>
                <th>Penjelasan</th>
                <th width="35%">Skor</th>
              </thead>
              <tbody>
                <td>
                  {{-- ada input hidden untuk nilai indikator dan data dokumen --}}
                  {!! Form::hidden('penjelasan_assessment', "Sekolah mengidentifikasi sumber-sumber belajar dan sarana prasarana di dalam dan luar sekolah.") !!}
                  Sekolah mengidentifikasi sumber-sumber belajar dan sarana prasarana di dalam dan luar sekolah.
                </td>
                <td>
                  <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                  <input type="hidden" name="assessment" value="1">
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
              <b>0 - Sekolah tidak melakukan identifikasi</b>
              <br>
              <b>1 - Sekolah mengidentifikasi minimal 1 sumber belajar dan sarana prasarana di sekolah</b>
              <br>
              <b>2 - Sekolah mengidentifikasi minimal 4 sumber belajar di sekolah dan luar sekolah</b>
              <br>
              <b>3 - Sekolah mengidentifikasi minimal 6 sumber belajar di sekolah dan luar sekolah</b>
              <br>
              <b>4 - Sekolah mengidentifikasi minimal 10 sumber belajar di sekolah dan luar sekolah</b>
              <br>
            </div>
            <hr>
            <div class="col-sm-12 col-lg-6">
              {!! Form::label('file[0]', "Unggah Dokumen:") !!}
              <div class="form-group" id="upload-file_1">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="1">Add More</button>
                <br>
                <input type="file" name="file[]" id="file">
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

<!-- Modal for indikator[1] -->
<div class="modal fade" id="modalForm2" tabindex="-1" role="dialog" aria-labelledby="modalForm2Title" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalForm2Title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="" id="form_2" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method("PUT")
          <div class="row">
          <div class="col-lg-12 col-sm-12">
            <ul id="error_indikator_2" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
            @foreach ($json_assessmen as $item)
                    @if ($item->no == 2)
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
                  {!! Form::hidden('penjelasan_assessment', "Sekolah mengidentifikasi sumber daya manusia yang tersedia di sekolah dan luar sekolah.") !!}
                  Sekolah mengidentifikasi sumber daya manusia yang tersedia di sekolah dan luar sekolah.
                </td>
                <td>
                  <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                  <input type="hidden" name="assessment" value="2">
                  <input type="radio" name="indikator" id="" value="0" class="form-group">0
                  <input type="radio" name="indikator" id="" value="1" class="form-group">1
                  <input type="radio" name="indikator" id="" value="2" class="form-group">2
                  <input type="radio" name="indikator" id="" value="3" class="form-group">3
                  <input type="radio" name="indikator" id="" value="4" class="form-group">4
                </td>
              </tbody>
            </table>
            <div class="col-lg-6 col-sm-12">
              {!! Form::label('keterangan' , 'Keterangan Skor: ') !!}
              <br>
              <b>0 - Sekolah tidak melakukan identifikasi</b>
              <br>
              <b>1 - Sekolah mengidentifikasi minimal 1 SDM di sekolah</b>
              <br>
              <b>2 - Sekolah mengidentifikasi minimal 4 SDM di sekolah dan luar sekolah</b>
              <br>
              <b>3 - Sekolah mengidentifikasi minimal 6 SDM di sekolah dan luar sekolah</b>
              <br>
              <b>4 - Sekolah mengidentifikasi minimal 10 SDM di sekolah dan luar sekolah</b>
              <br>
            </div>
            <hr>
            <div class="col-sm-12 col-lg-12">
              {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
              <br>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-group" id="upload-file_2">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="2">Add More</button>
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

<!-- Modal for indikator[2] -->
<div class="modal fade" id="modalForm3" tabindex="-1" role="dialog" aria-labelledby="modalForm3Title" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalForm3Title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="" id="form_3" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method("PUT")
          <div class="row">
          <div class="col-lg-12 col-sm-12">
            <ul id="error_indikator_3" style="background-color: #e53e3e; color: white; border-radius: 10px"  ></ul>
            @foreach ($json_assessmen as $item)
                    @if ($item->no == 3)
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
                  {!! Form::hidden('penjelasan_assessment', "Sekolah mengidentifikasi potensi budaya dan karakter yang ada di sekolah dan luar sekolah.") !!}
                  Sekolah mengidentifikasi potensi budaya dan karakter yang ada di sekolah dan luar sekolah.
                </td>
                <td>
                  <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                  <input type="hidden" name="assessment" value="3">
                  <input type="radio" name="indikator" id="" value="0" class="form-group">0
                  <input type="radio" name="indikator" id="" value="1" class="form-group">1
                  <input type="radio" name="indikator" id="" value="2" class="form-group">2
                  <input type="radio" name="indikator" id="" value="3" class="form-group">3
                  <input type="radio" name="indikator" id="" value="4" class="form-group">4
                </td>
              </tbody>
            </table>
            <div class="col-lg-6 col-sm-12">
              {!! Form::label('keterangan' , 'Keterangan Skor: ') !!}
              <br>
              <b>0 - Sekolah tidak melakukan identifikasi</b>
              <br>
              <b>1 - Sekolah mengidentifikasi minimal 1 potensi karakter dan budaya di sekolah</b>
              <br>
              <b>2 - Sekolah mengidentifikasi minimal 4 potensi karakter dan budaya di sekolah dan luar sekolah</b>
              <br>
              <b>3 - Sekolah mengidentifikasi minimal 6 potensi karakter dan budayadi sekolah dan luar sekolah</b>
              <br>
              <b>4 - Sekolah mengidentifikasi minimal 10 potensi karakter dan budaya di sekolah dan luar sekolah</b>
              <br>
            </div>
            <hr>
            <div class="col-sm-12 col-lg-12">
              {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
              <br>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-group" id="upload-file_3">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="3">Add More</button>
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

<!-- Modal for indikator[3] -->
<div class="modal fade" id="modalForm4" tabindex="-1" role="dialog" aria-labelledby="modalForm4Title" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalForm4Title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="" id="form_4" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method("PUT")
          <div class="row">
          <div class="col-lg-12 col-sm-12">
            <ul id="error_indikator_4" style="background-color: #e53e3e; color: white; border-radius: 10px"  ></ul>
            @foreach ($json_assessmen as $item)
                    @if ($item->no == 4)
                        @if (!empty($item->penjelasan_assessment))
                        <b>Histori Asesmen</b>
                            <ul>
                                <li>
                                  Skor Asesmen: {{ $item->skor_penilaian_assessment }}
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
                  {!! Form::hidden('penjelasan_assessment', "Sekolah mengidentifikasi sumber-sumber pembiayaan PPK.") !!}
                  Sekolah mengidentifikasi sumber-sumber pembiayaan PPK.
                </td>
                <td>
                  <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                  <input type="hidden" name="assessment" value="4">
                  <input type="radio" name="indikator" id="" value="0" class="form-group">0
                  <input type="radio" name="indikator" id="" value="1" class="form-group">1
                  <input type="radio" name="indikator" id="" value="2" class="form-group">2
                  <input type="radio" name="indikator" id="" value="3" class="form-group">3
                  <input type="radio" name="indikator" id="" value="4" class="form-group">4
                </td>
              </tbody>
            </table>
            <div class="col-lg-6 col-sm-12">
              {!! Form::label('keterangan' , 'Keterangan Skor: ') !!}
              <br>
              <b>0 - Sekolah tidak melakukan identifikasi sumber-sumber pembiayaan PPK</b>
              <br>
              <b>1 - Sekolah mengidentifikasi sumber-sumber pembiayaan dari pemerintah</b>
              <br>
              <b>2 - Sekolah mengidentifikasi sumber-sumber pembiayaan dari pemerintah dan orangtua siswa</b>
              <br>
              <b>3 - Sekolah mengidentifikasi sumber-sumber pembiayaan dari pemerintah, orangtua siswa, dan dunia usaha (CSR)</b>
              <br>
              <b>4 - Sekolah mengidentifikasi sumber-sumber pembiayaan melibatkan partisipasi seluruh stakeholder (orangtua, pemerintah, dunia usaha, masyarakat lainnya)</b>
              <br>
            </div>
            <hr>
            <div class="col-sm-12 col-lg-12">
              {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
              <br>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-group" id="upload-file_4">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="4">Add More</button>
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

<!-- Modal for indikator[4] -->
<div class="modal fade" id="modalForm5" tabindex="-1" role="dialog" aria-labelledby="modalForm5Title" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalForm5Title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="" id="form_5" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method("PUT")
          <div class="row">
          <div class="col-lg-12 col-sm-12">
            <ul id="error_indikator_5" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
            @foreach ($json_assessmen as $item)
            @if ($item->no == 5)
                @if (!empty($item->penjelasan_assessment))
                <b>Histori Asesmen</b>
                    <ul>
                        <li>
                            Skor Asesmen: {{ $item->skor_penilaian_assessment }}
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
                <th width="50%">Penjelasan</th>
                <th width="35%">Skor</th>
              </thead>
              <tbody>
                <td>
                  {{-- ada input hidden untuk nilai indikator dan data dokumen --}}
                  {!! Form::hidden('penjelasan_assessment', "Sekolah mengidentifikasi tata kelola sekolah") !!}
                  Sekolah mengidentifikasi tata kelola sekolah
                </td>
                <td>
                  <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                  <input type="hidden" name="assessment" value="5">
                  <input type="radio" name="indikator" id="" value="0" class="form-group">0
                  <input type="radio" name="indikator" id="" value="1" class="form-group">1
                  <input type="radio" name="indikator" id="" value="2" class="form-group">2
                  <input type="radio" name="indikator" id="" value="3" class="form-group">3
                  <input type="radio" name="indikator" id="" value="4" class="form-group">4
                </td>
              </tbody>
            </table>
            <div class="col-lg-6 col-sm-12">
              {!! Form::label('keterangan' , 'Keterangan Skor: ') !!}
              <br>
              <b>0 - Tidak melakukan identifikasi</b>
              <br>
              <b>1 - Sekolah memiliki: kebijakan dan peraturan-peraturan</b>
              <br>
              <b>2 - Sekolah memiliki: kebijakan, peraturan-peraturan, visi misi dan tahapan pencapaiannya</b>
              <br>
              <b>3 - Sekolah memiliki: kebijakan, peraturan-peraturan, visi misi dan tahapan pencapaiannya, prosedur kerja/SOP, mekanisme evaluasi</b>
              <br>
              <b>4 - Sekolah memiliki: kebijakan, peraturan-peraturan, visi misi dan tahapan pencapaiannya, prosedur kerja/SOP, pembagian peran, penggunaan teknologi dan mekanisme evaluasi</b>
              <br>
            </div>
            <hr>
            <div class="col-sm-12 col-lg-12">
              {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
              <br>
            </div>
            <div class="col-sm-12 col-lg-6">
              <div class="form-group" id="upload-file_5">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="5">Add More</button>
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