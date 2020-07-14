<div class="card shadow-sm">
    <div class="card-header" id="heading4">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
            @php
            $str = strtolower('4. DESAIN KEBIJAKAN');
        @endphp
        {{ ucwords($str)." PPK" }}
        </a>
      </h5>
    </div>
    <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td class="text-center">1</td>
                <td class="text-center" width="75%">Sekolah mendefinisikan dan menentukan peranan masing-masing pihak dalam pengembangan PPK.</td>
                 <td width="20%" class="text-center">
                    @foreach ($json_assessmen as $item)
                    @if ($item->no == 12)
                      @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm lihat_form" value="12" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                      @else
                      <button type="button" class="btn btn-warning btn-sm lihat_form" value="12" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Kebijakan dan peraturan sekolah mendukung implementasi PPK (kebijakan tentang mencontek, sanksi, apresiasi, dan lain-lain).</td>
               <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 13)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="13" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="13" data-target="{{ $assessment->id }}">Edit Assessmen</button>
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
               <td class="text-center" width="75%">Sekolah mengembangkan semangat inklusivitas dalam pengelolaan pendidikan bagi peserta didik penyandang disabilitas (berkebutuhan khusus).</td>
               <td width="20%" class="text-center">
                @foreach ($json_assessmen as $item)
                @if ($item->no == 14)
                  @if (empty($item->penjelasan_assessment))
                  <button type="button" class="btn btn-primary btn-sm lihat_form" value="14" data-target="{{ $assessment->id }}">Lakukan Assessmen</button>
                  @else
                  <button type="button" class="btn btn-warning btn-sm lihat_form" value="14" data-target="{{ $assessment->id }}">Edit Assessmen</button>
                  @endif
                @endif
             @endforeach
              </td>
           </tbody>
           
       </table>

      </div>
    </div>
  </div>

  <!-- Modal for indikator[3] -->
