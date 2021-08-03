<script>
    /*
        Nama: Muhammad Zhafran Auristianto
        Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
    */
    let indikator_asesmen = "";
    $(".lihat_form").on('click', function(){
            $("#form_indikator")[0].reset();
            indikator_asesmen = $(this).attr('value');
            let id_asesmen = $(this).attr('data-target');
            let url_dokumen = "{{route('kepsek.asesmen.ambilDetail', ['id_asesmen' => 'ids', 'id' => 'id_indikator'])}}";
            url_dokumen = url_dokumen.replace('ids', id_asesmen);
            url_dokumen = url_dokumen.replace('id_indikator', indikator_asesmen);
            $.ajax({
                url: url_dokumen,
                type: 'GET',
                dataType: 'JSON',
                cache: false,
                beforeSend: function(){
                    $("#lihat-dokumen").empty();
                    // $(".keterangan_skor").empty();
                    $("#checkbox-keterangan-indikator").empty();
                    $("#penjelasan_assessment").val();
                    $("#show_penjelasan").empty();
                    $("#information-asesment").empty();
                    $("#information-asesment").addClass('d-none');
                    $("#show-score").empty();
                    loading_bar(true);
                },
                success: function(result){
                    console.log(result);
                    loading_bar(false);
                    // let counter_penjelasan_skor = 0;
                    $("#modalForm").modal();
                    let url = '{{route("kepsek.asesmen.update", "id")}}';
                    url = url.replace('id' , id_asesmen );
                    $("#indikator_assessment").val(indikator_asesmen);
                    $("#form_indikator").attr('action' , url); 
                    $(".lihat-dokumen").empty();
                    if (result.data.length >= 1) {
                        $(".lihat-dokumen").append('<b>Histori Dokumen Asesmen</b>');
                        $.each(result.data, function(key, value){
                            // let assets = "{{ asset('kegiatan/asesmen_internal/asset_dokumen')}}";
                            let assets = "{{ asset('storage/asesmen_internal/asset_dokumen')}}";
                            assets = assets.replace('asset_dokumen', value.nama_dokumen_asesmen);
                            $(".lihat-dokumen").append('<li class="mb-2"><i class="fas fa-file-alt mr-2"></i>'+value.nama_dokumen_asesmen+'<button class="btn btn-primary btn-sm ml-2 lihat_file" value="'+assets+'"type="button">Lihat File</button><a href="'+assets+'" class="btn btn-sm btn-info ml-2" download="'+value.nama_dokumen_asesmen+'">Download File</a><button type="button" class="btn btn-warning btn-sm ml-2 edit_file" value="'+id_asesmen+'" data-target="'+value.nama_dokumen_asesmen+'" data-target2="'+indikator_asesmen+'">Ubah File</button><button class="btn btn-danger btn-sm ml-2 delete_file" value="'+value.nama_dokumen_asesmen+'" data-target="'+indikator_asesmen+'" data-target2="'+id_asesmen+'"type="button">Hapus File</button></li>');
                            $(".lihat-dokumen").append('<input type="hidden" name="nama_dokumen_asesmen[]" value="'+value.nama_dokumen_asesmen+'">');
                        });   
                    }
                    else if(result.data.length === 0){
                        $(".lihat-dokumen").append('<b class="text-center font-weight-bolder">Belum Mengunggah Dokumen</b>');
                    }
                    $("#penjelasan_assessment").val(result.data_penjelasan_asesmen.penjelasan_asesmen);
                    $("#show_penjelasan").append(result.data_penjelasan_asesmen.penjelasan_asesmen);
                    let penjelasan_skor_asesmen = result.penjelasan_skor;
                    let dataSkor = result.skor_asesmen;
                    for (let index = 0; index < penjelasan_skor_asesmen.length; index++) {
                        const element = penjelasan_skor_asesmen[index];
                        $("#checkbox-keterangan-indikator").append('<input type="radio" name="indikator" id="indikator" value="'+index+'" class="form-group mr-2 mb-2 indikator_penjelasan">'+element.keterangan_skor+'<br>');
                    }
                    if (result.histori_asesmen === "") {
                        //tambahin keterangan belom melakukan asesmen
                        $("#show-score").removeClass('alert-success');
                        $("#show-score").addClass('alert-info');
                        $("#show-score").append('<b class="text-center font-weight-bolder">Belum Melakukan Asesmen</b>');
                    } else {
                        $("#show-score").removeClass('alert-info');
                        $("#show-score").addClass('alert-success');
                        $("#information-asesment").append('*Jika Ingin Menambah Dokumen Asesmen PPK / Mengubah Nilai Asesmen PPK, Isi bagian yang diperlukan!');
                        $("#information-asesment").removeClass('d-none');
                        if (typeof dataSkor !== 'undefined') {
                            $("#show-score").append(`<b>Histori Asesmen</b><ul><li>Skor Asesmen: ${dataSkor}</li><input type="hidden" id="previous-score_asesmen" value="${dataSkor}"></ul>`);
                            $(".indikator_penjelasan[value='"+dataSkor+"']").prop('checked', true)
                        }
                    }
                },
                error: function(error){
                    loading_bar(false);
                    if (error.status === 404) {
                        let errors = JSON.parse(error.responseText);
                        alertNotificationErrorAndLogin(error.status, errors.messages);
                    }
                    else if (error.status === 401){
                        let errors = JSON.parse(error.responseText);
                        alertNotificationErrorAndLogin(error.status, errors.message);
                    }
                    else{
                        anyErrors(error.status , error.statusText , error);
                    }
                }
            });
               
        });
    // $(document).ready(function(){
    $("form").on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('[name = "_token"]').val()
            }
          });
        var formHas = $(this).attr("id").search('form_indikator');
        if (formHas === 0) {
        //   var value_indikator = $(this).attr('data-form');        
          var url = '{{route("kepsek.asesmen.update", "id")}}';
          var id_assessmen = $("#id_assessmen").attr('value');
          var formData = new FormData($(this)[0]);
          url = url.replace('id' , id_assessmen );          
          $.ajax({
              url: url,
              type: 'POST',
              data:  formData,  
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function(){
                $(".submit_form").attr('disabled', true);
                $(".close_modal").attr('disabled', true);
                $("#error_indikator").empty();
                $("#error_indikator").addClass('d-none');
                progressBar('show');
              },
              xhr: function(){
                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener("progress",  function(event){
                    if (event.lengthComputable) {
                        var percentageComplete = event.loaded / event.total;
                        percentageComplete = parseInt(percentageComplete * 100);
                        $('.myprogress').text(percentageComplete + '%');
                        $('.myprogress').css('width', percentageComplete + '%');
                    }
                },false);
                return xhr;
              },
              success: function(result){
                progressBar('hide');
                $(".submit_form").attr('disabled', false);
                $(".close_modal").attr('disabled', false);
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses Melakukan Asesmen'
                }).then((result)=>{
                    $("#modalForm"+indikator_asesmen).modal('hide');
                    location.reload(true);
                });
              },
              error: function(result){
                progressBar('hide');
                $(".submit_form").attr('disabled', false);
                $(".close_modal").attr('disabled', false);
                $("#error_indikator").removeClass('d-none');
                if (result.status === 404) {
                    let error_not_found = JSON.parse(result.responseText);
                    alertNotificationErrorAndLogin(result.status , error_not_found.messages);
                } else if(result.status === 401){
                    let loginInfo = JSON.parse(result.responseText);
                    alertNotificationErrorAndLogin(result.status , loginInfo.message);
                } else if(result.status === 422){
                    let value_error = JSON.parse(result.responseText);
                    $.each(value_error.errors, function(key, value){
                        $("#error_indikator").append('<li class="mb-2">'+value+'</li>');
                    });   
                    Swal.fire({
                        icon: 'error',
                        title: 'Terdapat Error',
                        text : 'Terdapat Error ketika Mengunggah Form, Silahkan Cek Error Diatas Form'
                    }).then((result)=>{
                        $("#modalForm"+indikator_asesmen).scrollTop(0);
                    });
                } else {
                    anyErrors(result.status, result.statusText, result);
                }
              }
          });   
        } else{
            var url_form = $(this).attr('action');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: url_form,
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(){
                    $("#close_btn").attr('disabled', true);
                    $("#submit_dokumen").attr('disabled', true);                    
                    $("#kurang_indikator_asesmen_dokumen").empty();
                    $("#kurang_indikator_asesmen_dokumen").addClass('d-none');
                    progressBar('show');
                },
                xhr: function(){
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress' , function(e){
                        if (e.lengthComputable) {
                            var percentage = e.loaded / e.total;
                            percentage = parseInt(percentage * 100);
                            $('.myprogress').text(percentage + '%');
                            $('.myprogress').css('width', percentage + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(res){
                    $("#close_btn").attr('disabled', false);
                    $("#submit_dokumen").attr('disabled', false);
                    progressBar('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses Mengubah Dokumen! Harap tunggu sistem melakukan refresh',
                        timer: 1000,
                        timerProgressBar: true,                        
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        showConfirmButton: false,
                        onClose: ()=>{
                            Swal.close();
                            location.reload(true);    
                        }
                    }).then((result)=>{
                        Swal.close();
                        location.reload(true);
                    });
                },
                error: function(res){
                    progressBar('hide');
                    $("#close_btn").attr('disabled', false);
                    $("#submit_dokumen").attr('disabled', false);
                    $("#kurang_indikator_asesmen_dokumen").removeClass('d-none');
                    if (res.status === 401) {
                        let loginInfo = JSON.parse(res.responseText);
                        alertNotificationErrorAndLogin(res.status, loginInfo.message);
                    } else if(res.status === 404){
                        let error_value = JSON.parse(res.responseText);
                        alertNotificationErrorAndLogin(res.status , error_value.messages);
                    } else if(res.status === 422){
                        let value_error = $.parseJSON(res.responseText);
                        $.each(value_error.errors, function(key, value){
                            $("#kurang_indikator_asesmen_dokumen").append('<li class="mb-2">'+value+'</li>');
                        }); 
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terdapat Error ketika menyimpan Dokumen Asesmen, Silahkan lihat error diatas form'
                        }).then((result)=>{
                            $("#edit_file").scrollTop(0);
                        });  
                    } else {
                        anyErrors(res.status , res.statusText , res);
                    }
                }
            });
        }
    });
    // submit pergantian informasi
            $('#edit').on('click', function(){
                $("#kurang_indikator").empty();
                $("#kurang_indikator").addClass('d-none');
                $("#sukses_indikator").empty();
                $('#edit_informasi').modal();
            });
               
            $(".submit").on('click', function(e){
                e.preventDefault();
                var url = '{{route("kepsek.asesmen.update_informasi", "id")}}';
                var ids = $("#id_assessmen").attr('value');
                url = url.replace("id", ids);
                var form_url = $("#pergantian_informasi").attr("action", url);
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN' : $('[name = "_token"]').val()
                    }
                });
                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: $("#pergantian_informasi").serialize(),
                    beforeSend: function(){
                        loading_bar(true);
                        $(".submit").attr('disabled', true);
                        $("#kurang_indikator").empty();
                        $("#kurang_indikator").addClass('d-none');
                    },
                    success: function(result){
                        loading_bar(false);
                        $(".submit").attr('disabled', false);
                        $("#edit_informasi").modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: 'Berhasil Mengubah Informasi Assessmen!'
                        }).then((result)=>{
                            location.reload(true);
                        });
                    },
                    error: function(result){
                        loading_bar(false);
                        $("#kurang_indikator").removeClass('d-none');
                        $(".submit").attr('disabled', false);
                        if (result.status === 401) {
                            let loginInfo = JSON.parse(result.responseText);
                            alertNotificationErrorAndLogin(result.status , loginInfo.message);
                        } else if(result.status === 422) {
                            let error_informasi = $.parseJSON(result.responseText);   
                            $.each(error_informasi.errors, function(key, value){
                                $("#kurang_indikator").append('<li>'+value+'</li>');
                            }); 
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terdapat Error ketika melakukan Pengubahan data Informasi Asesmen, Silahkan Cek Error diatas Form!'
                            }).then((result)=>{
                                $("#pergantian_informasi").scrollTop(0);
                            });  
                        } else if(result.status === 404){
                            let error_not_found = JSON.parse(result.responseText);
                            alertNotificationErrorAndLogin(result.status , error_not_found.messages);
                        } else {
                            anyErrors(result.status , result.statusText , result);
                        }
                    }
                });
            });

            $("#modalForm").on('hidden.bs.modal', function(){
                $("#error_indikator").empty();
                $("#error_indikator").addClass('d-none');
            });
    
            $(document).on('click', '.lihat_file', function(){
                    var value = $(this).attr('value');
                    // var docx = value.search('.docx');
                    // var xlsx = value.search('.xlsx');
                    // if (docx !== -1 || xlsx !== -1) {
                    //     window.open(value);
                    // } else {
                        window.open(value);
                        // $('#myModal').modal();
                        // $('#myModal iframe').attr({src: value});
                    // }
                });
            
            $(document).on('click', '.edit_file', function(){
                var file_name = $(this).attr('data-target');
                var body_indikator = $(this).attr('data-target2');
                var id_asesmen_dokumen = $(this).attr('value');
                var url_ubah = '{{route("kepsek.asesmen.updateDoc", ["file_name" => "file","id_indikator" => "body_indikator", "id_asesmen" => "id_asesmen_table"])}}';
                url_ubah = url_ubah.replace("file" , file_name);
                url_ubah = url_ubah.replace("body_indikator", body_indikator);
                url_ubah = url_ubah.replace("id_asesmen_table" , id_asesmen_dokumen);
                var asset_dokumen_lama = '{{asset("storage/asesmen_internal/docs")}}';
                asset_dokumen_lama = asset_dokumen_lama.replace('docs' , file_name);
                $("#ubah_dokumen_asesmen").attr('action', url_ubah);
                $("#modalForm").modal('hide');
                $(".lihat_dokumen").append('<i class="fas fa-file-alt"></i><b class="ml-2">'+file_name+'</b><button class="btn btn-primary btn-sm ml-2 lihat_file" value="'+asset_dokumen_lama+'"type="button">Lihat File</button><a href="'+asset_dokumen_lama+'" class="btn btn-info btn-sm ml-2" download="'+file_name+'">Download File</a>');
                $("#edit_file").css({
                    'overflow-y' : 'auto'
                });
                $("#edit_file").modal();
            });

            $("#edit_file").on('hidden.bs.modal' , function(){
                $(".lihat_dokumen").empty();
                $("#kurang_indikator_asesmen_dokumen").empty();
                $("#kurang_indikator_asesmen_dokumen").addClass('d-none');
                $("#modalForm").modal();
            });

        // });
    function progressBar(condition){
        if (condition === 'show') {
            $(".progress").attr('hidden' , false);
            $('.myprogress').text('0%');
            $('.myprogress').css('width', '0%');
        } else if(condition === 'hide'){
            $(".progress").attr('hidden' , true);
            $(".myprogress").text('0%')
            $(".myprogress").css('width' , '0%');
        }
    }

    function alertNotificationErrorAndLogin(reqStatus, status){
        if (reqStatus === 401) {
            Swal.fire({
                icon: 'info',
                title: 'Please Login',
                text: status
            }).then((result)=>{
                window.location.replace('/');
            });
        } else if(reqStatus === 404){
            Swal.fire({
                icon: 'error',
                title: 'Terdapat Error',
                text: status
            });
        }
    }
    
    function anyErrors(status, statusText , errors){
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'System Error Code: '+status+': '+statusText
        });
        console.log(errors);
    }

