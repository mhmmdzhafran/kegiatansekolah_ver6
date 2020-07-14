<div class="card shadow-sm">
    <div class="card-header" id="heading6">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
          @php
              $str = "BERBASIS KELAS";
          @endphp
          {{ "6. PPK ".ucwords(strtolower($str)) }}
        </a>
      </h5>
    </div>
    <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
          <thead>
             <th class="text-center">No</th>
             <th class="text-center">Penjelasan Assessment</th>
             <th class="text-center">Skor</th>
          </thead>
          <tbody>
              <td>1</td>
              <td>Guru mengintegrasikan nilai-nilai utama PPK dalam desain rencana pelaksanaan pembelajaran (RPP).</td>
              <td>
                  {!! Form::hidden('penjelasan_assessment[]' , "Guru mengintegrasikan nilai-nilai utama PPK dalam desain rencana pelaksanaan pembelajaran (RPP).") !!}
                  <input type="radio" name="indikator[21]" id="" value="0" class="form-group">0
                  <input type="radio" name="indikator[21]" id="" value="1" class="form-group">1
                  <input type="radio" name="indikator[21]" id="" value="2" class="form-group">2
                  <input type="radio" name="indikator[21]" id="" value="3" class="form-group">3
                  <input type="radio" name="indikator[21]" id="" value="4" class="form-group">4
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
             <td>Guru mengembangkan skenario pembelajaran yang dapat memperkuat nilai-nilai karakter.</td>
             <td>
                 {!! Form::hidden('penjelasan_assessment[]' , "Guru mengembangkan skenario pembelajaran yang dapat memperkuat nilai-nilai karakter.") !!}
                 <input type="radio" name="indikator[22]" id="" value="0" class="form-group">0
                 <input type="radio" name="indikator[22]" id="" value="1" class="form-group">1
                 <input type="radio" name="indikator[22]" id="" value="2" class="form-group">2
                 <input type="radio" name="indikator[22]" id="" value="3" class="form-group">3
                 <input type="radio" name="indikator[22]" id="" value="4" class="form-group">4
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
             <td>Guru mengaitkan isi materi pembelajaran dengan persoalan kehidupan sehari-hari.</td>
             <td>
                 {!! Form::hidden('penjelasan_assessment[]' , "Guru mengaitkan isi materi pembelajaran dengan persoalan kehidupan sehari-hari.") !!}
                 <input type="radio" name="indikator[23]" id="" value="0" class="form-group">0
                 <input type="radio" name="indikator[23]" id="" value="1" class="form-group">1
                 <input type="radio" name="indikator[23]" id="" value="2" class="form-group">2
                 <input type="radio" name="indikator[23]" id="" value="3" class="form-group">3
                 <input type="radio" name="indikator[23]" id="" value="4" class="form-group">4
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
          <td>Sekolah mengembangkan kapasitas guru secara berkelanjutan (pelatihan, lesson studies, berbagi pengalaman, dan lain-lain).</td>
          <td>
              {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mengembangkan kapasitas guru secara berkelanjutan (pelatihan, lesson studies, berbagi pengalaman, dan lain-lain).") !!}
              <input type="radio" name="indikator[24]" id="" value="0" class="form-group">0
              <input type="radio" name="indikator[24]" id="" value="1" class="form-group">1
              <input type="radio" name="indikator[24]" id="" value="2" class="form-group">2
              <input type="radio" name="indikator[24]" id="" value="3" class="form-group">3
              <input type="radio" name="indikator[24]" id="" value="4" class="form-group">4
          </td>
      </tbody>
      
  </table>      </div>
    </div>
  </div>