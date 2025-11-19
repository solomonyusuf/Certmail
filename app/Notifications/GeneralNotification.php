<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class GeneralNotification extends Notification
{
    use Queueable;

    public $subject;
    public $body;
    public $user;
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $subject, string $body, $user = null, $token = null)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
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
            ->subject($this->subject)
            ->view('mail.general-notification', [
                'body' => $this->body,
                'user' => $this->user ?? $notifiable,
                'token' => $this->token,
            ]);
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}

