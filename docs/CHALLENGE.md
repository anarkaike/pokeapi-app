[ ⭠ Voltar para README](../README.md) | [Arquitetura](./ARCHITECTURE.md) | ★ Desafio ★ |  [Banco de Dados](./DATABASE.md) | [O que é Pokémon](./GLOSSARY.md) | [Instalação](./INSTALL.md)

# Especificação do Desafio Técnico: PokéAPI APP

Foi transcrito neste markdown os requisitos oficiais do desafio técnico, passados para a vaga de **Laravel Pleno** na **ipe.digital**.

## Objetivo
Desenvolver uma aplicação web utilizando **Laravel** e **Blade** que consuma a **PokéAPI**, realize a persistência e sincronização de dados em **MySQL** e aplique camadas de autenticação e autorização via Roles/Policies do **Laravel**.


## Requisitos Técnicos
- **Framework**: Laravel
- **Frontend**: Blade
- **Banco de Dados**: MySQL
- **Integração**: PokéAPI
- **Versionamento**: GitHub


## Funcionalidades Obrigatórias

### 1. Autenticação e Perfis de Acesso
Implementar 3 níveis de permissão:
- **Viewer**: Pesquisa e visualiza dados persistidos.
- **Editor**: Importa/sincroniza dados da API e gerencia favoritos.
- **Admin**: Gestão de usuários, permissões e exclusão de registros.

### 2. Consulta e Listagem
- Tela de busca por nome ou listagem paginada.
- Paginação obrigatória via parâmetros `limit` e `offset` da API.
- Página de detalhes consumindo dados em tempo real quando necessário.
- Tratamento de erros para falhas de integração (timeout, API offline).

### 3. Persistência e Modelagem
Ao importar um Pokémon, o sistema deve salvar:
- **Entidade Principal**: ID da API, nome, altura, peso e sprites.
- **Relacionamentos (N:N)**: Pelo menos um relacionamento entre *Types*, *Moves* ou *Abilities*.
- **Integridade**: Evitar duplicidade via índices únicos ou operações de `upsert`.

### 4. Sistema de Favoritos
- Usuários **Editor** e **Admin** podem favoritar Pokémons importados.
- Listagem exclusiva "Meus Favoritos" com opção de remoção.


## Padrões citados no documento
- **Camada de Service**: `PokeApiClient` para consumo e `PokemonImporter` para persistência.
- **Validação**: Uso de `FormRequest`.
- **Controllers**: Manter a responsabilidade enxuta.
- **Cache**: Persistir respostas da API por alguns minutos para otimizar performance.
- **Observabilidade**: Logar falhas de integração e eventos críticos.


## Entrega e Avaliação
- **Documentação**: README completo com instruções de setup, `.env.example`, comandos de migration/seed e credenciais de teste.
- **Qualidade**: Serão avaliados a maturidade técnica, uso de Jobs/Commands, implementação de Policies e organização de código.
- **Prazo e Envio**: O link do repositório deve ser enviado para os e-mails indicados na especificação original.

---

[ ⭠ Voltar para README](../README.md) | [Arquitetura](./ARCHITECTURE.md) | ★ Desafio ★ |  [Banco de Dados](./DATABASE.md) | [O que é Pokémon](./GLOSSARY.md) | [Instalação](./INSTALL.md)