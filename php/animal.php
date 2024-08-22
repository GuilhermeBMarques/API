<?php
session_start(); 
include_once __DIR__ . '/config.php'; 

if (isset($_POST['submit'])) {
    $nome_animal = $_POST['nome_animal'];
    $responsavel_animal = $_POST['responsavel_animal'];
    $gmail_animal = $_POST['gmail_animal'];
    $Whatsapp_animal = $_POST['Whatsapp_animal'];
    $especie_animal = $_POST['especie_animal'];
    $sexo_animal = $_POST['sexo_animal'];
    $faixaEtaria_animal = $_POST['faixaEtaria_animal'];
    $porte_animal = $_POST['porte_animal'];
    $descricao_animal = $_POST['descricao_animal'];
    $estado_animal = $_POST['estado_animal'];
    $cidade_animal = $_POST['cidade_animal'];
    $arquivo_principal_animal = $_POST['arquivo_principal_animal'];
    $arquivo_secundario_animal = $_POST['arquivo_secundario_animal']; 

    $stmt = $conexao->prepare("INSERT INTO animal (nome_animais, responsavel_animais, gmail_animais, Whatsapp_animais, arquivo_principal_animais, arquivo_secundario_animais, especie_animais, sexo_animais, faixaEtaria_animais, porte_animais, descricao_animais, estado_animais, cidade_animais) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $nome_animal, $responsavel_animal, $gmail_animal, $Whatsapp_animal, $arquivo_principal_animal, $arquivo_secundario_animal, $especie_animal, $sexo_animal, $faixaEtaria_animal, $porte_animal, $descricao_animal, $estado_animal, $cidade_animal);

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
