<?php
include_once __DIR__ . '/config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['email_usuario'])) {
    header("Location: /API/assets/html/Login/loginErro.html");
    exit();
}

// Recupera o email do usuário da sessão
$email_usuario = $_SESSION['email_usuario'];

// Adiciona a recuperação do ID do usuário
$stmt = $conexao->prepare("SELECT id_usuarios, nome_usuarios, email_usuarios FROM usuarios WHERE email_usuarios=?");
$stmt->bind_param("s", $email_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $id_usuarios = htmlspecialchars($user['id_usuarios']);
    $nome_usuario = htmlspecialchars($user['nome_usuarios']);
    $email_usuario = htmlspecialchars($user['email_usuarios']);
} else {
    header("Location: /API/assets/html/Login/loginErro.html");
    exit();
}

$stmt->close();
?>