<?php

# git bundle create meu_bundle.bundle dev // **dev** o nome do branch alvo
class Translator
{
    public function translate($texto, $lang)
    {
        // Idioma de destino
        $idioma_destino = $lang; // Por exemplo, "en" para inglês

        // URL da API do Google Translate
        $url = "https://translate.google.com/m?sl=auto&tl=$idioma_destino&ie=UTF-8&prev=_m&q=" . urlencode($texto);

        // Faz a requisição HTTP GET
        $traducao_html = file_get_contents($url);

        // Analisa o HTML para extrair a tradução
        $padrao = '/<div class="result-container">(.*?)<\/div>/s';
        preg_match($padrao, $traducao_html, $traducao);

        // var_dump($traducao_html);
        if (isset($traducao[1])) {
            // Imprime a tradução
            return htmlspecialchars_decode($traducao[1]);
        } else {
            return "Erro ao traduzir o texto.";
        }

        //return $traducao;
    }
}

// Criar um objeto da classe Translator
$translator = new Translator();

// Receber os parâmetros
$texto = $argv[1];
$lang = $argv[2];

// Validar os parâmetros
if (empty($texto) || empty($lang)) {
    echo "Erro: É necessário passar dois parâmetros: o texto a ser traduzido e o idioma de destino.\n";
    exit;
}

// Chamar a função translate no objeto
$traducao = $translator->translate($texto, $lang);

// Exibir o resultado
echo "Tradução para $lang: $traducao\n";
