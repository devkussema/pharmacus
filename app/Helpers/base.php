<?php

use \App\Models\User;
use App\Models\Grupo;
use App\Models\{Permissao, Cargo};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

function isAreaDefault()
{
    $user = Auth::user()->with('area_hospitalar')->whereHas('area_hospitalar', function ($query) {
        $query->where('area_hospitalar_id', 'Armazém I');
    })->first();

    if ($user)
        return true;
    else
        return false;
}

function translate($texto, $lang)
{
    // Texto a ser traduzido
    #$texto = "Texto para tradução, sobrinho";

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
        echo "Tradução: " . htmlspecialchars_decode($traducao[1]);
    } else {
        echo "Erro ao traduzir o texto.";
    }
}

function calcMes($dataAlvo)
{
    // Converte a data alvo para um objeto DateTime
    $dataAlvo = new DateTime($dataAlvo);

    // Obtém a data atual
    $hoje = new DateTime();

    // Calcula a diferença entre as duas datas
    $intervalo = $hoje->diff($dataAlvo);

    // Calcula o número total de meses restantes
    $mesesRestantes = $intervalo->y * 12 + $intervalo->m;

    if ($mesesRestantes < 1) {
        // Se faltar menos de 1 mês, retorna o número de dias restantes
        $diasRestantes = $intervalo->days;
        return "$diasRestantes dias";
    } else {
        // Caso contrário, retorna o número de meses restantes
        return "$mesesRestantes meses";
    }
}

function assets($path)
{
    $url = env("APP_THEME", "default") . "/" . $path;

    return asset($url);
}

function isCargo($cargo)
{
    $c = Grupo::where('nome', $cargo)->first();
    if ($c) {
        if (Auth::user()->grupo_id == $c->id) {
            return true;
        }
    }

    return false;
}

function getMobileBrand($user_agent)
{
    #$brand = 'Desconhecido';

    // Define os padrões de marca
    $brands = [
        '/(iPhone|iPad|iPod)/' => 'Apple',
        '/(Samsung|Galaxy)/' => 'Samsung',
        '/(Huawei|Honor)/' => 'Huawei',
        '/(Xiaomi|Redmi)/' => 'Xiaomi',
        '/(OnePlus)/' => 'OnePlus',
        '/(Google Pixel)/' => 'Google',
        '/(Motorola Moto)/' => 'Motorola',
        '/(LG G|LG V)/' => 'LG',
        '/(Sony Xperia)/' => 'Sony',
        '/(Oppo)/' => 'Oppo',
        '/(Vivo)/' => 'Vivo',
        '/(Realme)/' => 'Realme',
    ];

    $brand = null;
    foreach ($brands as $pattern => $branD) {
        if (preg_match($pattern, $user_agent)) {
            $brand = $branD;
            break; // Sai do loop após encontrar a primeira correspondência
        }
    }

    // Verifica se o User-Agent contém padrões específicos para marcas de dispositivos móveis conhecidas
    /*if (preg_match('/(iPhone|iPad|iPod)/', $user_agent)) {
        $brand = 'Apple';
    } elseif (preg_match('/(Samsung|Galaxy)/', $user_agent)) {
        $brand = 'Samsung';
    }*/
    // Exibe a marca
    if ($brand) {
        return $brand;
    } else {
        return "Desconhecido";
    }
}

function getDesktopOS($user_agent) {
    $os = 'Desconhecido';
    $version = '';

    // Verifica se o User-Agent contém padrões específicos para sistemas operacionais de desktop conhecidos
    if (preg_match('/Windows NT (\d+\.\d+)/', $user_agent, $matches)) {
        $os = 'Windows';
        $version = $matches[1];
    } elseif (preg_match('/(Macintosh|Mac OS X) (\d+(_\d+)?)/', $user_agent, $matches)) {
        $os = 'macOS';
        $version = str_replace('_', '.', $matches[2]);
    }
    // Adicione mais verificações para outros sistemas operacionais de desktop, se necessário

    return "{$os} {$version}";
}

function getDeviceTipo($user_agent)
{
    // Lista dos tipos de dispositivos
    $devices = array(
        'Mobile' => 'Telemóvel',
        'Tablet' => 'Tablet',
        'Desktop' => 'Desktop',
        'Smart TV' => 'Smart TV',
        'Console' => 'Console'
        // Adicione outros tipos de dispositivos conforme necessário
    );
    $mobile = getMobileBrand($user_agent);
    $desktop = getDesktopOS($user_agent);

    if ($mobile != "Desconhecido"){
        return getMobileBrand($user_agent);
    }else if ($desktop != "Desconhecido"){
        return getDesktopOS($user_agent);
    }

    // Percorre a lista de dispositivos e verifica se o User-Agent contém o tipo de dispositivo
    /*foreach ($devices as $device => $device_name) {
        if (strpos($user_agent, $device) !== false) {
            if ($device_name == "Mobile"){
                return getMobileBrand($user_agent);
            }else if ($device_name == "Desktop"){
                return getDesktopOS($user_agent);
            }
            return $device_name;
        }
    }*/

    // Se nenhum tipo de dispositivo for encontrado, retorna "Desconhecido"

    return 'Desconhecido';
}

