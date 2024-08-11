<?php
include_once __DIR__ . '/config.php';

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
        echo "Email já está em uso!";
    } else {
        // Insere o novo usuário
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome_usuarios, senha_usuarios, email_usuarios) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome_usuario, $senha_usuario, $email_usuario);
        if ($stmt->execute()) {
            // Registro bem-sucedido, redirecione para loginCerto.html
            header("Location: /API/assets/html/Login/loginCerto.html");
            exit(); // Garante que o script PHP pare de executar após o redirecionamento
        } else {
            // Redirecione para loginErrado.html
            header("Location: /API/assets/html/Login/loginErrado.html");
            exit(); // Garante que o script PHP pare de executar após o redirecionamento
        }
    }
    $stmt->close();
} 

if (isset($_POST['loginForm'])) {
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];

       // Verifica se o email já existe
       $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email_usuarios=?");
       $stmt->bind_param("s", $email_usuario);
       $stmt->execute();
       $result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    var_dump($row);
    if (password_verify($senha_usuario, $row['senha_usuarios'])) {
        session_start();
        $_SESSION['email_usuario'] = $row['email_usuarios'];
        header("Location: /API/assets/html/Login/loginCerto.html");
        exit();
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}

    $stmt->close();
}
?>