<?php
session_start();
include_once __DIR__ . '/../../php/config.php'; 

// Consulta para contar os animais por espécie
$query = "SELECT especie_animais, COUNT(*) as total FROM animal GROUP BY especie_animais";
$result = $conexao->query($query);

// Organiza os resultados em um array associativo
$animal_counts = [];
while ($row = $result->fetch_assoc()) {
    $animal_counts[$row['especie_animais']] = $row['total'];
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animais Disponíveis</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/sobre.css">
</head>
<body>
    <div class="container">
        <section class="animals">
            <h2>Animais Disponíveis para Adoção</h2>
            <ul>
                <?php foreach ($animal_counts as $especie => $total): ?>
                    <li class="animal-box">
                        <p class="animal"><?php echo htmlspecialchars($especie); ?></p>
                        <p class="count"><?php echo htmlspecialchars($total); ?> disponível</p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>
</body>
</html>
