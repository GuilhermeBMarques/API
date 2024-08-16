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

    // Processa o arquivo principal
    $arquivo_principal = '';
    if (isset($_FILES['arquivo_principal']) && $_FILES['arquivo_principal']['error'] == UPLOAD_ERR_OK) {
        $arquivo_principal = 'uploads/' . basename($_FILES['arquivo_principal']['name']);
        move_uploaded_file($_FILES['arquivo_principal']['tmp_name'], $arquivo_principal);
    }

    // Processa arquivos secundários
    $arquivos_secundarios = '';
    if (isset($_FILES['arquivos_secundarios']) && $_FILES['arquivos_secundarios']['error'][0] == UPLOAD_ERR_OK) {
        $arquivos_secundarios = 'uploads/';
        foreach ($_FILES['arquivos_secundarios']['name'] as $index => $filename) {
            $file_path = $arquivos_secundarios . basename($filename);
            move_uploaded_file($_FILES['arquivos_secundarios']['tmp_name'][$index], $file_path);
            $arquivos_secundarios .= $filename . ',';
        }
        $arquivos_secundarios = rtrim($arquivos_secundarios, ',');
    }

    $stmt = $conexao->prepare("INSERT INTO animal (nome_animais, responsavel_animais, gmail_animais, Whatsapp_animais, arquivo_principais, arquivos_secundarios, especie_animais, sexo_animais, faixaEtaria_animais, porte_animais, descricao_animais, estado_animais, cidade_animais) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssss", $nome_animal, $responsavel_animal, $gmail_animal, $Whatsapp_animal, $arquivo_principal, $arquivos_secundarios, $especie_animal, $sexo_animal, $faixaEtaria_animal, $porte_animal, $descricao_animal, $estado_animal, $cidade_animal);

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