<?php

namespace App\Listeners;

use App\Events\UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent;
use App\Notifications\AjukanDokumentasiKegiatanNotifyKepalaSekolahNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class BroadcastDokumentasiKegiatanNotifyKepalaSekolah
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent $event)
    {
        //
        $user_kepalaSekolah = User::whereHas('Role', function($query){
            $query->where('id' , 2);
        })->first();
        Notification::send($user_kepalaSekolah, new AjukanDokumentasiKegiatanNotifyKepalaSekolahNotification($user_kepalaSekolah,$event->dokumentasiKegiatan , $event->statusKegiatan));
    }
}
