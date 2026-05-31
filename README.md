## Como executar o projeto

### Pré-requisitos
Antes de começar, você vai precisar ter as seguintes ferramentas instaladas em sua máquina:

- [PHP](https://www.php.net/) *(versão 8.2 ou superior recomendada)*
- [Composer](https://getcomposer.org/)
- [PostgreSQL](https://www.postgresql.org/)
- [Git](https://git-scm.com/)

---

## 🛠️ Instalação e Configuração

### 1. Clone o repositório

```bash
git clone https://github.com/Lz-Fernando/agape-desafio.git
```

### 2. Acesse a pasta do projeto

```bash
cd agape-desafio
```

### 3. Configure o arquivo `php.ini`

Após instalar o PHP, localize o arquivo `php.ini` da sua instalação e habilite as extensões necessárias removendo o `;` do início das linhas abaixo *(caso estejam comentadas)*:

```ini
extension=pdo_pgsql
extension=pgsql
extension=fileinfo
extension=openssl
extension=mbstring
extension=zip
```

Depois de salvar o arquivo, reinicie o terminal ou o servidor local para aplicar as alterações.

> 💡 Dica: Você pode descobrir o caminho do `php.ini` executando o comando abaixo no terminal:
>
> ```bash
> php --ini
> ```

### 4. Instale as dependências do Back-end (PHP)

```bash
composer install
```

### 5. Configure o ambiente

Crie uma cópia do arquivo de configuração de exemplo:

```bash
cp .env.example .env
```

### 6. Configure o Banco de Dados (PostgreSQL)

- Abra o seu SGBD *(ex: pgAdmin ou DBeaver)*.
- Crie um banco de dados vazio chamado `agape_desafio`.
- Abra o arquivo `.env` na raiz do projeto e configure as variáveis de conexão com as suas credenciais locais:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=agape_desafio
DB_USERNAME=seu_usuario_do_postgres
DB_PASSWORD=sua_senha_do_postgres
```

### 7. Gere a chave da aplicação

```bash
php artisan key:generate
```

### 8. Rode as migrações

Este comando criará todas as tabelas no banco de dados e as populará com os dados iniciais *(seeders)*:

```bash
php artisan migrate --seed
```

---

## 💻 Executando a Aplicação

Para visualizar o projeto funcionando perfeitamente, abra o terminal na pasta do projeto.

### Terminal — Inicia o servidor local do Laravel

```bash
php artisan serve
```

---

## ✅ Acesso ao sistema

Após iniciar os serviços, o projeto estará disponível em:

👉 `http://localhost:8000`
