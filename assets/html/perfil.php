<?php
session_start();
include_once __DIR__ . '/../../php/config.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['email_usuario'])) {
    header("Location: /API/assets/html/Login/loginErro.html");
    exit();
}

/*
// Recupera o email do usuário da sessão
$email_usuario = $_SESSION['email_usuario'];

// Prepara a consulta para recuperar informações do usuário
$stmt = $conexao->prepare("SELECT nome_usuarios, email_usuarios FROM usuarios WHERE email_usuarios=?");
$stmt->bind_param("s", $email_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário foi encontrado
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nome_usuario = htmlspecialchars($user['nome_usuarios']);
    $email_usuario = htmlspecialchars($user['email_usuarios']);
} else {
    header("Location: /API/assets/html/Login/loginErro.html");
    exit();
}
$stmt->close();
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/perfil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <!-- Navegação Desktop -->
    <nav class="navbarDesk">
        <a href="home.php"><h1><span style="color: #db7434">Pet</span>Amigo</h1></a>
        <ul>
            <li><a href="/API/assets/html/home.php">Home</a></li>
            <li><a href="/API/assets/html/sobre.php">Sobre Nós</a></li>
            <li><a href="/API/assets/html/perfil.php">Perfil</a></li>
        </ul>
    </nav>

    <!-- Navegação Mobile -->
    <nav class="navbarMoba">
        <ul>
            <li><a href="/API/assets/html/home.php"><i class="bi bi-house-fill"></i></a></li>
            <li><a href="/API/assets/html/sobre.php"><i class="bi bi-info-circle-fill"></i></a></li>
            <li><a href="/API/assets/html/perfil.php"><i class="bi bi-person-fill"></i></a></li>
        </ul>
    </nav>


    <div id="img">
        <i class="bi bi-person-circle"></i>
     <!--   <h1><?php echo $nome_usuario; ?></h1> -->
    </div>
      <!-- 
    <div class="perfil-list">
        <ul>
        <li>
        <p><strong>Email:</strong> <?php echo $email_usuario; ?></p>
        </li>
        <li>
        <p><strong>Email:</strong> <?php echo $email_usuario; ?></p>
        </li>
        <li>
        <p><strong>Email:</strong> <?php echo $email_usuario; ?></p>
        </li>
        </ul>
    </div>
-->

    <form id="updateForm">
        <div class="dados">
        <label>Usuario:</label>
        <input type="text" id="updateNome_usuario">
        </div>
        <div class="dados">
        <label>Gmail:</label>
        <input type="text" id="updategmail_usuario">
        </div>
        <div class="dados">
        <label>Senha:</label>
        <input type="text" id="updatesenha_usuario">
        </div>
        <button> Update </button>
    </form>

    <div id="userInfoContainer" > 
            <h2>User Information</h2> 
            <div class="dados">
                <label>Nome: </label> 
                <span id="nome_usuario"></span> 
            </div>
            <div class="dados">
                <label>Email: </label>
                <span id="email_usuario"></span> 
            </div>
            <button id="deleteUsuario">Deletar Conta</button> 
        </div>
</div>

<a href="/API/assets/html/Login/login.html" class="btn">Sair</a>

        <script>
        // Preenche os campos do formulário com os dados do usuário armazenados na sessão
        document.addEventListener('DOMContentLoaded', function() {
            const nome_usuario = sessionStorage.getItem('nome_usuario');
            const email_usuario = sessionStorage.getItem('email_usuario');

            document.getElementById('updatenome_usuario').value = nome_usuario;
            document.getElementById('updateemail_usuario').value = email_usuario;

            document.getElementById('userInfonome_usuario').innerText = nome_usuario;
            document.getElementById('userInfoemail_usuario').innerText = email_usuario;
        });

        // Submissão do formulário de atualização
        document.getElementById('updateForm').addEventListener('submit', async function(event) {
            event.preventDefault(); // Previne o comportamento padrão do formulário
            const nome_usuario = document.getElementById('updatenome_usuario').value;
            const senha_usuario = document.getElementById('updatesenha_usuario').value;
            const email_usuario = document.getElementById('updateemail_usuario').value;

            // Envia os dados de atualização para o servidor
            const response = await fetch('server.php?action=update', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nome_usuario, senha_usuario, email_usuario })
            });

            const result = await response.json(); // Converte a resposta em JSON
            document.getElementById('updateResponse').innerText = result.message; // Exibe a mensagem de resposta
            if (result.success) {
                sessionStorage.setItem('email_usuario', email_usuario); // Atualiza o email_usuario armazenado na sessão
                document.getElementById('userInfoemail_usuario').innerText = email_usuario; // Atualiza o email exibido
            }
        });

        // Deletar a conta do usuário
        document.getElementById('deleteUser').addEventListener('click', async function() {
            const nome_usuario = sessionStorage.getItem('nome_usuario');

            // Envia a solicitação de deleção para o servidor
            const response = await fetch('config.php?action=delete', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ nome_usuario })
            });

            const result = await response.json(); // Converte a resposta em JSON
            alert(result.message); // Exibe a mensagem de resposta
            if (result.success) {
                sessionStorage.clear(); // Limpa os dados armazenados na sessão
                window.location.href = 'index.html'; // Redireciona para a página de login
            }
        });
    </script>
</body>
</html>