<div class="modal fade" id="modalForm12" tabindex="-1" role="dialog" aria-labelledby="modalForm12Title" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalForm12Title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="" id="form_12" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method("PUT")
          <div class="row">
          <div class="col-lg-12 col-sm-12">
            <ul id="error_indikator_12" style="background-color: #e53e3e; color: white; border-radius: 10px"  ></ul>
            @foreach ($json_assessmen as $item)
                    @if ($item->no == 12)
                        @if (!empty($item->penjelasan_assessment))
                        <b>Histori Asesmen</b>
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
                  {!! Form::hidden('penjelasan_assessment', "Sekolah mendefinisikan dan menentukan peranan masing-masing pihak dalam pengembangan PPK.") !!}
                  Sekolah mendefinisikan dan menentukan peranan masing-masing pihak dalam pengembangan PPK.
                </td>
                <td>
                  <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                  <input type="hidden" name="assessment" value="12">
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
              <b>0 - Sekolah tidak merumuskan peranan masing-masing pelaku pendidikan dalam PPK</b>
              <br>
              <b>1 - Sekolah hanya mendefinisikan peranan masing-masing pihak dalam PPK</b>
              <br>
              <b>2 - Sekolah mendefinisikan peranan dan membuat mekanisme kerja</b>
              <br>
              <b>3 - Sekolah mendefinisikan peranan, merumuskan mekanisme kerja dan pembagian tugas</b>
              <br>
              <b>4 - Sekolah mendefinisikan peranan masing-masing individu, merumuskan mekanisme kerja, pembagian tugas, deskripsi tugas dan jalur komunikasi agar peranan masing-masing pihak semakin maksimal</b>
              <br>
            </div>
            <hr>
            <div class="col-sm-12 col-lg-12">
              {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
              <div class="form-group" id="upload-file_12">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="12">Add More</button>
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
<div class="modal fade" id="modalForm13" tabindex="-1" role="dialog" aria-labelledby="modalForm13Title" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalForm13Title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="" id="form_13" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method("PUT")
          <div class="row">
          <div class="col-lg-12 col-sm-12">
            <ul id="error_indikator_13" style="background-color: #e53e3e; color: white; border-radius: 10px"  ></ul>
            @foreach ($json_assessmen as $item)
                    @if ($item->no == 13)
                        @if (!empty($item->penjelasan_assessment))
                        <b>Histori Asesmen</b>
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
                  {!! Form::hidden('penjelasan_assessment', "Kebijakan dan peraturan sekolah mendukung implementasi PPK (kebijakan tentang mencontek, sanksi, apresiasi, dan lain-lain).") !!}
                  Kebijakan dan peraturan sekolah mendukung implementasi PPK (kebijakan tentang mencontek, sanksi, apresiasi, dan lain-lain).
                </td>
                <td>
                  <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                  <input type="hidden" name="assessment" value="13">
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
              <b>0 - Tidak memiliki kebijakan-kebijakan dan peraturan-peraturan</b>
              <br>
              <b>1 - Sekolah memiliki kebijakan-kebijakan dan peraturan-peraturan yang mendukung PPK tetapi belum diterapkan secara efektif.</b>
              <br>
              <b>2 - Sekolah memiliki kebijakan-kebijakan dan peraturan-peraturan yang mendukung implementasi PPK dan diterapkan sebagian kecil peraturan secara efektif.</b>
              <br>
              <b>3 - Sekolah memiliki kebijakan-kebijakan dan peraturan-peraturan yang mendukung implementasi PPK dan diterapkan sebagian besar peraturan secara efektif.</b>
              <br>
              <b>4 - Sekolah memiliki, mengimplementasikan kebijakan-kebijakan dan peraturan-peraturan secara sistemik yang mendukung implementasi PPK secara efektif.</b>
              <br>
            </div>
            <hr>
            <div class="col-sm-12 col-lg-12">
              {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
              <div class="form-group" id="upload-file_13">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="13">Add More</button>
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
<div class="modal fade" id="modalForm14" tabindex="-1" role="dialog" aria-labelledby="modalForm14Title" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalForm14Title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <form action="" id="form_14" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method("PUT")
          <div class="row">
          <div class="col-lg-12 col-sm-12">
            <ul id="error_indikator_14" style="background-color: #e53e3e; color: white; border-radius: 10px"  ></ul>
            @foreach ($json_assessmen as $item)
                    @if ($item->no == 14)
                        @if (!empty($item->penjelasan_assessment))
                        <b>Histori Asesmen</b>
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
                  {!! Form::hidden('penjelasan_assessment', "Sekolah mengembangkan semangat inklusivitas dalam pengelolaan pendidikan bagi peserta didik penyandang disabilitas (berkebutuhan khusus).") !!}
                  Sekolah mengembangkan semangat inklusivitas dalam pengelolaan pendidikan bagi peserta didik penyandang disabilitas (berkebutuhan khusus).
                </td>
                <td>
                  <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                  <input type="hidden" name="assessment" value="14">
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
              <b>0 - Sekolah tidak melakukan pendidikan inklusi, bangunan sekolah tidak ramah penyandang disabilitas (anak berkebutuhan khusus)</b>
              <br>
              <b>1 - Bangunan Sekolah ramah terhadap penyandang disabilitas (anak berkebutuhan khusus), sekolah menerima peserta didik penyandang disabilitas (anak berkebutuhan khusus) dan memperlakukan mereka sama dengan anak-anak lain dalam pembelajaran</b>
              <br>
              <b>2 - Bangunan sekolah ramah terhadap penyandang disabilitas (anak berkebutuhan khusus), sekolah menerima peserta didik penyandang disabilitas (anak berkebutuhan khusus) dan memberikan akomodasi dan pembelajaran terindividualisasi dalam proses pembelajaran</b>
              <br>
              <b>3 - Bangunan sekolah ramah terhadap penyandang disabilitas (anak berkebutuhan khusus), sekolah menerima peserta didik penyandang disabilitas (anak berkebutuhan khusus), memberikan akomodasi dalam pembelajaran dengan metode individualisasi, serta menyediakan guru khusus untuk melayani peserta didik penyandang disabilitas</b>
              <br>
              <b>4 - Bangunan sekolah ramah terhadap penyandang disabilitas, sekolah memiliki kebijakan khusus tentang anak berkebutuhan khusus, ada guru yang memiliki kompetensi khusus untuk menangani peserta didik berkebutuhan khusus, para guru memberikan akomodasi dan pembelajaran terindividualisasi terhadap penyandang disabilitas (anak-anak berkebutuhan khusus), lingkungan budaya sekolah menunjukkan penghormatan dan penghargaan terhadap penyandang disabilitas dan anak-anak berkebutuhan khusus.</b>
              <br>
            </div>
            <hr>
            <div class="col-sm-12 col-lg-12">
              {!! Form::label('file[0]', "Unggah Dokumen: ") !!}
              <div class="form-group" id="upload-file_14">
                <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="14">Add More</button>
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