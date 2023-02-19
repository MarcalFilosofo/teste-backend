<?php

include 'config/session.php';
include 'config/uuid.php';
include 'controller/UsuarioController.php';
include 'controller/LoginController.php';

if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle): bool {
        if ( is_string($haystack) && is_string($needle) ) {
            return '' === $needle || false !== strpos($haystack, $needle);
        } else {
            return false;
        }
    }
}

$caminho = $_REQUEST['rota'] ?? 'usuario.index';

switch ($caminho) {
    case 'usuario.index':
        return (new UsuarioController)->index();
        break;
    case 'usuario.create':
        return (new UsuarioController)->create();
        break;
    case 'usuario.store':
        return (new UsuarioController)->store($_POST);
        break;
    case 'usuario.edit':
        return (new UsuarioController)->edit($_REQUEST['id']);
        break;
    case 'usuario.update':
        return (new UsuarioController)->update($_REQUEST['id'], $_POST);
        break;
    case 'login':
        return (new LoginController)->showLoginForm();
        break;
    case 'authenticate':
        return (new LoginController)->authenticate($_POST['login'], $_POST['senha']);
        break;
    case 'logout':
        return (new LoginController)->logout();
        break;
    
    default:
        return (new UsuarioController)->index();
        break;
}
// validarSessao();