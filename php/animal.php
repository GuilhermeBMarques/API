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
    $perdido_animal = $_POST['perdido_animal'];
    $estado_animal = $_POST['estado_animal'];
    $cidade_animal = $_POST['cidade_animal'];
    $id_usuario = $_SESSION['id_usuario']; 

    // Diretório de uploads
    $upload_dir = __DIR__ . '/uploads/';
    $upload_url = '/API/php/uploads/';

    // Upload do arquivo principal
    $arquivo_principal_animal = '';
    if (isset($_FILES['arquivo_principal']) && $_FILES['arquivo_principal']['error'] == UPLOAD_ERR_OK) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['arquivo_principal']['type'], $allowed_types)) {
            echo "Tipo de arquivo não permitido.";
            exit();
        }

        $nome_arquivo_principal = uniqid() . '_' . basename($_FILES['arquivo_principal']['name']);
        $arquivo_principal_animal = $upload_dir . $nome_arquivo_principal;

        if (move_uploaded_file($_FILES['arquivo_principal']['tmp_name'], $arquivo_principal_animal)) {
            $arquivo_principal_animal = $upload_url . $nome_arquivo_principal;
        } else {
            echo "Erro ao mover o arquivo principal: " . $_FILES['arquivo_principal']['tmp_name'] . "<br>";
            exit();
        }
    }

    // Prepara a consulta SQL para inserir os dados
    $stmt = $conexao->prepare("INSERT INTO animal (nome_animais, responsavel_animais, gmail_animais, Whatsapp_animais, arquivo_principal_animais, especie_animais, sexo_animais, faixaEtaria_animais, porte_animais, descricao_animais, perdido_animais, estado_animais, cidade_animais, id_usuarios) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssssss", $nome_animal, $responsavel_animal, $gmail_animal, $Whatsapp_animal, $arquivo_principal_animal, $especie_animal, $sexo_animal, $faixaEtaria_animal, $porte_animal, $descricao_animal, $perdido_animal, $estado_animal, $cidade_animal, $id_usuario);

    // Executa a consulta e redireciona ou exibe erros
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
?>
