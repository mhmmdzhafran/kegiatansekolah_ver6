<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
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
        $user_pj = $this->pengajuan_kegiatan->user->name;
        $url = url('/penanggung-jawab/mengelola-kegiatan');
        $nama_status = $this->status_kegiatan->nama;
        if ($nama_status == 'Pengajuan Ulang') {
            $nama_status = 'Mengajukan Ulang Kembali';
        }
        return (new MailMessage)
                    ->subject('Pemberian Keputusan Proposal Kegiatan SIMPPK')
                    ->greeting('Hello, '.$user_pj)
                    ->line('Proposal Kegiatan Dengan Nama Kegiatan: '.$this->pengajuan_kegiatan->PJ_nama_kegiatan
                    .' Telah Diberikan Keputusan: '.$nama_status)
                    ->action('Lihat Proposal', $url)
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
        $nilai_ppk = json_decode($this->pengajuan_kegiatan->nilai_ppk);
        $id_nilai_ppk = 1;
        $data_ppk = "";
        foreach ($nilai_ppk as $item_ppk) {
            if (count($nilai_ppk) == $id_nilai_ppk) {
                $data_ppk .=  $item_ppk->nilai_ppk;
            }
            else{
                $data_ppk .= $item_ppk->nilai_ppk.", ";
            }
            $id_nilai_ppk++;
        }
        return [
            // input field pengajuan kegiatan serta nama pj, links
            "user_pj" => $this->pengajuan_kegiatan->user->username_id,
            "nama_kegiatan" => $this->pengajuan_kegiatan->PJ_nama_kegiatan,
            "nilai_ppk" => $data_ppk,
            "kegiatan_berbasis" => $this->pengajuan_kegiatan->kegiatan_berbasis,
            "status_kegiatan_id" => $this->status_kegiatan->id,
            "status_kegiatan" => $this->status_kegiatan->nama,
            "timestamp_pengiriman" => $this->pengajuan_kegiatan->updated_at,
            "link" => '/penanggung-jawab/mengelola-kegiatan',
            "type_notification" => "Proposal Kegiatan"
        ];
    }
}
