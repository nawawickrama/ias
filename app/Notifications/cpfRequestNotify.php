<?php

namespace App\Notifications;

use App\Models\Cpf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class cpfRequestNotify extends Notification
{
    use Queueable;

    private $cpf;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Cpf $cfp)
    {
        $this->cpf = $cfp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /*return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');*/
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'info' => 'Pending CPF Request.',
            'cpf_id' => $this->cpf->cpf_id,
            'time' => date('Y-m-d H:i:s'),
        ];
    }
}
