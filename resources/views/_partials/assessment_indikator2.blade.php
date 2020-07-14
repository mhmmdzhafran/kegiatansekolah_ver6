<div class="card shadow-sm">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <a href="#" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">
            @php
                $str = strtolower('SOSIALISASI PPK KEPADA PARA PEMANGKU KEPENTINGAN PENDIDIKAN');
            @endphp
            2. {{ ucwords($str) }}
        </a>
      </h5>
    </div>
    <div id="collapse" class="collapse" aria-labelledby="heading" data-parent="#accordion">
      <div class="card-body">
          <table class="table table-borderless">
              <thead>
                 <th class="text-center">No</th>
                 <th class="text-center">Penjelasan Assessment</th>
                 <th class="text-center">Skor</th>
              </thead>
              <tbody>
                  <td class="text-center">1</td>
                  <td class="text-center">Sekolah melakukan sosialisasi PPK kepada para pemangku kepentingan pendidikan (pejabat struktural, guru, Komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).</td>
                  <td>
                      {!! Form::hidden('penjelasan_assessment[]', "Sekolah melakukan sosialisasi PPK kepada para pemangku kepentingan pendidikan (pejabat struktural, guru, Komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).") !!}
                      <input type="radio" name="indikator[5]" id="" value="0" class="form-group">0
                      <input type="radio" name="indikator[5]" id="" value="1" class="form-group">1
                      <input type="radio" name="indikator[5]" id="" value="2" class="form-group">2
                      <input type="radio" name="indikator[5]" id="" value="3" class="form-group">3
                      <input type="radio" name="indikator[5]" id="" value="4" class="form-group">4
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
                 <td class="text-center">Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan semua pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya).</td>
                 <td>
                     {!! Form::hidden("penjelasan_assessment[]", "Perumusan prioritas nilai-nilai utama PPK di sekolah melibatkan semua pemangku kepentingan pendidikan (pejabat struktural, guru, komite sekolah, orang tua/wali siswa, siswa, DU/DI, lembaga swadaya masyarakat yang relevan, dan masyarakat lainnya)." ) !!}
                     <input type="radio" name="indikator[6]" id="" value="0" class="form-group">0
                     <input type="radio" name="indikator[6]" id="" value="1" class="form-group">1
                     <input type="radio" name="indikator[6]" id="" value="2" class="form-group">2
                     <input type="radio" name="indikator[6]" id="" value="3" class="form-group">3
                     <input type="radio" name="indikator[6]" id="" value="4" class="form-group">4
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
                 <td class="text-center">Sekolah menentukan nilai-nilai khas sesuai dengan latar belakang sosial budaya setempat (gotong royong, agamis, seni, agraris, dan sejenisnya).</td>
                 <td>
                     {!! Form::hidden('penjelasan_assessment[]', "Sekolah menentukan nilai-nilai khas sesuai dengan latar belakang sosial budaya setempat (gotong royong, agamis, seni, agraris, dan sejenisnya).") !!}
                     <input type="radio" name="indikator[7]" id="" value="0" class="form-group">0
                     <input type="radio" name="indikator[7]" id="" value="1" class="form-group">1
                     <input type="radio" name="indikator[7]" id="" value="2" class="form-group">2
                     <input type="radio" name="indikator[7]" id="" value="3" class="form-group">3
                     <input type="radio" name="indikator[7]" id="" value="4" class="form-group">4
                 </td>
             </tbody>
             
         </table>
      </div>
    </div>
  </div>