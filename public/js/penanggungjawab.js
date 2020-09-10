const userID = document.querySelector('meta[name="user-authorization"]').getAttribute('content');
const getUserNotificationsElement = document.querySelector('.notification-items');
let badgeCounterElement = document.querySelector('.badge-counter');
let notificationID = [];
let unreadNotification = 0;

Echo.private('App.User.'+userID)
    .notification((notification) => {
        unreadNotification+=1;
        console.log(notificationID);
        console.log(notification);
        
        if (notificationID.length >= 9) {
            if (unreadNotification > 9) {
                badgeCounterElement.innerText = "9+";    
            } else {
                badgeCounterElement.innerText = unreadNotification; 
            }
            //bugs => read google docs
            let getLastNotification = notificationID[notificationID.length-1];
            console.log(getLastNotification);
            
            if (typeof document.getElementsByClassName('dropdown-item d-flex align-items-center notify-test notification-'+getLastNotification)[0] !== "undefined") {
                console.log(document.getElementsByClassName('dropdown-item d-flex align-items-center notify-test notification-'+getLastNotification)[0]);
                document.getElementsByClassName('dropdown-item d-flex align-items-center notify-test notification-'+getLastNotification)[0].remove();
                notificationID.pop();
                console.log(notificationID);
            }
            
        } else if(notificationID.length < 9) {
            if (unreadNotification > 9) {
                badgeCounterElement.innerText = "9+";    
            } else {
                badgeCounterElement.innerText = unreadNotification; 
            }
        }
        
        const createLinkElement = document.createElement('a');

        const createStatusPartition = document.createElement('div');
        const createCircleStatusElement = document.createElement('div');
        const createIconElement = document.createElement('i');
    
        const createDivNotificationDetailsElement = document.createElement('div');
        const createDivDetailsElement = document.createElement('div');
        const createSpanExtraDetailsElement = document.createElement('span');

        createLinkElement.className='dropdown-item d-flex align-items-center notify-test notification-'+notification.id;
        createLinkElement.setAttribute('id' , notification.id);
        createLinkElement.setAttribute('href' , notification.link);

        createStatusPartition.className = 'mr-3';
        switch (notification.status_kegiatan_id) {
            case 1:
                createCircleStatusElement.className = 'icon-circle bg-success';
                createIconElement.className= 'fa fa-check text-white';
                createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+notification.nama_kegiatan+" "+notification.status_kegiatan+" Oleh Kepala Sekolah";
                $.notify({
                    title: "Ada Notifikasi Baru <hr>",
                    message: "Ada Notifikasi Baru terkait Proposal Kegiatan: "+notification.nama_kegiatan
                }, {
                    type: 'success',
                    newest_on_top: true,
                    offset: {
                        x: 20,
                        y: 60
                    },
                    delay: 100,
                    animate: {
                        enter: 'animate__animated animate__fadeInRight',
                        exit: 'animate__animated animate__fadeOutRight'
                    },
                });
                break;
            case 4:
                createCircleStatusElement.className = 'icon-circle bg-warning';
                createIconElement.className= 'fa fa-exclamation text-white';
                createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+notification.nama_kegiatan+" Mohon Mengajukan Ulang Kembali Sesuai Dengan Keterangan Yang Diberikan";
                $.notify({
                    title: "Ada Notifikasi Baru <hr>",
                    message: "Ada Notifikasi Baru terkait Proposal Kegiatan: "+notification.nama_kegiatan
                }, {
                    type: 'warning',
                    newest_on_top: true,
                    offset: {
                        x: 20,
                        y: 60
                    },
                    delay: 100,
                    animate: {
                        enter: 'animate__animated animate__fadeInRight',
                        exit: 'animate__animated animate__fadeOutRight'
                    },
                });
                break;
            case 5:
                createCircleStatusElement.className = 'icon-circle bg-danger';
                createIconElement.className= 'fa fa-times text-white';
                createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+notification.nama_kegiatan+" Telah Ditolak Oleh Kepala Sekolah";
                $.notify({
                    title: "Ada Notifikasi Baru <hr>",
                    message: "Ada Notifikasi Baru terkait Proposal Kegiatan: "+notification.nama_kegiatan
                }, {
                    type: 'danger',
                    newest_on_top: true,
                    offset: {
                        x: 20,
                        y: 60
                    },
                    delay: 100,
                    animate: {
                        enter: 'animate__animated animate__fadeInRight',
                        exit: 'animate__animated animate__fadeOutRight'
                    },
                });
                break;
            default:
                break;
        }
        createDivNotificationDetailsElement.className = "notification-details";
        
        createDivDetailsElement.className = "small text-gray-500";
        const getDateNow = new Date();
        // waktu relatif sama dengan waktu notification table
        console.log(getDateNow.getHours(), getDateNow.getMinutes(), getDateNow.getSeconds(), getDateNow.getFullYear(), getDateNow.getMonth(), getDateNow.getDate());
        const timestamp = getDateNow.getFullYear()+"-"+transformToFormatTimestamps(getDateNow.getMonth()+1)+"-"+transformToFormatTimestamps(getDateNow.getDate())+" "+transformToFormatTimestamps(getDateNow.getHours())+":"+transformToFormatTimestamps(getDateNow.getMinutes())+":"+transformToFormatTimestamps(getDateNow.getSeconds());
        createDivDetailsElement.innerText = timestamp;

        createSpanExtraDetailsElement.className = "font-weight-bold";
        createSpanExtraDetailsElement.setAttribute('id' , 'span-class-notification-'+notification.id);

        getUserNotificationsElement.prepend(createLinkElement);
        createLinkElement.appendChild(createStatusPartition);
        createStatusPartition.appendChild(createCircleStatusElement);
        createCircleStatusElement.appendChild(createIconElement);
        createLinkElement.appendChild(createDivNotificationDetailsElement);
        createDivNotificationDetailsElement.appendChild(createDivDetailsElement);
        createDivNotificationDetailsElement.appendChild(createSpanExtraDetailsElement);

        notificationID.unshift(notification.id);
        console.log(notificationID);

        if (document.getElementById("pengajuan-table") !== null) {
            const addNewDataPengajuan = $("#pengajuan-table").DataTable();
            addNewDataPengajuan.draw(false);
            console.log(addNewDataPengajuan);
        } else if(document.getElementById("dokumentasi_kegiatan") !== null) {
            const addNewDataDokumentasi = $("#dokumentasi_kegiatan").DataTable();
            addNewDataDokumentasi.draw(false);
        } else if(document.getElementById('badge-counter-notification') !== null) {
            let badgeCounterNotificationElement = document.getElementById('badge-counter-notification');
            badgeCounterNotificationElement.innerText = unreadNotification;
            if(document.getElementById("notification_box") !== null) {
                if (state === "" && state_2 === "") {
                    getData(page, state);
                } else {
                    //alerts
                    const alertNotificationExist = document.getElementById('alerts-notify-exist');
                    alertNotificationExist.classList.remove('d-none');
                    alertNotificationExist.classList.add('animate__animated' , 'animate__fadeInDown');
                    setTimeout(function(){
                        alertNotificationExist.classList.remove('animate__animated','animate__fadeInDown');
                        alertNotificationExist.classList.add('animate__animated' ,'animate__fadeOutUp');
                        alertNotificationExist.classList.add('d-none');
                        alertNotificationExist.classList.add('animate__animated','animate__fadeInDown');
                        alertNotificationExist.classList.remove('animate__animated','animate__fadeOutUp');
                    }, 5000); 
                }
            }
        } 

});

