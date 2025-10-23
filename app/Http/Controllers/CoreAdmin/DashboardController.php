<?php

namespace App\Http\Controllers\CoreAdmin;

use App\Http\Controllers\Controller;

/**
 * Controller mínimo para o painel Core Admin
 *
 * Autor: Augusto Kussema
 * Data de criação: 23/10/2025
 */
class DashboardController extends Controller
{
    public function index()
    {
        return view('core_admin::dashboard.index');
    }

    public function reports()
    {
        return view('core_admin::dashboard.reports');
    }

    public function users()
    {
        return view('core_admin::dashboard.users');
    }

    public function products()
    {
        return view('core_admin::dashboard.products');
    }

    public function settings()
    {
        return view('core_admin::dashboard.settings');
    }
}
