<?php
session_start();
include_once __DIR__ . '/config.php';
include_once __DIR__ . '/verifique.php';

// Verifica se o formulário foi submetido
if (isset($_POST['registerAnimal'])) {
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

    // Obtém o ID do usuário logado
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
    } else {
        // Encerra o script se o usuário não estiver autenticado
        die('Usuário não autenticado.');
    }

    // Diretórios para salvar as fotos dos pets
    $upload_dir = __DIR__ . '/uploads/';
    $upload_url = '/API/php/uploads/';

    // Processa o arquivo principal, ele gera um nome unico pro arquivo, leva até o caminho completo e atualiza a URl
    $arquivo_principal_animal = '';
    if (isset($_FILES['arquivo_principal']) && $_FILES['arquivo_principal']['error'] == UPLOAD_ERR_OK) {
        $nome_arquivo_principal = uniqid() . '_' . basename($_FILES['arquivo_principal']['name']);
        $arquivo_principal_animal = $upload_dir . $nome_arquivo_principal;
        if (move_uploaded_file($_FILES['arquivo_principal']['tmp_name'], $arquivo_principal_animal)) {
            $arquivo_principal_animal = $upload_url . $nome_arquivo_principal;
        } else {
            echo "Erro ao mover o arquivo principal: " . $_FILES['arquivo_principal']['tmp_name'] . "<br>";
        }
    }

    // Prepara e executa a consulta SQL para inserir os dados no banco
    $stmt = $conexao->prepare("INSERT INTO animal (nome_animais, responsavel_animais, gmail_animais, Whatsapp_animais, arquivo_principal_animais, especie_animais, sexo_animais, faixaEtaria_animais, porte_animais, descricao_animais, estado_animais, cidade_animais, id_usuarios) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $nome_animal, $responsavel_animal, $gmail_animal, $Whatsapp_animal, $arquivo_principal_animal, $especie_animal, $sexo_animal, $faixaEtaria_animal, $porte_animal, $descricao_animal, $estado_animal, $cidade_animal, $id_usuario);

    if ($stmt->execute()) {
        header("Location: /API/assets/html/home.php");
        exit();
    } else {
        echo "Erro ao executar a consulta SQL: " . $stmt->error;
        exit();
    }

    $stmt->close();
    $conexao->close();
}
