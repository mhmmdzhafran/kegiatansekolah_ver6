var total_photos_counter = 0;
var value = 0;
var jml = 0;
Dropzone.options.myDropzone = {
    uploadMultiple: true,
    parallelUploads: 2,
    autoProcessQueue: true,
    acceptedFiles: '.pdf, .jpeg, .png, .docx, .xlsx',
    maxFilesize: 2,
    previewTemplate: document.querySelector('#preview').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove file',
    dictFileTooBig: 'Image is larger than 2MB',
    timeout: 10000,
 
    init: function () {
        var nilai = $("#jumlah_upload").attr("value");
        var size = parseInt(nilai);
        myDropzone = this;
        myDropzone.options.parallelUploads = size; //set default
        $(document).on('input', "#jumlah_upload" ,function(){
            value = $(this).val();
            jml = parseInt(value);
            myDropzone.options.parallelUploads = jml;
            if (myDropzone.options.parallelUploads === 0) {
                myDropzone.options.parallelUploads = 2;
            }
        });
        this.on("removedfile", function (file) {
            var id_doc = $("#id_doc").attr("value");
            var date = $("#date").attr("value");
            var file_name = date+"_Dokumentasi-Baru_"+file.name;
            var role = $("#role").attr("value");
            if (role == "Kepala Sekolah") {
                $.post({
                    url: '/kepala-sekolah/mengelola-dokumentasi-kegiatan/'+id_doc+"/"+file_name+"/delete",
                    data: {_token: $('[name="_token"]').val()},
                    dataType: 'json',
                    success: function (data) {
                        total_photos_counter--;
                        if (total_photos_counter < 0) {
                            $("#counter").text("# 0");
                        } else {
                            $("#counter").text("# " + total_photos_counter);   
                        }
                    }
                });
            } else if(role == "Penanggung Jawab Kegiatan") {
                $.post({
                    url: '/penanggung-jawab/dokumentasi-kegiatan/'+id_doc+"/"+file_name+"/delete",
                    data: {_token: $('[name="_token"]').val()},
                    dataType: 'json',
                    success: function (data) {
                        total_photos_counter--;
                        if (total_photos_counter < 0) {
                            $("#counter").text("# 0");
                        } else {
                            $("#counter").text("# " + total_photos_counter);   
                        }
                    }
                });
            }
        });
    },
    success: function (file, done) {
        total_photos_counter++;
        $("#counter").text("# " + total_photos_counter);
    }
};