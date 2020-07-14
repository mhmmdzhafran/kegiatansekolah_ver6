<div class="card shadow-sm">
    <div class="card-header" id="heading9">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
            @php
                $str = strtolower('9. IMPLEMENTASI NILAI-NILAI UTAMA');
            @endphp
            {{ ucwords($str) }}
        </a>
      </h5>
    </div>
    <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion">
      <div class="card-body">
          <table class="table table-borderless">
              <thead>
                 <th class="text-center">No</th>
                 <th class="text-center">Penjelasan Assessment</th>
                 <th class="text-center">Skor</th>
              </thead>
              <tbody>
                  <td>1</td>
                  <td>Sekolah memiliki kegiatan untuk mengembangkan dimensi religiusitas peserta didik sesuai dengan agama dan kepercayaannya, menumbuhkan perilaku toleran dan kemampuan bekerja sama antarumat beragama dan penganut kepercayaan.</td>
                  <td>
                      {!! Form::hidden('penjelasan_assessment[]' , "Sekolah memiliki kegiatan untuk mengembangkan dimensi religiusitas peserta didik sesuai dengan agama dan kepercayaannya, menumbuhkan perilaku toleran dan kemampuan bekerja sama antarumat beragama dan penganut kepercayaan.") !!}
                      <input type="radio" name="indikator[35]" id="" value="0" class="form-group">0
                      <input type="radio" name="indikator[35]" id="" value="1" class="form-group">1
                      <input type="radio" name="indikator[35]" id="" value="2" class="form-group">2
                      <input type="radio" name="indikator[35]" id="" value="3" class="form-group">3
                      <input type="radio" name="indikator[35]" id="" value="4" class="form-group">4
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
                 <td>Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan semangat nasionalisme.</td>
                 <td>
                     {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan semangat nasionalisme.") !!}
                     <input type="radio" name="indikator[36]" id="" value="0" class="form-group">0
                     <input type="radio" name="indikator[36]" id="" value="1" class="form-group">1
                     <input type="radio" name="indikator[36]" id="" value="2" class="form-group">2
                     <input type="radio" name="indikator[36]" id="" value="3" class="form-group">3
                     <input type="radio" name="indikator[36]" id="" value="4" class="form-group">4
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
                 <td>Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan kemandirian peserta didik.</td>
                 <td>
                     {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mengembangkan kegiatan-kegiatan yang menumbuhkan kemandirian peserta didik.") !!}
                     <input type="radio" name="indikator[37]" id="" value="0" class="form-group">0
                     <input type="radio" name="indikator[37]" id="" value="1" class="form-group">1
                     <input type="radio" name="indikator[37]" id="" value="2" class="form-group">2
                     <input type="radio" name="indikator[37]" id="" value="3" class="form-group">3
                     <input type="radio" name="indikator[37]" id="" value="4" class="form-group">4
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
                <td>Sekolah mengembangkan kegiatan dan program yang merepresentasikan semangat gotong royong.</td>
                <td>
                    {!! Form::hidden('penjelasan_assessment[]' , "Sekolah mengembangkan kegiatan dan program yang merepresentasikan semangat gotong royong.") !!}
                    <input type="radio" name="indikator[38]" id="" value="0" class="form-group">0
                    <input type="radio" name="indikator[38]" id="" value="1" class="form-group">1
                    <input type="radio" name="indikator[38]" id="" value="2" class="form-group">2
                    <input type="radio" name="indikator[38]" id="" value="3" class="form-group">3
                    <input type="radio" name="indikator[38]" id="" value="4" class="form-group">4
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
                <td>Sekolah memiliki norma-norma dan peraturan yang baik untuk menumbuhkan nilai-nilai integritas dan kejujuran dalam diri peserta didik.</td>
                <td>
                    {!! Form::hidden('penjelasan_assessment[]' , "Sekolah memiliki norma-norma dan peraturan yang baik untuk menumbuhkan nilai-nilai integritas dan kejujuran dalam diri peserta didik.") !!}
                    <input type="radio" name="indikator[39]" id="" value="0" class="form-group">0
                    <input type="radio" name="indikator[39]" id="" value="1" class="form-group">1
                    <input type="radio" name="indikator[39]" id="" value="2" class="form-group">2
                    <input type="radio" name="indikator[39]" id="" value="3" class="form-group">3
                    <input type="radio" name="indikator[39]" id="" value="4" class="form-group">4
                </td>
            </tbody>
            
        </table>
      </div>
    </div>
  </div>