initializeNotifications("init");


//read notification
$(document).on("click", '.notify-test', function(e){
    e.preventDefault();
    let notificationRequest = $(this).attr('id');
    let notificationLink = $(this).attr('href');
    markAsReadNotification(notificationRequest, notificationLink);     
});

function initializeNotifications(status){
    if(status === "init") {
        $.get('/penanggung-jawab/get-notification', function(res) {
            console.log(res);
            let notificationData = res.notifications;
            // count_more_notification+= notificationData.length;
            // console.log(count_more_notification);
            let counterNotification = res.unreadNotifications;
            unreadNotification = counterNotification.length;
            if (counterNotification.length <= 9) {
                badgeCounterElement.innerText = unreadNotification;    
            } else {
                badgeCounterElement.innerText = "9+";   
            }
            notificationData.forEach(element => {
                const createLinkElement = document.createElement('a');
        
                const createStatusPartition = document.createElement('div');
                const createCircleStatusElement = document.createElement('div');
                const createIconElement = document.createElement('i');
            
                const createDivNotificationDetailsElement = document.createElement('div');
                const createDivDetailsElement = document.createElement('div');
                const createSpanExtraDetailsElement = document.createElement('span');
        
                let {data: {links, nama_kegiatan, status_kegiatan, status_kegiatan_id}} = element;
                notificationID.push(element.id);
                createLinkElement.className='dropdown-item d-flex align-items-center notify-test notification-'+element.id;
                createLinkElement.setAttribute('id' , element.id);
                createLinkElement.setAttribute('href' , links);
        
                createStatusPartition.className = 'mr-3';
                switch (status_kegiatan_id) {
                    case 1:
                        createCircleStatusElement.className = 'icon-circle bg-success';
                        createIconElement.className= 'fa fa-check text-white';
                        createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" "+status_kegiatan+" Oleh Kepala Sekolah";
                        break;
                    case 4:
                        createCircleStatusElement.className = 'icon-circle bg-warning';
                        createIconElement.className= 'fa fa-exclamation text-white';
                        createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" Mohon Mengajukan Ulang Kembali Sesuai Dengan Keterangan Yang Diberikan";
                        break;
                    case 5:
                        createCircleStatusElement.className = 'icon-circle bg-danger';
                        createIconElement.className= 'fa fa-times text-white';
                        createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" Telah Ditolak Oleh Kepala Sekolah";
                        break;
                    default:
                        createCircleStatusElement.className = 'icon-circle bg-secondary';
                        createIconElement.className= 'fa fa-question text-white';
                        createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" "+status_kegiatan+" Oleh Kepala Sekolah";
                        break;
                }
                createDivNotificationDetailsElement.className = "notification-details";

                createDivDetailsElement.className = "small text-gray-500";

                const dateConvert = new Date(element.created_at);
                dateConvert.setHours(dateConvert.getHours() + 7)

                let notificationTimestamp = dateConvert.getFullYear()+"-"+transformToFormatTimestamps(dateConvert.getMonth()+1)+"-"+transformToFormatTimestamps(dateConvert.getDate())+" "+transformToFormatTimestamps(dateConvert.getHours())+":"+transformToFormatTimestamps(dateConvert.getMinutes())+":"+transformToFormatTimestamps(dateConvert.getSeconds());
                
                createDivDetailsElement.innerText = notificationTimestamp;
                if (element.read_at === null) {
                    createSpanExtraDetailsElement.className = "font-weight-bold";
                    createSpanExtraDetailsElement.setAttribute('id' , 'span-class-notification-'+element.id);
                } 
                getUserNotificationsElement.appendChild(createLinkElement);
                createLinkElement.appendChild(createStatusPartition);
                createStatusPartition.appendChild(createCircleStatusElement);
                createCircleStatusElement.appendChild(createIconElement);
                createLinkElement.appendChild(createDivNotificationDetailsElement);
                createDivNotificationDetailsElement.appendChild(createDivDetailsElement);
                createDivNotificationDetailsElement.appendChild(createSpanExtraDetailsElement);
                
            });
        });
    }
}

