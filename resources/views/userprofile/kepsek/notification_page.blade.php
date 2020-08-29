@extends('layouts.template_kepsek')

@section('title')
    Kepala Sekolah - Notifikasi
@endsection

@section('content')
<h1>Halaman Notifikasi Kepala Sekolah {{ ucwords(Auth::user()->name) }}</h1>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            {{-- animate__animated animate__fadeInDown --}}
            <div class="alert alert-warning py-3 shadow-sm d-none" id="alerts-notify-exist">
                Anda Mendapatkan Notifikasi Baru, Silahkan Klik Refresh Laman Untuk Melihatnya!
                <a class="btn btn-sm btn-success float float-lg-right float-md-right float-sm-right" href="/kepala-sekolah/notifications">Refresh Laman</a>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="/kepala-sekolah/user-profile" id="profile">Profil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="/kepala-sekolah/notifications" id="notification">Notifikasi 
                    <span class="badge badge-primary badge-pill" id="badge-counter-notification">
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
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              <button class="dropdown-item dropdown-choice filter_by" type="button" id="terbaru">Terbaru</button>
                              <button class="dropdown-item dropdown-choice filter_by" type="button" id="belum_disetujui">Belum Disetujui</button>
                              <button class="dropdown-item dropdown-choice filter_by" type="button" id="sudah_unggah_dokumentasi">Sudah Mengunggah Dokumentasi</button>
                              <button class="dropdown-item dropdown-choice filter_by" type="button" id="terlama">Terlama</button>
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
                    @include('userprofile.kepsek.notification')
                </div>
              </div>
        </div>
    </div>
</div> 
@endsection

@section('script')

