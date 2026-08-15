# Sistema de Cadastro de Produtos

Projeto acadêmico desenvolvido com PHP, Bootstrap, JavaScript e MySQL para implementar um CRUD completo de produtos, com ambiente pronto para execução via Docker.

## Tecnologias

- PHP
- MySQL
- Bootstrap
- JavaScript
- Docker

## Estrutura

- `public/`: arquivos públicos da aplicação
- `src/`: classes, helpers e configuração
- `database/sistema_db.sql`: criação do banco `sistema_db`, tabela `produtos` e dados iniciais
- `Dockerfile`: build do container PHP com Apache

## Como executar

1. Tenha Docker e Docker Compose instalados.
2. No diretório do projeto, execute:

```bash
docker compose up build
```
e depois rode 

```bash
docker compose up -d
```

3. Acesse:

- Aplicação: `http://localhost:8000`
- PHPMyAdmin: `http://localhost:8080`
- MySQL: `localhost:3300`

## Credenciais do banco

- Banco: `sistema_db`
- Usuário: `sistema_user`
- Senha: `sistema_pass`
- Root: `root`

## Funcionalidades

- Criar produtos
- Listar produtos
- Editar produtos
- Excluir produtos
- Validar formulário com JavaScript e PHP
- Proteger senhas com `password_hash`

