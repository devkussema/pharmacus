<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAllowedHosts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedHosts = nem('allowed_hosts');

        // Obtém o IP ou o DNS atual
        $currentHost = $_SERVER['REMOTE_ADDR'] ?? $_SERVER['SERVER_NAME'] ?? null;

        if ($currentHost && is_array($allowedHosts)) {
            if (!in_array($currentHost, $allowedHosts)) {
                abort(403, "Acesso não autorizado: {$_SERVER['REMOTE_ADDR']}, {$_SERVER['SERVER_NAME']}");
                //echo "Acesso não autorizado: {$_SERVER['REMOTE_ADDR']}"; exit;
            }
        } else {
            // Se não houver hosts permitidos configurados, aborta com erro
            abort(500, 'Configuração de hosts permitidos ausente ou inválida.');
        }

        return $next($request);
    }

    /* example
    {
        "key1": "value1",
        "key2": "nem?conf",
        "allowed_hosts": {
            "host1": "192.168.18.90",
            "host2": "218.189.43.179",
            "host3": "127.0.0.1"
        },
        "nested": {
            "nested_key1": "nested_value1",
            "nested_key2": "nested_value2"
        },
        "system": {
            "db_conn": "mysql",
            "db_host": "127.0.0.",
            "db_user": "root",
            "db_passwd": "",
            "db_port": 3306,
            "db_database": "pharmacus"
        },
        "pc_host": true
    }
    */
}
