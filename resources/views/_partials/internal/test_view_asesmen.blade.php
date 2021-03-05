<div class="card shadow-sm">
    @php
        $counter_indikator = 1;
        $counter_asesmen = 1;
    @endphp
    
@foreach ($kategori_asesmen as $item_kategori)
    <div class="card-header border border-left-success" id="heading{{$counter_indikator}}">
      <h5 class="mb-0">
      <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$counter_indikator}}" aria-expanded="true" aria-controls="collapse{{$counter_indikator}}">
          <b>{{$counter_indikator.".".$item_kategori->nama_kategori_asesmen}}</b>
        </a>
      </h5>
    </div>
@if ($loop->first)
    <div id="collapse{{$counter_indikator}}" class="collapse show" aria-labelledby="heading{{$counter_indikator}}" data-parent="#accordion">
@else
    <div id="collapse{{$counter_indikator}}" class="collapse" aria-labelledby="heading{{$counter_indikator}}" data-parent="#accordion">
@endif
    <div class="card-body">
      <table class="table table-borderless">  
        <thead>
           <th class="text-center">No</th>
           <th class="text-center">Penjelasan Asesmen</th>
           <th class="text-center">Status Asesmen</th>
           {{-- <th class="text-center">Skor</th> --}}
      </thead> 
      @foreach ($item_kategori->PenjelasanAsesmen as $item_asesmen)
          @if ($item_kategori->id <= $item_asesmen->id)
         <tbody>
             <td class="text-center" width="10%">
               {{ $counter_asesmen }}
              </td>
             <td class="text-center">
               {{ $item_asesmen->penjelasan_asesmen }}
            </td>
            @foreach ($json_assessmen as $item)
                  @if ($item->no == $counter_asesmen)
                    @if (empty($item->penjelasan_assessment))
                    <td width="20%" class="text-center">
                      <button type="button" class="btn btn-primary btn-sm rounded-pill lihat_form" value="{{ $counter_asesmen }}" data-target="{{ $assessment->id }}">Lakukan Asesmen</button>    
                    </td>
                    {{-- <td class="text-center scores_{{$counter_asesmen}}"><span class="badge badge-pill badge-danger">{{ $item->skor_penilaian_assessment }}</span></td> --}}
                    @else
                    <td width="20%" class="text-center">
                        <button type="button" class="btn btn-warning btn-sm rounded-pill lihat_form" value="{{ $counter_asesmen }}"  data-target="{{ $assessment->id }}">Edit Asesmen</button>
                    </td>
                    {{-- <td class="text-center scores_{{$counter_asesmen}}"><span class="badge badge-pill badge-success">{{ $item->skor_penilaian_assessment }}</span></td> --}}
                    @endif
                  @endif
               @endforeach
         </tbody>
         <div class="modal fade" id="modalForm{{$counter_asesmen}}" tabindex="-1" role="dialog" aria-labelledby="modalForm{{$counter_asesmen}}Title" aria-hidden="true" data-keyboard ="false" data-backdrop="static">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modalForm{{$counter_asesmen}}Title">Lakukan Asesmen PPK</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                
                <div class="modal-body">
                <form action="" id="form_{{$counter_asesmen}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method("PUT")
                    <div class="row">
                    <div class="col-lg-12 col-sm-12">
                    <ul id="error_indikator_{{$counter_asesmen}}" class="d-none" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                      @foreach ($json_assessmen as $item)
                      @if ($item->no == $counter_asesmen)
                          @if (!empty($item->penjelasan_assessment))
                          <div class="alert alert-success alert-heading font-weight-bolder" style="border-radius: 10px;">
                          <b>Histori Asesmen</b>
                              <ul>
                                  <li>
                                      Skor Asesmen: {{ $item->skor_penilaian_assessment }}
                                  </li>
                                  
                                <input type="hidden" id="previous-score_{{$counter_asesmen}}" value="{{ $item->skor_penilaian_assessment }}">
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
                      <h3 class="font-weight-bolder text-dark">Penjelasan Asesmen</h3>
                      <div class="penjelasan-komponen-asesmen pl-3">
                        {!! Form::hidden('penjelasan_assessment', $item_asesmen->penjelasan_asesmen) !!}
                        <h4 class="mb-3">{{ $item_asesmen->penjelasan_asesmen }}</h4>
                      </div>
                      <input type="hidden" value="{{ $assessment->id }}" id="id_assessmen" name="id">
                      <input type="hidden" name="assessment" value="{{ $counter_asesmen }}">
                      <hr>
                      <div class="alert alert-info alert-heading font-weight-bolder mb-2 information-asesment d-none"></div>
                      <h4 class="font-weight-bolder text-dark">Pilih Skor Asesmen</h4>
                      <div class="checkbox-keterangan-indikator_{{$counter_asesmen}}"></div>
                      <hr>
                      <div class="col-sm-12 col-lg-12">
                        {!! Form::label('file[0]', "Unggah Dokumen (ekstensi .pdf dan total seluruh file sebesar 5MB): ") !!}
                        <br>
                      </div>
                      <div class="col-sm-12 col-lg-6">
                      <div class="form-group" id="upload-file_{{$counter_asesmen}}">
                          <button type="button" class="btn btn-success btn-sm mb-2 add_file" value="{{ $counter_asesmen }}">Add More</button>
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
         @endif
        @php
            $counter_asesmen++;
        @endphp
    @endforeach
  </table>     
</div>
  @php
      $counter_indikator++;
  @endphp
</div>
@endforeach
</div>
