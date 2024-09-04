<?php
session_start();
include_once __DIR__ . '/../../php/config.php';
include_once __DIR__ . '/../../php/verifique.php';

if (!empty($_GET['id_usuario'])) {
    $id_usuario = intval($_GET['id_usuario']); // Converte para inteiro para evitar SQL Injection

    // Prepara a consulta SELECT para verificar se o usuário existe
    $sqlSelect = "SELECT * FROM usuarios WHERE id_usuarios=?";
    $stmt = $conexao->prepare($sqlSelect);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Prepara a consulta DELETE para remover o usuário
        $sqlDelete = "DELETE FROM usuarios WHERE id_usuarios=?";
        $stmtDelete = $conexao->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $id_usuario);
        $stmtDelete->execute();

        if ($stmtDelete->affected_rows > 0) {
            header("Location: /API/assets/html/Login/login.html");
            exit();
        } else {
            echo "Erro ao deletar o usuário.";
        }
        $stmtDelete->close();
    } else {
        echo "Usuário não encontrado.";
    }
    $stmt->close();
}


$conexao->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/perfil.css">
    <script src="/API/assets/js/perfil.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <!-- Navegação Desktop -->
    <nav class="navbarDesk">
        <a href="home.php">
            <h1><span style="color: #db7434">Pet</span>Amigo</h1>
        </a>
        <ul>
            <li><a href="/API/assets/html/home.php">Home</a></li>
            <li><a href="/API/assets/html/sobre.php">Sobre Nós</a></li>
            <li><a href="/API/assets/html/perfil.php">Perfil</a></li>
        </ul>
    </nav>

    <!-- Navegação Mobile -->
    <nav class="navbarMoba">
        <ul>
            <li><a href="/API/assets/html/home.php"><i class="bi bi-house-fill"></i></a></li>
            <li><a href="/API/assets/html/sobre.php"><i class="bi bi-info-circle-fill"></i></a></li>
            <li><a href="/API/assets/html/perfil.php"><i class="bi bi-person-fill"></i></a></li>
        </ul>
    </nav>

    <div id="img">
        <i class="bi bi-person-circle"></i>
    </div>

        <div class="perfil-list">
            <ul>
                <li>
                    <p><strong>Nome:</strong> <?php echo $nome_usuario; ?></p>
                    <p><strong>Email:</strong> <?php echo $email_usuario; ?></p>
                </li>
            </ul>
        </div>

        <a href="/API/assets/html/Login/login.html" class="btn">Sair</a>

        <form action="">
        </form>
        <a class='btn btn-sm btn-danger' href="perfil.php?id_usuario=<?php echo htmlspecialchars($id_usuarios); ?>">
            <i class="bi bi-trash3-fill"></i> Deletar Perfil
        </a>

        <a class="btn btn-sm btn-primary" href="edit.php?id_usuario=<?php echo htmlspecialchars($id_usuarios); ?>">
        <i class="bi bi-pencil-fill"></i> Editar Perfil
        </a>

</body>

</html>