<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmarDesignacaoAH extends Mailable
{
    use Queueable, SerializesModels;

    public $usuario;
    public $cargo;
    public $areaHospitalar;
    public $farmacia;
    public $linkConfirmacao;
    public $dataDesignacao;
    public $tempoExpiracao;

    public function __construct($dados)
    {
        $this->usuario = $dados['usuario'];
        $this->cargo = $dados['cargo'];
        $this->areaHospitalar = $dados['areaHospitalar'];
        $this->farmacia = $dados['farmacia'];
        $this->linkConfirmacao = $dados['linkConfirmacao'];
        $this->dataDesignacao = $dados['dataDesignacao'] ?? now();
        $this->tempoExpiracao = $dados['tempoExpiracao'] ?? '48 horas';
    }

    public function build()
    {
        return $this->view('emails.confirmCargoAH')
                    ->subject('Confirmação de Designação - ' . $this->cargo->nome)
                    ->with([
                        'usuario' => $this->usuario,
                        'cargo' => $this->cargo,
                        'areaHospitalar' => $this->areaHospitalar,
                        'farmacia' => $this->farmacia,
                        'linkConfirmacao' => $this->linkConfirmacao,
                        'dataDesignacao' => $this->dataDesignacao,
                        'tempoExpiracao' => $this->tempoExpiracao,
                        'assunto' => 'Confirmação de Designação - ' . $this->cargo->nome,
                        'mensagemPersonalizada' => "Foi designado(a) como {$this->cargo->nome} na área {$this->areaHospitalar->nome}. Por favor, confirme a sua designação para ativar o seu acesso ao sistema."
                    ]);
    }
}
