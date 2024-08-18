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

// Executa a consulta
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetAmigo</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/adotar.css">
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
        <div>
            <h1>Encontre seu novo melhor amigo(a)</h1>
            <form method="GET" action="adote.php">
                    <select name="especie">
                        <option value="">Todas as espécies</option>
                        <option value="Gato" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Gato' ? 'selected' : ''; ?>>Gato</option>
                        <option value="Pássaro" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Pássaro' ? 'selected' : ''; ?>>Pássaro</option>
                        <option value="Roedores" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Roedores' ? 'selected' : ''; ?>>Roedores</option>
                        <option value="Cachorro" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Cachorro' ? 'selected' : ''; ?>>Cachorro</option>
                    </select> 
    
                    <select name="porte">
                        <option value="">Todos os tamanhos</option>
                        <option value="Grande" <?php echo isset($_GET['porte']) && $_GET['porte'] == 'Grande' ? 'selected' : ''; ?>>Porte Grande</option>
                        <option value="Médio" <?php echo isset($_GET['porte']) && $_GET['porte'] == 'Médio' ? 'selected' : ''; ?>>Porte Médio</option>
                        <option value="Pequeno" <?php echo isset($_GET['porte']) && $_GET['porte'] == 'Pequeno' ? 'selected' : ''; ?>>Porte Pequeno</option>
                    </select>  

                    <select name="sexo">
                        <option value="">Todos os sexos</option>
                        <option value="Macho" <?php echo isset($_GET['sexo']) && $_GET['sexo'] == 'Macho' ? 'selected' : ''; ?>>Macho</option>
                        <option value="Fêmea" <?php echo isset($_GET['sexo']) && $_GET['sexo'] == 'Fêmea' ? 'selected' : ''; ?>>Fêmea</option>
                    </select>  

                    <select name="faixaEtaria">
                        <option value="">Todas as idades</option>
                        <option value="Filhote" <?php echo isset($_GET['faixaEtaria']) && $_GET['faixaEtaria'] == 'Filhote' ? 'selected' : ''; ?>>Filhote</option>
                        <option value="Adulto" <?php echo isset($_GET['faixaEtaria']) && $_GET['faixaEtaria'] == 'Adulto' ? 'selected' : ''; ?>>Adulto</option>
                        <option value="Senior" <?php echo isset($_GET['faixaEtaria']) && $_GET['faixaEtaria'] == 'Senior' ? 'selected' : ''; ?>>Senior</option>
                    </select>  

                    <div>
                    <button type="submit" class="btn">Filtrar</button>
                  <a href="adote.php" class="btn">Limpar</a>
                  </div>
           
            </form>
            </div>
        </section>

    <div class="animal-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($animal = $result->fetch_assoc()): ?>
                <div class="animal-card">
                    <img src="<?php echo htmlspecialchars($animal['arquivo_principais']); ?>">
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

    <script src="script.js"></script>
</body>
</html>