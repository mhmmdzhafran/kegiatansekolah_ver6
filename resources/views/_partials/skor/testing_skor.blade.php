@php
    $max_column = $kategori_asesmen->count() - 1;
    $item_score_number = 0;
    $score = 1;
@endphp
@foreach ($kategori_asesmen as $item_kategori)
<tbody>
    <td>{{ $item_kategori->id.". ".$item_kategori->nama_kategori_asesmen}}</td>
    @php
        $current_score_count = $item_kategori->penjelasan_asesmen_count;
    @endphp
    @foreach ($assessment_json as $item)
        
        @if ($item->no == $score)
            <td> 
                <button type="button" class="btn btn-primary btn-sm lihat_indikator" id="{{ $score }}" data-target="{{ $assessmen_internal->id }}" data-target2="{{ $item->skor_penilaian_assessment }}">
                    {{ $item->skor_penilaian_assessment }}
                </button>
            </td>
        @php
            $score++;
            $item_score_number++;
        @endphp
        @else
            @continue
        @endif
            @if ($item_score_number == $current_score_count)
                @php
                    $score = $item->no + 1;
                @endphp
                @break
            @endif
    @endforeach
    @if ($item_kategori->penjelasan_asesmen_count < $max_column)
        @php
            $count_rest_table = $max_column - $item_kategori->penjelasan_asesmen_count;
        @endphp
        @for ($counter = 1; $counter <= $count_rest_table; $counter++)
            <td style="background-color: grey"></td>
        @endfor
    @endif
    @php
        $dynamic_score = "rerata_indikator_".$item_kategori->id;    
        $final_result_of_table = $assessmen_internal->$dynamic_score;
        $item_score_number = 0;
    @endphp
    <td>{{ $final_result_of_table}}</td>
</tbody>
@endforeach