function getBrowserName($user_agent)
{
    // Lista dos principais navegadores
    $browsers = array(
        'Opera' => 'Opera',
        'Edge' => 'Edge',
        'Chrome' => 'Chrome',
        'Safari' => 'Safari',
        'Firefox' => 'Firefox',
        'Brave' => 'Brave',
        'IE' => 'Internet Explorer'
    );

    // Percorre a lista de navegadores e verifica se o User-Agent contém o nome do navegador
    foreach ($browsers as $browser => $browser_name) {
        if (strpos($user_agent, $browser) !== false) {
            return $browser_name;
        }
    }

    // Se nenhum dos principais navegadores for encontrado, retorna "Desconhecido"
    return 'Desconhecido';
}

function printNome($nomeCompleto)
{
    // Dividir o nome completo em partes (nome e sobrenome)
    $partesNome = explode(' ', $nomeCompleto);

    // Pegar o último elemento do array (sobrenome)
    $sobrenome = end($partesNome);

    // Pegar o primeiro elemento do array (primeiro nome)
    // $primeiroNome = reset($partesNome);

    // Retornar apenas o sobrenome
    return $sobrenome;
}

if (!function_exists('saudacaoDoDia')) {
    function saudacaoDoDia()
    {
        date_default_timezone_set('Africa/Luanda'); // Define o fuso horário para São Paulo

        $hora = date('H'); // Obtém a hora atual no formato de 24 horas

        if ($hora >= 5 && $hora < 12) {
            return "Bom dia";
        } elseif ($hora >= 12 && $hora < 18) {
            return "Boa tarde";
        } else {
            return "Boa noite";
        }
    }
}

if (!function_exists('calcTempo')) {
    function calcTempo($data)
    {
        // Converte a data para um objeto DateTime
        $data = new DateTime($data);

        // Obtém a data atual
        $dataAtual = new DateTime();

        // Calcula a diferença entre as duas datas
        $diferenca = $data->diff($dataAtual);

        // Obtém a diferença de anos, meses e dias
        $anos = $diferenca->y;
        $meses = $diferenca->m;
        $dias = $diferenca->d;

        // Formata a string de tempo decorrido
        $tempoDecorrido = '';
        if ($anos > 0) {
            $tempoDecorrido .= $anos . ' ano';
            if ($anos > 1) {
                $tempoDecorrido .= 's';
            }
            $tempoDecorrido .= ' ';
        }
        if ($meses > 0) {
            $tempoDecorrido .= $meses . ' mês';
            if ($meses > 1) {
                $tempoDecorrido .= 'es';
            }
            $tempoDecorrido .= ' ';
        }
        if ($dias > 0) {
            $tempoDecorrido .= $dias . ' dia';
            if ($dias > 1) {
                $tempoDecorrido .= 's';
            }
        }

        // Retorna o tempo decorrido com o nome do mês em português
        return 'desde ' . $data->format('d \d\e F');
    }
}

if (!function_exists('isAdministrator')) {
    function isAdministrator()
    {
        // Verifica se o usuário está autenticado
        if (Auth::check()) {
            // Obtém o ID do usuário atual
            $userId = Auth::user()->id;

            // Verifica se o usuário pertence ao grupo "Administrador"
            return \App\Models\UserGroup::whereHas('grupo', function ($query) {
                $query->where('nome', 'Administrador');
            })->where('user_id', $userId)->exists();
        }

        return false;
    }
}

if (!function_exists('isPerm')) {
    function isPerm($permissaoChave, $permissoes)
    {
        // Converte a lista de permissões de JSON para um array PHP
        $permissoesArray = json_decode($permissoes, true);

        // Verifica se a chave da permissão existe no array de permissões
        return in_array($permissaoChave, $permissoesArray);
    }
}

if (!function_exists('getPerm')) {
    function getPerm($grupoIdOuNome)
    {
        // Verifica se o argumento é um ID de grupo ou nome de grupo
        if (is_numeric($grupoIdOuNome)) {
            // Se for um ID de grupo, busca o grupo pelo ID
            $grupo = Grupo::find($grupoIdOuNome);
        } else {
            // Se for um nome de grupo, busca o grupo pelo nome
            $grupo = Grupo::where('nome', $grupoIdOuNome)->first();
        }

        // Se o grupo não for encontrado, retorna null
        if (!$grupo) {
            return null;
        }

        // Obtém todas as permissões associadas ao grupo
        $permissoes = DB::table('grupo_permissoes')
            ->join('permissoes', 'grupo_permissoes.permissao_id', '=', 'permissoes.id')
            ->where('grupo_permissoes.grupo_id', $grupo->id)
            ->pluck('permissoes.conteudo');

        // Retorna as permissões em formato JSON
        return $permissoes->toJson();
    }
}

function isGerente()
{
    if (auth()->user()->gerente) {
        return true;
    }

    return false;
}
