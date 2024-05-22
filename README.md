# Desafio Técnico - Sistema de Gestão Bancária

Este é um sistema simples de gestão bancária, proposto pelo Desafio Técnico da Objective, como uma das etapas do seu processo seletivo para vaga de Desenvolvedor(a) PL | PHP.

Este projeto foi desenvolvido em Laravel 11. A aplicação fornece endpoints para criar contas, realizar transações e consultar saldos.

## Requisitos

- PHP >= 8.1
- Composer
- MySQL ou outro banco de dados compatível
- Extensões PHP: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON

## Instalação

### Passo 1: Clonar o repositório

```bash
git clone https://github.com/seu-usuario/sistema-bancario.git
cd sistema-bancario
```

### Passo 2: Instalar as dependências
```bash
composer install
```

### Passo 3: Configurar o ambiente
Copie o arquivo `.env.example` para `.env`:
```bash
cp .env.example .env
```
Edite o arquivo .env e configure com as informações do seu banco de dados.

### Passo 4: Gerar a chave da aplicação
Copie o arquivo `.env.example` para `.env`:
```bash
php artisan key:generate
```

### Passo 5: Executar as migrações
Copie o arquivo `.env.example` para `.env`:
```bash
php artisan migrate
```

### Passo 6: Iniciar o servidor de desenvolvimento
```bash
php artisan serve
```
A aplicação estará disponível localmente em http://localhost:8000.

Para testar a API, você pode usar ferramentas como Postman, Insomnia, cURL ou até mesmo bibliotecas de teste integradas ao Laravel, como PHPUnit.

### Rodar teste via PHPUnit
```bash
php artisan test 
```