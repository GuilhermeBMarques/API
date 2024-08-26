<?php
session_start(); 
include_once __DIR__ . '/config.php';

// Verifica se o formulário foi submetido
if (isset($_POST['registerForm'])) {
    $nome_usuario = $_POST['nome_usuario'];
    $senha_usuario = password_hash($_POST['senha_usuario'], PASSWORD_DEFAULT); 
    $email_usuario = $_POST['email_usuario'];

    // Prepara a consulta para verificar se o email já está em uso
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email_usuarios=?");
    $stmt->bind_param("s", $email_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o email já está cadastrado
    if ($result->num_rows > 0) {
        // Se já estiver, da erro
        header("Location: /API/assets/html/Login/loginErro.html");
        exit(); 
    } else {
         // Se não estiver, insere um novo usuário no banco de dados
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

if ($action == 'update') {
    $nome_usuario = $input['nome_usuario']; // Obtém o nome de usuário do input JSON
    $senha_usuario = password_hash($input['senha_usuario'], PASSWORD_DEFAULT); // Cria um novo hash da senha
    $email_usuario = $input['email_usuario']; // Obtém o email_usuario do input JSON

    // Atualiza os dados do usuário no banco de dados
    $stmt = $conn->prepare("UPDATE usuarios SET senha_usuario=?, email_usuario=? WHERE nome_usuario=?");
    $stmt->bind_param("sss", $senha_usuario, $email_usuario, $nome_usuario);
    
    // Verifica se a atualização foi bem-sucedida e retorna mensagem correspondente
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Update successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }
    $stmt->close(); // Fecha a declaração preparada
} 

// Ação para deletar um usuário
if ($action == 'delete') {
    $nome_usuario = $input['nome_usuario']; // Obtém o nome de usuário do input JSON

    // Deleta o usuário do banco de dados
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE nome_usuario=?");
    $stmt->bind_param("s", $nome_usuario);
    
    // Verifica se a exclusão foi bem-sucedida e retorna mensagem correspondente
    if ($stmt->execute()) {
            header("Location: /API/assets/html/Login/loginCerto.html");
            exit(); 
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }
    $stmt->close(); // Fecha a declaração preparada
}
?>
