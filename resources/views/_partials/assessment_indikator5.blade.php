<div class="card shadow-sm">
    <div class="card-header" id="heading5">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
          @php
              $str = "5. DESAIN PROGRAM";
          @endphp
          {{ ucwords(strtolower($str)) }}
        </a>
      </h5>
    </div>
    <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td>1</td>
                <td>Sekolah mengembangkan program PPK secara seimbang antara olah raga, olah pikir, olah rasa, dan olah hati.</td>
                <td>
                    {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mengembangkan program PPK secara seimbang antara olah raga, olah pikir, olah rasa, dan olah hati.") !!}
                    <input type="radio" name="indikator[14]" id="" value="0" class="form-group">0
                    <input type="radio" name="indikator[14]" id="" value="1" class="form-group">1
                    <input type="radio" name="indikator[14]" id="" value="2" class="form-group">2
                    <input type="radio" name="indikator[14]" id="" value="3" class="form-group">3
                    <input type="radio" name="indikator[14]" id="" value="4" class="form-group">4
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
               <td>Sekolah menggunakan potensi lingkungan sebagai ekstensi ruang pembelajaran sehingga pembelajaran berlangsung dalam kehidupan yang luas.</td>
               <td>
                   {!! Form::hidden('penjelasan_assessment[]' , "Sekolah menggunakan potensi lingkungan sebagai ekstensi ruang pembelajaran sehingga pembelajaran berlangsung dalam kehidupan yang luas.") !!}
                   <input type="radio" name="indikator[15]" id=""  value="0" class="form-group">0
                   <input type="radio" name="indikator[15]" id=""  value="1" class="form-group">1
                   <input type="radio" name="indikator[15]" id=""  value="2" class="form-group">2
                   <input type="radio" name="indikator[15]" id=""  value="3" class="form-group">3
                   <input type="radio" name="indikator[15]" id=""  value="4" class="form-group">4
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
               <td>Sekolah memiliki program unggulan PPK dengan mengintegrasikan nilai-nilai utama PPK dalam setiap aktivitas pembelajaran (intrakurikuler dan kokurikuler).</td>
               <td>
                   {!! Form::hidden("penjelasan_assessment[]" , "Sekolah memiliki program unggulan PPK dengan mengintegrasikan nilai-nilai utama PPK dalam setiap aktivitas pembelajaran (intrakurikuler dan kokurikuler).") !!}
                   <input type="radio" name="indikator[16]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[16]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[16]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[16]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[16]" id="" value="4" class="form-group">4
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
            <td>Sekolah memiliki program bersifat kesukarelawanan (volunter).</td>
            <td>
                {!! Form::hidden("penjelasan_assessment[]" , "Sekolah memiliki program bersifat kesukarelawanan (volunter).") !!}
                <input type="radio" name="indikator[17]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[17]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[17]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[17]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[17]" id="" value="4" class="form-group">4
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
            <td>Kegiatan-kegiatan ekstrakurikuler mendukung pengembangan branding sekolah.</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Kegiatan-kegiatan ekstrakurikuler mendukung pengembangan branding sekolah.") !!}
                <input type="radio" name="indikator[18]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[18]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[18]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[18]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[18]" id="" value="4" class="form-group">4
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
            <td>Program PPK sesuai dengan tahap perkembangan usia peserta didik</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Program PPK sesuai dengan tahap perkembangan usia peserta didik") !!}
                <input type="radio" name="indikator[19]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[19]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[19]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[19]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[19]" id="" value="4" class="form-group">4
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
            <td>Sekolah memiliki kegiatan pembiasaan untuk menanamkan nilai-nilai utama PPK</td>
            <td>
                {!! Form::hidden('penjelasan_assessment[]' , "Sekolah memiliki kegiatan pembiasaan untuk menanamkan nilai-nilai utama PPK") !!}
                <input type="radio" name="indikator[20]" id="" value="0" class="form-group">0
                <input type="radio" name="indikator[20]" id="" value="1" class="form-group">1
                <input type="radio" name="indikator[20]" id="" value="2" class="form-group">2
                <input type="radio" name="indikator[20]" id="" value="3" class="form-group">3
                <input type="radio" name="indikator[20]" id="" value="4" class="form-group">4
            </td>
        </tbody>
    </table>
      </div>
    </div>
  </div>
