<div class="card shadow-sm">
    <div class="card-header" id="heading8">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
          @php
              $str = "8. PARTISIPASI MASYARAKAT";
          @endphp
          {{ ucwords(strtolower($str)) }}
        </a>
      </h5>
    </div>
    <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td>1</td>
                <td>Sekolah mengembangkan kapasitas orangtua, paguyuban wali murid dan komite sekolah agar mereka dapat berfungsi secara efektif dalam mendukung dan memperkuat program PPK di sekolah melalui dukungan pikiran, tenaga, materi, dan finansial. </td>
                <td>
                    {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mengembangkan kapasitas orangtua, paguyuban wali murid dan komite sekolah agar mereka dapat berfungsi secara efektif dalam mendukung dan memperkuat program PPK di sekolah melalui dukungan pikiran, tenaga, materi, dan finansial. ") !!}
                    <input type="radio" name="indikator[29]" id="" value="0" class="form-group">0
                    <input type="radio" name="indikator[29]" id="" value="1" class="form-group">1
                    <input type="radio" name="indikator[29]" id="" value="2" class="form-group">2
                    <input type="radio" name="indikator[29]" id="" value="3" class="form-group">3
                    <input type="radio" name="indikator[29]" id="" value="4" class="form-group">4
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
               <td>Komite sekolah berperan aktif dalam mendukung program PPK.</td>
               <td>
                   {!! Form::hidden('penjelasan_assessment[]' , "Komite sekolah berperan aktif dalam mendukung program PPK.") !!}
                   <input type="radio" name="indikator[30]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[30]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[30]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[30]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[30]" id="" value="4" class="form-group">4
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
               <td>Ada pelibatan masyarakat (paguyuban orang tua siswa, komite sekolah, tokoh masyarakat, pelaku seni dan budaya, DU/DI, perguruan tinggi, ikatan alumni, media,  dan lembaga pemerintah) dalam kegiatan Penguatan Pendidikan Karakter.</td>
               <td>
                   {!! Form::hidden('penjelasan_assessment[]' , "Ada pelibatan masyarakat (paguyuban orang tua siswa, komite sekolah, tokoh masyarakat, pelaku seni dan budaya, DU/DI, perguruan tinggi, ikatan alumni, media,  dan lembaga pemerintah) dalam kegiatan Penguatan Pendidikan Karakter.") !!}
                   <input type="radio" name="indikator[31]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[31]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[31]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[31]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[31]" id="" value="4" class="form-group">4
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
            <td>Masyarakat aktif memberikan umpan balik dalam rangka evaluasi dan perbaikan pelaksanaan PPK.</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Masyarakat aktif memberikan umpan balik dalam rangka evaluasi dan perbaikan pelaksanaan PPK.") !!}
                <input type="radio" name="indikator[32]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[32]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[32]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[32]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[32]" id="" value="4" class="form-group">4
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
            <td>Sekolah memanfaatkan sumber-sumber pembelajaran di luar lingkungan sekolah secara maksimal dan efektif.</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Sekolah memanfaatkan sumber-sumber pembelajaran di luar lingkungan sekolah secara maksimal dan efektif.") !!}
                <input type="radio" name="indikator[33]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[33]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[33]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[33]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[33]" id="" value="4" class="form-group">4
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
            <td>Sekolah memiliki sumber-sumber pendanaan dari masyarakat untuk mengembangkan PPK. </td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Sekolah memiliki sumber-sumber pendanaan dari masyarakat untuk mengembangkan PPK.") !!}
                <input type="radio" name="indikator[34]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[34]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[34]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[34]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[34]" id="" value="4" class="form-group">4
            </td>
        </tbody>
        
    </table>
      </div>
    </div>
  </div>
