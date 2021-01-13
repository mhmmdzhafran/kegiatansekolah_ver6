@extends('layouts.template_pj')

@section('title')
    Penanggung Jawab - Notifikasi
@endsection

@section('content')
<h1>Halaman Notifikasi Penanggung Jawab {{ ucwords(Auth::user()->name) }}</h1>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            {{-- animate__animated animate__fadeInDown --}}
            <div class="alert alert-warning py-3 shadow-sm d-none" id="alerts-notify-exist">
                Anda Mendapatkan Notifikasi Baru, Silahkan Klik Refresh Laman Untuk Melihatnya!
                <a class="btn btn-sm btn-success float float-lg-right float-md-right float-sm-right" href="/penanggung-jawab/notifications">Refresh Laman</a>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('userprofile.pj.index')}}" id="profile">Profil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('pj.userprofile.getAllNotify')}}" id="notification">Notifikasi 
                    <span class="badge badge-primary badge-pill" id="badge-counter-notification" data-id="{{$counter_notification}}">
                        {{ $counter_notification }}
                    </span>
                </a>
                </li>
              </ul>
              <div class="card shadow mb-4 mb-2" id="card-profile2">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Notifikasi Anda</h6>
                </div>
                <div class="card-body" style="max-height: 500px; overflow-y: scroll; height: auto">
                    <div class="input-group mb-5">
                        <button class="btn btn-circle btn-info mr-2 d-none" type="button" id="button_back"><i class="fa fa-arrow-circle-left"></i></button>
                        <div class="dropdown mr-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              <button class="dropdown-item dropdown-choice filter_by" type="button" id="Terbaru">Terbaru</button>
                              <button class="dropdown-item dropdown-choice filter_by" type="button" id="Sudah Disetujui">Sudah Disetujui</button>
                              <button class="dropdown-item dropdown-choice filter_by" type="button" id="Pengajuan Ulang">Pengajuan Ulang</button>
                              <button class="dropdown-item dropdown-choice filter_by" type="button" id="Ditolak">Ditolak</button>
                              <button class="dropdown-item dropdown-choice filter_by" type="button" id="Terlama">Terlama</button>
                            </div>
                          </div>
                        <input type="text" class="form-control bg-light border-0 ml-2 small search" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" id="search">
                        <div class="input-group-append">
                          <button class="btn btn-success" type="submit" id="searchNotifications">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                      {{-- status_filter => search --}}
                      <div class="alert alert-primary col-lg-4 col-sm-12 d-none" id="status_filter">
                        <b id="text_search"></b>
                        <a href="#" class="float float-right text-black-50" id="remove_filter">x</a>
                      </div>
                      {{-- status_filter => dropdown --}}
                      <div class="alert alert-primary col-lg-4 col-sm-12 d-none" id="status_filter_2">
                        <b id="text_search_2"></b>
                        <a href="#" class="float float-right text-black-50" id="remove_filter_2">x</a>
                      </div>
                    @include('userprofile.pj.notification')
                </div>
              </div>
        </div>
    </div>
</div> 
@endsection

@section('script')

