<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountCreatedWithTempPwdMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The temporary password
     *
     * @var String
     */
    public $tempPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $tempPassword)
    {
        $this->tempPassword = $tempPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Project Orange Account Created')->markdown('emails.account-created-with-temp-pwd-mail');
    }
}
