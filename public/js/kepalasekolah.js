const userID = document.querySelector('meta[name="user-authorization"]').getAttribute('content');
const getUserNotificationsElement = document.querySelector('.notification-items');
let badgeCounterElement = document.querySelector('.badge-counter');
let notificationID = [];
let unreadNotification = 0;

Echo.private('App.User.'+userID)
    .notification((notification) => {
        unreadNotification+=1;
        
        console.log(notificationID);
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
                // console.log(notificationID);
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
        createLinkElement.setAttribute('data-type' , notification.type_notification);
        createLinkElement.setAttribute('data-id' , notification.kegiatan_id);
        createLinkElement.setAttribute('href' , '#');

        createStatusPartition.className = 'mr-3';
        switch (notification.status_kegiatan_id) {
            case 3:
                // let kegiatanType = "";
                createCircleStatusElement.className = 'icon-circle bg-warning';
                createIconElement.className= 'fa fa-exclamation text-white';
                // if (notification.type_notification === "Pengajuan Kegiatan") {
                //     kegiatanType = "Proposal Kegiatan:";
                //     createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+notification.nama_kegiatan+" Yang diunggah oleh "+notification.user_pj+" "+notification.status_kegiatan;   
                // } else if(notification.type_notification === "Dokumentasi Kegiatan") {
                //     kegiatanType = "Dokumentasi Kegiatan:";
                //     createSpanExtraDetailsElement.innerText = "Dokumentasi Kegiatan "+notification.nama_kegiatan+" Yang diunggah oleh "+notification.user_pj+" "+notification.status_kegiatan;
                // }
                createSpanExtraDetailsElement.innerText = notification.type_notification+" "+notification.nama_kegiatan+" Telah diunggah oleh "+notification.user_pj+", Silahkan Beri Keputusan terkait "+notification.type_notification;
                $.notify({
                    title: "Ada Notifikasi Baru <hr>",
                    message: "Ada Notifikasi Baru terkait "+notification.type_notification+" "+notification.nama_kegiatan+" Yang Diunggah oleh "+notification.user_pj
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
            case 6:
                createCircleStatusElement.className = 'icon-circle bg-success';
                createIconElement.className= 'fa fa-check text-white';
                createSpanExtraDetailsElement.innerText = "Laporan Kegiatan Historis "+notification.nama_kegiatan+" Sudah Diunggah oleh "+notification.user_pj;
                $.notify({
                    title: "Ada Notifikasi Baru <hr>",
                    message: "Ada Notifikasi Baru terkait Laporan Kegiatan Historis: "+notification.nama_kegiatan+" Yang Diunggah oleh "+notification.user_pj
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
            default:
                break;
        }
        createDivNotificationDetailsElement.className = "notification-details";
        
        createDivDetailsElement.className = "small text-gray-500";
        const notificationTime = new Date();
        const timestamp = notificationTime.getFullYear()+"-"+transformToFormatTimestamps(notificationTime.getMonth()+1)+"-"+transformToFormatTimestamps(notificationTime.getDate())+" "+transformToFormatTimestamps(notificationTime.getHours())+":"+transformToFormatTimestamps(notificationTime.getMinutes())+":"+transformToFormatTimestamps(notificationTime.getSeconds());
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
        // console.log(notificationID);

        if (document.getElementById("pengajuan_kegiatan") !== null) {
            const addNewDataPengajuan = $("#pengajuan_kegiatan").DataTable();
            addNewDataPengajuan.draw(false);
        } else if(document.getElementById("dokumentasi_kegiatan") !== null) {
            const addNewDataDokumentasi = $("#dokumentasi_kegiatan").DataTable();
            addNewDataDokumentasi.draw(false);
        } else if(document.getElementById('badge-counter-notification') !== null) {
            let badgeCounterNotificationElement = document.getElementById('badge-counter-notification');
            badgeCounterNotificationElement.setAttribute('data-id' , unreadNotification);
            badgeCounterNotificationElement.innerText = unreadNotification;
            if(document.getElementById("notification_box") !== null) {
                console.log(state+" "+state_2);
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
    let notificationType = $(this).attr('data-type');
    markAsReadNotification(notificationRequest, notificationType);     
});

function initializeNotifications(status){
   if(status === "init") {
        $.get('/kepala-sekolah/get-notification', function(res) {
            console.log(res.notifications);
            let notificationData = res.notifications;
            let counterNotification = res.unreadNotifications;
            unreadNotification = counterNotification.length;

            if (unreadNotification <= 9) {
                badgeCounterElement.innerText = unreadNotification;    
            } else {
                badgeCounterElement.innerText = "9+";   
            }
            console.log(unreadNotification);
            
            notificationData.forEach(element => {
                const createLinkElement = document.createElement('a');
        
                const createStatusPartition = document.createElement('div');
                const createCircleStatusElement = document.createElement('div');
                const createIconElement = document.createElement('i');
            
                const createDivNotificationDetailsElement = document.createElement('div');
                const createDivDetailsElement = document.createElement('div');
                const createSpanExtraDetailsElement = document.createElement('span');
        
                let {data: {kegiatan_id,nama_kegiatan, status_kegiatan_id, user_pj , type_notification}} = element;
                notificationID.push(element.id);
                createLinkElement.className='dropdown-item d-flex align-items-center notify-test notification-'+element.id;
                createLinkElement.setAttribute('id' , element.id);
                createLinkElement.setAttribute('data-type' , type_notification);
                createLinkElement.setAttribute('data-id' , kegiatan_id);
                createLinkElement.setAttribute('href' , '#');
                // if (element.read_at !== null) {
                //     createLinkElement.setAttribute('href' , link_changed);
                // } else {
                //     createLinkElement.setAttribute('href' , link);
                // }
                createStatusPartition.className = 'mr-3';
                switch (status_kegiatan_id) {
                    case 3:
                        createCircleStatusElement.className = 'icon-circle bg-warning';
                        createIconElement.className= 'fa fa-exclamation text-white';
                        // if (type_notification === "Pengajuan Kegiatan") {
                        //     createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" Yang diunggah oleh "+user_pj+" "+status_kegiatan;   
                        // } else if(type_notification === "Dokumentasi Kegiatan") {
                        //     createSpanExtraDetailsElement.innerText = "Dokumentasi Kegiatan "+nama_kegiatan+" Yang diunggah oleh "+user_pj+" "+status_kegiatan;
                        // }
                        createSpanExtraDetailsElement.innerText = type_notification+" "+nama_kegiatan+" Telah diunggah oleh "+user_pj+", Silahkan Beri Keputusan terkait "+type_notification;
                        break;
                    case 6:
                        createCircleStatusElement.className = 'icon-circle bg-success';
                        createIconElement.className= 'fa fa-check text-white';
                        createSpanExtraDetailsElement.innerText = "Laporan Kegiatan Historis "+nama_kegiatan+" Sudah Diunggah oleh "+user_pj;
                        break;
                    default:
                        createCircleStatusElement.className = 'icon-circle bg-secondary';
                        createIconElement.className= 'fa fa-question text-white';
                        createSpanExtraDetailsElement.innerText = "Undefined Notification";
                        break;
                }
                createDivNotificationDetailsElement.className = "notification-details";

                createDivDetailsElement.className = "small text-gray-500";

                const dateConvert = new Date(element.created_at);
                dateConvert.setHours(dateConvert.getHours()+7);

                const notificationTimestamp = dateConvert.getFullYear()+"-"+transformToFormatTimestamps(dateConvert.getMonth()+1)+"-"+transformToFormatTimestamps(dateConvert.getDate())+" "+transformToFormatTimestamps(dateConvert.getHours())+":"+transformToFormatTimestamps(dateConvert.getMinutes())+":"+transformToFormatTimestamps(dateConvert.getSeconds());
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
// const scrollNotification = getUserNotificationsElement.parentElement;
// scrollNotification.onscroll = (ev) => {
//     if (scrollNotification.scrollTop + scrollNotification.clientHeight === scrollNotification.scrollHeight) {
//         // console.log(notificationID.length);
//         // console.log(notificationID);
//         if (notificationID.length >= 9) {
//             console.log(notificationID.length);
//             $.get('/kepala-sekolah/get-more-notification/'+notificationID.length, function(res){
//                 let newNotification = res.moreNotifications;
//                 Object.keys(newNotification).forEach(element => {
//                     const createLinkElement = document.createElement('a');
//                     const createStatusPartition = document.createElement('div');
//                     const createCircleStatusElement = document.createElement('div');
//                     const createIconElement = document.createElement('i');
                
//                     const createDivNotificationDetailsElement = document.createElement('div');
//                     const createDivDetailsElement = document.createElement('div');
//                     const createSpanExtraDetailsElement = document.createElement('span');
                    
//                     let {data:  {kegiatan_id,link, nama_kegiatan, status_kegiatan, status_kegiatan_id, user_pj , link_changed, type_notification}} = newNotification[element];
//                     notificationID.push(newNotification[element].id);

//                     createLinkElement.className='dropdown-item d-flex align-items-center notify-test notification-'+newNotification[element].id;
//                     createLinkElement.setAttribute('id' , newNotification[element].id);
//                     createLinkElement.setAttribute('data-type' , type_notification);
//                     createLinkElement.setAttribute('data-id' , kegiatan_id);
//                     createLinkElement.setAttribute('href' , '#');
//                     createStatusPartition.className = 'mr-3';
//                     switch (status_kegiatan_id) {
//                         case 3:
//                             createCircleStatusElement.className = 'icon-circle bg-warning';
//                             createIconElement.className= 'fa fa-exclamation text-white';
//                             createSpanExtraDetailsElement.innerText = type_notification+" "+nama_kegiatan+" Telah diunggah oleh "+user_pj;
//                             break;
//                         // case 6:
//                         //     createCircleStatusElement.className = 'icon-circle bg-success';
//                         //     createIconElement.className= 'fa fa-check text-white';
//                         //     createSpanExtraDetailsElement.innerText = "Dokumentasi Kegiatan "+nama_kegiatan+" Sudah Diunggah oleh "+user_pj;
//                         //     break;
//                         default:
//                             break;
//                     }
//                     createDivNotificationDetailsElement.className = "notification-details";

//                     createDivDetailsElement.className = "small text-gray-500";
//                     const dateConvert = new Date(element.created_at);
//                     dateConvert.setHours(dateConvert.getHours()+7);
    
//                     const notificationTimestamp = dateConvert.getFullYear()+"-"+transformToFormatTimestamps(dateConvert.getMonth()+1)+"-"+transformToFormatTimestamps(dateConvert.getDate())+" "+transformToFormatTimestamps(dateConvert.getHours())+":"+transformToFormatTimestamps(dateConvert.getMinutes())+":"+transformToFormatTimestamps(dateConvert.getSeconds());
//                     createDivDetailsElement.innerText = notificationTimestamp;
//                     getUserNotificationsElement.appendChild(createLinkElement);
//                     createLinkElement.appendChild(createStatusPartition);
//                     createStatusPartition.appendChild(createCircleStatusElement);
//                     createCircleStatusElement.appendChild(createIconElement);
//                     createLinkElement.appendChild(createDivNotificationDetailsElement);
//                     createDivNotificationDetailsElement.appendChild(createDivDetailsElement);
//                     if (newNotification[element].read_at === null) {
//                         createSpanExtraDetailsElement.className = "font-weight-bold";
//                         createSpanExtraDetailsElement.setAttribute('id' , 'span-class-notification-'+newNotification[element].id);
//                         createDivNotificationDetailsElement.appendChild(createSpanExtraDetailsElement);
//                     } else {
//                         createDivNotificationDetailsElement.appendChild(createSpanExtraDetailsElement);
//                     }
//                     // console.log(notificationID);
//                 });
//                 // count_more_notification+=Object.keys(newNotification).length;
//                 // console.log(count_more_notification);
//             });    
//         }
//     }
// }

function markAsReadNotification(notificationRequest, notificationType){
    window.axios.put('/kepala-sekolah/mark-as-read/', {
        data: notificationRequest,
        type: notificationType,
        page: 'accessLinks'
    }).then((response) => {
        const links = response.data.link_data;
        window.location.replace(links);
    }).catch((responseError) => {
        errorsNotificationAlert(responseError.response.status, responseError.response);
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
                window.location.replace('/');
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Terdapat Error Ketika Mengambil Data, Jika Masalah Masih Ada, Kontak Admin! System Error: ',
                text: message
            }).then((result) => {
                location.reload();
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

    function isTouchDevice(){
        return true == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
    }

