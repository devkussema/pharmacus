<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Classe Recover
 *
 * Envia e-mail de redefinição de senha para o utilizador.
 *
 * @author Augusto Kussema
 * @since 01/10/2025
 */
class Recover extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Nome do utilizador
     * @var string
     */
    public string $nome;

    /**
     * URL para redefinição/solicitação de senha
     * @var string
     */
    public string $url;

    /**
     * @param string $nome
     * @param string $url
     */
    public function __construct(string $nome, string $url)
    {
        $this->nome = $nome;
        $this->url  = $url;
    }

    /**
     * Define o envelope do e-mail
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Redefinição de senha - ' . env('APP_NAME', 'Pharmatina'),
        );
    }

    /**
     * Define o conteúdo do e-mail
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recover',
            with: [
                'nome' => $this->nome,
                'url'  => $this->url,
            ],
        );
    }

    /**
     * Anexos do e-mail
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
