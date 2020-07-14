<div class="card shadow-sm">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapse">
            @php
                $str = strtolower('SOSIALISASI PPK KEPADA PARA PEMANGKU KEPENTINGAN PENDIDIKAN');
            @endphp
            2. {{ ucwords($str) }}
        </a>
      </h5>
    </div>
    <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordion">
      <div class="card-body">
          <table class="table table-borderless">
              <thead>
                 <th class="text-center">No</th>
                 <th class="text-center">Penjelasan Assessment</th>
                 <th class="text-center">Skor</th>
              </thead>
              <tbody>
                  <td class="text-center">1</td>
                  <td class="text-center" width="75%">Sekolah melakukan sosialisasi PPK kepada para pemangku kepentingan pendidikan (pejabat struktural, guru, Komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).</td>
                  <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 6)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="6" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="6" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
                 <td class="text-center" width="75%">Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan semua pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).</td>
                 <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 7)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="7" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="7" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
                 <td class="text-center" width="75%">Sekolah menentukan nilai-nilai khas sesuai dengan latar belakang sosial budaya setempat (gotong royong, agamis, seni, agraris, dan sejenisnya).</td>
                 <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 8)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="8" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="8" data-target="{{ $assessment->id }}">Edit Assessmen</button>
                      @endif
                    @endif
                 @endforeach
                 </td>
             </tbody>
             
         </table>
      </div>
    </div>
  </div>

{{-- Modals --}}
<!-- Modal for indikator[0] -->
<div class="modal fade" id="modalForm6" tabindex="-1" role="dialog" aria-labelledby="modalForm6Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm6Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_6" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_6" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 6)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah melakukan sosialisasi PPK kepada para pemangku kepentingan pendidikan (pejabat struktural, guru, Komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).") !!}
                    Sekolah melakukan sosialisasi PPK kepada para pemangku kepentingan pendidikan (pejabat struktural, guru, Komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="6">
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
                <b>0 - Sekolah tidak melakukan sosialisasi</b>
                <br>
                <b>1 - Sekolah melakukan sosialisasi PPK kepada sebagian kecil pemangku kepentingan pendidikan (pejabat struktural, guru, siswa)</b>
                <br>
                <b>2 - Sekolah melakukan sosialisasi PPK kepada sebagianpemangku kepentingan pendidikan (pejabat struktural, guru, Komite sekolah, siswa)</b>
                <br>
                <b>3 - Sekolah melakukan sosialisasi PPK kepada sebagian besar pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, orang tua/wali siswa, siswa, dan masyarakat lainnya)</b>
                <br>
                <b>4 - Sekolah melakukan sosialisasi PPK kepada semua pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya) <br> Saran: Sekolah Sudah Mencapai Maksimum Asesmen</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_6">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="6">Add More</button>
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
<div class="modal fade" id="modalForm7" tabindex="-1" role="dialog" aria-labelledby="modalForm7Title" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm7Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_7" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_7" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 7)
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
                    {!! Form::hidden('penjelasan_assessment', "Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan semua pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).") !!}
                    Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan semua pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="7">
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
                <b>0 - Sekolah tidak melibatkan pemangku kepentingan dalam perumusan prioritas nilai utama PPK <br> Saran: 1- Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan sebagian kecil pemangku kepentingan pendidikan (pejabat struktural, guru, siswa)</b>
                <br>
                <b>1 - Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan sebagian kecil pemangku kepentingan pendidikan (pejabat struktural, guru, siswa)</b>
                <br>
                <b>2 - Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan sebagian pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, siswa)</b>
                <br>
                <b>3 - Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan sebagian besar pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, orang tua/wali siswa, siswa, dan masyarakat lainnya)</b>
                <br>
                <b>4 -  Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan semua pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_7">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="7">Add More</button>
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
<div class="modal fade" id="modalForm8" tabindex="-1" role="dialog" aria-labelledby="modalForm8Title" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm8Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_8" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_8" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                    @if ($item->no == 8)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah menentukan nilai-nilai khas sesuai dengan latar belakang sosial budaya setempat (gotong royong, agamis, seni, agraris, dan sejenisnya).") !!}
                    Sekolah menentukan nilai-nilai khas sesuai dengan latar belakang sosial budaya setempat (gotong royong, agamis, seni, agraris, dan sejenisnya).
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="8">
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
                <b>0 - Sekolah tidak menyesuaikan nilaikhas dengan latar belakang sosial budaya setempat</b>
                <br>
                <b>1 - Sekolah menentukan sebagian kecil nilai-nilai khas sesuai dengan latar belakang sosial budaya setempat</b>
                <br>
                <b>2 -  Sekolah menentukan beberapa nilai-nilai khas sesuai dengan latar belakang sosial budaya setempat</b>
                <br>
                <b>3 -  Sekolah menentukan beberapa nilai-nilai khas sesuai dengan latar belakang sosial </b>
                <br>
                <b>4 -  Sekolah menentukan semua nilai-nilai khas sesuai dengan latar belakang sosial budaya setempat</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_8">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="8">Add More</button>
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