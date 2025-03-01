# 📌 API Documentation

## 🛠️ Autenticação
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
        "mensagem": "Cliente cadastrado com sucesso"
    },
    "retorno": {
        "id": 1,
        "cpf_cnpj": "12345678900",
        "nome_razao_social": "Fulano de Tal"
    }
}
```

### 🔍 Listar Clientes
**Endpoint:** `GET /customers`  
**Descrição:** Retorna a lista de clientes cadastrados.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Lista de clientes"
    },
    "retorno": [
        {
            "id": 1,
            "cpf_cnpj": "12345678900",
            "nome_razao_social": "Fulano de Tal"
        },
        {
            "id": 2,
            "cpf_cnpj": "98765432100",
            "nome_razao_social": "Ciclano de Souza"
        }
    ]
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


