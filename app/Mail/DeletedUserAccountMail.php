<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeletedUserAccountMail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $username;
    protected $name;
    protected $role;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username , $role, $name)
    {
        //
        $this->username = $username;
        $this->role = $role;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Informasi Penghapusan Akun Pengguna SIMPPK')->markdown('users.account.deleted')
                    ->with([
                        'username' => $this->username,
                        'nama_user' => $this->name,
                        'peran' => $this->role
                    ]);
    }
}
