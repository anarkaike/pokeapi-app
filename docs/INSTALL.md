[ ⭠ Voltar para README](../README.md) | [Desafio](./CHALLENGE.md) | [O que é Pokémon](./GLOSSARY.md) | [Arquitetura](./ARCHITECTURE.md) | [Banco de Dados](./DATABASE.md) | ★ Instalação ★

# Instalação e Setup

Instruções para configurar a aplicação no ambiente local utilizando Laravel Sail.

## Pré-requisitos
- OrbStack ou Docker Desktop
- Git

## Execução Inicial

### 1. Clone o repositório em uma pasta vazia
```bash
git clone https://github.com/anarkaike/pokeapi-app.git .
```

### 2. Subir os containers
Suba os containers do projeto. Garanta que o docker esteja rodando.
```bash
./vendor/bin/sail up -d
```

### 3. Setup Automatizado
Limpe todos os caches, gere a chave, link storage, rode todas as migrations e seeds, execute a instalação do npm e compilação do vite com um único comando:
```bash
./vendor/bin/sail artisan app:install
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
