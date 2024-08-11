<?php
include_once __DIR__ . '/config.php';

// Verifica se o formulário de registro foi submetido
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
        echo "Email já está em uso!";
    } else {
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome_usuarios, senha_usuarios, email_usuarios) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome_usuario, $senha_usuario, $email_usuario);
        if ($stmt->execute()) {
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

    // Verifica a consulta para ver se o email está cadastrado
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email_usuarios=?");
    $stmt->bind_param("s", $email_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o email já está cadastrado
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "Senha fornecida: " . htmlspecialchars($senha_usuario) . "<br>";
        echo "Hash armazenado: " . htmlspecialchars($row['senha_usuarios']) . "<br>";

        // Verifica se a senha fornecida corresponde ao hash armazenado
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
