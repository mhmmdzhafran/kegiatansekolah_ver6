<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdatedUserAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user_data;
    protected $data_pass_user;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_data, $data_pass_user, $url)
    {
        //
        $this->user_data = $user_data;
        $this->data_pass_user = $data_pass_user;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('users.account.updated')
                    ->with([
                        'nama_user' => $this->user_data->name,
                        'username' => $this->user_data->username_id,
                        'peran' => $this->user_data->Role->role_title,
                        'password' => $this->data_pass_user,
                        'link' => $this->url
                    ]);
    }
}