</script>

<script>
    var document_row=1; 
    var indikator_body = "";
      $(".add_file").click(function(){
          var value = $(this).attr('value');
          document_row++;
          $('#upload-file_indikator_asesmen').append('<input type="file" name="file[]" id="row'+document_row+'" placeholder="Enter your Name" class = "mb-2" /><button type="button" name="remove" id="'+document_row+'" class="btn btn-sm btn-danger btn_remove">X</button>');          
      })
          $(document).on('click', '.btn_remove', function(){  
              var button_id = $(this).attr("id");   
              $('#'+button_id+'').remove();  
              $('#row'+button_id).remove();
              document_row--;
              if (document_row <= 0) {
                  document_row = 1;
              }
          });

          $(document).on('click' , '.delete_file', function(){
              let value_file = $(this).attr('value');
              indikator_body = $(this).attr('data-target');
              let id_asesmen = $(this).attr('data-target2');
              $("#error_indikator").empty();
              $(".dokumen-asesmen").empty();
              var url_delete_file = '{{route("kepsek.asesmen.destroy" , ["file_name" => "file" , "id_indikator" => "id_indikator_asesmen", "id_asesmen" => "asesmen_id"])}}';
              let asset_dokumen_lama = '{{asset("storage/asesmen_internal/docs")}}';
              asset_dokumen_lama = asset_dokumen_lama.replace('docs' , value_file);
              $(".dokumen-asesmen").append('<i class="fas fa-file-alt"></i><b class="ml-2">'+value_file+'</b><button class="btn btn-primary btn-sm ml-2 lihat_file" value="'+asset_dokumen_lama+'"type="button">Lihat File</button><a href="'+asset_dokumen_lama+'" class="btn btn-info btn-sm ml-2" download="'+value_file+'">Download File</a>');
              url_delete_file = url_delete_file.replace('file' , value_file);
              url_delete_file = url_delete_file.replace('id_indikator_asesmen' , indikator_body);
              url_delete_file = url_delete_file.replace('asesmen_id', id_asesmen);    
              $("#delete_dokumen").attr('action', url_delete_file);              
              $("#modalForm").modal('hide');
              $("#modalConfirmationDelete").modal();
          });

          $("#modalConfirmationDelete").on('hidden.bs.modal', function(){
            $("#modalForm").modal('show');
          });

          $(".submit_delete").on('click', function(e){
              e.preventDefault();
              var indikator_body = $(".delete_file").attr('data-target');
              var url_delete = $("#delete_dokumen").attr('action');
              $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN' : $('[name = "_token"]').val()
                    }
                });
              $.ajax({
                  url: url_delete,
                  method: 'POST',
                  beforeSend: function() {
                    loading_bar(true);
                    $(".submit_delete").attr('disabled', true);
                  },
                  success: function(result){
                    loading_bar(true);
                    $(".submit_delete").attr('disabled', false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses Menghapus Dokumen Asesmen',
                        timer: 1000,
                        timerProgressBar: true,                        
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        showConfirmButton: false,
                        onClose: ()=>{
                            Swal.close();
                            location.reload(true);    
                        }
                    }).then((result)=>{
                        Swal.close();
                        location.reload(true);
                    });
                  },
                  error: function(result){
                    $(".submit_delete").attr('disabled', false);
                    loading_bar(true);
                    if (result.status === 401) {
                        let infoLogin = JSON.parse(result.responseText);
                        alertNotificationErrorAndLogin(result.status, infoLogin.message);
                    } else if(result.status === 422) {
                        let result_error = $.parseJSON(result.responseText);                    
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: $.each(result_error.errors, function(key,value){
                                value;
                            })
                        }).then((result)=>{
                            $("#modalConfirmationDelete").modal('hide');
                            $("#modalForm"+indikator_body).modal();
                        });
                    } else if(result.status === 404){
                        let notFoundError = JSON.parse(result.responseText);
                        alertNotificationErrorAndLogin(result.status , notFoundError.messages);
                    } else {
                        anyErrors(result.status, result.statusText , result);
                    }
                  }
              });
          });   
    function loading_bar(condition){
        if (condition) {
            $(".close_modal").attr('disabled', true);
            Swal.fire({
                title: 'Sedang Memproses',
                html: '<div class="spinner-border" role="status" style="margin:25%"><span class="sr-only"></span></div>',    
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: false
            });
        } else {
            $(".close_modal").attr('disabled', false);
            Swal.close();
    }
}
</script>