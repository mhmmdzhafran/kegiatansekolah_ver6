<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AjukanProposalKegiatanToKepalaSekolahNotification extends Notification
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
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user_kepsek = User::whereRoleId(2)->first();
        $decode_file = json_decode($this->pengajuan_kegiatan->dokumen_kegiatan);
        // $file_name = '';
        // foreach ($decode_file as $getFile) {
        //     $file_name = $getFile->nama_dokumen;
        // }
         // ->attach(public_path('/kegiatan/pengajuan_kegiatan/'.$file_name), [
                    //     'as' => $file_name,
                    //     'mime' => 'application/pdf'
                    // ])
        $url = url('/kepala-sekolah/mengelola-kegiatan');
        return (new MailMessage)
                    ->greeting('Hello, '.$user_kepsek->name)
                    ->line('Proposal Kegiatan dengan Nama Kegiatan: '.$this->pengajuan_kegiatan->PJ_nama_kegiatan
                    .' Telah Diunggah oleh: '.$this->pengajuan_kegiatan->user->name)
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
            // input detail notifikasi and links
             "user_pj" => $this->pengajuan_kegiatan->user->name,
             "username_id" => $this->pengajuan_kegiatan->user->username_id,
             "kegiatan_id" => $this->pengajuan_kegiatan->id,
             "nama_kegiatan" => $this->pengajuan_kegiatan->PJ_nama_kegiatan,
             "nilai_ppk" => $data_ppk,
             "kegiatan_berbasis" => $this->pengajuan_kegiatan->kegiatan_berbasis,
             "timestamp_pengiriman" => $this->pengajuan_kegiatan->updated_at->timezone('Asia/Jakarta')->toDateTimeString(),
             "type_notification" => "Proposal Kegiatan",
             "status_kegiatan_id" => $this->status_kegiatan->id,
             "status_kegiatan" => $this->status_kegiatan->nama,
             "link" => "/kepala-sekolah/mengelola-kegiatan/".$this->pengajuan_kegiatan->id."/edit",
             "link_changed" => '/kepala-sekolah/mengelola-kegiatan/',
        ];
    }
}
