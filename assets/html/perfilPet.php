<?php
session_start();
include_once __DIR__ . '/../../php/config.php';
include_once __DIR__ . '/../../php/verifique.php';

// Verifica se o id do animal foi passado na URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Animal não encontrado.');
}

$id = $conexao->real_escape_string($_GET['id']);

// Consulta SQL para obter os detalhes do animal específico
$sql_animal = "SELECT * FROM animal WHERE id_animal = '$id'";
$result_animal = $conexao->query($sql_animal);

if ($result_animal && $result_animal->num_rows > 0) {
    $animal = $result_animal->fetch_assoc();
    $responsavel_id = $animal['id_usuarios']; // ID do usuário responsável pelo animal
} else {
    die('Animal não encontrado.');
}

// Consulta SQL para obter outros animais disponíveis
$sql_others = "SELECT * FROM animal WHERE id_animal != '$id'";
$result_others = $conexao->query($sql_others);

// Obtém o ID do usuário da sessão
$id_usuario_atual = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

// Verifica se a solicitação de exclusão foi feita
if (isset($_GET['delete']) && $_GET['delete'] == 'true') {
    if ($id_usuario_atual == $responsavel_id) {
        // Prepara a consulta DELETE para remover o animal
        $sqlDelete = "DELETE FROM animal WHERE id_animal = ?";
        $stmtDelete = $conexao->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $id);
        $stmtDelete->execute();

        if ($stmtDelete->affected_rows > 0) {
            header("Location: /API/assets/html/adote.php");
            exit();
        } else {
            echo "Erro ao deletar o animal.";
        }
        $stmtDelete->close();
    } else {
        echo "Você não tem permissão para deletar este animal.";
    }
}

