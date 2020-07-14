<div class="card shadow-sm">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          1. Assessment Awal
        </a>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
       <table class="table table-borderless">
           <thead>
              <th class="text-center">No</th>
              <th class="text-center">Penjelasan Assessment</th>
              <th class="text-center">Skor</th>
           </thead>
           <tbody>
               <td class="text-center">1</td>
               <td class="text-center">Sekolah mengidentifikasi sumber-sumber belajar dan sarana prasarana di dalam dan luar sekolah.</td>
               <td>
                {!! Form::hidden('penjelasan_assessment[]', "Sekolah mengidentifikasi sumber-sumber belajar dan sarana prasarana di dalam dan luar sekolah.") !!}
                   <input type="radio" name="indikator[0]" id="" value="0" class="form-group">0
                   <input type="radio" name="indikator[0]" id="" value="1" class="form-group">1
                   <input type="radio" name="indikator[0]" id="" value="2" class="form-group">2
                   <input type="radio" name="indikator[0]" id="" value="3" class="form-group">3
                   <input type="radio" name="indikator[0]" id="" value="4" class="form-group">4
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
              <td class="text-center">Sekolah mengidentifikasi sumber daya manusia yang tersedia di sekolah dan luar sekolah.</td>
              <td>
                {!! Form::hidden('penjelasan_assessment[]', "Sekolah mengidentifikasi sumber daya manusia yang tersedia di sekolah dan luar sekolah.") !!}
                  <input type="radio" name="indikator[1]" id="" value="0" class="form-group">0
                  <input type="radio" name="indikator[1]" id="" value="1" class="form-group">1
                  <input type="radio" name="indikator[1]" id="" value="2" class="form-group">2
                  <input type="radio" name="indikator[1]" id="" value="3" class="form-group">3
                  <input type="radio" name="indikator[1]" id="" value="4" class="form-group">4
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
              <td class="text-center">Sekolah mengidentifikasi potensi budaya dan karakteryang ada di sekolah dan luar sekolah.</td>
              <td>
                {!! Form::hidden('penjelasan_assessment[]', "Sekolah mengidentifikasi potensi budaya dan karakteryang ada di sekolah dan luar sekolah.") !!}
                  <input type="radio" name="indikator[2]" id="" value="0" class="form-group">0
                  <input type="radio" name="indikator[2]"  id="" value="1" class="form-group">1
                  <input type="radio" name="indikator[2]" id="" value="2" class="form-group">2
                  <input type="radio" name="indikator[2]" id="" value="3" class="form-group">3
                  <input type="radio" name="indikator[2]" id="" value="4" class="form-group">4
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
              <td class="text-center">4</td>
              <td class="text-center">Sekolah mengidentifikasi sumber-sumber pembiayaan PPK.</td>
              <td class="text-center">
                {!! Form::hidden('penjelasan_assessment[]', "Sekolah mengidentifikasi sumber-sumber pembiayaan PPK.") !!}
                  <input type="radio" name="indikator[3]" id="" value="0" class="form-group">0
                  <input type="radio" name="indikator[3]" id="" value="1" class="form-group">1
                  <input type="radio" name="indikator[3]" id="" value="2" class="form-group">2
                  <input type="radio" name="indikator[3]" id="" value="3" class="form-group">3
                  <input type="radio" name="indikator[3]" id="" value="4" class="form-group">4
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
              <td class="text-center">5</td>
              <td class="text-center">Sekolah mengidentifikasi tata kelola sekolah</td>
              <td class="text-center">
                  {!! Form::hidden('penjelasan_assessment[]', "Sekolah mengidentifikasi tata kelola sekolah") !!}
                  <input type="radio" name="indikator[4]" id="" value="0" class="form-group">0
                  <input type="radio" name="indikator[4]" id="" value="1" class="form-group">1
                  <input type="radio" name="indikator[4]" id="" value="2" class="form-group">2
                  <input type="radio" name="indikator[4]" id="" value="3" class="form-group">3
                  <input type="radio" name="indikator[4]" id="" value="4" class="form-group">4
              </td>
          </tbody>
          
      </table>

      </div>
    </div>
  </div>