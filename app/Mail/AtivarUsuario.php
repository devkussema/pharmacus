<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AtivarUsuario extends Mailable
{
    use Queueable, SerializesModels;

    public $nomeUser, $url_ativacao, $email_to;

    /**
     * Create a new message instance.
     */
    public function __construct($nomeUser, $url_ativacao, $email_to)
    {
        $this->nomeUser = $nomeUser;
        $this->url_ativacao = $url_ativacao;
        $this->email_to = $email_to;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmação de email | '.env('APP_NAME'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.bemVindoUser',
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
