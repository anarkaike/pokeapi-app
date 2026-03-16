[ ⭠ Voltar para README](../README.md) | [Desafio](./CHALLENGE.md) | [O que é Pokémon](./GLOSSARY.md) | [Arquitetura](./ARCHITECTURE.md) | [Banco de Dados](./DATABASE.md) | ★ Instalação ★


<p align="center"><a href="https://ipe.digital" target="_blank"><img src="https://ipe.digital/wp-content/themes/bootscore-child-main/img/ropade-mod.png" width="100%" alt="Desafio ipe.digital"></a></p>


# Instalação e Setup

Instruções para configurar a aplicação no ambiente local com Docker Compose e em produção com um compose compatível com Coolify.

## Pré-requisitos
- OrbStack ou Docker Desktop
- Git

## Execução Inicial

### 1. Clone o repositório em uma pasta vazia
```bash
git clone https://github.com/anarkaike/pokeapi-app.git .
```

### 2. Crie o arquivo `.env` local
```bash
cp .env.example .env
```

### 3. Subir os containers
Suba os containers do projeto. Garanta que o docker esteja rodando.
```bash
docker compose -f docker-compose.dev.yaml up -d --build
```

### 4. Setup Automatizado
Limpe todos os caches, gere a chave, link storage, rode todas as migrations e seeds, execute a instalação do npm e compilação do vite com um único comando:
```bash
docker compose -f docker-compose.dev.yaml exec app php artisan app:install
```

### 5. Hot Reload (opcional, para desenvolvimento)
Caso queira ativar o Hot Reload para melhor DX (Experiência de Desenvolvimento), rode:
```bash
npm run dev
```

Após os passos, acesse http://localhost

## Produção e Coolify

Utilize o arquivo `docker-compose.prod.yaml` como base de deploy.

- **No Coolify**
- Configure `APP_KEY`, `APP_URL`, `DB_*` e `REDIS_*` diretamente no painel
- Não é necessário enviar `.env` no repositório

- **No ambiente local**
- Use o `.env` para validar também a stack de produção
- Suba com:
```bash
docker compose -f docker-compose.prod.yaml up -d --build
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

<br />

<a href="https://ipe.digital" target="_blank"><img src="https://ipe.digital/wp-content/themes/bootscore-child-main/img/aviao.png" width="100%" alt="Desafio ipe.digital"></a>