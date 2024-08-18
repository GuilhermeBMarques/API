<?php
session_start();
include_once __DIR__ . '/../../php/config.php';

// Inicializa a consulta SQL
$sql = "SELECT * FROM animal WHERE 1=1";

// Verifica se os filtros foram aplicados e adiciona
$filters = [];
$params = [];
$types = '';

if (isset($_GET['estado']) && $_GET['estado'] !== '') {
    $filters[] = "estado_animais = ?";
    $params[] = $_GET['estado'];
    $types .= 's';
}

if (isset($_GET['especie']) && $_GET['especie'] !== '') {
    $filters[] = "especie_animais = ?";
    $params[] = $_GET['especie'];
    $types .= 's';
}

if (isset($_GET['porte']) && $_GET['porte'] !== '') {
    $filters[] = "porte_animais = ?";
    $params[] = $_GET['porte'];
    $types .= 's';
}

if (isset($_GET['sexo']) && $_GET['sexo'] !== '') {
    $filters[] = "sexo_animais = ?";
    $params[] = $_GET['sexo'];
    $types .= 's';
}

if (isset($_GET['faixaEtaria']) && $_GET['faixaEtaria'] !== '') {
    $filters[] = "faixaEtaria_animais = ?";
    $params[] = $_GET['faixaEtaria'];
    $types .= 's';
}

if (count($filters) > 0) {
    $sql .= " AND " . implode(' AND ', $filters);
}

$stmt = $conexao->prepare($sql);

if ($stmt === false) {
    die("Erro na preparação da consulta: " . $conexao->error);
}

if (count($params) > 0) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetAmigo</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/adote.css">
</head>
<body>
    <header>
        <h1 class="logo"><span style="color: #db7434">Pet</span>Amigo</h1>
        <nav>
            <ul>
                <li><a href="/API/assets/html/home.php">Home</a></li>
                <li><a href="/API/assets/html/buscarPet.html">Pet perdido</a></li>
                <li><a href="#">Perfil</a></li>
            </ul>
        </nav>
    </header>
    
    <section>
        <div class="search-container">
            <h1>Encontre seu novo melhor amigo(a)</h1>
            <form method="GET" action="adote.php">
                <!-- Your form content remains unchanged -->
                <select name="estado">
                    <option value="">Todos os Estados</option>
                    <!-- Options here -->
                </select>
                <select name="especie">
                    <option value="">Todas as espécies</option>
                    <!-- Options here -->
                </select>
                <select name="porte">
                    <option value="">Todos os tamanhos</option>
                    <!-- Options here -->
                </select>
                <select name="sexo">
                    <option value="">Todos os sexos</option>
                    <!-- Options here -->
                </select>
                <select name="faixaEtaria">
                    <option value="">Todas as idades</option>
                    <!-- Options here -->
                </select>
                <div class="btn">
                    <button type="submit">Filtrar</button>
                    <a href="adote.php">Limpar</a>
                </div>
            </form>
        </div>
    </section>

    <section class="animal-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($animal = $result->fetch_assoc()): ?>
                <div class="animal-card">
                    <img src="<?php echo htmlspecialchars($animal['arquivo_principais']); ?>" alt="Imagem do Animal">
                    <h2><?php echo htmlspecialchars($animal['nome_animais']); ?></h2>
                    <p><strong>Espécie:</strong> <?php echo htmlspecialchars($animal['especie_animais']); ?></p>
                    <p><strong>Sexo:</strong> <?php echo htmlspecialchars($animal['sexo_animais']); ?></p>
                    <p><strong>Faixa Etária:</strong> <?php echo htmlspecialchars($animal['faixaEtaria_animais']); ?></p>
                    <p><strong>Porte:</strong> <?php echo htmlspecialchars($animal['porte_animais']); ?></p>
                    <p><strong>Localização:</strong> <?php echo htmlspecialchars($animal['cidade_animais']); ?></p>
                    <p><strong>Estado:</strong> <?php echo htmlspecialchars($animal['estado_animais']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum animal encontrado.</p>
        <?php endif; ?>
    </section>

    <script src="script.js"></script>
</body>
</html>
