# AmigoPet 
**Participantes:** Guilherme e Bruno Henrique.

**Turma:** TDS23-T1

### Introdução
 Nosso projeto será voltado em um **SITE** especializado na **Adoção responsável de animais**. Este site servira para simplificar e facilitar esse processo, desde a disponibilização de animais para adoção até o apoio na busca por animais desaparecidos e na arrecadação de doações para abrigos e canis locais.

**Adoção Responsável:**
Nosso objetivo principal é promover a adoção responsável, garantindo que os animais encontrem lares amorosos e adequados. Para isso, cada seção do nosso site será cuidadosamente desenvolvida e funcional.

**Seção de Adoção:**
Os usuários encontrarão informações detalhadas sobre animais disponíveis para adoção, incluindo fotos e descrições abrangentes, como raça, cor, idade e sexo. Esta seção será projetada para facilitar a conexão entre animais em busca de um lar e pessoas dispostas a adotar.

### Funcionalidades
* Cadastro e Login de usuários
* Cadastro do Animal do usuários
* Divulgação do pet

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

### Conclusão
Em resumo, nosso projeto não apenas simplificará o processo de adoção de animais, mas também promoverá uma cultura de responsabilidade e respeito pelos animais em nossa comunidade. Através desta plataforma online, aspiramos a transformar vidas, oferecendo um lar amoroso e seguro para animais desabrigados e perdidos, enquanto conscientizamos a população sobre a importância do bem-estar animal.

