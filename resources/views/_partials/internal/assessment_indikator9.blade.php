<div class="card shadow-sm">
    <div class="card-header" id="heading9">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
            @php
                $str = strtolower('9. IMPLEMENTASI NILAI-NILAI UTAMA');
            @endphp
            {{ ucwords($str) }}
        </a>
      </h5>
    </div>
    <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion">
      <div class="card-body">
          <table class="table table-borderless">
              <thead>
                 <th class="text-center">No</th>
                 <th class="text-center">Penjelasan Assessment</th>
                 <th class="text-center">Skor</th>
              </thead>
              <tbody>
                  <td class="text-center">1</td>
                  <td class="text-center" width="75%">Sekolah memiliki kegiatan untuk mengembangkan dimensi religiusitas peserta didik sesuai dengan agama dan kepercayaannya, menumbuhkan perilaku toleran dan kemampuan bekerja sama antarumat beragama dan penganut kepercayaan.</td>
                  <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 36)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="36" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="36" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
                 <td class="text-center">Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan semangat nasionalisme.</td>
                 <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 37)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="37" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="37" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
                 <td class="text-center">Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan kemandirian peserta didik.</td>
                 <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 38)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="38" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="38" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
                <td class="text-center">Sekolah mengembangkan kegiatan dan program yang merepresentasikan semangat gotong royong.</td>
                <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 39)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="39" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="39" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
                <td class="text-center">Sekolah memiliki norma-norma dan peraturan yang baik untuk menumbuhkan nilai-nilai integritas dan kejujuran dalam diri peserta didik.</td>
                <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 40)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="40" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="40" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
