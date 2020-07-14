<div class="card shadow-sm">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          @php
              $str = strtolower('3. VISI, MISI DAN PERUMUSAN');
          @endphp
          {{ ucwords($str) }}
        </a>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
              <thead>
                 <th class="text-center">No</th>
                 <th class="text-center">Penjelasan Assessment</th>
                 <th class="text-center">Skor</th>
              </thead>
              <tbody>
                  <td class="text-center">1</td>
                  <td class="text-center">Program Penguatan Pendidikan Karakter terintegrasi dalam rumusan visi misi dan dokumen kurikulum Sekolah (visi, misi, silabus, skenario pembelajaran, strategi, konten, media, dan penilaian).</td>
                  <td>
                    {!! Form::hidden('penjelasan_assessment[]', "Program Penguatan Pendidikan Karakter terintegrasi dalam rumusan visi misi dan dokumen kurikulum Sekolah (visi, misi, silabus, skenario pembelajaran, strategi, konten, media, dan penilaian).") !!}
                      <input type="radio" name="indikator[8]" id="" value="0" class="form-group">0
                      <input type="radio" name="indikator[8]" id="" value="1" class="form-group">1
                      <input type="radio" name="indikator[8]" id="" value="2" class="form-group">2
                      <input type="radio" name="indikator[8]" id="" value="3" class="form-group">3
                      <input type="radio" name="indikator[8]" id="" value="4" class="form-group">4
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
                 <td class="text-center">Sekolah mengaitkan nilai-nilai utama PPK yang lain dengan prioritas nilai utama yang dipilih dan dikembangkan (religius, nasionalis, integritas, gotong royong, dan mandiri).</td>
                 <td>
                   {!! Form::hidden('penjelasan_assessment[]', "Sekolah mengaitkan nilai-nilai utama PPK yang lain dengan prioritas nilai utama yang dipilih dan dikembangkan (religius, nasionalis, integritas, gotong royong, dan mandiri).") !!}
                     <input type="radio" name="indikator[9]" id="" value="0" class="form-group">0
                     <input type="radio" name="indikator[9]" id="" value="1" class="form-group">1
                     <input type="radio" name="indikator[9]" id="" value="2" class="form-group">2
                     <input type="radio" name="indikator[9]" id="" value="3" class="form-group">3
                     <input type="radio" name="indikator[9]" id="" value="4" class="form-group">4
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
                 <td class="text-center">Rumusan nilai-nilai utama karakter oleh sekolah sejalan dengan semangat globalisasi, mengadopsi nilai-nilai keutamaan lokal, dan sejalan dengan perkembangan anak.</td>
                 <td>
                   {!! Form::hidden('penjelasan_assessment[]' , "Rumusan nilai-nilai utama karakter oleh sekolah sejalan dengan semangat globalisasi, mengadopsi nilai-nilai keutamaan lokal, dan sejalan dengan perkembangan anak.") !!}
                     <input type="radio" name="indikator[10]" id="" value="0" class="form-group">0
                     <input type="radio" name="indikator[10]" id="" value="1" class="form-group">1
                     <input type="radio" name="indikator[10]" id="" value="2" class="form-group">2
                     <input type="radio" name="indikator[10]" id="" value="3" class="form-group">3
                     <input type="radio" name="indikator[10]" id="" value="4" class="form-group">4
                 </td>
             </tbody>
             
         </table>

      </div>
    </div>
  </div>