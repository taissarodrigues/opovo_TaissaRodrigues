# Sistema de Gerenciamento de Autores - php

![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange?style=for-the-badge&logo=mysql)
![Architecture](https://img.shields.io/badge/Architecture-MVC-314d7d?style=for-the-badge)

Aplicação web desenvolvida em PHP utilizando a arquitetura MVC, focada no gerenciamento completo (CRUD) de autores com validações rigorosas e interface responsiva.

---

## Demonstração das Funcionalidades

Vídeo demonstrativo da aplicação em funcionamento:  
[Acesse a demonstração em vídeo](https://youtu.be/foYycWflAEs)

---

## Sobre o Desenvolvimento

Este projeto foi construído para aplicar conceitos avançados de organização modular. A escolha da arquitetura MVC permitiu separar a lógica de persistência de dados da interface do usuário, resultando em um código mais limpo e de fácil manutenção.

> **Nota Técnica:** Com experiência prévia no padrão MVC em tecnologias como Swift, a implementação deste projeto no ecossistema PHP foi uma oportunidade para validar a portabilidade de conceitos de arquitetura entre diferentes linguagens e plataformas.

---

## Regras de Negócio e Validações

O sistema garante a integridade dos dados através de múltiplas camadas de proteção:

* **Validação de Identidade:** Verificação de nome completo com no mínimo 3 caracteres.
* **Sanitização:** Validação de e-mail utilizando a função filter_var no backend.
* **UX e Máscaras:** Formatação dinâmica de telefone via JavaScript no padrão (XX) XXXXX-XXXX.
* **Lógica de Maioridade:** Restrição automática para autores com menos de 18 anos e bloqueio de datas de nascimento futuras.
* **Segurança:** Revalidação de campos obrigatórios no servidor antes da persistência no banco de dados MySQL.

---

## Instruções de Instalação

### Pré-requisitos
* PHP 8.2 ou superior
* MySQL 8
* Servidor Apache (XAMPP, WAMP ou similar)

### Passo a Passo

1. **Clone o repositório** para o diretório público do seu servidor (ex: htdocs):
   ```bash
   git clone [https://github.com/taissarodrigues/sistema-gerenciamento-autores.git](https://github.com/taissarodrigues/sistema-gerenciamento-autores.git)
   2. **Importe o banco de dados:**
   * Acesse o gerenciador de banco de dados (ex: phpMyAdmin).
   * Crie um banco de dados denominado `empresa`.
   * Importe o arquivo SQL localizado no diretório `/config/empresa.sql`.

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
* PHP aplica revalidação no backend

##  Implantação

Para colocar o projeto no ar:

1.  Copie o conteúdo da pasta `/public` para o diretório público do seu servidor (ex: `/var/www/html`)
2.  Configure o banco MySQL com o mesmo script usado em desenvolvimento
3.  Ajuste as credenciais no arquivo `/config/database.php`
4.  Certifique-se de que o PHP e o MySQL estão habilitados no servidor
## Arquitetura Utilizada

A estrutura do projeto segue a divisão de responsabilidades do padrão MVC:

* **Model:** Responsável pela conexão com o banco de dados e regras de persistência.
* **View:** Camada de interface desenvolvida em HTML5 e CSS3.
* **Controller:** Atua como intermediário no processamento de requisições e gerenciamento do fluxo da aplicação.

---
Desenvolvido por [Taíssa Rodrigues](https://github.com/taissarodrigues)
