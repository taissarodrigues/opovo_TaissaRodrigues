# Sistema de Gerenciamento de Autores

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

3. **Configuração de Conexão:**
   * Verifique e ajuste as credenciais de acesso no arquivo `/config/database.php`.

4. **Acesso ao Sistema:**
   Navegue até o endereço local correspondente:
[http://localhost/sistema-gerenciamento-autores/public/
](http://localhost/opovo_TaissaRodrigues/public/)
---

## Arquitetura Utilizada

A estrutura do projeto segue a divisão de responsabilidades do padrão MVC:

* **Model:** Responsável pela conexão com o banco de dados e regras de persistência.
* **View:** Camada de interface desenvolvida em HTML5 e CSS3.
* **Controller:** Atua como intermediário no processamento de requisições e gerenciamento do fluxo da aplicação.

---
Desenvolvido por [Taíssa Rodrigues](https://github.com/taissarodrigues)
