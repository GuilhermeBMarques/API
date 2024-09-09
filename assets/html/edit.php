<?php
session_start();
include_once __DIR__ . '/../../php/config.php';
include_once __DIR__ . '/../../php/verifique.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/edit.css">
</head>

<body>
    <!-- Container de Update -->
    <div id="updateContainer" class="updateContainer">
        <header class="crieConta">
            <h2><span style="color: #f8ae4e;">Redefine</span> sua conta</h2>
            <h1><span style="color: #f8ae4e;">Pet</span>Amigo</h1>
        </header>
        <form id="salvarUpdate" action="/API/php/usuarios.php" method="POST">
            <div class="dados">
                <label for="registerNome"><i class="bi bi-person-fill"></i></label>
                <input type="text" id="registerNome" value="<?php echo $nome_usuario ?>" name="nome_usuario" required placeholder="Nome de Usuário">
            </div>
            <div class="dados">
                <label for="registerEmail"><i class="bi bi-envelope-fill"></i></label>
                <input type="email" id="registerEmail" value="<?php echo $email_usuario ?>" name="email_usuario" required placeholder="Email">
            </div>
            <div class="dados">
                <label for="registerSenha"><i class="bi bi-lock-fill"></i></label>
                <input type="text" id="registerSenha" name="senha_usuario" required placeholder="Senha">
            </div>
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
            <button type="submit" name="update">Atualizar</button>
            <br>
            <a href="/API/assets/html/perfil.php" class="link">Voltar</a>
        </form>
    </div>
</body>

</html>