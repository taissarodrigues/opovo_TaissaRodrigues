# Sistema de Gerenciamento de Autores - Teste Técnico OPOVO

![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)
![MVC](https://img.shields.io/badge/architecture-MVC-314d7d)
![License](https://img.shields.io/badge/license-MIT-green)

Aplicação web desenvolvida em **PHP** com arquitetura **MVC**, que permite o **cadastro, listagem, edição e exclusão de autores** de forma organizada e validada.
O projeto foi criado para demonstrar **boas práticas de organização de código**, **design de interface** e **validações no frontend e backend**, para o teste técnico para a vaga de aprendiz de tecnologia.


##  Demostração CRUH: https://youtu.be/foYycWflAEs

##  Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

Consulte **[Implantação](#implantação)** para saber como implantar o projeto.

###  Pré-requisitos

De que coisas você precisa para instalar o software e como instalá-lo:

* PHP 8.2 ou superior
* MySQL 8
* XAMPP (ou outro servidor local Apache + MySQL)
* Safari ou Chrome

###  Instalação

Siga os passos abaixo para configurar o ambiente de desenvolvimento:

1.  **Clone o repositório**
    ```bash
    git clone [https://github.com/taissarodrigues/opovo_TaissaRodrigues.git](https://github.com/taissarodrigues/opovo_TaissaRodrigues.git)
    ```

2.  **Acesse o diretório**
    ```bash
    cd opovo_TaissaRodrigues
    ```

3.  **Inicie o servidor Apache e MySQL no XAMPP**

4.  **Acesse no navegador:**
    `http://localhost/opovo_TaissaRodrigues/public/`

5.  **Crie o banco de dados:**
    a. Abra o `phpMyAdmin`
    b. Crie um banco chamado `empresa`
    c. Importe o arquivo `empresa.sql` localizado em `/config/`
    d. Verifique se as credenciais em `/config/database.php` estão corretas:

    ```php
    $server = "localhost";
    $user   = "root";
    $pass   = "";
    $dbname = "empresa";
    ```

##  Executando os testes

O sistema conta com validações integradas e testes manuais de entrada de dados, que garantem consistência entre as camadas de View, Controller e Model.

### Analise os testes de ponta a ponta

Testes de ponta a ponta (funcionais):

* Validação de nome completo com no mínimo 3 caracteres
* Verificação de e-mail válido com `filter_var()`
* Máscara de telefone dinâmica no formato `(XX) XXXXX-XXXX`
* Bloqueio de datas futuras e de autores com menos de 18 anos
* Checagem de campos obrigatórios antes do envio do formulário

Testes de estilo e comportamento:

* Campos obrigatórios exibem mensagens nativas (`reportValidity()`)
* JavaScript garante padronização entre navegadores
* PHP aplica revalidação no backend (evita bypass de formulário)

##  Implantação

Para colocar o projeto no ar:

1.  Copie o conteúdo da pasta `/public` para o diretório público do seu servidor (ex: `/var/www/html`)
2.  Configure o banco MySQL com o mesmo script usado em desenvolvimento
3.  Ajuste as credenciais no arquivo `/config/database.php`
4.  Certifique-se de que o PHP e o MySQL estão habilitados no servidor

## 🛠️ Construído com

* PHP — Linguagem principal
* MySQL — Banco de dados relacional
* HTML5 — Estrutura das views
* CSS3 — Estilização responsiva
* JavaScript — Máscaras e validações
* Arquitetura MVC — Organização modular de código


##  Autor

* Taíssa Rodrigues — Desenvolvimento
  
Nota sobre o desenvolvimento: Este projeto foi minha primeira oportunidade de aplicar PHP em uma aplicação web completa. Aproveitei o desafio para estudar e implementar a arquitetura MVC. Já tinha aplicado  MVC em Swift, foi muito interessante perceber como o conceito se aplica de forma parecida em outra linguagem. Achei o PHP bem acessível e intuitivo. Foi uma ótima experiência de aprendizado, e gostei bastante de implementar as validações e organizar as camadas do projeto

---
