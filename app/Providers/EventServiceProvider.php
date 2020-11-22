<?php

namespace App\Providers;

use App\Events\AjukanProposalKegiatanToKepalaSekolahEvent;
use App\Events\KeputusanLaporanKegiatanToPJEvent;
use App\Events\KeputusanProposalKegiatanToPJEvent;
use App\Events\UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent;
use App\Listeners\BroadcastAjukanProposalKegiatanToKepalaSekolah;
use App\Listeners\BroadcastDokumentasiKegiatanNotifyKepalaSekolah;
use App\Listeners\BroadcastKeputusanLaporanKegiatanToPJ;
use App\Listeners\BroadcastKeputusanProposalKegiatanToPJ;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AjukanProposalKegiatanToKepalaSekolahEvent::class => [
            BroadcastAjukanProposalKegiatanToKepalaSekolah::class
        ],
        KeputusanProposalKegiatanToPJEvent::class => [
            BroadcastKeputusanProposalKegiatanToPJ::class
        ],
        UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent::class => [
            BroadcastDokumentasiKegiatanNotifyKepalaSekolah::class
        ],
        KeputusanLaporanKegiatanToPJEvent::class => [
            BroadcastKeputusanLaporanKegiatanToPJ::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
