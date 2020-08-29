const userID = document.getElementById('user').getAttribute('value');
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
            case 3:
                createCircleStatusElement.className = 'icon-circle bg-warning';
                createIconElement.className= 'fa fa-exclamation text-white';
                createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+notification.nama_kegiatan+" Yang diunggah oleh "+notification.user_pj+" "+notification.status_kegiatan;
                $.notify({
                    title: "Ada Notifikasi Baru <hr>",
                    message: "Ada Notifikasi Baru terkait Proposal Kegiatan: "+notification.nama_kegiatan+" Yang Diunggah oleh "+notification.user_pj
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
                createSpanExtraDetailsElement.innerText = "Dokumentasi Kegiatan "+notification.nama_kegiatan+" Sudah Diunggah oleh "+notification.user_pj;
                $.notify({
                    title: "Ada Notifikasi Baru <hr>",
                    message: "Ada Notifikasi Baru terkait Dokumentasi Kegiatan: "+notification.nama_kegiatan+" Yang Diunggah oleh "+notification.user_pj
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
        createDivDetailsElement.innerText = notification.timestamp_pengiriman;

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

        if (document.getElementById("pengajuan_kegiatan") !== null) {
            const addNewDataPengajuan = $("#pengajuan_kegiatan").DataTable();
            addNewDataPengajuan.draw(false);
        } else if(document.getElementById("dokumentasi_kegiatan") !== null) {
            const addNewDataDokumentasi = $("#dokumentasi_kegiatan").DataTable();
            addNewDataDokumentasi.draw(false);
        } else if(document.getElementById('badge-counter-notification') !== null) {
            let badgeCounterNotificationElement = document.getElementById('badge-counter-notification');
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
    let notificationLink = $(this).attr('href');
    markAsReadNotification(notificationRequest, notificationLink);     
});

function initializeNotifications(status){
    if (status === "refresh") {
        //ada di notification page saja
        console.log(notificationID);
        $.get('/kepala-sekolah/get-notification', function(res) {
            notificationID.length = 0;
            console.log(res.notifications);
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
        
                let {data: {link, nama_kegiatan, status_kegiatan, status_kegiatan_id, user_pj}} = element;
                notificationID.push(element.id);
                createLinkElement.className='dropdown-item d-flex align-items-center notify-test notification-'+element.id;
                createLinkElement.setAttribute('id' , element.id);
                createLinkElement.setAttribute('href' , link);
        
                createStatusPartition.className = 'mr-3';
                switch (status_kegiatan_id) {
                    case 3:
                        createCircleStatusElement.className = 'icon-circle bg-warning';
                        createIconElement.className= 'fa fa-exclamation text-white';
                        createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" Yang diunggah oleh "+user_pj+" "+status_kegiatan;
                        break;
                    case 6:
                        createCircleStatusElement.className = 'icon-circle bg-success';
                        createIconElement.className= 'fa fa-check text-white';
                        createSpanExtraDetailsElement.innerText = "Dokumentasi Kegiatan "+nama_kegiatan+" Sudah Diunggah oleh "+user_pj;
                        break;
                    default:
                        break;
                }
                createDivNotificationDetailsElement.className = "notification-details";
        
                createDivDetailsElement.className = "small text-gray-500";
                createDivDetailsElement.innerText = element.created_at;
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
                let badgeCounterNotificationElement = document.getElementById('badge-counter-notification');
                badgeCounterNotificationElement.innerText = unreadNotification;
            });
            console.log(notificationID);
        });
    } else if(status === "init") {
        $.get('/kepala-sekolah/get-notification', function(res) {
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
        
                let {data: {link, nama_kegiatan, status_kegiatan, status_kegiatan_id, user_pj}} = element;
                notificationID.push(element.id);
                createLinkElement.className='dropdown-item d-flex align-items-center notify-test notification-'+element.id;
                createLinkElement.setAttribute('id' , element.id);
                createLinkElement.setAttribute('href' , link);
        
                createStatusPartition.className = 'mr-3';
                switch (status_kegiatan_id) {
                    case 3:
                        createCircleStatusElement.className = 'icon-circle bg-warning';
                        createIconElement.className= 'fa fa-exclamation text-white';
                        createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" Yang diunggah oleh "+user_pj+" "+status_kegiatan;
                        break;
                    case 6:
                        createCircleStatusElement.className = 'icon-circle bg-success';
                        createIconElement.className= 'fa fa-check text-white';
                        createSpanExtraDetailsElement.innerText = "Dokumentasi Kegiatan "+nama_kegiatan+" Sudah Diunggah oleh "+user_pj;
                        break;
                    default:
                        break;
                }
                createDivNotificationDetailsElement.className = "notification-details";

                createDivDetailsElement.className = "small text-gray-500";
                createDivDetailsElement.innerText = element.created_at;
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
                    
                    let {data: {link, nama_kegiatan, status_kegiatan, status_kegiatan_id, user_pj}} = newNotification[element];
                    notificationID.push(newNotification[element].id);

                    createLinkElement.className='dropdown-item d-flex align-items-center notify-test notification-'+newNotification[element].id;
                    createLinkElement.setAttribute('id' , newNotification[element].id);
                    createLinkElement.setAttribute('href' , link);

                    createStatusPartition.className = 'mr-3';
                    switch (status_kegiatan_id) {
                        case 3:
                            createCircleStatusElement.className = 'icon-circle bg-warning';
                            createIconElement.className= 'fa fa-exclamation text-white';
                            createSpanExtraDetailsElement.innerText = "Proposal Kegiatan "+nama_kegiatan+" Yang diunggah oleh "+user_pj+" "+status_kegiatan;
                            break;
                        case 6:
                            createCircleStatusElement.className = 'icon-circle bg-success';
                            createIconElement.className= 'fa fa-check text-white';
                            createSpanExtraDetailsElement.innerText = "Dokumentasi Kegiatan "+nama_kegiatan+" Sudah Diunggah oleh "+user_pj;
                            break;
                        default:
                            break;
                    }
                    createDivNotificationDetailsElement.className = "notification-details";

                    createDivDetailsElement.className = "small text-gray-500";
                    createDivDetailsElement.innerText = newNotification[element].created_at; 
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
        if (responseError.response.status === 404) {
            console.log(responseError.response.statusText);
            console.log(responseError.response);
        } else if(responseError.response.status === 401){

        } else {
            console.log(responseError.response);
        }
        
    });
}
    function errorsNotifications(status, message){

    }

