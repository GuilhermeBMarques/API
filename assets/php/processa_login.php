<?php
include_once('config.php');

if (isset($_POST['submit'])) {
    $nome_usuario = $_POST['nome_usuario'];
    $senha_usuario = password_hash($_POST['senha_usuario'], PASSWORD_DEFAULT);
    $email_usuario = $_POST['email_usuario'];

    // Verifica se o email já existe
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email_usuarios=?");
    $stmt->bind_param("s", $email_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email já está em uso
        echo "Email já está em uso!";
    } else {
        // Insere o novo usuário
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome_usuarios, senha_usuarios, email_usuarios) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome_usuario, $senha_usuario, $email_usuario);
        if ($stmt->execute()) {
            // Registro bem-sucedido, redirecione para home.html
            header("Location: home.html");
            exit(); // Garante que o script PHP pare de executar após o redirecionamento
        } else {
            // Erro ao registrar
            echo "Erro ao registrar: " . $stmt->error;
        }
    }
    $stmt->close();
}
?>
