<?php
session_start();
include_once __DIR__ . '/../../php/config.php';

$sql = "SELECT * FROM animal";
$result = $conexao->query($sql);
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
            <div class="filters">
                <select>
                    <option>Todos os Estados</option>
                    <option >AC</option>
                    <option >AL</option>
                    <option >AP</option>
                    <option >AM</option>
                    <option >BA</option>
                    <option >CE</option>
                    <option >ES</option>
                    <option >GO</option>
                    <option >MA</option>
                    <option >MT</option>
                    <option >MS</option>
                    <option >MG</option>
                    <option >PA</option>
                    <option >PB</option>
                    <option >PR</option>
                    <option >PE</option>
                    <option >PI</option>
                    <option >RJ</option>
                    <option >RN</option>
                    <option >RS</option>
                    <option >RO</option>
                    <option >RR</option>
                    <option >SC</option>
                    <option >SP</option>
                    <option >SE</option>
                    <option >TO</option>
                </select>

                <select>
                    <option >Todas as espécie</option>
                    <option >Gato</option>
                    <option >Pássaro</option>
                    <option >Roedores</option>
                    <option >Cachorro</option>
                </select> 
    
                    <select>
                        <option >Todos os tamanhos</option>
                        <option >Porte Grande</option>
                        <option >Porte Médio</option>
                        <option >Porte Pequeno</option>
                    </select>  

                    <select>
                        <option >Todos os sexo</option>
                        <option >Macho</option>
                        <option >Fêmea</option>
                    </select>  

                    <select>
                        <option >Todas as idades </option>
                        <option >Filhote</option>
                        <option >Adulto</option>
                        <option >Senior</option>
                    </select>  
            </div>
    </section>

    <section class="animal-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($animal = $result->fetch_assoc()): ?>
                <div class="animal-card">
                    <img src="<?php echo htmlspecialchars($animal['arquivo_principais']); ?>">
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
