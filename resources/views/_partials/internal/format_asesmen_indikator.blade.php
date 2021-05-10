<div class="card shadow-sm">
    {{-- TODO: FIX THIS --}}
      @php
        $max_column = $kategori_asesmen->count() - 1;
        $item_number = 0;
        $counter_indikator = 1;
        $counter_asesmen = 1;
      @endphp
      
@foreach ($kategori_asesmen as $item_kategori)
  <div class="card-header border border-left-success" id="heading{{$item_kategori->id}}">
        <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$item_kategori->id}}" aria-expanded="true" aria-controls="collapse{{$item_kategori->id}}">
            <b>{{$item_kategori->id.".".$item_kategori->nama_kategori_asesmen}}</b>
          </a>
        </h5>
  </div>
  @if ($loop->first)
  <div id="collapse{{$counter_indikator}}" class="collapse show" aria-labelledby="heading{{$counter_indikator}}" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
          <thead>
             <th class="text-center">No</th>
             <th class="text-center">Penjelasan Asesmen</th>
             {{-- <th class="text-center">Skor</th> --}}
             <th class="text-center">Status Asesmen</th>
        </thead> 
        @foreach ($item_kategori->PenjelasanAsesmen()->get() as $item_asesmen)
            @if ($counter_asesmen <= $item_kategori->penjelasan_asesmen_count)
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
              $item_number++;
          @endphp
      @endif
      @endforeach
    </table>     
      </div>
    </div>
    @php
        $counter_indikator++;
        $item_number = 0;
    @endphp
    @else
      @if ($counter_indikator == $item_kategori->id)
    <div id="collapse{{$counter_indikator}}" class="collapse" aria-labelledby="heading{{$counter_indikator}}" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
          <thead class="table_asesmen_counter_{{$counter_indikator}} text-center"></thead>
        @foreach ($item_kategori->PenjelasanAsesmen()->get() as $item_asesmen)
            @if ($item_number <= $item_kategori->penjelasan_asesmen_count)
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
              $item_number++;
          @endphp
          @if ($item_number == $item_kategori->penjelasan_asesmen_count)
              @break
          @endif
      @endif
      @endforeach
    </table>
      </div>
    </div>
      @php
        $counter_indikator++;
        $item_number = 0;
      @endphp
      @endif
    @endif
  @endforeach
  </div>
  
  <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormTitle" aria-hidden="true" data-keyboard ="false" data-backdrop="static">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <h5 class="modal-title" id="modalFormTitle">Lakukan Asesmen PPK</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
          <form action="" id="form_indikator" enctype="multipart/form-data">
              @csrf
              @method("PUT")
              <div class="row">
              <div class="col-lg-12 col-sm-12">
              <ul id="error_indikator" class="d-none" style="background-color: #e53e3e; color: white; border-radius: 10px"></ul>
                <div class="alert alert-heading font-weight-bolder" id="show-score" style="border-radius: 10px;"></div>
                <div class="lihat-dokumen alert alert-warning alert-heading font-weight-bolder" style="border-radius: 10px;"></div>

                <hr>
                <h3 class="font-weight-bolder text-dark">Penjelasan Asesmen</h3>

                <div class="penjelasan-komponen-asesmen pl-3">
                  {!! Form::hidden('penjelasan_assessment', null, ['id' => 'penjelasan_assessment']) !!}
                  {{-- <h4 class="mb-3" id="show_penjelasan">{{ $item_modal_asesmen->penjelasan_asesmen }}</h4> --}}
                  <h4 class="mb-3" id="show_penjelasan"></h4>
                </div>

                {{-- <input type="hidden"  id="id_assessmen" name="id"> --}}
                <input type="hidden" name="indikator_assessment" id="indikator_assessment">
                <hr>
                <div class="alert alert-info alert-heading font-weight-bolder mb-2 d-none" id="information-asesment"></div>
                <h4 class="font-weight-bolder text-dark">Pilih Skor Asesmen</h4>
                <div id="checkbox-keterangan-indikator"></div>
                <hr>
                <div class="col-sm-12 col-lg-12">
                  {!! Form::label('file[0]', "Unggah Dokumen (ekstensi .pdf dan total seluruh file sebesar 5MB): ") !!}
                  <br>
                </div>
                <div class="col-sm-12 col-lg-6">
                <div class="form-group" id="upload-file_indikator_asesmen">
                    <button type="button" class="btn btn-success btn-sm mb-2 add_file">Add More</button>
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