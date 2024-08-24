<?php
session_start();
include_once __DIR__ . '/../../php/config.php'; 

// Inicializa a consulta SQL
$sql = "SELECT * FROM animal WHERE 1=1";

// Verifica se os filtros foram aplicados e adiciona
if (isset($_GET['especie']) && $_GET['especie'] !== '') {
    $especie = $conexao->real_escape_string($_GET['especie']);
    $sql .= " AND especie_animais = '$especie'";
}

$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adote</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/home.css">
    <script src="/API/assets/js/home.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <!-- Navegação Desktop -->
    <nav class="navbarDesk">
        <a href="home.php"><h1><span style="color: #db7434">Pet</span>Amigo</h1></a>
        <ul>
            <li><a href="/API/assets/html/home.php">Home</a></li>
            <li><a href="#">Favoritos</a></li>
            <li><a href="#">Sobre Nós</a></li>
            <li><a href="/API/assets/html/perfil.php">Perfil</a></li>
        </ul>
    </nav>

     <!-- Navegação Mobile -->
    <nav class="navbarMoba">
        <ul>
            <li><a href="/API/assets/html/home.php"><i class="bi bi-house-fill"></i></a></li>
            <li><a href="#"><i class="bi bi-heart-fill"></i></a></li>
            <li><a href="#"><i class="bi bi-info-circle-fill"></i></a></li>
            <li><a href="/API/assets/html/perfil.php"><i class="bi bi-person-fill"></i></a></li>
        </ul>
    </nav>

    <section class="slider">
        <div class="slider-content">

        <input type="radio" name="btn-radio" id="radio1">
        <input type="radio" name="btn-radio" id="radio2">
        <input type="radio" name="btn-radio" id="radio3">
        <input type="radio" name="btn-radio" id="radio4">

        <div class="slide-box primeiro">
            <img class="img-desktop" src="/API/assets/img/ad.jpg" alt="">
            <img class="img-mobile" src="/API/assets/img/ad.jpg" alt="">
        </div>

        <div class="slide-box">
            <img class="img-desktop" src="/API/assets/img/ad2.jpg" alt="">
            <img class="img-mobile" src="/API/assets/img/ad2.jpg" alt="">
        </div>

        <div class="slide-box">
            <img class="img-desktop" src="/API/assets/img/ad3.jpg" alt="">
            <img class="img-mobile" src="/API/assets/img/ad3.jpg" alt="">
        </div>

        <div class="slide-box">
            <img class="img-desktop" src="/API/assets/img/ad4.jpg" alt="">
            <img class="img-mobile" src="/API/assets/img/ad4.jpg" alt="">
        </div>

        <div class="nav-auto">
            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn3"></div>
            <div class="auto-btn4"></div>
        </div>

        <div class="nav-manual">
            <label for="radio1" class="manual-btn"></label>
            <label for="radio2" class="manual-btn"></label>
            <label for="radio3" class="manual-btn"></label>
            <label for="radio4" class="manual-btn"></label>
        </div>
        </div>
    </section>

    <section class="botoes">
    <a href="/API/assets/html/adote.php" class="btn">
    <h1>🐾</h1>
        <h3>Adote</h3>
        <p>Quero Adotar um Pet</p>
    </a>

    <a href="/API/assets/html/divulgar.html" class="btn">
    <h1>🐶</h1>
        <h3>Divulgar Pet</h3>
        <p>Quero Divulgar um Pet</p>
    </a>

    <a href="#" class="btn">
    <h1>📣</h1>
        <h3>Divulgar Marca</h3>
        <p>Quero Divulgar minha Marca</p>
    </a>
</section>

<section class="botoes-animal">
    <a href="home.php?especie=cachorro" class="btn-animal">
        <h1>🐶</h1>
        <p>Cachorros</p>
    </a>

    <a href="home.php?especie=gato" class="btn-animal">
        <h1>🐱</h1>
        <p>Gatos</p>
    </a>

    <a href="home.php?especie=coelho" class="btn-animal">
        <h1>🐰</h1>
        <p>Coelhos</p>
    </a>

    <a href="home.php?especie=roedor" class="btn-animal">
        <h1>🐹</h1>
        <p>Roedores</p>
    </a>

    <a href="home.php?especie=pássaro" class="btn-animal">
        <h1>🐦</h1>
        <p>Pássaros</p>
    </a>

    <a href="home.php" class="btn-animal">
        <h1>∞</h1>
        <p>Todos</p>
    </a>
</section>

<div class="animal-list">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($animal = $result->fetch_assoc()): ?>
                <div class="animal-card">
                <img src="<?php echo htmlspecialchars($animal['arquivo_principal_animais']); ?>" alt="Imagem do animal">
                    <h2><?php echo htmlspecialchars($animal['nome_animais']); ?></h2>
                    <p><strong>Espécie:</strong> <?php echo htmlspecialchars($animal['especie_animais']); ?></p>
                    <p><strong>Sexo:</strong> <?php echo htmlspecialchars($animal['sexo_animais']); ?></p>
                    <p><strong>Faixa Etária:</strong> <?php echo htmlspecialchars($animal['faixaEtaria_animais']); ?></p>
                    <p><strong>Porte:</strong> <?php echo htmlspecialchars($animal['porte_animais']); ?></p>
                    <p><strong>Estado:</strong> <?php echo htmlspecialchars($animal['estado_animais']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum animal encontrado.</p>
        <?php endif; ?>
    </div>

</body>
</html>