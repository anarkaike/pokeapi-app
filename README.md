★ README ★ | [Desafio](docs/CHALLENGE.md) | [O que é Pokémon](docs/GLOSSARY.md)  | [Arquitetura](docs/ARCHITECTURE.md) | [Banco de Dados](docs/DATABASE.md) | [Instalação](docs/INSTALL.md)


<p align="center"><a href="https://ipe.digital" target="_blank"><img src="https://ipe.digital/wp-content/themes/bootscore-child-main/img/logo/logo.svg" width="400" alt="Desafio ipe.digital"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Sobre o PokéAPI APP
Este é um case de desafio técnico desenvolvido para o processo seletivo da ipe.digital, para a vaga de Laravel Pleno. 


## Objetivo
Demonstrar domínio do Laravel + Blade, consumindo uma API pública do PokéAPI, oferecendo um administrador básico com três perfis de acesso e funcionalidades:

- **Viewer**: Apenas visualiza dados já importados da PokéAPI.
- **Editor**: Importa, sincroniza e favorita Pokémons da PokéAPI.
- **Admin**: Gerencia os usuários, permissões, registros e também favorita Pokémons da PokéAPI.


## API pública PokéAPI
Se trata de um banco de dados técnico e gratuito que centraliza praticamente todas as informações da franquia Pokémon. Será usada como fonte de informações para importação e sincronização com nossa base de dados.

Link da documentação: [https://pokeapi.co/docs/v2](https://pokeapi.co/docs/v2)


## Instalando o Projeto
Este projeto utiliza **Laravel Sail** (Docker) para garantir a consistência do ambiente e facilitar a configuração.

### **Passo 01**: Clone o repositório do desafio em uma pasta vazia
```bash
git clone https://github.com/anarkaike/pokeapi-app.git .
```

### **Passo 02**: Suba os containers (requer Docker/OrbStack)
```bash
./vendor/bin/sail up -d
```

### **Passo 03**: Execute o setup inicial
```bash
./vendor/bin/sail artisan app:install
```


## Credenciais de Acesso
Ao instalar o projeto, utilize as credenciais abaixo para logar em cada um dos perfíls de acesso.

| PERFIL   | EMAIL                | SENHA     | PERMISSÕES                                 |
|----------|----------------------|-----------|--------------------------------------------|
| Admin    | admin@ipe.digital    | Senh@123  | Acesso Total                               |
| Editor   | editor@ipe.digital   | Senh@123  | Importações, sincronizações e favoritar    |
| Viewer   | viewer@ipe.digital   | Senh@123  | Somente leitura                            |

## Decisões Técnicas
- **Cache**: Implementado via Redis para evitar rate-limit da PokéAPI.
- **Segurança**: Uso de Laravel Policies para isolamento de ações por perfil.
- **Jobs/Commands**: Sincronização em background para não travar a UI.

## Documentação
Navegue pela documentação, para mais detalhes:
- [Requisitos do Desafio](./docs/CHALLENGE.md)
- [O que é Pokémon?](./docs/GLOSSARY.md)
- [Arquitetura e Camada de Service](./docs/ARCHITECTURE.md)
- [Modelagem do Banco de Dados](./docs/DATABASE.md)
- [Instalação detalhada](./docs/INSTALL.md)

## Licença
Esta aplicação de desafio é um software de código aberto licenciado sob a [licença MIT](https://opensource.org/licenses/MIT).

---

★ README ★ | [Desafio](docs/CHALLENGE.md) | [O que é Pokémon](docs/GLOSSARY.md)  | [Arquitetura](docs/ARCHITECTURE.md) | [Banco de Dados](docs/DATABASE.md) | [Instalação](docs/INSTALL.md)