$conexao->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Animal</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/perfilPet.css">
    <script src="/API/assets/js/perfilPet.js" defer></script>
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

    <div class="fotoPet">
        <img src="<?php echo htmlspecialchars($animal['arquivo_principal_animais']); ?>" alt="Imagem do animal">
    </div>

    <div class="container-pai">
        <header class="container1">
            <div class="animal-detalhes">
                <h1><?php echo htmlspecialchars($animal['nome_animais']); ?></h1>
                <ul>
                    <li>
                        <p><?php echo htmlspecialchars(ucfirst($animal['especie_animais'])); ?></p>
                    </li>
                    <li>
                        <p><?php echo htmlspecialchars(ucfirst($animal['sexo_animais'])); ?></p>
                    </li>
                    <li>
                        <p><?php echo htmlspecialchars(ucfirst($animal['faixaEtaria_animais'])); ?></p>
                    </li>
                    <li>
                        <p><?php echo htmlspecialchars(ucfirst($animal['porte_animais'])); ?></p>
                    </li>
                </ul>
                
                <p id="sobre"><strong>Sobre o <?php echo htmlspecialchars($animal['nome_animais']); ?> </strong></p>
                <p><?php echo htmlspecialchars(ucfirst($animal['descricao_animais'])); ?></p>
            </div>

            <div class="alerta">
                <button class="fechar" onclick="fechar()">X</button>
                <h3>Isto é um Alerta</h3>
                <p>O PetAmigo recomenda que você sempre deve tomar medidas de segurança razoáveis antes de fazer adoção.</p>
            </div>
        </header>

        <header class="container2">
            <div class="usuario">
                <h3> Quer me Adotar?</h3>
                <h4> FALE COM MEU TUTOR!</h4>
                <p><i class="bi bi-person-fill"></i> <?php echo htmlspecialchars(ucfirst($animal['responsavel_animais'])); ?></p>
                <p><strong>Whatsapp:</strong> <?php echo htmlspecialchars(ucfirst($animal['Whatsapp_animais'])); ?></p>
                <p><strong>Estado:</strong> <?php echo htmlspecialchars(ucfirst($animal['estado_animais'])); ?></p>
                <p><strong>Cidade:</strong> <?php echo htmlspecialchars(ucfirst($animal['cidade_animais'])); ?></p>
            </div>

            <div class="perguntas">
                <ul>
                    <li>
                        <strong>Adoção responsável</strong>
                        <button class="info-button" onclick="toggleInfo('adocao')">ℹ️</button>
                        <br>
                        <span class="info-message hidden" id="adocao-message">
                            Adotar um animal é um compromisso a longo prazo. Considere os seguintes pontos:
                            <br><br>
                            - Custos contínuos de cuidados (alimentação, veterinário, acessórios).
                            <br><br>
                            - Tempo diário para interação e cuidados.
                            <br><br>
                            - Preparação para treinamento e desafios comportamentais.
                            <br><br>
                            - Casa segura e adequada para o animal.
                            <br><br>
                            - Concordância de todos na casa.
                            <br><br>
                            - Integração com outros animais, se houver.
                            <br><br>
                        </span>
                    </li>

                    <li>
                        <strong>Aviso de responsabilidade</strong>
                        <button class="info-button" onclick="toggleInfo('responsabilidade')">ℹ️</button>
                        <br>
                        <span class="info-message hidden" id="responsabilidade-message">
                            O PetAmigo é um guia para encontrar animais e organizações de adoção. Entre em contato diretamente com a organização para confirmar a disponibilidade e detalhes.
                            <br><br>
                        </span>
                    </li>

                    <li>
                        <strong>Como posso adotar um pet que vejo no PetAmigo?</strong>
                        <button class="info-button" onclick="toggleInfo('adotar')">ℹ️</button>
                        <br>
                        <span class="info-message hidden" id="adotar-message">
                            Acesse o perfil do pet clicando na imagem dele para obter as informações de contato da organização responsável.
                            <br><br>
                        </span>
                    </li>

                    <li>
                        <strong>O animal de estimação que eu vejo no PetAmigo ainda é adotável?</strong>
                        <button class="info-button" onclick="toggleInfo('adotavel')">ℹ️</button>
                        <br>
                        <span class="info-message hidden" id="adotavel-message">
                            Verifique a disponibilidade do animal entrando em contato diretamente com a organização responsável através da página de perfil do pet.
                            <br><br>
                        </span>
                    </li>

                    <li>
                        <strong>Quais são os requisitos para adotar um animal de estimação?</strong>
                        <button class="info-button" onclick="toggleInfo('requisitos')">ℹ️</button>
                        <br>
                        <span class="info-message hidden" id="requisitos-message">
                            Os requisitos variam entre organizações. Para informações detalhadas, entre em contato diretamente com o grupo de adoção através da página de perfil do pet.
                            <br><br>
                        </span>
                    </li>

                    <li>
                        <strong>Como faço uma reclamação sobre um grupo de abrigo ou resgate?</strong>
                        <button class="info-button" onclick="toggleInfo('abrigoResgate')">ℹ️</button>
                        <br>
                        <span class="info-message hidden" id="abrigoResgate-message">
                            Para reclamações sobre um grupo de resgate listado no PetAmigo, entre em contato conosco diretamente com o nome completo do grupo, cidade e estado.
                            <br><br>
                        </span>
                    </li>
                </ul>
            </div>
        </header>


    </div>

    <div class="btns">
        <?php if ($id_usuario_atual == $responsavel_id): ?>
            <a class='btn btn-danger' href="perfilPet.php?id=<?php echo htmlspecialchars($id); ?>&delete=true">
                <i class="bi bi-trash3-fill"></i> Deletar Animal
            </a>

            <a class='btn btn-danger' href="perfilPet.php?id=<?php echo htmlspecialchars($id); ?>&delete=true">
                Para adoção
            </a>
        <?php endif; ?>
    </div>

    <div class="pets">
        <h1> Outros Pets </h1>
        <div class="animal-list" id="animal-list">
            <?php if ($result_others && $result_others->num_rows > 0): ?>
                <?php while ($other_animal = $result_others->fetch_assoc()): ?>
                    <div class="animal-card">
                        <a href="perfilPet.php?id=<?php echo htmlspecialchars($other_animal['id_animal']); ?>">
                            <img src="<?php echo htmlspecialchars($other_animal['arquivo_principal_animais']); ?>" alt="Imagem do animal">
                            <h2><?php echo htmlspecialchars($other_animal['nome_animais']); ?></h2>
                            <p><strong>Espécie:</strong> <?php echo htmlspecialchars($other_animal['especie_animais']); ?></p>
                            <p><strong>Sexo:</strong> <?php echo htmlspecialchars($other_animal['sexo_animais']); ?></p>
                            <p><strong>Faixa Etária:</strong> <?php echo htmlspecialchars($other_animal['faixaEtaria_animais']); ?></p>
                            <p><strong>Porte:</strong> <?php echo htmlspecialchars($other_animal['porte_animais']); ?></p>
                            <p><strong>Estado:</strong> <?php echo htmlspecialchars($other_animal['estado_animais']); ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhum animal encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>