<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Notifications;

use App\DokumentasiKegiatan;
use App\StatusKegiatan;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AjukanDokumentasiKegiatanNotifyKepalaSekolahNotification extends Notification
{
    use Queueable;

    public $dokumentasiKegiatan;
    public $statusKegiatan;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,DokumentasiKegiatan $dokumentasiKegiatan , StatusKegiatan $statusKegiatan)
    {
        //
        $this->dokumentasiKegiatan = $dokumentasiKegiatan;
        $this->statusKegiatan = $statusKegiatan;
        $this->user = $user;
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
        $url = url('/kepala-sekolah/dokumentasi-kegiatan');
        return (new MailMessage)
                    ->subject('Unggah Laporan Kegiatan SIMPPK')
                    ->greeting('Hello, '.$this->user->name)
                    ->line('Laporan Kegiatan dengan Nama Kegiatan: '.$this->dokumentasiKegiatan->nama_kegiatan
                    .' Telah Diunggah oleh: '.$this->dokumentasiKegiatan->user->name)
                    ->action('Notification Action', $url)
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

        $nilai_ppk = json_decode($this->dokumentasiKegiatan->nilai_ppk);
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
            // input field dokumentasi, status, and links
            "user_pj" => $this->dokumentasiKegiatan->user->name,
            "username_id" => $this->dokumentasiKegiatan->user->username_id,
            "kegiatan_id" => $this->dokumentasiKegiatan->id,
            "nama_kegiatan" => $this->dokumentasiKegiatan->nama_kegiatan,
            "nilai_ppk" => $data_ppk,
            "kegiatan_berbasis" => $this->dokumentasiKegiatan->kegiatan_berbasis,
            "timestamp_pengiriman" => $this->dokumentasiKegiatan->updated_at,
            "type_notification" => "Laporan Kegiatan",
            'tipe_pengajuan' => $this->dokumentasiKegiatan->tipe_kegiatan,
            "status_kegiatan" => $this->statusKegiatan->nama,
            "status_kegiatan_id" => $this->statusKegiatan->id,
            "link" => "/kepala-sekolah/dokumentasi-kegiatan/".$this->dokumentasiKegiatan->id."/edit",
            "link_changed" => '/kepala-sekolah/dokumentasi-kegiatan/'
        ];
    }
}
