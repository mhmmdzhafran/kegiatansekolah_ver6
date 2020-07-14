<div class="card shadow-sm">
    <div class="card-header" id="heading10">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
          @php
              $str = "10. EVALUASI";
          @endphp
          {{ ucwords(strtolower($str))." PPK" }}
        </a>
      </h5>
    </div>
    <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td>1</td>
                <td>Sekolah memiliki instrumen untuk mengukur dan mendokumentasikan keberhasilan program PPK.</td>
                <td>
                    {!! Form::hidden('penjelasan_assessment[]' , "Sekolah memiliki instrumen untuk mengukur dan mendokumentasikan keberhasilan program PPK.") !!}
                    <input type="radio" name="indikator[40]" id="" value="0" class="form-group">0
                    <input type="radio" name="indikator[40]" id="" value="1" class="form-group">1
                    <input type="radio" name="indikator[40]" id="" value="2" class="form-group">2
                    <input type="radio" name="indikator[40]" id="" value="3" class="form-group">3
                    <input type="radio" name="indikator[40]" id="" value="4" class="form-group">4
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
               <td>Kepala sekolah, guru, orang tua dan komite sekolah melakukan kegiatan monitoring PPK secara rutin dan berkelanjutan.</td>
               <td>
                   {!! Form::hidden('penjelasan_assessment[]' , "Kepala sekolah, guru, orang tua dan komite sekolah melakukan kegiatan monitoring PPK secara rutin dan berkelanjutan.") !!}
                   <input type="radio" name="indikator[41]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[41]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[41]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[41]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[41]" id="" value="4" class="form-group">4
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
               <td>Sekolah memiliki mekanisme umpan balik di antara peserta didik untuk memperbaiki perilaku individu dan budaya sekolah.</td>
               <td>
                   {!! Form::hidden('penjelasan_assessment[]', "Sekolah memiliki mekanisme umpan balik di antara peserta didik untuk memperbaiki perilaku individu dan budaya sekolah.") !!}
                   <input type="radio" name="indikator[42]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[42]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[42]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[42]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[42]" id="" value="4" class="form-group">4
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
            <td>Sekolah menindaklanjuti hasil monitoring untuk memperbaiki pelaksanaan kegiatan PPK.</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Sekolah menindaklanjuti hasil monitoring untuk memperbaiki pelaksanaan kegiatan PPK.") !!}
                <input type="radio" name="indikator[43]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[43]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[43]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[43]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[43]" id="" value="4" class="form-group">4
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
            <td>5</td>
            <td>Sekolah menggunakan dokumentasi dan data-data pendukung (presensi siswa, catatan harian sekolah, notulensi rapat, dan lain-lain) untuk menilai pelaksanaan dan keberhasilan program PPK.</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Sekolah menggunakan dokumentasi dan data-data pendukung (presensi siswa, catatan harian sekolah, notulensi rapat, dan lain-lain) untuk menilai pelaksanaan dan keberhasilan program PPK.") !!}
                <input type="radio" name="indikator[44]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[44]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[44]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[44]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[44]" id="" value="4" class="form-group">4
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
            <td>6</td>
            <td>Sekolah melibatkan seluruh sumber daya manusia yang tersedia dalam PPK.</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Sekolah melibatkan seluruh sumber daya manusia yang tersedia dalam PPK.") !!}
                <input type="radio" name="indikator[45]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[45]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[45]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[45]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[45]" id="" value="4" class="form-group">4
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
            <td>7</td>
            <td>Sekolah menggunakan sarana dan prasarana (lapangan olah raga, alat-alat kesenian, dan lain-lain) secara efektif.</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Sekolah menggunakan sarana dan prasarana (lapangan olah raga, alat-alat kesenian, dan lain-lain) secara efektif.") !!}
                <input type="radio" name="indikator[46]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[46]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[46]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[46]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[46]" id="" value="4" class="form-group">4
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
            <td>8</td>
            <td>Sekolah memanfaatkan berbagai media pembelajaran PPK (papan sekolah aman, poster, spanduk, website, buletin, mading, dan lain-lain).</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Sekolah memanfaatkan berbagai media pembelajaran PPK (papan sekolah aman, poster, spanduk, website, buletin, mading, dan lain-lain).") !!}
                <input type="radio" name="indikator[47]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[47]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[47]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[47]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[47]" id="" value="4" class="form-group">4
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
            <td>9</td>
            <td>Gerakan PPK meningkatkan prestasi akademik dan membangun budaya belajar mandiri.</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Gerakan PPK meningkatkan prestasi akademik dan membangun budaya belajar mandiri.") !!}
                <input type="radio" name="indikator[48]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[48]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[48]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[48]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[48]" id="" value="4" class="form-group">4
            </td>
        </tbody>
        
    </table>
      </div>
    </div>
  </div>
