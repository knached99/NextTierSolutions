<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
             ->subject($this->data['subject'])
            ->greeting('Hey Pablo, '.$this->data['name']. ' has contacted you')
            ->from(config('mail.from.address'), $this->data['name'])
            ->line('Contact Submission Details:')
            ->line('Customer Name:'. $this->data['name'])
            ->line('Business Name: '. $this->data['businessName'])
            ->line('Business Email: '. $this->data['businessEmail'])
            ->line('Business Number: '. $this->data['businessNumber'])
            ->line('Subject: '. $this->data['subject'])
            ->line('Message: '. $this->data['message'])
            ->line('This contact is expecting a response from you within 24-48 hours.')
            ->line('You can reply to them by')
            ->line("[Clicking Here](mailto:{$this->data['businessEmail']})");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