//onscroll
const scrollNotification = getUserNotificationsElement.parentElement;
scrollNotification.onscroll = (ev) => {
    if (scrollNotification.scrollTop + scrollNotification.clientHeight === scrollNotification.scrollHeight) {
        console.log(notificationID.length);
        console.log(notificationID);
        if (notificationID.length >= 9) {
            console.log(notificationID.length);
            $.get('/kepala-sekolah/get-more-notification/'+notificationID.length, function(res){
                let newNotification = res.moreNotifications;
                Object.keys(newNotification).forEach(element => {
                    const createLinkElement = document.createElement('a');
                    const createStatusPartition = document.createElement('div');
                    const createCircleStatusElement = document.createElement('div');
                    const createIconElement = document.createElement('i');
                
                    const createDivNotificationDetailsElement = document.createElement('div');
                    const createDivDetailsElement = document.createElement('div');
                    const createSpanExtraDetailsElement = document.createElement('span');
                    
                    let {data: {links, nama_kegiatan, status_kegiatan, status_kegiatan_id}} = newNotification[element];
                    notificationID.push(newNotification[element].id);

                    createLinkElement.className='dropdown-item d-flex align-items-center notify-test notification-'+newNotification[element].id;
                    createLinkElement.setAttribute('id' , newNotification[element].id);
                    createLinkElement.setAttribute('href' , links);

                    createStatusPartition.className = 'mr-3';
                    switch (status_kegiatan_id) {
                        case 1:
                            createCircleStatusElement.className = 'icon-circle bg-success';
                            createIconElement.className= 'fa fa-check text-white';
                            createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" "+status_kegiatan+" Oleh Kepala Sekolah";
                        break;
                        case 4:
                            createCircleStatusElement.className = 'icon-circle bg-warning';
                            createIconElement.className= 'fa fa-exclamation text-white';
                            createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" Mohon Mengajukan Ulang Kembali Sesuai Dengan Keterangan Yang Diberikan";
                            break;
                        case 5:
                            createCircleStatusElement.className = 'icon-circle bg-danger';
                            createIconElement.className= 'fa fa-times text-white';
                            createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" Telah Ditolak Oleh Kepala Sekolah";
                            break;
                        default:
                            createCircleStatusElement.className = 'icon-circle bg-secondary';
                            createIconElement.className= 'fa fa-question text-white';
                            createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" "+status_kegiatan+" Oleh Kepala Sekolah";
                            break;
                    }
                    createDivNotificationDetailsElement.className = "notification-details";

                    createDivDetailsElement.className = "small text-gray-500";

                    const dateConvert = new Date(element.created_at);
                    dateConvert.setHours(dateConvert.getHours() + 7)
                    let notificationTimestamp = dateConvert.getFullYear()+"-"+transformToFormatTimestamps(dateConvert.getMonth()+1)+"-"+transformToFormatTimestamps(dateConvert.getDate())+" "+transformToFormatTimestamps(dateConvert.getHours())+":"+transformToFormatTimestamps(dateConvert.getMinutes())+":"+transformToFormatTimestamps(dateConvert.getSeconds());
                    createDivDetailsElement.innerText = notificationTimestamp;
                    
                    getUserNotificationsElement.appendChild(createLinkElement);
                    createLinkElement.appendChild(createStatusPartition);
                    createStatusPartition.appendChild(createCircleStatusElement);
                    createCircleStatusElement.appendChild(createIconElement);
                    createLinkElement.appendChild(createDivNotificationDetailsElement);
                    createDivNotificationDetailsElement.appendChild(createDivDetailsElement);
                    if (newNotification[element].read_at === null) {
                        createSpanExtraDetailsElement.className = "font-weight-bold";
                        createSpanExtraDetailsElement.setAttribute('id' , 'span-class-notification-'+newNotification[element].id);
                        createDivNotificationDetailsElement.appendChild(createSpanExtraDetailsElement);
                    } else {
                        createDivNotificationDetailsElement.appendChild(createSpanExtraDetailsElement);
                    }
                    console.log(notificationID);
                });
                // count_more_notification+=Object.keys(newNotification).length;
                // console.log(count_more_notification);
            });    
        }
    }
};

function markAsReadNotification(notificationRequest, notificationLink){
    window.axios.put('/kepala-sekolah/mark-as-read/', {
        data: notificationRequest,
        links: notificationLink
    }).then((response) => {
        console.log(response.data);
        window.location = notificationLink;
    }).catch((responseError) => {
        errorsNotificationAlert(responseError.response.status , responseError.response);
    });
}
function errorsNotificationAlert(status, messages){
    let {data:{message}} = messages;
    if (status === 404) {
        Swal.fire({
            icon: 'error',
            title: 'Terdapat Error Ketika Mengambil Data, System Error Code',
            text: message
        });
    } else if(status === 401){
        Swal.fire({
            icon: 'info',
            title: 'Please Login',
            text: message
        }).then((result)=>{
            window.location = '/';
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Terdapat Error Ketika Mengambil Data, Jika Masalah Masih Ada, Kontak Admin! System Error: ',
            text: message
        }).then((result) => {
            location.reload(true);
        });
        console.log(messages);
    }
}

function transformToFormatTimestamps(timestamps){
    if (timestamps < 10) {
        return "0"+timestamps;
    }
    return timestamps;
}

