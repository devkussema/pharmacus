<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

putenv("TMPDIR=C:\\laragon\\tmp");

//$allowedHosts = env('APP_ALLOWED_HOSTS', '50.800.90.56');

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

if (!function_exists('nem')) {
    function nem($key, $default=null)
    {
        $nemFile = base_path('.nem_conf');

        if (file_exists($nemFile)) {
            $nemContent = file_get_contents($nemFile);
            $nemConfig = json_decode($nemContent, true);

            // Quebrando a chave em partes usando '.' como delimitador
            $keys = explode('.', $key);
            $value = $nemConfig;

            // Percorre cada parte da chave para acessar o valor aninhado
            foreach ($keys as $part) {
                if (isset($value[$part])) {
                    $value = $value[$part];
                } else {
                    // Retorna null se a chave não existir
                    return null;
                }
            }

            return $value;
        }

        return $default;
    }
}


/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
