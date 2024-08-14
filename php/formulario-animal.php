<?php
session_start(); 
include_once __DIR__ . '/config.php';

// Verifica se o formulário de registro foi submetido
if (isset($_POST['submit'])) {
    $nome_animal = $_POST['nome_animal'];
    $responsavel_animal = $_POST['responsavel_animal'];
    $gmail_animal = $_POST['gmail_animal'];
    $Whatsapp_animal = $_POST['Whatsapp_animal'];
    $arquivo_principal = $_POST['arquivo_principal'];
    $arquivos_secundarios = $_POST['arquivos_secundarios'];
    $especie_animal = $_POST['especie_animal'];
    $sexo_animal = $_POST['sexo_animal'];
    $faixaEtaria_animal = $_POST['faixaEtaria_animal'];
    $porte_animal = $_POST['porte_animal'];
    $caracteristicas_animal = $_POST['caracteristicas_animal'];
    $descricao_animal = $_POST['descricao_animal'];
    $estado_animal = $_POST['estado_animal'];
    $cidade_animal = $_POST['cidade_animal'];

    $stmt = $conexao->prepare("SELECT * FROM animal");
    $stmt->execute();
    $result = $stmt->get_result();

   
        $stmt = $conexao->prepare("INSERT INTO animal (nome_animais, responsavel_animais, gmail_animais, Whatsapp_animais, arquivo_principais, arquivos_secundarios, especie_animais, sexo_animais, faixaEtaria_animais, porte_animais, caracteristicas_animais, descricao_animais, estado_animais, cidade_animais) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sss", $nome_usuario, $senha_usuario, $email_usuario);
        if ($stmt->execute()) {
            $_SESSION['email_usuario'] = $email_usuario;
            header("Location: /API/assets/html/Login/loginCerto.html");
            exit(); 
        } else {
            header("Location: /API/assets/html/Login/loginErrado.html");
            exit(); 
        }
        $stmt->close();
    }
?>
