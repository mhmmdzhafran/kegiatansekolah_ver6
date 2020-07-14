<div class="card shadow-sm">
    <div class="card-header" id="heading7">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
          @php
              $str = "7. PENGEMBANGAN BUDAYA SEKOLAH";
          @endphp
          {{ ucwords(strtolower($str)) }}
        </a>
      </h5>
    </div>
    <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td>1</td>
                <td>Sekolah memiliki dan mengembangkan tradisi-tradisi unggulan yang memperkuat budaya sekolah.</td>
                <td>
                    {!! Form::hidden('penjelasan_assessment[]' , "Sekolah memiliki dan mengembangkan tradisi-tradisi unggulan yang memperkuat budaya sekolah") !!}
                    <input type="radio" name="indikator[25]" id="" value="0" class="form-group">0
                    <input type="radio" name="indikator[25]" id=""  value="1" class="form-group">1
                    <input type="radio" name="indikator[25]" id="" value="2" class="form-group">2
                    <input type="radio" name="indikator[25]" id="" value="3" class="form-group">3
                    <input type="radio" name="indikator[25]" id="" value="4" class="form-group">4
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
               <td>2</td>
               <td>Sekolah mengembangkan dan mengapresiasi kearifan lokal.</td>
               <td>
                   {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mengembangkan dan mengapresiasi kearifan lokal.") !!}
                   <input type="radio" name="indikator[26]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[26]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[26]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[26]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[26]" id="" value="4" class="form-group">4
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
               <td>3</td>
               <td>Sekolah mengembangkan budaya belajar yang menumbuhkan keterampilan abad 21 (berpikir kritis, kreatif, komunikasi dan kolaborasi, literasi multimedia).</td>
               <td>
                   {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mengembangkan budaya belajar yang menumbuhkan keterampilan abad 21 (berpikir kritis, kreatif, komunikasi dan kolaborasi, literasi multimedia).") !!}
                   <input type="radio" name="indikator[27]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[27]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[27]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[27]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[27]" id="" value="4" class="form-group">4
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
            <td>4</td>
            <td>Bimbingan konseling memiliki program-program yang relevan yang mendukung penguatan PPK di tingkat kelas, pengembangan budaya sekolah dan pelibatan masyarakat.</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Bimbingan konseling memiliki program-program yang relevan yang mendukung penguatan PPK di tingkat kelas, pengembangan budaya sekolah dan pelibatan masyarakat.") !!}
                <input type="radio" name="indikator[28]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[28]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[28]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[28]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[28]" id="" value="4" class="form-group">4
            </td>
        </tbody>
        
    </table>
      </div>
    </div>
  </div>
