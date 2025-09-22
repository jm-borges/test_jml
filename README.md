# 📝 Teste Técnico – PHP Nativo e Laravel (Migração)

Este repositório contém a solução do **teste técnico de migração de sistema legado (PHP 7.4 procedural) para Laravel 12**, desenvolvido por **João Manoel Borges** usando um **template Laravel CLI personalizado**.

> ⚠️ Obs.: O projeto foi gerado a partir do template CLI da Aastera (`jm.borges7312@gmail.com`), garantindo estrutura pronta para APIs RESTful, boas práticas e arquitetura limpa.

---

## 🧩 Objetivo do Teste

Migrar o sistema legado de fornecedores para Laravel, implementando:

* Migration e Model `BusinessPartner` (com `softDeletes` e timestamps `created_at`/`updated_at`)
* Validações via **FormRequest**, incluindo **CNPJ customizado** (`CnpjIsValid`)
* API RESTful (`index`, `show`, `store`, `update`, `destroy`)
* Service Layer para regras de negócio (sanitização de CNPJ, transações)
* Resources para formatação de respostas JSON
* Testes Feature cobrindo:

  * sucesso
  * falha de validação
  * busca com filtros
* Plano de migração resumido

---

## 🚀 Como Executar

1. Clone o repositório:

```bash
git clone <repo-url>
cd <repo-dir>
```

2. Instale dependências:

```bash
composer install
```

3. Configure o `.env` (banco de dados, mail, etc.)
4. Rode migrations e seeders:

```bash
php artisan migrate --seed
```

5. Execute os testes automatizados:

```bash
php artisan test
```

---

## 🧪 Endpoints API

Todos os endpoints utilizam **autenticação via Sanctum**. Para testar manualmente:

1. Faça login:

```http
POST /api/v1/login
```

2. Copie o **Bearer token** retornado.
3. Inclua o token no header das requisições:

```http
Authorization: Bearer <token>
```

| Método | Endpoint                       | Descrição                                    |
| ------ | ------------------------------ | -------------------------------------------- |
| GET    | /api/v1/business-partners      | Listar parceiros (com filtros: `q` e `type`) |
| POST   | /api/v1/business-partners      | Criar parceiro                               |
| GET    | /api/v1/business-partners/{id} | Obter parceiro específico                    |
| PUT    | /api/v1/business-partners/{id} | Atualizar parceiro                           |
| DELETE | /api/v1/business-partners/{id} | Deletar parceiro (soft delete)               |

---

## ✅ Funcionalidades Implementadas

* CRUD completo para `BusinessPartner`
* Validação de CNPJ via regra customizada (`CnpjIsValid`)
* Testes Feature cobrindo criação, atualização, exclusão, filtros e falhas de validação
* Migração do modelo legado para Laravel, mantendo integridade de dados
* Uso de **Service Layer** para lógica de negócio
* Respostas JSON padronizadas via **Resource**
* `SoftDeletes` implementado

---

## 📝 Observações

* Este projeto segue **PSR-12** e boas práticas de Laravel moderno
* Template CLI utilizado: **Aastera Laravel Template**
* API protegida via **Sanctum** — qualquer requisição a endpoints de parceiros exige token válido
* Autor: **João Manoel Borges – [jm.borges7312@gmail.com](mailto:jm.borges7312@gmail.com)**

