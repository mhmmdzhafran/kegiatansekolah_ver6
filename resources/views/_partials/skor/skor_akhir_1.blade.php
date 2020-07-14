<tbody>
    
    @foreach ($kategori_asesmen as $list_kategori)
        @if ($list_kategori->id == 1)
            <td>{{ $list_kategori->id.". ".$list_kategori->nama_kategori_asesmen }}</td>
        @endif
            @continue
    @endforeach
    @foreach ($assessment_json as $item)
   
    @if ($item->no <= $assessment_limit_kategori_1)
        @if ($item->skor_penilaian_assessment == 0)
            <td> <button type="button" class="btn btn-primary btn-sm lihat_indikator" id="{{ $item->no }}" data-target="{{ $assessmen_internal->id }}" data-target2="{{ $item->skor_penilaian_assessment }}">{{ $item->skor_penilaian_assessment }}</button></td> 
        @elseif($item->skor_penilaian_assessment == 1)
            <td> <button type="button" class="btn btn-primary btn-sm lihat_indikator" id="{{ $item->no }}" data-target="{{ $assessmen_internal->id }}" data-target2="{{ $item->skor_penilaian_assessment }}">{{ $item->skor_penilaian_assessment }}</button></td> 
        @elseif($item->skor_penilaian_assessment == 2)
            <td> <button type="button" class="btn btn-primary btn-sm lihat_indikator" id="{{ $item->no }}" data-target="{{ $assessmen_internal->id }}" data-target2="{{ $item->skor_penilaian_assessment }}">{{ $item->skor_penilaian_assessment }}</button></td> 
        @elseif($item->skor_penilaian_assessment == 3)
            <td> <button type="button" class="btn btn-primary btn-sm lihat_indikator" id="{{ $item->no }}" data-target="{{ $assessmen_internal->id }}" data-target2="{{ $item->skor_penilaian_assessment }}">{{ $item->skor_penilaian_assessment }}</button></td> 
        @elseif($item->skor_penilaian_assessment == 4)
            <td> <button type="button" class="btn btn-primary btn-sm lihat_indikator" id="{{ $item->no }}" data-target="{{ $assessmen_internal->id }}" data-target2="{{ $item->skor_penilaian_assessment }}">{{ $item->skor_penilaian_assessment }}</button></td> 
        @endif
    {{-- @else --}}
    {{-- @php
    // if ($item->no < $counter_limit_asesment_2) {
    //     continue;
    // }
        $item->no++;
    @endphp --}}
    @endif
    @endforeach    
    <td style="background-color: grey"></td>
    <td style="background-color: grey"></td>
    <td style="background-color: grey"></td>
    <td style="background-color: grey"></td>
    <td>{{ $assessmen_internal->rerata_indikator_1 }}</td>
</tbody>