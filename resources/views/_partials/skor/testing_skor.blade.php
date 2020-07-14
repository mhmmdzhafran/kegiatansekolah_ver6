{{-- @php
    $counter = 1;
    $counter_penjelasan = 1;
@endphp
@foreach ($get_kategori as $item_kategori)
        @if (count($get_kategori) >= $counter)
        <tbody>
            @foreach ($assessment_json as $item)
                @if ($item->no >= 1 && $item->no <= 5)
                <td>{{ $item->penjelasan_assessment }}</td>
                <td><button type="button" class="btn btn-primary btn-sm lihat_indikator" value="{{ $item->penjelasan_assessment }} <br> Nilai: 0- Sekolah tidak melakukan identifikasi <br> Saran: 1- Sekolah mengidentifikasi minimal 1 sumber belajar dan sarana prasarana di sekolah" id="{{ $item->no }}" data-target="{{ $assessmen_internal->id }}" data-target2="{{ $item->skor_penilaian_assessment }}" >{{ $item->skor_penilaian_assessment }}</button></td> 
                    @php
                        $item->no++;
                    @endphp
                    @break
                @else
                <td><button class="btn btn-secondary btn-sm" disabled>N/A</button></td>
                <td><button class="btn btn-secondary btn-sm" disabled>N/A</button></td>
                <td><button class="btn btn-secondary btn-sm" disabled>N/A</button></td>
                <td><button class="btn btn-secondary btn-sm" disabled>N/A</button></td>
                <td>{{ $assessmen_internal->rerata_indikator_1 }}</td>
                    @break
                @endif
            @endforeach
        </tbody>
        @php
            $counter++;
        @endphp
        @endif
@endforeach --}}