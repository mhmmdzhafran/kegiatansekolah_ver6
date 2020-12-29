<?php

namespace App\Listeners;

use App\Events\AjukanProposalKegiatanToKepalaSekolahEvent;
use App\Notifications\AjukanProposalKegiatanToKepalaSekolahNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class BroadcastAjukanProposalKegiatanToKepalaSekolah
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
    public function handle(AjukanProposalKegiatanToKepalaSekolahEvent $event)
    {
        //
        $user_kepalaSekolah = User::whereHas('Role', function($query){
            $query->where('id',2);
        })->first();
        Notification::send($user_kepalaSekolah, new AjukanProposalKegiatanToKepalaSekolahNotification($user_kepalaSekolah,$event->pengajuanKegiatan, $event->statusKegiatan));
    }
}
