<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewComment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private string $user;
    private string $comment;
    private string $approveUrl;
    private string $rejectUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $comment, $approveUrl, $rejectUrl)
    {
        $this->user = $user;
        $this->comment = $comment;
        $this->approveUrl = $approveUrl;
        $this->rejectUrl = $rejectUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'User Comment',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'newComment',
            with: [
                'user' => $this->user,
                'comment' => $this->comment,
                'approveUrl' => $this->approveUrl,
                'rejectUrl' => $this->rejectUrl
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
