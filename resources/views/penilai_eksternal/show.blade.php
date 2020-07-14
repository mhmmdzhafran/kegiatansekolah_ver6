@extends('layouts.template_eksternal')

@section('content')
    <h3> <a href="{{ route('penilai_eksternal.hasil_penilaian') }}" class="back"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Back</a> Hasil Penilaian Skor untuk Sekolah {{ $assessment->nama_sekolah }}</h3>

    <table class="table table-bordered table-responsive">
        <thead>
            <th>Penjelasan</th>
            <th>1</th>
            <th>2</th>
            <th>3</th>
            <th>4</th>
            <th>5</th>
            <th>6</th>
            <th>7</th>
            <th>8</th>
            <th>9</th>
            <th>Rerata</th>
        </thead>
        
        @include('_partials/eksternal/skor_eksternal_1')

        @include('_partials/eksternal/skor_eksternal_2')

        @include('_partials/eksternal/skor_eksternal_3')
        
        @include('_partials/eksternal/skor_eksternal_4')

        @include('_partials/eksternal/skor_eksternal_5')

        @include('_partials/eksternal/skor_eksternal_6')
        
        @include('_partials/eksternal/skor_eksternal_7')
        
        @include('_partials/eksternal/skor_eksternal_8')
        
        @include('_partials/eksternal/skor_eksternal_9')

        @include('_partials/eksternal/skor_eksternal_10')
        
        <tbody>
            <td class="font-weight-bold text-center">Hasil Akhir</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $assessment->skor_penilaian_kegiatan_akhir }}</td>
        </tbody>
    </table>

<!-- Modal for melihat detail assessmen -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalTitle">Penjelasan Assessmen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <b class="detail" style="color:black"></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
    <script>
        $(".lihat_indikator").on('click', function(){
            $(".detail").empty();
            var value = $(this).attr('value');
            $("#myModal").modal();
            $(".detail").append(value);
        });
    </script>
@endsection