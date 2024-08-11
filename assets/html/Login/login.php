<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/APi/assets/css/reset.css">
    <link rel="stylesheet" href="/APi/assets/css/Login/login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    
    <!-- Contêiner de Login -->
<div id="loginContainer" class="loginContainer">
    <header class="crieConta">
        <h2>Entre na sua conta</h2>
        <h1><span style="color: #db7434 ">Pet</span>Amigo</h1>
    </header>
    <form id="loginForm" action="/API/php/formulario-usuarios.php" method="POST">
    <div class="dados">
        <label for="loginEmail"><i class="bi bi-person-fill"></i></label>
        <input type="text" id="loginEmail" name="email_usuario" required placeholder="Email de Usuário">
    </div>
    <div class="dados">
        <label for="loginSenha"><i class="bi bi-lock-fill"></i></label>
        <input type="password" id="loginSenha" name="senha_usuario" required placeholder="Senha">
    </div>
    <!-- Botão de envio com nome "loginForm" -->
    <button type="submit" name="loginForm" class="w-full bg-blue-500 text-white py-2 rounded-lg">Entrar</button> 
        <br>
        <p>Ou</p>
        <br>
        <button type="button" id="showRegister" class="w-full bg-gray-500 text-white py-2 rounded-lg mt-4">Não possui uma conta? Cadastre-se</button>
        <div id="loginResponse" class="mt-4"></div>
    </form>
</div>

<!-- Contêiner de Registro -->
<div id="registerContainer" class="registerContainer hidden">
    <header class="crieConta">
        <h2>Crie sua conta</h2>
        <h1><span style="color: #db7434;">Pet</span>Amigo</h1>
    </header>
    <form id="registerForm" action="/API/php/formulario-usuarios.php" method="POST">
        <div class="dados">
            <label for="registerNome"><i class="bi bi-person-fill"></i></label>
            <input type="text" id="registerNome" name="nome_usuario" required placeholder="Nome de Usuário">
        </div>
        <div class="dados">
            <label for="registerSenha"><i class="bi bi-lock-fill"></i></label>
            <input type="password" id="registerSenha" name="senha_usuario" required placeholder="Senha">
        </div>
        <div class="dados">
            <label for="registerEmail"><i class="bi bi-envelope-fill"></i></label>
            <input type="email" id="registerEmail" name="email_usuario" required placeholder="Email">
        </div>
        <button type="submit" name="submit" class="w-full bg-green-500 text-white py-2 rounded-lg">Registrar</button>
        <br>
        <button type="button" id="showLogin" class="w-full bg-gray-500 text-white py-2 rounded-lg mt-4">Voltar para o login</button>
    </form>
    <div id="registerResponse" class="mt-4"></div>
</div>

<script>
    // Alterna entre os formulários de login e registro
    document.getElementById('showRegister').addEventListener('click', function() {
        document.getElementById('loginContainer').classList.add('hidden');
        document.getElementById('registerContainer').classList.remove('hidden');
    });

    document.getElementById('showLogin').addEventListener('click', function() {
        document.getElementById('registerContainer').classList.add('hidden');
        document.getElementById('loginContainer').classList.remove('hidden');
    });
</script>
</body>
</html>
