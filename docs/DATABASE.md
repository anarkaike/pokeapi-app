[ ⭠ Voltar para README](../README.md) | [Desafio](./CHALLENGE.md) | [O que é Pokémon](./GLOSSARY.md) | [Arquitetura](./ARCHITECTURE.md) | ★ Banco de Dados ★ | [Instalação](./INSTALL.md)


<p align="center"><a href="https://ipe.digital" target="_blank"><img src="https://ipe.digital/wp-content/themes/bootscore-child-main/img/ropade-mod.png" width="100%" alt="Desafio ipe.digital"></a></p>


# Modelagem do Banco de Dados

Esquema de banco de dados seguindo a risca as instruções e nomes citados no documento do desafio.

## Entidades Principais

### Tabela `pokemons`
Armazena os pokemons sincronizados/importados.
- **`id`**: int PK (auto-increment)
- **`api_id`**: int (Unique Index) - ID original da PokéAPI
- **`name`**: varchar(255)
- **`height`**: int
- **`weight`**: int
- **`sprite_url`**: varchar(255) (thumbnail oficial)
- **`created_at`**: timestamp
- **`updated_at`**: timestamp

### Tabela `types`
Armazena as classificações elementares vindas da API.
- **`id`**: int PK (auto-increment)
- **`name`**: varchar(255) (Unique)
- **`created_at`**: timestamp
- **`updated_at`**: timestamp

### Tabela `abilities`
Armazena as características passivas vindas da API.
- **`id`**: int PK (auto-increment)
- **`name`**: varchar(255) (Unique)
- **`created_at`**: timestamp
- **`updated_at`**: timestamp

### Tabela `moves`
Armazena os golpes e ataques. Cenário ideal para validação da camada de cache devido à volumetria.
- **`id`**: int PK (auto-increment)
- **`name`**: varchar(255) (Unique)
- **`created_at`**: timestamp
- **`updated_at`**: timestamp

## Tabelas Pivot (Relacionamentos N:N)

### Tabela `pokemon_type`
Relacionamento entre Pokémons e seus tipos.
- **`pokemon_id`**: int FK -> pokemons.id
- **`type_id`**: int FK -> types.id

### Tabela `pokemon_ability`
Relacionamento entre Pokémons e suas habilidades.
- **`pokemon_id`**: int FK -> pokemons.id
- **`ability_id`**: int FK -> abilities.id

### Tabela `pokemon_move`
Relacionamento entre Pokémons e seus movimentos.
- **`pokemon_id`**: int FK -> pokemons.id
- **`move_id`**: int FK -> moves.id

## Sistema de Favoritos

### Tabela `user_favorites` (Pivot)
Relacionamento N:N que permite usuários Admin e Editor favoritarem registros.
- **`user_id`**: int FK -> users.id
- **`pokemon_id`**: int FK -> pokemons.id
- **`created_at`**: timestamp (Data em que o usuário favoritou)

## Autenticação (Users)

### Tabela `users`
Tabela padrão do Laravel estendida para suportar o controle de acesso por perfis.
- **`id`**: int PK (auto-increment)
- **`name`**: varchar(255)
- **`email`**: varchar(255) (Unique)
- **`password`**: varchar(255)
- **`role`**: enum ('admin', 'editor', 'viewer')
- **`created_at`**: timestamp
- **`updated_at`**: timestamp

> **Nota Técnica**: Foi implementado um Unique Index no campo api_id da tabela pokemons para suportar operações de upsert, evitando duplicidade de registros durante as sincronizações.

---

[ ⭠ Voltar para README](../README.md) | [Desafio](./CHALLENGE.md) | [O que é Pokémon](./GLOSSARY.md) | [Arquitetura](./ARCHITECTURE.md) | ★ Banco de Dados ★ | [Instalação](./INSTALL.md)


<br />

<a href="https://ipe.digital" target="_blank"><img src="https://ipe.digital/wp-content/themes/bootscore-child-main/img/aviao.png" width="100%" alt="Desafio ipe.digital"></a>