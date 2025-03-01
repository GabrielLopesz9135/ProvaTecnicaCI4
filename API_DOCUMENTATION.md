# 📌 API Documentation

## 🛠️ Autenticação

### 📝 Registro  
**Endpoint:** `POST /users/register`  
**Descrição:** Registra um novo usuário na plataforma.  

**Exemplo de Requisição:**  
```json
{
    "parametros": {
        "name": "João Silva",
        "email": "joaosilva@example.com",
        "password": "senhasegura"
    }
}
```
**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 201,
        "mensagem": "Usuário registrado com sucesso"
    },
    "retorno": {
        "name": "João Silva",
        "email": "joaosilva@example.com"
    }
}
```
### 🔑 Login
**Endpoint:** `POST /users/login`  
**Descrição:** Autentica um usuário e retorna um token JWT.  
**Exemplo de Requisição:**  
```json
{
    "parametros": {
        "email": "user@example.com",
        "password": "123456"
    }
}
```
**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Login realizado com sucesso"
    },
    "retorno": {
        "token": "eyJhbGciOiJIUzI1..."
    }
}
```
---

## 🛍️ Clientes (Customers)
### 🔹 Listar Clientes
**Endpoint:** `GET /customers`  
**Descrição:** Retorna uma lista de clientes cadastrados. Pode ser filtrado por nome_razao_social e cpf_cnpj 
**Parâmetros de Consulta (Query Params):**
    >nome_razao_social (opcional): Filtra clientes pelo nome ou razão social.
    >cpf_cnpj (opcional): Filtra clientes pelo CPF ou CNPJ.
    >page (opcional): Controla o número da paginação dos registros.
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/customers?nome_razao_social=João&cpf_cnpj=12345678900&page=2` 

**Exemplo de Resposta (201 Created):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Clientes encontrados com sucesso!"
    },
    "retorno": [
        {
            "id": 1,
            "nome_razao_social": "João Silva",
            "cpf_cnpj": "12345678900",
        },
        {
            "id": 2,
            "nome_razao_social": "Empresa XYZ",
            "cpf_cnpj": "98765432100001",
        }
    ]
}
```
---

## 🛍️ Clientes (Customers)
### 🔹 Criar Cliente
**Endpoint:** `POST /customers`  
**Descrição:** Cria um novo cliente.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:**  
```json
{
    "parametros": {
        "cpf_cnpj": "12345678900",
        "nome_razao_social": "Fulano de Tal"
    }
}
```
**Exemplo de Resposta (201 Created):**  
```json
{
    "cabecalho": {
        "status": 201,
        "mensagem": "Cliente registrado com sucesso!"
    },
    "retorno": {
        "cpf_cnpj": "12345678900",
        "nome_razao_social": "Fulano de Tal"
    }
}
```

### 🔍 Listar Cliente
**Endpoint:** `GET /customers/$id`  
**Descrição:** Retorna os detalhes de um cliente específico com base no ID.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/customers/1` 

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Cliente encontrado com sucesso!"
    },
    "retorno": {
        "id": 1,
        "nome_razao_social": "João Silva",
        "cpf_cnpj": "12345678900",
        "created_at": "2023-10-01T12:00:00Z"
    }
}
```
---

### 🔍 Atualizar Cliente
**Endpoint:** `PUT /customers/$id`  
**Descrição:** Atualiza os dados de um cliente existente com base no ID.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:**  
```json
{
    "parametros": {
        "nome_razao_social": "João Silva Santos",
        "cpf_cnpj": "12345678900"
    }
}
```

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Cliente atualizado com sucesso"
    },
    "retorno": {
        "nome_razao_social": "João Silva Santos",
        "cpf_cnpj": "12345678900",
    }
}
```
---

### 🔍 Excluir Cliente
**Endpoint:** `DELETE /customers/$id`  
**Descrição:** Exclui um cliente com base no ID.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/customers/1` 

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Registro apagado com sucesso!"
    },
    "retorno": ""
}
```
---

## 📦 Pedidos (Orders)
### 📝 Criar Pedido
**Endpoint:** `POST /orders`  
**Descrição:** Cria um novo pedido e adiciona produtos na tabela intermediária.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:**  
```json
{
    "parametros": {
        "customer_id": 1,
        "products": [
            {
                "product_id": 101,
                "quantity": 2
            },
            {
                "product_id": 202,
                "quantity": 1
            }
        ]
    }
}
```
**Exemplo de Resposta (201 Created):**  
```json
{
    "cabecalho": {
        "status": 201,
        "mensagem": "Pedido criado com sucesso"
    },
    "retorno": {
        "order_id": 10,
        "customer_id": 1,
        "products": [
            {
                "product_id": 101,
                "quantity": 2
            },
            {
                "product_id": 202,
                "quantity": 1
            }
        ]
    }
}
```

### 📋 Listar Pedidos
**Endpoint:** `GET /orders`  
**Descrição:** Retorna a lista de pedidos com detalhes dos produtos e clientes.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Lista de pedidos"
    },
    "retorno": [
        {
            "order": {
                "orderData": {
                    "id": 10,
                    "customer_id": 1,
                    "status": "confirmado"
                },
                "products": [
                    {
                        "product_id": 101,
                        "name": "Produto A",
                        "quantity": 2
                    },
                    {
                        "product_id": 202,
                        "name": "Produto B",
                        "quantity": 1
                    }
                ]
            }
        }
    ]
}
```

---

## 🗑️ Excluir Pedido
**Endpoint:** `DELETE /orders/{id}`  
**Descrição:** Remove um pedido do sistema.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Pedido removido com sucesso"
    }
}
```


