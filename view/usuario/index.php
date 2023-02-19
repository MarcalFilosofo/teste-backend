<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div id="site">
        <header>
            <h1>USUÁRIOS</h1>
            <form class="busca" action="">
                <i><img src="images/lupa.svg"></i>
                <input type="text" name="pesquisa" placeholder="Pesquisar...">
            </form>
            <figure></figure>
            <a class="sair" href="?rota=logout">sair</a>
        </header>

        <ul>
            <li class="titulo">
                <div class="texto nome">Nome</div>
                <div class="texto cpf">CPF</div>
                <div class="texto email">E-MAIL</div>
                <div class="texto data">DATA</div>
                <div class="texto status">STATUS</div>
                <div class="editar"></div>
                <div class="deletar"></div>
            </li>
            <?php foreach($usuarios as $usuario): ?>
                <li class="dado">
                    <div class="texto nome"><?= $usuario['nome']; ?></div>
                    <div class="texto cpf"><?= $usuario['cpf']; ?></div>
                    <div class="texto email"><?= $usuario['email']; ?></div>
                    <div class="texto data"><?= $usuario['data_criacao']; ?></div>
                    <div class="texto status"><?= $usuario['status'] == 1 ? "Ativo" : "Destivado" ?></div>
                    <div class="editar"><a href="?rota=usuario.edit&id=<?= $usuario['id'] ?>"><img src="images/editar.svg"></a></div>
                    <div class="deletar"><img src="images/deletar.svg"></div>
                </li>    
            <?php endforeach; ?>
        </ul>
        <div class="pagina">
            <p class="resultado"><?= count($usuarios) ?> resultados</p>
            <?php if($page > 1): ?>
                <a href="index.php?rota=usuario.index&page=<?= $page - 1 ?>">Anterior</a>
            <?php endif; ?>
            
            <a href="index.php?rota=usuario.index&page=<?= $page + 1 ?>">Próxima</a>
        </div>
        <a href="?rota=usuario.create" class="botao_add">Adicionar novo</a>
    </div>
</body>

</html>
