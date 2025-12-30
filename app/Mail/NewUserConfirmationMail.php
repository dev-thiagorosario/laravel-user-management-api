<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public readonly string $name,
        public readonly string $confirmationUrl,
    ){}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmacao de email',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $html = sprintf(
            '<p>Ola, %s.</p><p>Para confirmar seu email, clique no link abaixo:</p><p><a href="%s">%s</a></p><p>Se voce nao solicitou isso, ignore este email.</p>',
            e($this->name),
            e($this->confirmationUrl),
            e($this->confirmationUrl),
        );

        return new Content(
            htmlString: $html,
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