<script>
     if(isTouchDevice()===false) {
        $('[data-toggle="tooltip"]').tooltip();   
    }
    var url = "";
    var state = "";
    var state_2 = "";
    var page = 1;
    var searchValue = "";
    var text_state_2 = "";
    const button_return = document.getElementById('button_back');
    const getSearchElement = document.getElementById('search');
    const getAlertElement = document.getElementById('status_filter');
    const getSecondAlertElement = document.getElementById('status_filter_2');

    const returnElement = document.getElementById('remove_filter');
    const returnSecondElement = document.getElementById('remove_filter_2');

    const textSearch = document.getElementById('text_search');
    const textSearchTwo = document.getElementById('text_search_2');

    const badgeCounterElementNotificationPage = document.getElementById('badge-counter-notification');

    //add events
    $(document).on('click', '.pagination a',function(event){
        event.preventDefault();
        let myurl = $(this).attr('href');
        page = myurl.split('page=')[1];
        console.log(url);
        if (state  !== "" && state_2 !== "") {
            getDataTwoConditions(page, state, state_2);
        } else {
            getData(page, state);
        }
});
    const searchNotifications = document.getElementById('searchNotifications');
    searchNotifications.addEventListener('click', (e) => {
        state = "search";
        let searchData = document.getElementById('search').value;
        searchValue = searchData;
        if (searchData !== "") {
            if (state_2 !== "") {
                //masuk ke two conditions  
                url = '/penanggung-jawab/filter-notifications-by/'+searchData+'/'+text_state_2;
                window.axios.get(url)
                    .then((response) => {
                        console.log(response.data);
                        // location.hash = url;
                        $("#notification_box").empty().html(response.data);
                        button_return.classList.remove('d-none');
                        getAlertElement.classList.remove('d-none');
                        textSearch.innerText="Pencarian: "+searchData;
                        page = 1;
                    }).catch((responseError) => {
                        console.log(responseError);
                        errorNotifications(responseError.response.status, responseError.response);
                    });
            } else {
                url = '/penanggung-jawab/search-notification/'+searchData+"/search";
                window.axios.get(url)
                .then((response) => {
                    // Swal.close();
                    console.log(response);
                    $("#notification_box").empty().html(response.data);
                    // location.hash = url;
                    console.log(state);
                    button_return.classList.remove('d-none');
                    getAlertElement.classList.remove('d-none');
                    textSearch.innerText="Pencarian: "+searchData;
                    page = 1;
                }).catch((responseError) => {
                    errorNotifications(responseError.response.status, responseError.response);
                });
            }
        } 
    });

    button_return.addEventListener('click', (e) => {
        e.preventDefault();
        init();        
    });

    returnElement.addEventListener('click', (e) => {
        e.preventDefault();
        if (state_2 !== "") {
            filterByInit(text_state_2);
        } else {
            init();
        }
    });

    returnSecondElement.addEventListener('click' , (e) => {
        e.preventDefault();
        if (state !== "") {
            searchInit(searchValue);
        } else {
            init();
        }
    });

    $(document).on('click', '.filter_by', function(e){
        e.preventDefault();
        console.log($(this).attr('id'));
        let choiceFilter = $(this).attr('id');
        let filterName = "";
        if (choiceFilter === "Ditolak") {
            filterName = "Menolak";
        } else {
            filterName = $(this).attr('id');
            
        }
        text_state_2 = filterName;
        if (state !== "") {
            // ke url two conditions
            url = '/penanggung-jawab/filter-notifications-by/'+searchValue+'/'+text_state_2;
            state_2 = $(this).attr('id');
            window.axios.get(url)
                .then((response) => {
                    $("#notification_box").empty().html(response.data);
                    // location.hash = url+"?page="+page;
                    state_2 = $(this).attr('id');
                    getSecondAlertElement.classList.remove('d-none');
                    textSearchTwo.innerText= "Filter: "+filterName;
                    button_return.classList.remove('d-none');
                    page = 1;
                }).catch((responseError) => {
                        errorNotifications(responseError.response.status, responseError.response);
                    });
        } else {               
            url = '/penanggung-jawab/filter-notifications/'+text_state_2;
            window.axios.get(url)
                .then((response) => {
                    // Swal.close();
                    $("#notification_box").empty().html(response.data);
                    // location.hash = url+"?page="+page;
                    state_2 = $(this).attr('id');
                    getSecondAlertElement.classList.remove('d-none');
                    textSearchTwo.innerText = "Filter: "+filterName;
                    button_return.classList.remove('d-none');
                    page = 1;
                }).catch((responseError) => {
                        errorNotifications(responseError.response.status, responseError.response);
                    });  
        }
    });

    $(document).on('click' , '.notificationRead', function(e) {
        e.preventDefault();
        let readState = $(this).attr('id');
        let countNotification = notificationID.length - 1;
        if (countNotification <= 0) {
            countNotification = 0;
        }
        window.axios.put('/penanggung-jawab/mark-as-read/', {
            data: readState,
            page: 'read',
            lastRequest: countNotification
        }).then((response) => {
            if (state !== "") {
                if (state_2 !== "") {
                    //dua state
                    console.log(state+" "+state_2);
                    getDataTwoConditions(page, state, state_2);
                } else {
                    //state2 tidak ada, state satu berisi
                    getData(page, state);
                }
            } else if(state_2 !== "") {
                if (state !== "") {
                    //dua state
                    console.log(state+" "+state_2);
                    getDataTwoConditions(page, state, state_2);
                } else {
                    //state satu tidak ada, state 2 berisi
                    getData(page, state);
                }
            } else {
                //all state
                getData(page , state);
            }

            $.notify({
                message: 'Notifikasi Berhasil Dibaca!',
            }, {
                newest_on_top: true,
                type: 'secondary',
                delay: 100,
                placement: {
                    from: "bottom",
                    align: "center"
                },
                animate: {
                    enter: 'animate__animated animate__fadeInUp',
                    exit: 'animate__animated animate__fadeOutDown'
                },
            });
            const createLinkNotificationElement = document.createElement('a');
            const createStatusNotificationElement = document.createElement('div');
            const createLogoStatusElement = document.createElement('div');
            const createIconStatusElement = document.createElement('i');
            const createSectionNotificationElement = document.createElement('div');
            const createNotificationDetailsElement = document.createElement('div');
            const createSpanFontElement = document.createElement('span');
            if (typeof document.getElementsByClassName('dropdown-item d-flex align-items-center notify-test notification-'+readState)[0] !== "undefined") {
                document.getElementsByClassName('dropdown-item d-flex align-items-center notify-test notification-'+readState)[0].remove();
                let indexNotification = notificationID.indexOf(readState);
                if (indexNotification > -1) {
                    notificationID.splice(indexNotification, 1);   
                }
            }
            unreadNotification-=1;
            if (unreadNotification <= 9) {
                badgeCounterElement.innerText = unreadNotification;    
            } else {
                badgeCounterElement.innerText = "9+";   
            }
            let counterElement = badgeCounterElementNotificationPage.getAttribute('data-id');
            counterElement-=1;
            badgeCounterElementNotificationPage.setAttribute('data-id', counterElement);
            badgeCounterElementNotificationPage.innerText = counterElement;
            if (notificationID.length < 9) {
                // console.log(response.data);
                console.log(response.data.data_notification);
                if (typeof response.data.data_notification !== Boolean && typeof response.data.data_notification === 'object') {
                    const dataNotification = response.data.data_notification;
                    $.each(dataNotification, function(key, value){
                        createLinkNotificationElement.className='dropdown-item d-flex align-items-center notify-test notification-'+value.id;
                        createLinkNotificationElement.setAttribute('id' , value.id);
                        createLinkNotificationElement.setAttribute('href' , value.data.link);
                
                        createStatusNotificationElement.className = 'mr-3';
                        switch (value.data.status_kegiatan_id) {
                            case 1:
                                createLogoStatusElement.className = 'icon-circle bg-success';
                                createIconStatusElement.className= 'fa fa-check text-white';
                                createSpanFontElement.innerText = "Proposal Kegiatan "+value.data.nama_kegiatan+" "+value.data.status_kegiatan+" Oleh Kepala Sekolah";
                                break;
                            case 4:
                                createLogoStatusElement.className = 'icon-circle bg-warning';
                                createIconStatusElement.className= 'fa fa-exclamation text-white';
                                createSpanFontElement.innerText = value.data.type_notification+" "+value.data.nama_kegiatan+" Mohon Mengajukan Ulang Kembali Sesuai Dengan Keterangan Yang Diberikan";
                                break;
                            case 5:
                                createLogoStatusElement.className = 'icon-circle bg-danger';
                                createIconStatusElement.className= 'fa fa-times text-white';
                                createSpanFontElement.innerText = "Proposal Kegiatan "+value.data.nama_kegiatan+" Telah Ditolak Oleh Kepala Sekolah";
                                break;
                            case 6:
                                createLogoStatusElement.className = 'icon-circle bg-success';
                                createIconStatusElement.className= 'fa fa-check text-white';
                                createSpanFontElement.innerText = "Laporan Kegiatan "+value.data.nama_kegiatan+" Sudah Disetujui Oleh Kepala Sekolah";
                                break;
                            default:
                                createLogoStatusElement.className = 'icon-circle bg-secondary';
                                createIconStatusElement.className= 'fa fa-question text-white';
                                createSpanFontElement.innerText = "Undefined Notification";
                                break;
                        }
                        createSectionNotificationElement.className = "notification-details";

                        createNotificationDetailsElement.className = "small text-gray-500";

                        const dateConvert = new Date(value.created_at);
                        dateConvert.setHours(dateConvert.getHours() + 7)

                        let notificationTimestamp = dateConvert.getFullYear()+"-"+transformToFormatTimestamps(dateConvert.getMonth()+1)+"-"+transformToFormatTimestamps(dateConvert.getDate())+" "+transformToFormatTimestamps(dateConvert.getHours())+":"+transformToFormatTimestamps(dateConvert.getMinutes())+":"+transformToFormatTimestamps(dateConvert.getSeconds());
                        
                        createNotificationDetailsElement.innerText = notificationTimestamp;
                        if (value.read_at === null) {
                            createSpanFontElement.className = "font-weight-bold";
                            createSpanFontElement.setAttribute('id' , 'span-class-notification-'+value.id);
                        } 
                        getUserNotificationsElement.appendChild(createLinkNotificationElement);
                        createLinkNotificationElement.appendChild(createStatusNotificationElement);
                        createStatusNotificationElement.appendChild(createLogoStatusElement);
                        createLogoStatusElement.appendChild(createIconStatusElement);
                        createLinkNotificationElement.appendChild(createSectionNotificationElement);
                        createSectionNotificationElement.appendChild(createNotificationDetailsElement);
                        createSectionNotificationElement.appendChild(createSpanFontElement);
                        notificationID.push(value.id);
                    });
                }
            }
        }).catch((responseError) => {
            errorNotifications(responseError.response.status, responseError.response);
        });
    });

    $(document).on('click' , '.notificationLink', function(e) {
        e.preventDefault();
        let readState = $(this).attr('id');
        let linkNotification = $(this).attr('href');
        if (readState !== 'alreadyRead') {
            //fungsi js pj
            markAsReadNotification(readState , linkNotification);
        } else {
            window.location.replace(linkNotification);
        }
    });

    $(document).on('click' , '.deleteNotification', function(e){
        e.preventDefault();
        let dataNotification = $(this).attr('id');
        let countNotification = notificationID.length - 1;
        if (countNotification <= 0) {
            countNotification = 0;
        }
        window.axios.delete('/penanggung-jawab/notification/delete-notifications',{
            params: {
                notificationID: dataNotification,
                lastRequest: countNotification
            }
        }).then((response) =>{
            console.log(response.data);
            if (typeof document.getElementsByClassName('dropdown-item d-flex align-items-center notify-test notification-'+dataNotification)[0] !== "undefined") {
                document.getElementsByClassName('dropdown-item d-flex align-items-center notify-test notification-'+dataNotification)[0].remove();
                let indexNotification = notificationID.indexOf(dataNotification);
                if (indexNotification > -1) {
                    notificationID.splice(indexNotification, 1);   
                }
                unreadNotification-=1;
                if (unreadNotification <= 9) {
                    badgeCounterElement.innerText = unreadNotification;    
                } else {
                    badgeCounterElement.innerText = "9+";   
                }
                let counterElement = badgeCounterElementNotificationPage.getAttribute('data-id');
                counterElement-=1;
                badgeCounterElementNotificationPage.setAttribute('data-id', counterElement);
                badgeCounterElementNotificationPage.innerText = counterElement;
                if (notificationID.length < 9) {
                    // console.log(response.data);
                    console.log(response.data.data_notification);
                    if (typeof response.data.data_notification !== Boolean && typeof response.data.data_notification === 'object') {
                        const dataNotification = response.data.data_notification;
                        $.each(dataNotification, function(key, value){
                            const createLinkNotificationElement = document.createElement('a');
                            const createStatusNotificationElement = document.createElement('div');
                            const createLogoStatusElement = document.createElement('div');
                            const createIconStatusElement = document.createElement('i');
                            const createSectionNotificationElement = document.createElement('div');
                            const createNotificationDetailsElement = document.createElement('div');
                            const createSpanFontElement = document.createElement('span');

                            createLinkNotificationElement.className='dropdown-item d-flex align-items-center notify-test notification-'+value.id;
                            createLinkNotificationElement.setAttribute('id' , value.id);
                            createLinkNotificationElement.setAttribute('href' , value.data.link);
                    
                            createStatusNotificationElement.className = 'mr-3';
                            switch (value.data.status_kegiatan_id) {
                                case 1:
                                    createLogoStatusElement.className = 'icon-circle bg-success';
                                    createIconStatusElement.className= 'fa fa-check text-white';
                                    createSpanFontElement.innerText = "Proposal Kegiatan "+value.data.nama_kegiatan+" "+value.data.status_kegiatan+" Oleh Kepala Sekolah";
                                    break;
                                case 4:
                                    createLogoStatusElement.className = 'icon-circle bg-warning';
                                    createIconStatusElement.className= 'fa fa-exclamation text-white';
                                    createSpanFontElement.innerText = value.data.type_notification+" "+value.data.nama_kegiatan+" Mohon Mengajukan Ulang Kembali Sesuai Dengan Keterangan Yang Diberikan";
                                    break;
                                case 5:
                                    createLogoStatusElement.className = 'icon-circle bg-danger';
                                    createIconStatusElement.className= 'fa fa-times text-white';
                                    createSpanFontElement.innerText = "Proposal Kegiatan "+value.data.nama_kegiatan+" Telah Ditolak Oleh Kepala Sekolah";
                                    break;
                                case 6:
                                    createLogoStatusElement.className = 'icon-circle bg-success';
                                    createIconStatusElement.className= 'fa fa-check text-white';
                                    createSpanFontElement.innerText = "Laporan Kegiatan "+value.data.nama_kegiatan+" Sudah Disetujui Oleh Kepala Sekolah";
                                    break;
                                default:
                                    createLogoStatusElement.className = 'icon-circle bg-secondary';
                                    createIconStatusElement.className= 'fa fa-question text-white';
                                    createSpanFontElement.innerText = "Undefined Notification";
                                    break;
                            }
                            createSectionNotificationElement.className = "notification-details";

                            createNotificationDetailsElement.className = "small text-gray-500";

                            const dateConvert = new Date(value.created_at);
                            dateConvert.setHours(dateConvert.getHours() + 7)

                            let notificationTimestamp = dateConvert.getFullYear()+"-"+transformToFormatTimestamps(dateConvert.getMonth()+1)+"-"+transformToFormatTimestamps(dateConvert.getDate())+" "+transformToFormatTimestamps(dateConvert.getHours())+":"+transformToFormatTimestamps(dateConvert.getMinutes())+":"+transformToFormatTimestamps(dateConvert.getSeconds());
                            
                            createNotificationDetailsElement.innerText = notificationTimestamp;
                            if (value.read_at === null) {
                                createSpanFontElement.className = "font-weight-bold";
                                createSpanFontElement.setAttribute('id' , 'span-class-notification-'+value.id);
                            } 
                            getUserNotificationsElement.appendChild(createLinkNotificationElement);
                            createLinkNotificationElement.appendChild(createStatusNotificationElement);
                            createStatusNotificationElement.appendChild(createLogoStatusElement);
                            createLogoStatusElement.appendChild(createIconStatusElement);
                            createLinkNotificationElement.appendChild(createSectionNotificationElement);
                            createSectionNotificationElement.appendChild(createNotificationDetailsElement);
                            createSectionNotificationElement.appendChild(createSpanFontElement);
                            notificationID.push(value.id);
                        });
                    }
                }
            }
            $.notify({
                message: 'Notifikasi Berhasil Dihapus!',
            }, {
                newest_on_top: true,
                type: 'success',
                delay: 100,
                placement: {
                    from: "bottom",
                    align: "center"
                },
                animate: {
                    enter: 'animate__animated animate__fadeInUp',
                    exit: 'animate__animated animate__fadeOutDown'
                },
            });
            if (state !== "") {
                if (state_2 !== "") {
                    //dua state
                    console.log(state+" "+state_2);
                    getDataTwoConditions(page, state, state_2);
                } else {
                    //state2 tidak ada, state satu berisi
                    getData(page, state);
                }
            } else if(state_2 !== "") {
                if (state !== "") {
                    //dua state
                    console.log(state+" "+state_2);
                    getDataTwoConditions(page, state, state_2);
                } else {
                    //state satu tidak ada, state 2 berisi
                    getData(page, state);
                }
            } else {
                //all state
                getData(page , state);
            }
        }).catch((responseError) => {
            errorNotifications(responseError.response.status, responseError.response);
        });
    });

    function getData(page, state) {
        if (state === "search") {
            window.axios.get(url+"?page=" + page)
            .then((response) => {
                // Swal.close();
                console.log(response.data);
                $("#notification_box").empty().html(response.data);
                // location.hash = url+"?page="+page;
                console.log(state);
                getAlertElement.classList.remove('d-none');
                // button_return.classList.remove('d-none');
            }).catch((responseError) => {
                        errorNotifications(responseError.response.status, responseError.response);
                    });    
         } else if(state_2 !== "terbaru" || state_2 !== "terlama"){
             window.axios.get(url+'?page='+page)
                .then((response) => {
                    console.log(response.data);
                    $("#notification_box").empty().html(response.data);
                }).catch((responseError) => {
                        errorNotifications(responseError.response.status, responseError.response);
                    });
         } else if(state === "" || state_2 === "terbaru" || state_2 === "terlama") {
            window.axios.get("?page="+page)
                .then((response) => {
                    // Swal.close();
                    $("#notification_box").empty().html(response.data);
                    // location.hash = url+"?page="+page;
                    console.log(state);
                    getAlertElement.classList.add('d-none');
                    // button_return.classList.add('d-none');
                }).catch((responseError) => {
                        errorNotifications(responseError.response.status, responseError.response);
                    });
        } 
    }

    function getDataTwoConditions(page, stateOne, stateTwo){
        //logic here
        window.axios.get(url+'?page='+page) 
            .then((response) => {
                console.log(response.data);
                $("#notification_box").empty().html(response.data);
                // location.hash = url+'?page='+page;
            }).catch((responseError) => {
                        errorNotifications(responseError.response.status, responseError.response);
                    });
    }

  

    function init(){
        url = '/penanggung-jawab/notifications';
        window.axios.get(url)
            .then((response) => {
                $("#notification_box").empty().html(response.data);
                button_return.classList.add('d-none');
                state = "";
                state_2 = "";
                getSearchElement.value = "";
                textSearch.innerText = "";
                getAlertElement.classList.add('d-none');
                location.replace(url);
                page = 1;
            }).catch((responseError) => {
                        errorNotifications(responseError.response.status, responseError.response);
                    });
    }

    function filterByInit(option){
        //axios
        url = '/penanggung-jawab/filter-notifications/'+text_state_2;
        window.axios.get(url)
            .then((response) => {                
                $("#notification_box").empty().html(response.data);
                getAlertElement.classList.add('d-none');
                textSearch.innerText="";
                state = "";
                page = 1;
            }).catch((responseError) => {
                        errorNotifications(responseError.response.status, responseError.response);
                    });
    }

    function searchInit(searchData) {
        //axios
        url = '/penanggung-jawab/search-notification/'+searchValue+"/search";
        window.axios.get(url)
            .then((response) => {
                $("#notification_box").empty().html(response.data);
                getSecondAlertElement.classList.add('d-none');
                textSearchTwo.innerText="";
                state_2 = "";
                page = 1;
            }).catch((responseError) => {
                errorNotifications(responseError.response.status, responseError.response);
            });
    }

    function errorNotifications(status, errorMessages){
        let {data: {message}} = errorMessages;
        if (status === 401) {
            Swal.fire({
                icon: 'info',
                title: message
            }).then((result) => {
                window.location.replace('/');
            }); 
        } else if(status === 404){
            Swal.fire({
                icon: 'error',
                title: 'Data Tidak Dapat Ditemukan',
                text: message
            }).then((result) => {
                location.reload(true);
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Terdapat Error Ketika Mengambil Data, Jika Masalah Masih Ada, Kontak Admin! System Error: ',
                text: message
            }).then((result) => {
                location.reload(true);
            });
        }
    }

</script>  
@endsection