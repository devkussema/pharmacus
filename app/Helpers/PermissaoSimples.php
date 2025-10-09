<?php

if (!function_exists('podeUsuarioCadastrar')) {
    /**
     * Verifica se o usuário pode cadastrar produtos (versão simplificada)
     *
     * @param int|null $userId
     * @return bool
     */
    function podeUsuarioCadastrar($userId = null)
    {
        try {
            $userId = $userId ?? auth()->id();
            
            if (!$userId) {
                return false;
            }

            $user = \App\Models\User::find($userId);
            
            return $user ? $user->pode_cadastrar_produtos : false;
            
        } catch (\Exception $e) {
            \Log::error('Erro ao verificar permissão de cadastro: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('podeAuthCadastrar')) {
    /**
     * Verifica se o usuário autenticado pode cadastrar produtos
     *
     * @return bool
     */
    function podeAuthCadastrar()
    {
        $user = auth()->user();
        return $user ? $user->pode_cadastrar_produtos : false;
    }
}