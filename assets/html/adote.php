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
if (isset($_GET['perdido']) && $_GET['perdido'] !== '') {
    $perdido = $conexao->real_escape_string($_GET['perdido']);
    $sql .= " AND perdido_animais = '$perdido'";
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

                <select name="estado">
                    <option value="">Todos os estados</option>
                    <option value="AC" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'AC' ? 'selected' : ''; ?>>Acre</option>
                    <option value="AL" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'AL' ? 'selected' : ''; ?>>Alagoas</option>
                    <option value="AP" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'AP' ? 'selected' : ''; ?>>Amapá</option>
                    <option value="AM" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'AM' ? 'selected' : ''; ?>>Amazonas</option>
                    <option value="BA" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'BA' ? 'selected' : ''; ?>>Bahia</option>
                    <option value="CE" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'CE' ? 'selected' : ''; ?>>Ceará</option>
                    <option value="ES" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'ES' ? 'selected' : ''; ?>>Espírito Santo</option>
                    <option value="GO" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'GO' ? 'selected' : ''; ?>>Goiás</option>
                    <option value="MA" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'MA' ? 'selected' : ''; ?>>Maranhão</option>
                    <option value="MT" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'MT' ? 'selected' : ''; ?>>Mato Grosso</option>
                    <option value="MS" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'MS' ? 'selected' : ''; ?>>Mato Grosso do Sul</option>
                    <option value="MG" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'MG' ? 'selected' : ''; ?>>Minas Gerais</option>
                    <option value="PA" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PA' ? 'selected' : ''; ?>>Pará</option>
                    <option value="PB" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PB' ? 'selected' : ''; ?>>Paraíba</option>
                    <option value="PR" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PR' ? 'selected' : ''; ?>>Paraná</option>
                    <option value="PE" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PE' ? 'selected' : ''; ?>>Pernambuco</option>
                    <option value="PI" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'PI' ? 'selected' : ''; ?>>Piauí</option>
                    <option value="RJ" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RJ' ? 'selected' : ''; ?>>Rio de Janeiro</option>
                    <option value="RN" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RN' ? 'selected' : ''; ?>>Rio Grande do Norte</option>
                    <option value="RS" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RS' ? 'selected' : ''; ?>>Rio Grande do Sul</option>
                    <option value="RO" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RO' ? 'selected' : ''; ?>>Rondônia</option>
                    <option value="RR" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'RR' ? 'selected' : ''; ?>>Roraima</option>
                    <option value="SC" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'SC' ? 'selected' : ''; ?>>Santa Catarina</option>
                    <option value="SP" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'SP' ? 'selected' : ''; ?>>São Paulo</option>
                    <option value="SE" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'SE' ? 'selected' : ''; ?>>Sergipe</option>
                    <option value="TO" <?php echo isset($_GET['estado']) && $_GET['estado'] == 'TO' ? 'selected' : ''; ?>>Tocantins</option>
                </select>

                <select name="especie">
                    <option value="">Todas as espécies</option>
                    <option value="Cachorro" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Cachorro' ? 'selected' : ''; ?>>Cachorro</option>
                    <option value="Gato" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Gato' ? 'selected' : ''; ?>>Gato</option>
                    <option value="Coelho" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Coelho' ? 'selected' : ''; ?>>Coelho</option>
                    <option value="Roedor" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Roedor' ? 'selected' : ''; ?>>Roedor</option>
                    <option value="Pássaro" <?php echo isset($_GET['especie']) && $_GET['especie'] == 'Pássaro' ? 'selected' : ''; ?>>Pássaro</option>
                </select>

                <select name="porte">
                    <option value="">Todos os tamanhos</option>
                    <option value="Pequeno" <?php echo isset($_GET['porte']) && $_GET['porte'] == 'Pequeno' ? 'selected' : ''; ?>>Porte Pequeno</option>
                    <option value="Médio" <?php echo isset($_GET['porte']) && $_GET['porte'] == 'Médio' ? 'selected' : ''; ?>>Porte Médio</option>
                    <option value="Grande" <?php echo isset($_GET['porte']) && $_GET['porte'] == 'Grande' ? 'selected' : ''; ?>>Porte Grande</option>
                </select>

                <select name="perdido">
                    <option value="">Animal perdido</option>
                    <option value="nao" <?php echo isset($_GET['perdido']) && $_GET['perdido'] == 'nao' ? 'selected' : ''; ?>>Não</option>
                    <option value="sim" <?php echo isset($_GET['perdido']) && $_GET['perdido'] == 'sim' ? 'selected' : ''; ?>>Sim</option>
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
                    <option value="Idoso" <?php echo isset($_GET['faixaEtaria']) && $_GET['faixaEtaria'] == 'Idoso' ? 'selected' : ''; ?>>Idoso</option>
                </select>

                <div>
                    <button type="submit" class="btn">Filtrar</button>
                    <a href="adote.php" class="btn">Limpar</a>
                </div>

                <div class="box-search">
                    <input type="search" class="btn-pesquisa" placeholder="Pesquisar" id="pesquisar">
                    <button onclick="searchData()" class="btn">
                        <i class="bi bi-search"></i>
                    </button>
                </div>

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