<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $assunto ?? 'Confirmação de Designação' }}</title>
    <style>
        /* Reset CSS para emails */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, Arial, sans-serif;
            line-height: 1.6;
            color: #2c3e50;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }

        .email-container {
            max-width: 650px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            text-align: center;
            padding: 40px 30px;
            position: relative;
        }

        .header::before {
            content: '⚕️';
            font-size: 48px;
            display: block;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 35px;
        }

        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        .greeting strong {
            color: #3498db;
        }

        .message {
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 30px;
            color: #555;
        }

        .info-card {
            background: linear-gradient(135deg, #f8faff 0%, #e8f4ff 100%);
            border: 1px solid #e1ecf7;
            border-radius: 10px;
            padding: 25px;
            margin: 25px 0;
            position: relative;
        }

        .info-card::before {
            content: '📋';
            font-size: 20px;
            position: absolute;
            top: 15px;
            right: 20px;
        }

        .info-card h3 {
            color: #2980b9;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .info-card h3::before {
            content: '💼';
            margin-right: 10px;
            font-size: 18px;
        }

        .info-item {
            margin-bottom: 12px;
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .info-item strong {
            color: #2c3e50;
            min-width: 140px;
            margin-right: 10px;
        }

        .info-item span {
            color: #555;
            flex: 1;
        }

        .btn-container {
            text-align: center;
            margin: 35px 0;
        }

        .btn {
            display: inline-block;
            padding: 15px 35px;
            margin: 8px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: #ffffff;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            color: #2c3e50;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(168, 237, 234, 0.4);
        }

        .alert {
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 15px;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fff5cd 0%, #fff0b3 100%);
            border-left: 4px solid #f39c12;
            color: #8b6914;
        }

        .alert-info {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .alert strong {
            display: block;
            margin-bottom: 5px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
            border-top: 1px solid #dee2e6;
        }

        .footer-brand {
            font-weight: 600;
            color: #495057;
            margin-bottom: 10px;
        }

        .footer p {
            margin-bottom: 8px;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 650px) {
            body {
                padding: 10px;
            }

            .email-container {
                margin: 0;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }

            .content {
                padding: 25px 20px;
            }

            .info-card {
                padding: 20px;
            }

            .btn {
                display: block;
                margin: 10px auto;
                max-width: 250px;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-item strong {
                min-width: auto;
                margin-bottom: 3px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>{{ config('app.name', 'Pharmacus') }}</h1>
            <p>Sistema de Gestão Hospitalar</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Olá @if(isset($usuario->nome))<strong>{{ $usuario->nome }}</strong>@else<strong>Utilizador</strong>@endif,
            </div>

            <div class="message">
                @if(isset($mensagemPersonalizada))
                    {{ $mensagemPersonalizada }}
                @else
                    Foi designado(a) para uma nova função no nosso sistema. Por favor, revise os detalhes abaixo e confirme a sua designação.
                @endif
            </div>

            @if(isset($usuario) || isset($cargo) || isset($areaHospitalar) || isset($farmacia))
                <div class="info-card">
                    <h3>Detalhes da Designação</h3>

                    @if(isset($usuario->nome))
                        <div class="info-item">
                            <strong>👤 Nome:</strong>
                            <span>{{ $usuario->nome }}</span>
                        </div>
                    @endif

                    @if(isset($usuario->email))
                        <div class="info-item">
                            <strong>📧 Email:</strong>
                            <span>{{ $usuario->email }}</span>
                        </div>
                    @endif

                    @if(isset($cargo->nome))
                        <div class="info-item">
                            <strong>💼 Cargo:</strong>
                            <span>{{ $cargo->nome }}</span>
                        </div>
                    @endif

                    @if(isset($areaHospitalar->nome))
                        <div class="info-item">
                            <strong>🏥 Área Hospitalar:</strong>
                            <span>{{ $areaHospitalar->nome }}</span>
                        </div>
                    @endif

                    @if(isset($departamento->nome))
                        <div class="info-item">
                            <strong>🏢 Departamento:</strong>
                            <span>{{ $departamento->nome }}</span>
                        </div>
                    @endif

                    @if(isset($farmacia->nome))
                        <div class="info-item">
                            <strong>💊 Farmácia:</strong>
                            <span>{{ $farmacia->nome }}</span>
                        </div>
                    @endif

                    @if(isset($dataDesignacao))
                        <div class="info-item">
                            <strong>📅 Data de Designação:</strong>
                            <span>{{ $dataDesignacao->format('d/m/Y H:i') }}</span>
                        </div>
                    @endif

                    @if(isset($dataExpiracao))
                        <div class="info-item">
                            <strong>⏰ Expira em:</strong>
                            <span>{{ $dataExpiracao->format('d/m/Y H:i') }}</span>
                        </div>
                    @endif
                </div>
            @endif

            @if(isset($linkConfirmacao) || isset($linkRecusar))
                <div class="alert alert-info">
                    <strong>📌 Ação Necessária:</strong>
                    Para ativar o seu acesso, confirme a sua designação utilizando os botões abaixo.
                </div>

                <div class="btn-container">
                    @if(isset($linkConfirmacao))
                        <a href="{{ $linkConfirmacao }}" class="btn btn-primary">✅ Confirmar Designação</a>
                    @endif
                    @if(isset($linkRecusar))
                        <a href="{{ $linkRecusar }}" class="btn btn-secondary">❌ Recusar Designação</a>
                    @endif
                </div>
            @endif

            @if(isset($tempoExpiracao))
                <div class="alert alert-warning">
                    <strong>⚠️ Atenção:</strong>
                    Este link de confirmação expira em {{ $tempoExpiracao }}. Após esse período, será necessário solicitar uma nova designação.
                </div>
            @endif

            <div class="message">
                @if(isset($notaAdicional))
                    {{ $notaAdicional }}
                @else
                    Se não solicitou esta designação ou tem dúvidas, entre em contacto connosco.
                @endif
            </div>

            <div class="message">
                Obrigado por fazer parte da nossa equipa! 🙏
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-brand">{{ config('app.name', 'Pharmacus') }} - Sistema de Gestão Hospitalar</div>
            <p>Este é um email automático, não responda a esta mensagem.</p>
            <p>© {{ date('Y') }} {{ config('app.name', 'Pharmacus') }}. Todos os direitos reservados.</p>
            @if(isset($linkSuporte))
                <p>Precisa de ajuda? <a href="{{ $linkSuporte }}">Contacte o suporte técnico</a></p>
            @elseif(isset($emailSuporte))
                <p>Precisa de ajuda? <a href="mailto:{{ $emailSuporte }}">{{ $emailSuporte }}</a></p>
            @endif
        </div>
    </div>
</body>
</html>
