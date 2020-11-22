<?php

namespace App\Listeners;

use App\Events\KeputusanLaporanKegiatanToPJEvent;
use App\Notifications\KeputusanLaporanKegiatanToPJNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class BroadcastKeputusanLaporanKegiatanToPJ
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
    public function handle(KeputusanLaporanKegiatanToPJEvent $event)
    {
        //
        $userPJ  = User::where("id" , "=" , $event->user->id)->first();
        Notification::send($userPJ, new KeputusanLaporanKegiatanToPJNotification($event->dokumentasiKegiatan , $event->statusKegiatan));
    }
}
