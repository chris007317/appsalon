<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function validarInput($html) : string {
    $validar = htmlspecialchars($html);
    return $validar;
}

// Funcion que valida que un usuario haya iniciado sesión
function isAuth() : void{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function esUltimo(string $actual, string $proximo) :bool {
    if ($actual === $proximo) {
        return true;
    }
    return false;
}

function isAdmin() : void{
    if (!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}