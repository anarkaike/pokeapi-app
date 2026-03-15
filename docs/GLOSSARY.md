[ ⭠ Voltar para README](../README.md) | [Desafio](./CHALLENGE.md) | ★ O que é Pokémon ★ | [Arquitetura](./ARCHITECTURE.md) | [Banco de Dados](./DATABASE.md) | [Instalação](./INSTALL.md)


<p align="center"><a href="https://ipe.digital" target="_blank"><img src="https://ipe.digital/wp-content/themes/bootscore-child-main/img/ropade-mod.png" width="100%" alt="Desafio ipe.digital"></a></p>


# Domínio de Negócio: O Universo Pokémon

Glossário para alinhar o entendimento do domínio da aplicação. O objetivo é garantir compreensão semântica dos dados que estamos consumindo da PokéAPI a quem não tem familiaridade prévia com a franquia.

## O que é um Pokémon?
Pokémon (abreviação de "pocket monsters") são criaturas fictícias de diversas formas e tamanhos. No contexto deste universo, humanos (chamados de Treinadores) capturam e treinam essas criaturas para competições esportivas. 

Para o escopo desta aplicação, o Pokémon é a nossa **Entidade Central**. Ele representa o registro principal no banco de dados, contendo atributos físicos básicos como altura (`height`), peso (`weight`) e uma imagem de catálogo (`sprite_url`).

## Entidades de Atributos

As características que definem o comportamento e as capacidades de um Pokémon na API são divididas em três entidades secundárias distintas:

### 1. Types (Tipos Elementares)
Representa a classificação elementar ou biológica da criatura. Funciona como um sistema de "pedra, papel e tesoura", definindo o balanço de vantagens e desvantagens de cada criatura.
- **Exemplo prático**: Um Pokémon do tipo *Fire* (Fogo) tem vantagem ofensiva contra o tipo *Grass* (Planta), mas possui fraqueza contra o tipo *Water* (Água).
- **Regra de Domínio**: Um Pokémon pode possuir um ou no máximo dois tipos simultaneamente.

### 2. Abilities (Habilidades Passivas)
São características orgânicas e passivas da criatura. Elas não são "usadas" ativamente como um ataque; em vez disso, elas reagem automaticamente a eventos do sistema (como sofrer um dano ou entrar em uma batalha).
- **Exemplo prático**: A habilidade *Levitate* (Levitar) torna a criatura imune a qualquer ataque do tipo terrestre. A habilidade *Static* (Estática) tem uma probabilidade matemática de paralisar um oponente que faça contato físico.
- **Regra de Domínio**: Um Pokémon geralmente possui apenas uma habilidade ativa por vez, escolhida de um leque restrito de possibilidades de sua espécie.

### 3. Moves (Movimentos/Golpes)
São as ações ativas que o Pokémon executa sob comando. É o arsenal ofensivo, defensivo ou tático da criatura. Esta é a entidade com maior densidade de dados na PokéAPI.
- **Exemplo prático**: *Thunderbolt* (Choque do Trovão) é um ataque ofensivo. *Recover* (Recuperação) é um movimento de cura.
- **Regra de Domínio**: Um Pokémon pode ter acesso a dezenas de movimentos diferentes ao longo de seu desenvolvimento, mas em um cenário prático, ele seleciona e equipa apenas quatro movimentos simultaneamente.

---

[ ⭠ Voltar para README](../README.md) | [Desafio](./CHALLENGE.md) | ★ O que é Pokémon ★ | [Arquitetura](./ARCHITECTURE.md) | [Banco de Dados](./DATABASE.md) | [Instalação](./INSTALL.md)

<br />

<a href="https://ipe.digital" target="_blank"><img src="https://ipe.digital/wp-content/themes/bootscore-child-main/img/aviao.png" width="100%" alt="Desafio ipe.digital"></a>