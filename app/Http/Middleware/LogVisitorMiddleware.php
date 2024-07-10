<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitante as Visitor;
use Carbon\Carbon;

class LogVisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verificar se o dispositivo com este IP acessou o sistema hoje
        $visitor = Visitor::where('ip', $request->ip())
            ->where('device', $request->header('User-Agent'))
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($request->ip() == "127.0.0.1" || $request->ip() == "::1") {
            $ip = "127.0.0.1";
        }else{
            $ip = $request->ip();
        }

        $geoLocation = $this->getLocation($ip);

        if ($visitor) {
            // Atualizar os dados do visitante
            $visitor->update([
                // Atualize os campos conforme necessário
                'referrer' => $request->header('referer'), // referência do site
            ]);
        } else {
            // Criar um novo registro para o visitante
            Visitor::create([
                'ip' => $request->ip(),
                'country' => $geoLocation['country'] ?? '127.0.0.1', // obter país se necessário
                'state' => $geoLocation['city'] ?? '127.0.0.1', // obter estado se necessário
                'browser' => $request->header('User-Agent'),
                'referrer' => $request->header('referer'), // referência do site
                'device' => $request->header('User-Agent'),
            ]);
        }
        return $next($request);
    }

    private function getLocation($Ip)
    {
        if (function_exists('curl_init')) {
            // Endereço IP do visitante
            $ip = $Ip;

            // URL da API do ip-api.com
            $url = "http://ip-api.com/json/{$ip}?lang=pt-BR&fields=650783";

            // Inicializa uma solicitação cURL
            $ch = curl_init();

            // Define a URL da solicitação cURL
            curl_setopt($ch, CURLOPT_URL, $url);

            // Define o método da solicitação como GET
            curl_setopt($ch, CURLOPT_HTTPGET, true);

            // Define que a resposta da solicitação deve ser retornada como uma string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Faz a solicitação para a API
            $response = curl_exec($ch);

            // Verifica se houve algum erro na solicitação
            if ($response === false) {
                #die('Erro ao fazer a solicitação para a API.');
            }else{
                // Decodifica a resposta JSON em um array associativo
                $data = json_decode($response, true);

                // Verifica se a resposta contém informações de localização válidas
                if ($data && $data['status'] == 'success') {
                    // Exibe as informações de localização
                    //echo "País: {$data['country']}, Cidade: {$data['city']}, Estado/Província: {$data['regionName']}, CEP: {$data['zip']}";
                    return $data;
                } else {
                    return $data = [
                        "query" => null,
                        "status" => null,
                        "country" => 0,
                        "countryCode" => null,
                        "region" => null,
                        "regionName" => null,
                        "city" => null,
                        "district" => null,
                        "isp" => null,
                        "org" => null,
                        "as" => null,
                        "mobile" => null,
                    ];
                }
            }

            // Fecha a solicitação cURL
            curl_close($ch);
        }
    }
}
