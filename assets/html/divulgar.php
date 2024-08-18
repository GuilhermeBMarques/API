<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divulgue seu Animal</title>
    <link rel="stylesheet" href="/API/assets/css/reset.css">
    <link rel="stylesheet" href="/API/assets/css/divulgar.css">
</head>
<body>

<form id="registerAnimal" action="/API/php/formulario-animal.php" method="POST" enctype="multipart/form-data">
    <div class="dados">
        <label for="registerNome">Nome do animal:</label>
        <input type="text" id="registerNome" name="nome_animal" required placeholder="Nome do animal">
    </div>

    <div class="dados">
        <label for="registerResponsavel">Responsável do animal:</label>
        <input type="text" id="registerResponsavel" name="responsavel_animal" required placeholder="Responsável do animal">
    </div>

    <div class="dados">
        <label for="registerGmail">Gmail do responsável:</label>
        <input type="email" id="registerGmail" name="gmail_animal" required placeholder="Gmail do responsável">
    </div>

    <div class="dados">
        <label for="registerWhatsapp">Whatsapp do responsável:</label>
        <input type="text" id="registerWhatsapp" name="Whatsapp_animal" required placeholder="Whatsapp do responsável">
    </div>

    <div class="dados">
        <label for="arquivo_principal">Foto Principal:</label>
        <br>
        <input type="file" id="arquivo_principal" name="arquivo_principal">
        <div class="galeria" id="galeria"></div>
    </div>

    <div class="dados">
        <label for="arquivos_secundario">Fotos secundárias:</label>
        <br>
        <input type="file" id="arquivos_secundario" name="arquivos_secundario" multiple>
        <div class="galeria" id="gallery"></div>
    </div>

    <div class="dados">
        <label for="registerEspecie">Espécie do animal:</label>
        <select id="registerEspecie" name="especie_animal" required>
            <option value="">Selecione a espécie</option>
            <option value="cachorro">Cachorro</option>
            <option value="gato">Gato</option>
            <option value="coelho">Coelho</option>
        </select>
    </div>

    <div class="dados">
        <label for="registerSexo">Sexo do animal:</label>
        <select id="registerSexo" name="sexo_animal" required>
            <option value="">Selecione o sexo</option>
            <option value="macho">Macho</option>
            <option value="femea">Fêmea</option>
        </select>
    </div>

    <div class="dados">
        <label for="registerFaixaEtaria">Faixa Etária do animal:</label>
        <select id="registerFaixaEtaria" name="faixaEtaria_animal" required>
            <option value="">Selecione a faixa etária</option>
            <option value="filhote">Filhote</option>
            <option value="adulto">Adulto</option>
            <option value="idoso">Idoso</option>
        </select>
    </div>

    <div class="dados">
        <label for="registerPorte">Porte do animal:</label>
        <select id="registerPorte" name="porte_animal" required>
            <option value="">Selecione o porte</option>
            <option value="pequeno">Pequeno</option>
            <option value="medio">Médio</option>
            <option value="grande">Grande</option>
        </select>
    </div>

    <div class="dados">
        <label for="registerDescricao">Descrição do animal:</label>
        <textarea id="registerDescricao" name="descricao_animal" required placeholder="Descrição do animal"></textarea>
    </div>

    <div class="dados">
        <label for="registerEstado">Estado:</label>
        <select id="registerEstado" name="estado_animal" required>
            <option value="">Todos os Estados</option>
            <option value="AC">AC</option>
            <option value="AL">AL</option>
            <option value="AP">AP</option>
            <option value="AM">AM</option>
            <option value="BA">BA</option>
            <option value="CE">CE</option>
            <option value="ES">ES</option>
            <option value="GO">GO</option>
            <option value="MA">MA</option>
            <option value="MT">MT</option>
            <option value="MS">MS</option>
            <option value="MG">MG</option>
            <option value="PA">PA</option>
            <option value="PB">PB</option>
            <option value="PR">PR</option>
            <option value="PE">PE</option>
            <option value="PI">PI</option>
            <option value="RJ">RJ</option>
            <option value="RN">RN</option>
            <option value="RS">RS</option>
            <option value="RO">RO</option>
            <option value="RR">RR</option>
            <option value="SC">SC</option>
            <option value="SP">SP</option>
            <option value="SE">SE</option>
            <option value="TO">TO</option>
        </select>
    </div>

    <div class="dados">
        <label for="registerCidade">Cidade do animal:</label>
        <input type="text" id="registerCidade" name="cidade_animal" required placeholder="Cidade do animal">
    </div>

    <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">Enviar</button> 
</form>

<script>
    document.getElementById('arquivo_principal').addEventListener('change', function(event) {
        const gallery = document.getElementById('galeria');
        gallery.innerHTML = ''; 
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            gallery.appendChild(img);
        }

        reader.readAsDataURL(file);
    });

    document.getElementById('arquivos_secundario').addEventListener('change', function(event) {
        const gallery = document.getElementById('gallery');
        const files = event.target.files;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                gallery.appendChild(img);
            }

            reader.readAsDataURL(file);
        }
    });

</script>
</body>
</html>