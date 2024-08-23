<?php
session_start(); 
include_once __DIR__ . '/config.php'; 

// Verifica se o formulário foi submetido
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

    // Diretórios para salvar os uploads
    $upload_dir = __DIR__ . 'uploads/';  // Caminho do diretório de uploads no servidor
    $upload_url = '/php/uploads/';       // URL do diretório de uploads

    // Processa o arquivo principal
    $arquivo_principal_animal = ''; 
    if (isset($_FILES['arquivo_principal']) && $_FILES['arquivo_principal']['error'] == UPLOAD_ERR_OK) {
        $nome_arquivo_principal = uniqid() . '_' . basename($_FILES['arquivo_principal']['name']);
        $arquivo_principal_animal = $upload_dir . $nome_arquivo_principal;
        if (move_uploaded_file($_FILES['arquivo_principal']['tmp_name'], $arquivo_principal_animal)) {
            $arquivo_principal_animal = $upload_url . $nome_arquivo_principal; 
        }
    }

    // Processa arquivos secundários
    $arquivo_secundario_animal = ''; 
    if (isset($_FILES['arquivo_secundario']) && is_array($_FILES['arquivo_secundario']['name'])) {
        foreach ($_FILES['arquivo_secundario']['name'] as $index => $filename) {
            if ($_FILES['arquivo_secundario']['error'][$index] == UPLOAD_ERR_OK) {
                $nome_arquivo_secundario = uniqid() . '_' . basename($filename);
                $file_path = $upload_dir . $nome_arquivo_secundario;
                if (move_uploaded_file($_FILES['arquivo_secundario']['tmp_name'][$index], $file_path)) {
                    $arquivo_secundario_animal .= $upload_url . $nome_arquivo_secundario . ',';
                }
            }
        }
        $arquivo_secundario_animal = rtrim($arquivo_secundario_animal, ','); 
    }

    // Prepara e executa a consulta SQL para inserir os dados no banco
    $stmt = $conexao->prepare("INSERT INTO animal (nome_animais, responsavel_animais, gmail_animais, Whatsapp_animais, arquivo_principal_animais, arquivo_secundario_animais, especie_animais, sexo_animais, faixaEtaria_animais, porte_animais, descricao_animais, estado_animais, cidade_animais) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $nome_animal, $responsavel_animal, $gmail_animal, $Whatsapp_animal, $arquivo_principal_animal, $arquivo_secundario_animal, $especie_animal, $sexo_animal, $faixaEtaria_animal, $porte_animal, $descricao_animal, $estado_animal, $cidade_animal);

    if ($stmt->execute()) {
        header("Location: /API/assets/html/home.php");
        exit(); 
    } else {
        header("Location: /API/assets/html/Login/loginErrado.html");
        exit(); 
    }
    $stmt->close();
    $conexao->close(); 
}
?>
