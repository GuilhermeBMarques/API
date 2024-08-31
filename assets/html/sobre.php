<?php
session_start();
include_once __DIR__ . '/../../php/config.php';
include_once __DIR__ . '/../../php/verifique.php';

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
    <title>Sobre Nós</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/sobre.css">
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

    <div class="container" >
        <h2>Sobre nós</h2>
        <P>
            Criamos este site com o objetivo de facilitar a adoção de animais que, infelizmente, foram separados de seus lares devido à 
            recente tragédia das enchentes em nosso estado. Sabemos que muitos animais ainda estão perdidos, longe de seus donos, e queremos 
            ajudar a reunir essas famílias. No futuro, planejamos adicionar mais funcionalidades ao site para ampliar ainda mais nossa missão 
            de proteção e cuidado com esses animais.
    <br>
            Nossa missão é utilizar a tecnologia da Internet e os recursos que ela pode gerar para:
            <ul>
                <li>
                    Aumentar a conscientização pública sobre a disponibilidade de animais de estimação adotáveis.
                </li>
                <li>
                    Aumentar a eficácia geral dos programas de adoção de animais de estimação em todo o Brasil.
                </li>
                <li>
                    Somos inovadores digitais, sempre à procura de formas de aproveitar os últimos avanços no mundo da tecnologia para resolver os grandes problemas e desafios que os animais de estimação de resgate enfrentam no Brasil.
                </li>
                <li>
                    Promover a defesa através de todas as campanhas, programas e serviços inovadores que criamos e fornecemos, defendemos ativamente o salvamento de animais de estimação.
                </li>    
            </ul>
        </P>
    </div>

    <div class="container">
        <h2>Animais Disponíveis para Adoção</h2>
        <section class="animals">
            <ul>
                <?php foreach ($animal_counts as $especie => $total): ?>
                    <li class="animal-box">
                        <p class="animal"><?php echo htmlspecialchars($especie); ?></p>
                        <p class="count"><?php echo htmlspecialchars($total); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>
</body>
</html>