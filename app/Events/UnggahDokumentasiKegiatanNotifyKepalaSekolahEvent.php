<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Events;

use App\DokumentasiKegiatan;
use App\StatusKegiatan;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UnggahDokumentasiKegiatanNotifyKepalaSekolahEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dokumentasiKegiatan;
    public $statusKegiatan;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(DokumentasiKegiatan $dokumentasiKegiatan , StatusKegiatan $statusKegiatan)
    {
        //
        $this->dokumentasiKegiatan = $dokumentasiKegiatan;
        $this->statusKegiatan = $statusKegiatan;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('dokumentasi-kegiatan-pj');
    }
}
