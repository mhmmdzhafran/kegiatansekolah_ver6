<?php
/**
 * Nama: Muhammad Zhafran Auristianto
 * Tim Pengembang: Tim Pengembang untuk SMP Islam Sabilurrosyad Malang
 */
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendForgetPasswordDataMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $userName;
    protected $passwordData;
    protected $urlLink;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $passwordData, $urlLink)
    {
        //
        $this->userName = $userName;
        $this->passwordData = $passwordData;
        $this->urlLink = $urlLink;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pembuatan Password Sementara Akun Pengguna SIMPPK')
            ->markdown('users.forgetPassword.send')
            ->with([
                'username' => $this->userName,
                'data'=> $this->passwordData,
                'url' => $this->urlLink
            ]);
    }
}
