<div class="card shadow-sm">
    @php
        $counter_indikator = 1;
        $counter_asesmen = 1;
        
        $counter_indikator_1 = 5;
        $counter_indikator_2 = 8;
        $batas_counter_2 = 9;
        $counter_indikator_3 = 11;
        $batas_counter_3 = 12;
        $counter_indikator_4 = 14;
        $batas_counter_4 = 15;
        $counter_indikator_5 = 21;
        $batas_counter_5 = 22;
        $counter_indikator_6 = 25;
        $batas_counter_6 = 26;
        $counter_indikator_7 = 29;
        $batas_counter_7 = 30;
        $counter_indikator_8 = 35;
        $batas_counter_8 = 36;
        $counter_indikator_9 = 40;
        $batas_counter_9 = 41;
        $counter_indikator_10 = 49;        
        $batas_counter_10 = 50;
    @endphp
    
    @foreach ($kategori_asesmen as $item_kategori)
<div class="card-header border border-left-success" id="heading{{$counter_indikator}}">
      <h5 class="mb-0">
      <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$counter_indikator}}" aria-expanded="true" aria-controls="collapse{{$counter_indikator}}">
          <b>{{$counter_indikator.".".$item_kategori->nama_kategori_asesmen}}</b>
        </a>
      </h5>
</div>
@if ($counter_indikator == 1)
<div id="collapse{{$counter_indikator}}" class="collapse show" aria-labelledby="heading{{$counter_indikator}}" data-parent="#accordion">
    <div class="card-body">
      <table class="table table-borderless">
        @if ($loop->first)
        <thead>
           <th class="text-center">No</th>
           <th class="text-center">Penjelasan Asesmen</th>
           {{-- <th class="text-center">Skor</th> --}}
           <th class="text-center">Status Asesmen</th>
      </thead> 
        @endif
      @foreach ($penjelasan_asesmen as $item_asesmen)
          @if ($counter_asesmen <= $counter_indikator_1)
         <tbody>
             <td class="text-center" width="10%">
               {{ $counter_asesmen }}
              </td>
             <td class="text-center">
               {{ $item_asesmen->penjelasan_asesmen }}
            </td>
            {{-- <td class="text-center scores_{{$counter_asesmen}}">1</td> --}}
             <td width="20%" class="text-center">
               @foreach ($json_assessmen as $item)
                  @if ($item->no == $counter_asesmen)
                    @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary btn-sm rounded-pill lihat_form" value="{{ $counter_asesmen }}" data-target="{{ $assessment->id }}">Lakukan Asesmen</button>    
                    @else
                    <button type="button" class="btn btn-warning btn-sm rounded-pill lihat_form" value="{{ $counter_asesmen }}"  data-target="{{ $assessment->id }}">Edit Asesmen</button>
                    @endif
                  @endif
               @endforeach
             </td>
         </tbody>                 
        @php
            $counter_asesmen++;
        @endphp
    @endif
    @endforeach
  </table>     
    </div>
  </div>
  @php
      $counter_indikator++;
  @endphp
  @else
    @if ($counter_indikator == $item_kategori->id)
  <div id="collapse{{$counter_indikator}}" class="collapse" aria-labelledby="heading{{$counter_indikator}}" data-parent="#accordion">
    <div class="card-body">
      <table class="table table-borderless">
        <thead class="table_asesmen_counter_{{$counter_indikator}} text-center"></thead>
      @foreach ($penjelasan_asesmen as $item_asesmen)
          @if ($counter_asesmen <= $counter_indikator_2 || $counter_asesmen <= $counter_indikator_3 || $counter_asesmen <= $counter_indikator_4 || $counter_asesmen <= $counter_indikator_5 || $counter_asesmen <= $counter_indikator_6 || $counter_asesmen <= $counter_indikator_7 || $counter_asesmen <= $counter_indikator_8 || $counter_asesmen <= $counter_indikator_9  || $counter_indikator <= $counter_indikator_10 )
            @if ($item_asesmen->id != $counter_asesmen)
              @php
                  $item_asesmen->id++;
                  continue;
              @endphp
            @endif
     {{-- <table class="table table-bordered"> --}}
         <tbody>
             <td class="text-center" width="10%">
               {{ $counter_asesmen }}
              </td>
             <td class="text-center">
               {{ $item_asesmen->penjelasan_asesmen }}
            </td>
            {{-- <td class="text-center">1</td> --}}
             <td width="20%" class="text-center">
               @foreach ($json_assessmen as $item)
                  @if ($item->no == $counter_asesmen)
                    @if (empty($item->penjelasan_assessment))
                      <button type="button" class="btn btn-primary rounded-pill btn-sm lihat_form" value="{{ $counter_asesmen }}" data-target="{{ $assessment->id }}">Lakukan Asesmen</button>    
                    @else
                    <button type="button" class="btn btn-warning rounded-pill btn-sm lihat_form" value="{{ $counter_asesmen }}"  data-target="{{ $assessment->id }}">Edit Asesmen</button>
                    @endif
                  @endif
               @endforeach
             </td>
         </tbody>                 
     {{-- </table>      --}}
        @php
            $counter_asesmen++;
        @endphp
        @if ($counter_asesmen == $batas_counter_2 || $counter_asesmen == $batas_counter_3 || $counter_asesmen == $batas_counter_4 || $counter_asesmen == $batas_counter_5|| $counter_asesmen == $batas_counter_6|| $counter_asesmen == $batas_counter_7|| $counter_asesmen == $batas_counter_8|| $counter_asesmen == $batas_counter_9|| $counter_asesmen == $batas_counter_10)
            @break
        @endif
    @endif
    @endforeach
  </table>
    </div>
  </div>
  @php
    $counter_indikator++;
    @endphp
    @endif
