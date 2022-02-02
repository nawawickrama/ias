<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newUser extends Mailable
{
    use Queueable, SerializesModels;
    public $pwrd;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pwrd)
    {
        $this->data = $pwrd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Welcome to IAS College')->markdown('admin.mail.new_user', ['data' => $this->data]);
    }
}
