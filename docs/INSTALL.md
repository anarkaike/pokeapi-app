[ ⭠ Voltar para README](../README.md) | [Desafio](./CHALLENGE.md) | [O que é Pokémon](./GLOSSARY.md) | [Arquitetura](./ARCHITECTURE.md) | [Banco de Dados](./DATABASE.md) | ★ Instalação ★

# Instalação e Setup

Instruções para configurar o ambiente local utilizando Laravel Sail.

## Pré-requisitos
- OrbStack ou Docker Desktop
- Git

## Execução Inicial

### 1. Clone o repositório em uma pasta vazia
```bash
git clone https://github.com/anarkaike/pokeapi-app.git .
```

### 2. Subir os containers
Suba os containers do projeto.
```bash
./vendor/bin/sail up -d
```

### 3. Setup Automatizado
Gere o banco de dados locais, chave da aplicação e rode as migrations e seeds.
```bash
./vendor/bin/sail artisan app:install
```

### 4. Compilar Assets
```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

## Credenciais de Teste
Utilize os acessos abaixo para validar as policies de cada perfil:


| PERFIL   | EMAIL                | SENHA     | PERMISSÕES                                 |
|----------|----------------------|-----------|--------------------------------------------|
| Admin    | admin@ipe.digital    | Senh@123  | Acesso Total                               |
| Editor   | editor@ipe.digital   | Senh@123  | Importações, sincronizações e favoritar    |
| Viewer   | viewer@ipe.digital   | Senh@123  | Somente leitura                            |

---

[ ⭠ Voltar para README](../README.md) | [Desafio](./CHALLENGE.md) | [O que é Pokémon](./GLOSSARY.md) | [Arquitetura](./ARCHITECTURE.md) | [Banco de Dados](./DATABASE.md) | ★ Instalação ★