<script>
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
                url = '/kepala-sekolah/filter-two/notifications/'+searchData+'/'+text_state_2;
                window.axios.get(url)
                    .then((response) => {
                        console.log(response.data);
                        location.hash = url;
                        $("#notification_box").empty().html(response.data);
                        button_return.classList.remove('d-none');
                        getAlertElement.classList.remove('d-none');
                        textSearch.innerText="Pencarian: "+searchData;
                        page = 1;
                    });
            } else {
                url = '/kepala-sekolah/search-notification/'+searchData;
                window.axios.get(url)
                .then((response) => {
                    // Swal.close();
                    console.log(response);
                    $("#notification_box").empty().html(response.data);
                    location.hash = url;
                    console.log(state);
                    button_return.classList.remove('d-none');
                    getAlertElement.classList.remove('d-none');
                    textSearch.innerText="Pencarian: "+searchData;
                    page = 1;
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
        let choiceFilter = $(this).attr('id');
        let filterBy = "";
        if (choiceFilter === "belum_disetujui") {
                filterBy = "belum disetujui";
                text_state_2 = "Belum Disetujui";
        } else if(choiceFilter === "sudah_unggah_dokumentasi"){
                filterBy = "sudah mengunggah dokumentasi";
                text_state_2 = "Sudah Mengunggah Dokumentasi";
        } else if(choiceFilter === "terlama"){
                filterBy = "terlama";
                text_state_2 = "Terlama";
        } else if(choiceFilter === "terbaru"){
                filterBy = "terbaru";
                text_state_2 = "Terbaru";
        }
        if (state !== "") {
            // ke url two conditions
            url = '/kepala-sekolah/filter-two/notifications/'+searchValue+'/'+filterBy;
            state_2 = $(this).attr('id');
            window.axios.get(url)
                .then((response) => {
                    $("#notification_box").empty().html(response.data);
                    location.hash = url+"?page="+page;
                    state_2 = $(this).attr('id');
                    getSecondAlertElement.classList.remove('d-none');
                    textSearchTwo.innerText= text_state_2;
                    button_return.classList.remove('d-none');
                    page = 1;
                });
        } else {               
            url = '/kepala-sekolah/filter-notifications/'+filterBy;
            window.axios.get(url)
                .then((response) => {
                    // Swal.close();
                    $("#notification_box").empty().html(response.data);
                    location.hash = url+"?page="+page;
                    state_2 = $(this).attr('id');
                    getSecondAlertElement.classList.remove('d-none');
                    textSearchTwo.innerText = text_state_2;
                    button_return.classList.remove('d-none');
                    page = 1;
                });   
        }
    });

    $(document).on('click' , '.notificationRead', function(e) {
        e.preventDefault();
        let readState = $(this).attr('id');
        window.axios.put('/kepala-sekolah/read-notification/', {
                data: readState
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
                // $(".notification-items").empty();
                // initializeNotifications("refresh");
                if (document.getElementById('span-class-notification-'+readState) !== null) {                    
                    let spanClassNotificationDropdown = document.getElementById('span-class-notification-'+readState);
                    if (spanClassNotificationDropdown.classList.contains('font-weight-bold')) {
                        spanClassNotificationDropdown.classList.remove('font-weight-bold');   
                    }
                }
            });
        
    });

    $(document).on('click' , '.notificationLink', function(e) {
        e.preventDefault();
        let readState = $(this).attr('id');
        let linkNotification = $(this).attr('href');
        if (readState !== 'alreadyRead') {
            //fungsi js kepsek
            markAsReadNotification(readState , linkNotification);
        } else {
            location.replace(linkNotification);
        }
    });

    function getData(page, state) {
        if (state === "search") {
            window.axios.get(url+"?page=" + page)
            .then((response) => {
                // Swal.close();
                console.log(response.data);
                $("#notification_box").empty().html(response.data);
                location.hash = url+"?page="+page;
                console.log(state);
                getAlertElement.classList.remove('d-none');
                // button_return.classList.remove('d-none');
            });    
         } else if (state_2 === "terlama") {
            window.axios.get(url+'?page= '+page)
            .then((response) => {
                // Swal.close();
                console.log(response.data);
                location.hash = url+"?page="+page;
                $("#notification_box").empty().html(response.data);
            });
        } else if(state_2 === "belum_disetujui") {
            window.axios.get(url+'?page='+page)
                .then((response) => {
                    console.log(response.data);
                    $("#notification_box").empty().html(response.data);
                    location.hash = url+"?page="+page;
                });
        } else if(state_2 === "sudah_unggah_dokumentasi") {
            window.axios.get(url+'?page='+page)
                .then((response) => {
                    console.log(response.data);
                    $("#notification_box").empty().html(response.data);
                    location.hash = url+"?page="+page;
                });
        } else if(state === "" || state_2 === "terbaru") {
            window.axios.get("?page="+page)
                .then((response) => {
                    // Swal.close();
                    $("#notification_box").empty().html(response.data);
                    location.hash = url+"?page="+page;
                    console.log(state);
                    getAlertElement.classList.add('d-none');
                    // button_return.classList.add('d-none');
                });
        }
    }

    function getDataTwoConditions(page, stateOne, stateTwo){
        //logic here
        window.axios.get(url+'?page='+page) 
            .then((response) => {
                console.log(response.data);
                $("#notification_box").empty().html(response.data);
                location.hash = url+'?page='+page;
            });
    }

  

    function init(){
        url = '/kepala-sekolah/notifications';
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
            });
    }

    function filterByInit(option){
        //axios
        url = '/kepala-sekolah/filter-notifications/'+text_state_2;
        window.axios.get(url)
            .then((response) => {                
                $("#notification_box").empty().html(response.data);
                getAlertElement.classList.add('d-none');
                textSearch.innerText="";
                state = "";
                page = 1;
            });
    }

    function searchInit(searchData) {
        //axios
        url = '/kepala-sekolah/search-notification/'+searchValue;
        window.axios.get(url)
            .then((response) => {
                $("#notification_box").empty().html(response.data);
                getSecondAlertElement.classList.add('d-none');
                textSearchTwo.innerText="";
                state_2 = "";
                page = 1;
            });
    }

</script>  
@endsection