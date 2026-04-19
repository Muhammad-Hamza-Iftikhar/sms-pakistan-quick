<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param array{name: string, email: string, subject: string, message: string} $payload
     * @param array{submitted_at?: string, ip_address?: string, user_agent?: string} $meta
     */
    public function __construct(
        public readonly array $payload,
        public readonly array $meta = []
    ) {
    }

    public function envelope(): Envelope
    {
        $subject = sprintf('New Contact Submission: %s', $this->payload['subject']);

        return new Envelope(
            subject: $subject,
            replyTo: [
                new Address($this->payload['email'], $this->payload['name']),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-submission',
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
