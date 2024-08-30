<?php
session_start();
include_once __DIR__ . '/../../php/config.php';
include_once __DIR__ . '/../../php/verifique.php';

// Inicializa a consulta SQL
$sql = "SELECT * FROM animal WHERE 1=1";

// Verifica se os filtros foram aplicados e adiciona
if (isset($_GET['estado']) && $_GET['estado'] !== '') {
    $estado = $conexao->real_escape_string($_GET['estado']);
    $sql .= " AND estado_animais = '$estado'";
}
if (isset($_GET['especie']) && $_GET['especie'] !== '') {
    $especie = $conexao->real_escape_string($_GET['especie']);
    $sql .= " AND especie_animais = '$especie'";
}
if (isset($_GET['porte']) && $_GET['porte'] !== '') {
    $porte = $conexao->real_escape_string($_GET['porte']);
    $sql .= " AND porte_animais = '$porte'";
}
if (isset($_GET['sexo']) && $_GET['sexo'] !== '') {
    $sexo = $conexao->real_escape_string($_GET['sexo']);
    $sql .= " AND sexo_animais = '$sexo'";
}
if (isset($_GET['faixaEtaria']) && $_GET['faixaEtaria'] !== '') {
    $faixaEtaria = $conexao->real_escape_string($_GET['faixaEtaria']);
    $sql .= " AND faixaEtaria_animais = '$faixaEtaria'";
}

// Verifica se há uma busca e ajusta a SQL
if (!empty($_GET['search'])) {
    $data = $conexao->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM animal WHERE nome_animais LIKE '%$data%' OR especie_animais LIKE '%$data%' OR sexo_animais LIKE '%$data%' OR faixaEtaria_animais LIKE '%$data%' OR porte_animais LIKE '%$data%' OR estado_animais LIKE '%$data%' OR cidade_animais LIKE '%$data%' ORDER BY id_animal DESC";
}


// Executa a consulta
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetAmigo</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/adote.css">
    <script src="/API/assets/js/adote.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <!-- Navegação Desktop -->
    <nav class="navbarDesk">
        <a href="home.php">
            <h1><span style="color: #db7434">Pet</span>Amigo</h1>
        </a>
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

    <section>
        <div id="encontre">
            <h1 id="titulo">Encontre seu novo melhor amigo(a)</h1>
            <form method="GET" action="adote.php">
                <!-- Filtros -->
                <!-- (Filtros permanecem inalterados) -->
            </form>
        </div>
    </section>

    <div class="animal-list" id="animal-list">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($animal = $result->fetch_assoc()): ?>
                <div class="animal-card">
                    <a href="perfilPet.php?id=<?php echo htmlspecialchars(ucfirst($animal['id_animal'])); ?>">
                        <img src="<?php echo htmlspecialchars(ucfirst($animal['arquivo_principal_animais'])); ?>" alt="Imagem do animal">
                        <h2><?php echo htmlspecialchars(ucfirst($animal['nome_animais'])); ?></h2>
                        <p><strong>Espécie:</strong> <?php echo htmlspecialchars(ucfirst($animal['especie_animais'])); ?></p>
                        <p><strong>Sexo:</strong> <?php echo htmlspecialchars(ucfirst($animal['sexo_animais'])); ?></p>
                        <p><strong>Faixa Etária:</strong> <?php echo htmlspecialchars(ucfirst($animal['faixaEtaria_animais'])); ?></p>
                        <p><strong>Porte:</strong> <?php echo htmlspecialchars(ucfirst($animal['porte_animais'])); ?></p>
                        <p><strong>Estado:</strong> <?php echo htmlspecialchars(ucfirst($animal['estado_animais'])); ?></p>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhum animal encontrado.</p>
        <?php endif; ?>
    </div>

</body>

</html>