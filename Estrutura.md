# AmigoPet 
**Nomes:** Guilherme e Bruno Henrique.

**Turma:** TDS23-T1

### Introdução
**Tema:** Nosso projeto será voltado em um **SITE** especializado na **Adoção responsável de animais**. Este site servira para simplificar e facilitar esse processo, desde a disponibilização de animais para adoção até o apoio na busca por animais desaparecidos e na arrecadação de doações para abrigos e canis locais.

**Adoção Responsável:**
Nosso objetivo principal é promover a adoção responsável, garantindo que os animais encontrem lares amorosos e adequados. Para isso, cada seção do nosso site será cuidadosamente desenvolvida e funcional.

**Seção de Adoção:**
Os usuários encontrarão informações detalhadas sobre animais disponíveis para adoção, incluindo fotos e descrições abrangentes, como raça, cor, idade e sexo. Esta seção será projetada para facilitar a conexão entre animais em busca de um lar e pessoas dispostas a adotar.

**Animais Desaparecidos:**
Os proprietários preocupados com seus animais perdidos poderão cadastrar informações relevantes, como características físicas, local e data do desaparecimento. Além disso, os usuários terão acesso a uma lista de animais encontrados, facilitando a reunião de animais perdidos com seus proprietários.

**Doações:**
Uma seção dedicada às doações será fundamental para apoiar a manutenção e operação dos abrigos e canis locais. Aceitaremos doações em dinheiro, bem como itens essenciais para o cuidado dos animais, como alimentos, produtos de higiene e cobertores.

### Funcionalidades
Cadastro e Login de usuários

Cadastro do Animal

Divulgação do pet

### Tecnologias Utilizadas
* **JavaScript:** Interatividade do site
* **CSS:** Estilização do site
* **HTML:** Estrutura do site
* **PHP:** Estrutura do site
* **Banco de Dados:** SQL Workbench

### Requisitos
* XAMPP
* SQL Workbench

### Configuração do XAMPP
* Baixe o XAMPP
* Força a parada do MySQL80 e deixa manual.
* Dentro do XAMPP, aperte Start no Apache e MySQL
* Vai na pasta htdocs dentro do XAMPP, deixa vazia, abre o cmd e de um git clone
```
glit clone https://github.com/GuilhermeBMarques/API
```
### Configuração do SQL
* Crie um server chamado
``` db_dados ```
* Charset: utf8mb4
* Collation: utf8mb4_unicode_ci

### Dentro do db_dados
usuarios
```
CREATE TABLE usuarios (
  id_usuarios INT(11) AUTO_INCREMENT PRIMARY KEY,
  nome_usuarios VARCHAR(120) NOT NULL,
  senha_usuarios VARCHAR(255) NOT NULL,
  email_usuarios VARCHAR(120) NOT NULL
);
```

animal
```
CREATE TABLE animal (
  id_animal INT(11) AUTO_INCREMENT PRIMARY KEY,
  nome_animais VARCHAR(120) NOT NULL,
  responsavel_animais VARCHAR(120) NOT NULL,
  gmail_animais VARCHAR(120) NOT NULL,
  Whatsapp_animais VARCHAR(50) NOT NULL,
  arquivo_principal_animais VARCHAR(255) NOT NULL,
  especie_animais VARCHAR(16) NOT NULL,
  sexo_animais VARCHAR(16) NOT NULL,
  faixaEtaria_animais VARCHAR(16) NOT NULL,
  porte_animais VARCHAR(16) NOT NULL,
  descricao_animais VARCHAR(500) NOT NULL,
  perdido_animais VARCHAR(16) NOT NULL,
  estado_animais VARCHAR(16) NOT NULL,
  cidade_animais VARCHAR(120) NOT NULL,
  id_usuarios INT(11), 
  CONSTRAINT fk_id_usuario FOREIGN KEY (id_usuarios) 
  REFERENCES usuarios(id_usuarios) 
  ON DELETE SET NULL
);
```

### Plano de Ação
**Desenvolvimento das Funcionalidades em JavaScript:**
Iniciar o desenvolvimento das funcionalidades do site utilizando JavaScript para garantir a interatividade e dinamismo necessários.
Implementar as operações relacionadas à adoção de animais, busca por animais desaparecidos e sistema de doações.

**Desenvolvimento do Front-end:**
Após a conclusão das funcionalidades em JavaScript, concentrar esforços no desenvolvimento do front-end para garantir uma interface intuitiva e amigável aos usuários.
Utilizar HTML e CSS para criar layouts atrativos e responsivos que facilitem a navegação e a interação dos usuários com o site.

**Criação das Tabelas e Configuração do Servidor:**
Proceder com a criação das tabelas no banco de dados, conforme definido na modelagem, para armazenar informações sobre animais disponíveis para adoção, animais perdidos e adotantes.
Configurar o servidor para garantir a disponibilidade e segurança do site durante o seu funcionamento.

**Coleta e Integração de Dados sobre Animais e Casas de Adoção:**
Realizar a coleta de dados sobre animais disponíveis para adoção e animais perdidos em parceria com abrigos e canis locais.
Integrar esses dados ao sistema para garantir que o site esteja sempre atualizado e ofereça informações precisas aos usuários.

**Implementação do Sistema de Doação via PIX:**
Desenvolver e integrar um sistema de doação via PIX para facilitar a contribuição dos usuários em dinheiro.
Garantir a segurança e transparência no processo de doação, fornecendo informações claras sobre como os fundos serão utilizados para apoiar abrigos e canis locais.

### Conclusão
Em resumo, nosso projeto não apenas simplificará o processo de adoção de animais, mas também promoverá uma cultura de responsabilidade e respeito pelos animais em nossa comunidade. Através desta plataforma online, aspiramos a transformar vidas, oferecendo um lar amoroso e seguro para animais desabrigados e perdidos, enquanto conscientizamos a população sobre a importância do bem-estar animal.

