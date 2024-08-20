<?php
session_start();
include_once __DIR__ . '/../../php/config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adote</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <nav class="navbarDesk">
        <a href="home.php"><h1><span style="color: #db7434">Pet</span>Amigo</h1></a>
        <ul>
            <li><a href="/API/assets/html/home.php">Home</a></li>
            <li><a href="#">Favoritos</a></li>
            <li><a href="/API/assets/html/perfil.php">Perfil</a></li>
        </ul>
    </nav>

    <section class="AD">
    </section>

    <section class="botoes">
        <a href="/API/assets/html/adote.php" class="btn">
            <span class="icon">👍</span> Quero Adotar um Pet
        </a>

        <a href="/API/assets/html/divulgar.php" class="btn">
            <span class="icon">📣</span> Quero Divulgar um Pet
        </a>
    </section>


    <footer style="text-align:center; padding:15%;">
        <p style="font-size:50px; font-weight:bold;">
        Usuario: <?php 
        if(isset($_SESSION['email_usuario'])){
            $email_usuario = $_SESSION['email_usuario'];
            $query = mysqli_query($conexao, "SELECT nome_usuarios FROM usuarios WHERE email_usuarios='$email_usuario'");
            if($row = mysqli_fetch_assoc($query)){
                echo htmlspecialchars($row['nome_usuarios'], ENT_QUOTES, 'UTF-8');
            } else {
                echo "Usuário não encontrado.";
            }
        } else {
            echo "Usuário não logado.";
        }
        ?>
        </p>
    </footer>
    
    <script src="/API/assets/js/home.js"></script>
</body>
</html>