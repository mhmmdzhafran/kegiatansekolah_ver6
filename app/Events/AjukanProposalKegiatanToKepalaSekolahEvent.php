<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Events;

use App\PengajuanKegiatan;
use App\StatusKegiatan;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AjukanProposalKegiatanToKepalaSekolahEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pengajuanKegiatan;
    public $statusKegiatan;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PengajuanKegiatan $pengajuanKegiatan , StatusKegiatan $statusKegiatan)
    {
        //
        $this->pengajuanKegiatan = $pengajuanKegiatan;
        $this->statusKegiatan = $statusKegiatan;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('pengajuanKegiatan-KepalaSekolah');
    }
}
