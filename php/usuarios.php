<?php
session_start(); 
include_once __DIR__ . '/config.php';

// Verifica se o formulário foi submetido
if (isset($_POST['submit'])) {
    $nome_usuario = $_POST['nome_usuario'];
    $senha_usuario = password_hash($_POST['senha_usuario'], PASSWORD_DEFAULT); 
    $email_usuario = $_POST['email_usuario'];

    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email_usuarios=?");
    $stmt->bind_param("s", $email_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o email já está em uso ou não
    if ($result->num_rows > 0) {
        header("Location: /API/assets/html/Login/loginErro.html");
        exit(); 
    } else {
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome_usuarios, senha_usuarios, email_usuarios) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome_usuario, $senha_usuario, $email_usuario);
        if ($stmt->execute()) {
            $_SESSION['email_usuario'] = $email_usuario;
            header("Location: /API/assets/html/Login/loginCerto.html");
            exit(); 
        } else {
            header("Location: /API/assets/html/Login/loginErrado.html");
            exit(); 
        }
    }
    $stmt->close();
}

// Verifica se o formulário de login foi submetido
if (isset($_POST['loginForm'])) {
    $email_usuario = $_POST['email_usuario'];
    $senha_usuario = $_POST['senha_usuario'];

    // Verifica se o email está cadastrado
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email_usuarios=?");
    $stmt->bind_param("s", $email_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifica se a senha fornecida corresponde ao hash armazenado
        if (password_verify($senha_usuario, $row['senha_usuarios'])) {
            $_SESSION['email_usuario'] = $row['email_usuarios'];
            header("Location: /API/assets/html/home.php");
            exit(); 
        } else {
            header("Location: /API/assets/html/Login/loginErro.html");
            exit(); 
        }
    } else {
        header("Location: /API/assets/html/Login/loginErro.html");
        exit(); 
    }
    $stmt->close();
}
?>
