<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewComment extends Notification implements ShouldQueue
{
    use Queueable;

    private string $user;
    private string $comment;
    private string $url;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $comment, $approveUrl)
    {
        $this->user = $user;
        $this->comment = $comment;
        $this->url = $approveUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('ការបញ្ចេញមតិថ្មី')
            ->greeting('សួស្តី, '.$notifiable->name.'!')
            ->line('មានការបញ្ចេញមតិ "'. $this->comment. '" ពី '. $this->user)
            ->action('ពិនិត្យការបញ្ចេញមតិ', $this->url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
