<?php
session_start(); 
include_once __DIR__ . '/config.php';

if (isset($_POST['submit'])) {
    $nome_animal = $_POST['nome_animal'];

    // Processa o arquivo principal
    $arquivo_principal = '';
    if (isset($_FILES['arquivo_principal']) && $_FILES['arquivo_principal']['error'] == UPLOAD_ERR_OK) {
        $arquivo_principal = '/API/assets/img/' . basename($_FILES['arquivo_principal']['name']);
        move_uploaded_file($_FILES['arquivo_principal']['tmp_name'], $arquivo_principal);
    }

  
    $stmt = $conexao->prepare("INSERT INTO animal (nome_animais) VALUES (?)");
    $stmt->bind_param("s", $nome_animal);

    if ($stmt->execute()) {
        header("Location: /API/assets/html/Login/loginCerto.html");
        exit(); 
    } else {
        header("Location: /API/assets/html/Login/loginErrado.html");
        exit(); 
    }

    $stmt->close();
}
?>
