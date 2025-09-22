# 🗂 Plano de Migração – Sistema Legado “Fornecedores” → Laravel 12

**Autor:** João Manoel Borges
**Objetivo:** Migrar código legado PHP 7.4 procedural para Laravel 12, mantendo integridade de dados, segurança e arquitetura limpa.

---

## 1. Análise do Legado

* Tabela `fornecedores` com campos: `id`, `nome`, `cnpj`, `email`, `criado_em`
* Regras mínimas: `nome` obrigatório ≥ 3 caracteres, `cnpj` 14 dígitos e único
* Funcionalidade básica: criação e listagem (com filtro por nome)
* Problemas identificados: SQL Injection, falta de validação formal, código procedural

---

## 2. Estrutura Laravel

* **Model:** `BusinessPartner` → representando fornecedores e clientes futuros
* **Migration:** criação de tabela `business_partners` com `softDeletes` e timestamps `created_at`/`updated_at`
* **FormRequest:** `StoreBusinessPartnerRequest` e `UpdateBusinessPartnerRequest` com validação de campos e CNPJ customizado (`CnpjIsValid`)
* **Controller:** `BusinessPartnerController` (RESTful: index, show, store, update, destroy)
* **Service Layer:** encapsula regras de negócio (sanitização CNPJ, transações)
* **Resource:** padroniza JSON de resposta
* **Testes Feature:** cobrem sucesso, falha de validação e filtros

---

## 3. Estratégia Incremental

1. **Setup Inicial:**

   * Criar projeto Laravel 12 a partir do template CLI Aastera
   * Configurar banco de dados, Sanctum e autenticação

2. **Migração de Estrutura de Dados:**

   * Criar migration para tabela `business_partners`
   * Rodar migration em ambiente de teste

3. **Model e Validações:**

   * Implementar `BusinessPartner` com `softDeletes`
   * Criar FormRequests com validação customizada de CNPJ

4. **Endpoints API:**

   * CRUD completo via `BusinessPartnerController`
   * Implementar filtros (`q` por nome, `type`)
   * Garantir uso de transações para operações críticas

5. **Service Layer & Resources:**

   * Extrair lógica de negócio para Services
   * Padronizar saída JSON via Resource

6. **Testes Automatizados:**

   * Criar testes Feature cobrindo:

     * Criação com sucesso
     * Falhas de validação
     * Busca com filtros
     * Atualização e exclusão (soft delete)

7. **Dados de Teste:**

   * Criar Seeder opcional para popular tabela com fornecedores fictícios

8. **Revisão Final:**

   * Conferir PSR-12, legibilidade, separação de responsabilidades
   * Garantir documentação clara no README
   * Versionar código com commits bem organizados

---

## 4. Observações

* API protegida com **Sanctum**
* Validação CNPJ reforçada via regra customizada (`CnpjIsValid`)
* Estrutura escalável para evolução futura (clientes e outros tipos de parceiros)
* Plano realista para migração incremental, sem downtime em produção

