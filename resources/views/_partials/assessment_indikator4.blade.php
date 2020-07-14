<div class="card shadow-sm">
    <div class="card-header" id="heading4">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
            @php
            $str = strtolower('4. DESAIN KEBIJAKAN');
        @endphp
        {{ ucwords($str)." PPK" }}
        </a>
      </h5>
    </div>
    <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
      <div class="card-body">
        <table class="table table-borderless">
            <thead>
               <th class="text-center">No</th>
               <th class="text-center">Penjelasan Assessment</th>
               <th class="text-center">Skor</th>
            </thead>
            <tbody>
                <td>1</td>
                <td>Sekolah mendefinisikan dan menentukan peranan masing-masing pihak dalam pengembangan PPK.</td>
                <td>
                    {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mendefinisikan dan menentukan peranan masing-masing pihak dalam pengembangan PPK.") !!}
                    <input type="radio" name="indikator[11]" id="" value="0" class="form-group">0
                    <input type="radio" name="indikator[11]" id="" value="1" class="form-group">1
                    <input type="radio" name="indikator[11]" id="" value="2" class="form-group">2
                    <input type="radio" name="indikator[11]" id="" value="3" class="form-group">3
                    <input type="radio" name="indikator[11]" id="" value="4" class="form-group">4
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
               <td>Kebijakan dan peraturan sekolah mendukung implementasi PPK (kebijakan tentang mencontek, sanksi, apresiasi, dan lain-lain).</td>
               <td>
                   {!! Form::hidden('penjelasan_assessment[]' , "Kebijakan dan peraturan sekolah mendukung implementasi PPK (kebijakan tentang mencontek, sanksi, apresiasi, dan lain-lain).") !!}
                   <input type="radio" name="indikator[12]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[12]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[12]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[12]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[12]" id="" value="4" class="form-group">4
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
               <td>Sekolah mengembangkan semangat inklusivitas dalam pengelolaan pendidikan bagi peserta didik penyandang disabilitas (berkebutuhan khusus).</td>
               <td>
                   {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mengembangkan semangat inklusivitas dalam pengelolaan pendidikan bagi peserta didik penyandang disabilitas (berkebutuhan khusus).") !!}
                   <input type="radio" name="indikator[13]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[13]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[13]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[13]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[13]" id="" value="4" class="form-group">4
               </td>
           </tbody>
           
       </table>

      </div>
    </div>
  </div>