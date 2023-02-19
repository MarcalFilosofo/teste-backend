<?php

include "model/Usuario.php";

class UsuarioController
{

    public function __construct() {
        session_start();
        validarSessao();    
    }

    public function index()
    {
        $page = $_GET['page'] ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $pesquisa = $_GET['pesquisa'] ?? '';

        $usuarios = new Usuario();
        $usuarios = $usuarios->getAll($limit, $offset, $pesquisa);

        include 'view/usuario/index.php';
    }

    public function create()
    {
        include 'view/usuario/create.php';
    }

    public function store($dados)
    {
        
        $usuarios = new Usuario();
        $dados['cpf'] = preg_replace('/[^0-9]/', '', $dados['cpf']);

        $existeCpf = $usuarios->existeCpf($dados['cpf']);

        if($existeCpf) {
            die('CPF já cadastrado');
        }

        $dados['uuid'] = guidv4();
        $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        $dados['permissao'] = implode(",", $dados['permissao']);
        $dados['data_criacao'] = date('Y-m-d H:i:s');
        $dados['data_atualizacao'] = date('Y-m-d H:i:s');
        $dados['status'] = $dados['status'] == 'ativo' ? 1 : 0;

        $usuarios = $usuarios->insert($dados);

        header('Location: ?rota=usuario.index');
        exit;
    }

    public function edit($id)
    {
        $usuario = new Usuario();

        $usuario = $usuario->getOne($id);

        include 'view/usuario/edit.php';
    }

    public function update($id, $dados)
    {

        if(isset($dados['senha'])) {
            $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        }

        $dados['data_atualizacao'] = date('Y-m-d H:i:s');
        $dados['permissao'] = implode(",", $dados['permissao']);
        $dados['status'] = $dados['status'] == 'ativo' ? 1 : 0;
        $dados['cpf'] = preg_replace('/[^0-9]/', '', $dados['cpf']);

        $usuario = new Usuario();

        $usuario = $usuario->update($id, $dados);

        header('Location: ?rota=usuario.index');
        exit;
    }
}
