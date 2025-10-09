<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Classe Welcome
 *
 * Responsável por enviar e-mail de boas-vindas ao utilizador recém-registado.
 *
 * Autor: Augusto Kussema
 * Data: 01/10/2025
 */
class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    public string $nome;
    public string $url;

    /**
     * Cria uma nova instância da mensagem.
     *
     * @param string $nome Nome do utilizador
     * @param string $url URL de confirmação/ativação da conta
     */
    public function __construct(string $nome, string $url)
    {
        $this->nome = $nome;
        $this->url = $url;
    }

    /**
     * Obtém o envelope da mensagem.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem-vindo ao ' . env('APP_NAME', 'Pharmatina'),
        );
    }

    /**
     * Obtém a definição do conteúdo da mensagem.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
            with: [
                'nome' => $this->nome,
                'url'  => $this->url,
            ],
        );
    }

    /**
     * Obtém os anexos da mensagem.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
