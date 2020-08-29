<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class KeputusanProposalKegiatanToPJNotification extends Notification
{
    use Queueable;

    public $pengajuan_kegiatan;
    public $status_kegiatan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($pengajuan_kegiatan , $status_kegiatan)
    {
        //
        $this->pengajuan_kegiatan = $pengajuan_kegiatan;
        $this->status_kegiatan = $status_kegiatan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' , 'database' , 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            // input field pengajuan kegiatan serta nama pj, links
            "nama_kegiatan" => $this->pengajuan_kegiatan->PJ_nama_kegiatan,
            "status_proposal_id" => $this->status_kegiatan->id,
            "status_proposal" => $this->status_kegiatan->nama,
            "link" => '/penanggung-jawab/mengelola-kegiatan',
        ];
    }
}
