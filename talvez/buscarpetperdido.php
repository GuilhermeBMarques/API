<?php
session_start();
include_once __DIR__ . '/../../php/config.php';

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
    <link rel="stylesheet" href="/API/assets/css/buscarPet.css">
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

    <section>
        <div>
            <h1 id="titulo" >Encontre seu amigo perdido</h1>
            <form method="GET" action="adote.php">

            <select name="estado">
                        <option value="">Todas os estados</option>
                        <option value="AC" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'AC' ? 'selected' : ''; ?>>AC</option>
                        <option value="AL" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'AL' ? 'selected' : ''; ?>>AL</option>
                        <option value="AP" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'AP' ? 'selected' : ''; ?>>AP</option>
                        <option value="AM" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'AM' ? 'selected' : ''; ?>>AM</option>
                        <option value="BA" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'BA' ? 'selected' : ''; ?>>BA</option>
                        <option value="CE" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'CE' ? 'selected' : ''; ?>>CE</option>
                        <option value="ES" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'ES' ? 'selected' : ''; ?>>ES</option>
                        <option value="GO" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'GO' ? 'selected' : ''; ?>>GO</option>
                        <option value="MA" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'MA' ? 'selected' : ''; ?>>MA</option>
                        <option value="MT" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'MT' ? 'selected' : ''; ?>>MT</option>
                        <option value="MS" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'MS' ? 'selected' : ''; ?>>MS</option>
                        <option value="MG" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'MG' ? 'selected' : ''; ?>>MG</option>
                        <option value="PA" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PA' ? 'selected' : ''; ?>>PA</option>
                        <option value="PB" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PB' ? 'selected' : ''; ?>>PB</option>
                        <option value="PR" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PR' ? 'selected' : ''; ?>>PR</option>
                        <option value="PE" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PE' ? 'selected' : ''; ?>>PE</option>
                        <option value="PI" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PI' ? 'selected' : ''; ?>>PI</option>
                        <option value="RJ" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RJ' ? 'selected' : ''; ?>>RJ</option>
                        <option value="RN" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RN' ? 'selected' : ''; ?>>RN</option>
                        <option value="RS" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RS' ? 'selected' : ''; ?>>RS</option>
                        <option value="RO" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RO' ? 'selected' : ''; ?>>RO</option>
                        <option value="RR" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RR' ? 'selected' : ''; ?>>RR</option>
                        <option value="SC" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'SC' ? 'selected' : ''; ?>>SC</option>
                        <option value="SP" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'SP' ? 'selected' : ''; ?>>SP</option>
                        <option value="SE" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'SE' ? 'selected' : ''; ?>>SE</option>
                        <option value="TO" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'TO' ? 'selected' : ''; ?>>TO</option>
                    </select> 


                    <select name="especie">
                        <option value="">Todas as espécies</option>
                        <option value="Cachorro" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Cachorro' ? 'selected' : ''; ?>>Cachorro</option>
                        <option value="Gato" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Gato' ? 'selected' : ''; ?>>Gato</option>
                        <option value="Coelho" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Coelho' ? 'selected' : ''; ?>>Coelho</option>
                        <option value="Roedores" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Roedores' ? 'selected' : ''; ?>>Roedor</option>
                        <option value="Pássaro" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Pássaro' ? 'selected' : ''; ?>>Pássaro</option>                   
                    </select> 

                    <select name="sexo">
                        <option value="">Todos os sexos</option>
                        <option value="Macho" <?php echo isset($_GET['sexo']) && $_GET['sexo'] == 'Macho' ? 'selected' : ''; ?>>Macho</option>
                        <option value="Fêmea" <?php echo isset($_GET['sexo']) && $_GET['sexo'] == 'Fêmea' ? 'selected' : ''; ?>>Fêmea</option>
                    </select>  

                    <div class="button-container">
                        <button type="submit" class="btn btn-primary">
                            <i   class="fas fa-plus"></i> Adicionar animal perdido
                        </button>
                        <button type="submit" class="btn">Filtrar</button>
                        <a href="buscarpetperdido.php" class="btn btn-secondary">
                            <i class="fas fa-eraser"></i> Limpar
                        </a>
                    </div>
           
            </form>
            </div>
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