<div class="modal fade" id="modalForm36" tabindex="-1" role="dialog" aria-labelledby="modalForm36Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm36Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_36" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_36" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 36)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memiliki kegiatan untuk mengembangkan dimensi religiusitas peserta didik sesuai dengan agama dan kepercayaannya, menumbuhkan perilaku toleran dan kemampuan bekerja sama antarumat beragama dan penganut kepercayaan.") !!}
                    Sekolah memiliki kegiatan untuk mengembangkan dimensi religiusitas peserta didik sesuai dengan agama dan kepercayaannya, menumbuhkan perilaku toleran dan kemampuan bekerja sama antarumat beragama dan penganut kepercayaan.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="36">
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
                <b>0 - Sekolah tidak memiliki kegiatan keagamaan selain melalui mata pelajaran Pendidikan Agama dan Budi pekerti</b>
                <br>
                <b>1 - Pembiasaan-pembiayaan dalam kegiatan agama masih bersifat ritual dan terkait dengan tata cara peribadatan saja, masing-masing agama dan keyakinan melakukan kegiatan sendiri-sendiri</b>
                <br>
                <b>2 - Kegiatan-kegiatan keagamaan mengajak peserta didik untuk memahami makna ritual/ tata peribadatan dan ajaran-ajaran agama dan kepercayaan secara lebih mendalam, mengajak peserta didik mencari titik temu dari ajaran agama dan kepercayaan masing-masing untuk memperkuat kerukunan dan toleransi antar umat beragama</b>
                <br>
                <b>3 - Sekolah memberi kesempatan pada peserta didik untuk mengamalkan ajaran agama dan kepercayaan dalam konteks kehidupan yang lebih luas, membangun kerja sama antarpemeluk agama dan kepercayaan, meningkatkan perilaku toleransi dalam tindakan dan perkataan</b>
                <br>
                <b>4 - Sekolah memiliki kegiatan untuk mengembangkan dimensi religiusitas peserta didik sesuai dengan agama dan keyakinannya, memiliki program untuk menumbuhkan semangat toleransi dan saling menghormati antar pemeluk agama dan keyakinan, memberikan banyak pengalaman pada peserta didik untuk berjumpa, bergaul, bersahabat dan mengenal peserta didik yang beragama dan berkepercayaan lain. Situasi persaudaraan, toleransi, kerja sama dan kolaborasi sudah menjadi budaya di lingkungan sekolah dan dapat dirasakan seluruh anggota komunitas sekolah.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_36">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="36">Add More</button>
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
<div class="modal fade" id="modalForm37" tabindex="-1" role="dialog" aria-labelledby="modalForm37Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm37Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_37" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_37" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 37)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan semangat nasionalisme.") !!}
                    Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan semangat nasionalisme.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="37">
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
                <b>0 - Sekolah tidak memiliki kegiatan yang menumbuhkan semangat nasionalisme</b>
                <br>
                <b>1 - Sekolah melakukan kegiatan rutin upacara bendera, menyanyikan lagu-lagu nasional dan daerah setiap kali mengakhiri pembelajaran di sekolah</b>
                <br>
                <b>2 - Sekolah memiliki kegiatan rutin dan mengembangkan kegiatan-kegiatan kreatif lain untuk mengembangkan semangat nasionalisme dalam diri peserta didik</b>
                <br>
                <b>3 - Sekolah memiliki kegiatan rutin, mengembangkan kegiatan-kegiatan kreatif lain untuk mengembangkan semangat nasionalisme dalam diri peserta didik yang melibatkan orang tua dan masyarakat sekitar</b>
                <br>
                <b>4 -  Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan semangat nasionalisme dalam diri peserta didik melalui berbagai macam kegiatan rutin, pembiasaan, dan kegiatan kreatif yang melibatkan pemangku kepentingan di luar sekolah, semangat nasionalis dan rasa cinta bangsa terasakan di lingkungan fisik,dan budaya sekolah.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_37">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="37">Add More</button>
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
<div class="modal fade" id="modalForm38" tabindex="-1" role="dialog" aria-labelledby="modalForm38Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm38Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_38" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_38" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 38)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan kemandirian peserta didik.") !!}
                    Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan kemandirian peserta didik.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="38">
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
                <b>0 - Sekolah tidak memiliki kegiatan untuk menumbuhkan kemandirian peserta didik</b>
                <br>
                <b>1 - Sekolah mengembangkan pembiasaan-pembiasaan kecil untuk menumbuhkan kemandirian peserta didik</b>
                <br>
                <b>2 - Sekolah mengembangkan pembiasaan-pembiasaan untuk menumbuhkan kemandirian peserta didik, memiliki program rutin sekolah untuk menumbuhkan kemandiran peserta didik</b>
                <br>
                <b>3 - Sekolah mengembangkan pembiasaan-pembiasaan untuk menumbuhkan kemandirian peserta didik, memiliki program rutin dan non rutin sekolah untuk menumbuhkan kemandirian peserta didik</b>
                <br>
                <b>4 - Di lingkungan sekolah muncul berbagai macam inisiatif dari peserta didik untuk menumbuhkan semangat kemandirian, sekolah memberikan pendampingan dan dukungan melalui program dan kegiatan yang semuanya dikelola, dikoordinasi dan dilakukan secara mandiri oleh peserta didik yang melibatkan komunitas sekolah maupun masyarakat</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_38">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="38">Add More</button>
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
<div class="modal fade" id="modalForm39" tabindex="-1" role="dialog" aria-labelledby="modalForm39Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm39Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_39" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_39" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 39)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah mengembangkan kegiatan dan program yang merepresentasikan semangat gotong royong.") !!}
                    Sekolah mengembangkan kegiatan dan program yang merepresentasikan semangat gotong royong.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="39">
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
                <b>0 - Sekolah tidak memiliki kegiatan dan program untuk mengembangkan semangat gotong royong</b>
                <br>
                <b>1 - Sekolah memiliki program di masing-masing kelas untuk menumbuhkan semangat gotong royong</b>
                <br>
                <b>2 - Sekolah memiliki program di masing-masing kelas dan di lingkungan sekolah untuk menumbuhkan semangat gotong royong</b>
                <br>
                <b>3 - Sekolah memiliki program dan masing-masing kelas, di lingkungan sekolah, dan di luar sekolah untuk menumbuhkan semangat gotong royong</b>
                <br>
                <b>4 - Sekolah memiliki berbagai macam program dan kegiatan untuk menumbuhkan semangat gotong royong, baik di dalam kelas, di lingkungan sekolah, di masyarakat, yang melibatkan partisipasi aktif seluruh warga sekolah. Semangat gotong royong, bahu membahu telah menjadi budaya dan dapat dirasakan oleh seluruh anggota komunitas sekolah</b>
                <br>
              </div>
              <hr>  
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_39">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="39">Add More</button>
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
<div class="modal fade" id="modalForm40" tabindex="-1" role="dialog" aria-labelledby="modalForm40Title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalForm40Title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <form action="" id="form_40" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator_40" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                @foreach ($json_assessmen as $item)
                @if ($item->no == 40)
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
                    {!! Form::hidden('penjelasan_assessment', "Sekolah memiliki norma-norma dan peraturan yang baik untuk menumbuhkan nilai-nilai integritas dan kejujuran dalam diri peserta didik.") !!}
                    Sekolah memiliki norma-norma dan peraturan yang baik untuk menumbuhkan nilai-nilai integritas dan kejujuran dalam diri peserta didik.
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="40">
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
                <b>0 - Sekolah tidak memiliki norma, peraturan dan kegiatan untuk menumbuhkan nilai integritas</b>
                <br>
                <b>1 - Sekolah hanya memiliki norma dan aturan tertulis saja, tapi tidak efektif diimplementasikan di lapangan</b>
                <br>
                <b>2 - Sekolah memiliki norma dan peraturan, namun belum mendukung bertumbuhnya nilai integritas karena peraturan yang tidak jelas </b>
                <br>
                <b>3 - Sekolah memiliki norma-norma dan peraturan yang mendukung bertumbuhnya nilai integritas</b>
                <br>
                <b>4 - Sekolah memiliki norma-norma, peraturan dan kegitan/program yang mendukung bertumbuhnya nilai-nilai integritas bagi seluruh anggota komunitas sekolah, terutama bagi peserta didik. Peraturan diterapkan dengan konsisten, sistem pemberian sanksi dan apresiasi mendukung bertumbuhnya nilai-nilai integritas.</b>
                <br>
              </div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
                <div class="form-group" id="upload-file_40">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="40">Add More</button>
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