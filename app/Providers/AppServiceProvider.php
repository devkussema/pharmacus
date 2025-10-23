<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProdutoEstoque;
use App\Observers\ProdutoEstoqueObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registra o namespace 'preview' para as views
        View::addNamespace('preview', resource_path('views/preview'));
        View::addNamespace('ocorrencia', base_path('core/views/ocorrencias'));
        View::addNamespace('prepharma_auth', resource_path('views/auth/prepharma'));
        View::addNamespace('prepharma', resource_path('views/prepharma'));
        View::addNamespace('admin', app_path('Views'));
        View::addNamespace('core_admin', base_path('core/views/admin'));

        // Registrar observer para histórico de produtos
        ProdutoEstoque::observe(ProdutoEstoqueObserver::class);
    }
}
