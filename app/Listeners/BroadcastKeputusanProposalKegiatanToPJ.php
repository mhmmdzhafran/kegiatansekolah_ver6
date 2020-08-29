<?php

namespace App\Listeners;

use App\Events\KeputusanProposalKegiatanToPJEvent;
use App\Notifications\KeputusanProposalKegiatanToPJNotification;
use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class BroadcastKeputusanProposalKegiatanToPJ
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
    public function handle(KeputusanProposalKegiatanToPJEvent $event)
    {
        //
        $user_PJ = User::where('id' , '=' , $event->user->id)->first();
        Notification::send($user_PJ , new KeputusanProposalKegiatanToPJNotification($event->pengajuanKegiatan ,$event->statusKegiatan));
    }
}
