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

class KeputusanLaporanKegiatanToPJNotification extends Notification
{
    use Queueable;

    public $dokumentasiKegiatan;
    public $statusKegiatan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($dokumentasiKegiatan , $statusKegiatan)
    {
        //
        $this->dokumentasiKegiatan = $dokumentasiKegiatan;
        $this->statusKegiatan = $statusKegiatan;
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
        $user_pj = $this->dokumentasiKegiatan->user->name;
        $url = url('/penanggung-jawab/unggah-dokumentasi-kegiatan');
        $nama_status = $this->statusKegiatan->nama;
        if ($nama_status == 'Pengajuan Ulang') {
            $nama_status = 'Mengajukan Ulang Kembali';
        }
        return (new MailMessage)
                    ->subject('Pemberian Keputusan Laporan Kegiatan SIMPPK')
                    ->greeting('Hello, '.$user_pj)
                    ->line('Laporan Kegiatan dengan Nama Kegiatan: '.$this->dokumentasiKegiatan->nama_kegiatan
                    .' Telah Diberikan Keputusan: '.$nama_status)
                    ->action('Lihat Laporan', $url)
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
            //
            "user_pj" => $this->dokumentasiKegiatan->user->username_id,
            "nama_kegiatan" => $this->dokumentasiKegiatan->nama_kegiatan,
            "nilai_ppk" => $data_ppk,
            "kegiatan_berbasis" => $this->dokumentasiKegiatan->kegiatan_berbasis,
            "status_kegiatan_id" => $this->statusKegiatan->id,
            "status_kegiatan" => $this->statusKegiatan->nama,
            "timestamp_pengiriman" => $this->dokumentasiKegiatan->updated_at,
            "link" => '/penanggung-jawab/unggah-dokumentasi-kegiatan',
            "type_notification" => "Laporan Kegiatan",
        ];
    }
}
