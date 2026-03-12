[ ⭠ Voltar para README](../README.md) | ★ Arquitetura ★ | [Desafio](./CHALLENGE.md) |  [Banco de Dados](./DATABASE.md) | [O que é Pokémon](./GLOSSARY.md) | [Instalação](./INSTALL.md)


# Arquitetura e Decisões

Padrões de projeto e as escolhas arquiteturais implementadas.


## Padrões de Projeto

### 1. Service Pattern
Para evitar o antipadrão de "Deus Controller" citado no projeto, a lógica de negócio foi isolada em camadas de serviço seguindo as recomendações de nomenclatura no documento do desafio:
- **`PokeApiClient`**: SDK que encapsula as chamadas a API externa, responsável exclusivo pela comunicação HTTP com a PokéAPI, lidando com timeouts, retentativas e formatação de respostas.
- **`PokemonImporter`**: Orquestra a persistência dos dados, garantindo que os relacionamentos (Types/Moves) sejam salvos corretamente e evitando duplicidade via `upsert`.


### 2. DTOs - Data Transfer Objects
As respostas da API são transformadas em **Data Transfer Objects (DTOs)** antes de chegarem aos Models. Isso protege a aplicação de mudanças inesperadas na estrutura da PokéAPI. Embora não tenha sido citado no projeto, acredito que seja de extrema importancia, já que ao lidar com API externas, blindamos mudanças de estruturas externas, podendo facilmente adaptar a variações futuras.


## Performance e Escalabilidade

### Estratégia de Cache
Utilizamos o **Redis** como driver de cache para armazenar as respostas da API por um período determinado.
- **Por que?** Reduz a latência para o usuário final e demonstra bom senso técnico ao evitar requisições desnecessárias para uma API pública.


### Processamento em Background
Para operações que podem levar mais tempo (como a sincronização em massa), utilizamos **Commands** e **Jobs**.
- Isso garante que a interface (Blade) permaneça responsiva para o usuário enquanto o servidor processa os dados em segundo plano.


## Segurança e Autorização

### Laravel Policies
- Cada ação (Importar, Favoritar, Deletar) é validada centralizadamente, respeitando estritamente os perfis **Admin**, **Editor** e **Viewer**.


## Observabilidade
A aplicação utiliza o sistema de logs do Laravel para registrar:
- Falhas críticas na comunicação com a API.
- Tentativas de acesso não autorizado a rotas protegidas.
- Performance de processos de importação longos.

---

[ ⭠ Voltar para README](../README.md) | ★ Arquitetura ★ | [Desafio](./CHALLENGE.md) |  [Banco de Dados](./DATABASE.md) | [O que é Pokémon](./GLOSSARY.md) | [Instalação](./INSTALL.md)