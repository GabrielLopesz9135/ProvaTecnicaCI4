# CodeIgniter 4 API - CRUD com JWT Authentication

## 📌 Sobre o Projeto
Este projeto é uma API RESTful desenvolvida com CodeIgniter 4, implementando CRUDs para clientes, produtos e ordens de compra. O sistema utiliza autenticação JWT para garantir segurança nas requisições.

---

## 🚀 Configuração do Ambiente

### 🔹 1. Clonar o Repositório
```sh
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

### 🔹 2. Instalar as Dependências do Composer
```sh
composer install
```

### 🔹 3. Configurar o Ambiente
Renomeie o arquivo `.env.example` para `.env` e edite os seguintes valores:
```sh
CI_ENVIRONMENT = development
```
> **Observação**: O `CI_ENVIRONMENT` define o ambiente de desenvolvimento. Em produção, altere para `production`.

### 🔹 4. Configurar o Banco de Dados
No arquivo `.env`, edite as credenciais do banco:
```sh
database.default.hostname = localhost
database.default.database = nome_do_banco
database.default.username = usuario
database.default.password = senha
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```
> **Dica**: Certifique-se de que o banco de dados já foi criado antes de rodar as migrations.

### 🔹 5. Rodar as Migrations
```sh
php spark migrate
```
Se precisar recriar as tabelas, utilize:
```sh
php spark migrate:refresh
```

---

## 🔑 Configuração do JWT

### 🔹 1. Instalar a Biblioteca JWT
```sh
composer require firebase/php-jwt
```

### 🔹 2. Configurar a Chave Secreta no `.env`
Adicione:
```sh
JWT_SECRET_KEY="sua_chave_secreta"
```
> **Importante**: Substitua `sua_chave_secreta` por uma chave forte e segura.

### 🔹 3. Criar Token JWT no Login
Após um login bem-sucedido, um token JWT será gerado e enviado na resposta:
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Login realizado com sucesso."
    },
    "retorno": {
        "token": "Seu Token"
    }
}
```

### 🔹 4. Enviar o Token nas Requisições Protegidas
Nas requisições autenticadas, envie o token no cabeçalho:
```sh
Authorization: Bearer seu_token_aqui
```

---

## 🛠️ Execução do Servidor
Para rodar o servidor localmente, utilize:
```sh
php spark serve
```
O servidor estará acessível em:
```
http://localhost:8080
```

---

## 📌 Endpoints da API

### 🔹 **Autenticação**
- **Login**: `POST /users/login`
  - Parâmetros:
  - `{
    "parametros": {
        "email": "teste2@gmail.com",
        "password": "123456"
        }
    }`
  - Retorno: `token JWT`

### 🔹 **Clientes** (`/customers`)
- `POST /customers` - Criar cliente
- `GET /customers` - Listar clientes
- `GET /customers/{id}` - Obter um cliente específico
- `PUT /customers/{id}` - Atualizar cliente
- `DELETE /customers/{id}` - Excluir cliente

### 🔹 **Produtos** (`/products`)
- `POST /products` - Criar produto
- `GET /products` - Listar produtos
- `GET /products/{id}` - Obter um produto específico
- `PUT /products/{id}` - Atualizar produto
- `DELETE /products/{id}` - Excluir produto

### 🔹 **Ordens de Compra** (`/orders`)
- `POST /orders` - Criar ordem
- `GET /orders` - Listar ordens
- `GET /orders/{id}` - Obter uma ordem específica
- `PUT /orders/{id}` - Atualizar ordem
- `DELETE /orders/{id}` - Excluir ordem

---

## 🛠️ Tecnologias Utilizadas
- **PHP 8.x**
- **CodeIgniter 4**
- **MySQL**
- **JWT Authentication**
- **Composer**

---

## 📄 Licença
Este projeto está licenciado sob a licença MIT.

---

## 🤝 Contribuição
Sinta-se à vontade para abrir Issues ou Pull Requests caso queira contribuir! 🚀


