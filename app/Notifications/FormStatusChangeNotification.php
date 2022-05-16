<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormStatusChangeNotification extends Notification
{
    use Queueable;
    private $formInfo;
    private $status;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($formInfo, $status)
    {
        $this->formInfo = $formInfo;
        $this->status = $status;
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
            'info' => 'Your '.$this->formInfo->form_name.' '.$this->status,
            'identifier' => $this->formInfo->form_id,
            'time' => date('Y-m-d H:i:s'),
        ];
    }
}
