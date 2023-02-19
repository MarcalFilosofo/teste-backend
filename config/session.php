<?php

function validarSessao()
{
    $usuario = $_SESSION['usuario'];

    if(!isset($usuario)) {
        header('Location: ?rota=login');

        exit();
    }
}