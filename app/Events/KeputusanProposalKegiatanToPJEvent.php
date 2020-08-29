<?php

namespace App\Events;

use App\PengajuanKegiatan;
use App\StatusKegiatan;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KeputusanProposalKegiatanToPJEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $pengajuanKegiatan;
    public $statusKegiatan;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, PengajuanKegiatan $pengajuanKegiatan, StatusKegiatan $statusKegiatan)
    {
        //
        $this->user = $user;
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
        return new PrivateChannel('proposal-kegiatan-'.$this->user->id);
    }
}