@endif
@endforeach
</div>

@php
    $counter_modal_asesmen = 1;
@endphp
<!-- Modal for indikator[4] -->
@foreach ($penjelasan_asesmen as $item_modal_asesmen)
<div class="modal fade" id="modalForm{{$counter_modal_asesmen}}" tabindex="-1" role="dialog" aria-labelledby="modalForm{{$counter_modal_asesmen}}Title" aria-hidden="true" data-keyboard ="false" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="modalForm{{$counter_modal_asesmen}}Title">Lakukan Asesmen PPK</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
        <form action="" id="form_{{$counter_modal_asesmen}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method("PUT")
            <div class="row">
            <div class="col-lg-12 col-sm-12">
            <ul id="error_indikator_{{$counter_modal_asesmen}}" class="d-none" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
              @foreach ($json_assessmen as $item)
              @if ($item->no == $counter_modal_asesmen)
                  @if (!empty($item->penjelasan_assessment))
                  <div class="alert alert-success alert-heading font-weight-bolder" style="border-radius: 10px;">
                  <b>Histori Asesmen</b>
                      <ul>
                          <li>
                              Skor Asesmen: {{ $item->skor_penilaian_assessment }}
                          </li>
                          
                        <input type="hidden" id="previous-score_{{$counter_modal_asesmen}}" value="{{ $item->skor_penilaian_assessment }}">
                       {{-- <input type="hidden" name="indikator" value="{{ $item->skor_penilaian_assessment }}"> --}}
                      </ul>
                  </div>
                  @else
                      <div class="state-asesmen alert alert-info alert-heading font-weight-bolder" style="border-radius: 10px;"></div>
                  @endif
              @endif
          @endforeach    
          <div class="lihat-dokumen alert alert-warning alert-heading font-weight-bolder" style="border-radius: 10px;"></div>
          <hr>
              {{-- <table class="table table-bordered table-responsive">
                <thead>
                  <th width="50%">Penjelasan</th>
                  <th width="35%">Skor</th>
                </thead>
                <tbody>
                  <td>
                    ada input hidden untuk nilai indikator dan data dokumen
                    {!! Form::hidden('penjelasan_assessment', $item_modal_asesmen->penjelasan_asesmen) !!}
                    {{ $item_modal_asesmen->penjelasan_asesmen }}
                    <hr>
                    <ul class="keterangan_skor alert alert-primary">

                    </ul>
                  </td>
                  <td>
                    <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                    <input type="hidden" name="assessment" value="{{ $counter_modal_asesmen }}">
                    <input type="radio" name="indikator" id="" value="0" class="form-group">0
                    <input type="radio" name="indikator" id="" value="1" class="form-group">1
                    <input type="radio" name="indikator" id="" value="2" class="form-group">2
                    <input type="radio" name="indikator" id="" value="3" class="form-group">3
                    <input type="radio" name="indikator" id="" value="4" class="form-group">4
                  </td>
                </tbody>
              </table> --}}
              <h3 class="font-weight-bolder text-dark">Penjelasan Asesmen</h3>
              <div class="penjelasan-komponen-asesmen pl-3">
                {!! Form::hidden('penjelasan_assessment', $item_modal_asesmen->penjelasan_asesmen) !!}
                <h4 class="mb-3">{{ $item_modal_asesmen->penjelasan_asesmen }}</h4>
              </div>
              <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
              <input type="hidden" name="assessment" value="{{ $counter_modal_asesmen }}">
              <hr>
              <div class="alert alert-info alert-heading font-weight-bolder mb-2 information-asesment d-none"></div>
              <h4 class="font-weight-bolder text-dark">Pilih Skor Asesmen</h4>
              <div class="checkbox-keterangan-indikator"></div>
              <hr>
              <div class="col-sm-12 col-lg-12">
                {!! Form::label('file[0]', "Unggah Dokumen (ekstensi .pdf dan total seluruh file sebesar 5MB): ") !!}
                <br>
              </div>
              <div class="col-sm-12 col-lg-6">
              <div class="form-group" id="upload-file_{{$counter_modal_asesmen}}">
                  <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="{{ $counter_modal_asesmen }}">Add More</button>
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
          <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary submit_form">Unggah Asesmen</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  @php
      $counter_modal_asesmen++;
  @endphp
  @endforeach