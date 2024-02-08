<?php

use \App\Models\User;

function isGerente() {
    if (auth()->user()->gerente) {
        return true;
    }

    return false;
}