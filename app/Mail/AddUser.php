<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddUser extends Mailable
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
        $this->pwrd = $pwrd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.mail.template.add_user', ['date' => $this->pwrd]);
    }
}
