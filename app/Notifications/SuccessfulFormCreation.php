<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuccessfulFormCreation extends Notification
{
    public $formData;

    public function __construct($formData)
    {
        $this->formData = $formData;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Form Created Successfully')
            ->line('The form was created successfully.')
            ->line('Form Details:')
            ->line('Title: ' . $this->formData['title'])
            // Add more details as needed
            ->line('Thank you for using our service.');
    }
}
