<?php
session_start();
include_once __DIR__ . '/../../php/config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['email_usuario'])) {
    header("Location: /API/assets/html/Login/loginErro.html");
    exit();
}

// Recupera o email do usuário da sessão
$email_usuario = $_SESSION['email_usuario'];

// Prepara a consulta para recuperar informações do usuário
$stmt = $conexao->prepare("SELECT nome_usuarios, email_usuarios FROM usuarios WHERE email_usuarios=?");
$stmt->bind_param("s", $email_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário foi encontrado
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nome_usuario = htmlspecialchars($user['nome_usuarios']);
    $email_usuario = htmlspecialchars($user['email_usuarios']);
} else {
    header("Location: /API/assets/html/Login/loginErro.html");
    exit();
}
$stmt->close();

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
        <a href="home.php"><h1><span style="color: #db7434">Pet</span>Amigo</h1></a>
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
            <h1><?php echo $nome_usuario; ?></h1>
        </div>

    <div id="userContainer" class="userContainer">
        <div class="perfil-list">
            <ul>
                <li>
                    <p><strong>Email:</strong> <?php echo $email_usuario; ?></p>
                </li>
            </ul>
        </div>

        <button type="button" id="showForm" class="w-full bg-gray-500 text-white py-2 rounded-lg mt-4">Redefinir Usuario</button>
        <a href="/API/assets/html/Login/login.html" class="btn">Sair</a>

        <button id="deleteUsuario" class="w-full bg-red-500 text-white py-2 rounded-lg"> Deletar Conta </button> <!-- Botão para deletar a conta -->
    </div>

    <div id="updateContainer" class="updateContainer hidden">
        <form id="updateForm">
            <div class="dados">
                <label>Usuário:</label>
                <input type="text" id="updateNome_usuario">
            </div>
            <div class="dados">
                <label>Gmail:</label>
                <input type="text" id="updategmail_usuario">
            </div>
            <div class="dados">
                <label>Senha:</label>
                <input type="text" id="updatesenha_usuario">
            </div>
            <button type="submit">Atualizar</button>
        </form>
        <button type="button" id="showUser" class="w-full bg-gray-500 text-white py-2 rounded-lg mt-4">Voltar</button>
    </div>

</body>
</html>
