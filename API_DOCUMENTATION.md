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
Descrição:
Retorna uma lista de clientes cadastrados. Pode ser filtrado por nome_razao_social e cpf_cnpj.

Parâmetros de Consulta (Query Params):
> • nome_razao_social (opcional): Filtra clientes pelo nome ou razão social. <br>
> • cpf_cnpj (opcional): Filtra clientes pelo CPF ou CNPJ.  <br>
> • page (opcional): Controla o número da paginação dos registros.

**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/customers?nome_razao_social=João&cpf_cnpj=12345678900&page=2` 

**Exemplo de Resposta (200):**  
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

### 📝 Criar Cliente
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

### 📋 Listar Cliente
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

### 📝 Atualizar Cliente
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

### 🗑️ Excluir Cliente
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

## 🛍️ Produtos (Products)
### 🔹 Listar Produtos
**Endpoint:** `GET /products`  
Descrição:
Retorna uma lista de produtos cadastrados. Pode ser filtrado por name e price.

Parâmetros de Consulta (Query Params):
> • name (opcional): Filtra produtos pelo nome. <br>
> • price (opcional): Filtra produtos pelo preço. <br>
> • page (opcional): Controla o número da paginação dos registros.

**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/products?name=Notebook&price=4500` 

**Exemplo de Resposta (200):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Produtos encontrados com sucesso!"
    },
    "retorno": [
        {
            "name": "Notebook Dell",
            "price": 4500.00,
        },
        {
            "name": "Smartphone Samsung",
            "price": 2500.00,
        }
    ]
}
```
---

### 📝 Criar Produto
**Endpoint:** `POST /products`  
**Descrição:** Cria um novo produto.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:**  
```json
{
    "parametros": {
        "name": "Notebook Dell",
        "price": 4500.00
    }
}
```
**Exemplo de Resposta (200):**  
```json
{
    "cabecalho": {
        "status": 201,
        "mensagem": "Produto registrado com sucesso!"
    },
    "retorno": {
        "name": "Notebook Dell",
        "price": 4500.00,
    }
}
```

### 📋 Listar Produto
**Endpoint:** `GET /products/$id`  
**Descrição:** Retorna os detalhes de um produto específico com base no ID.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/products/1` 

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Produto obtido com sucesso"
    },
    "retorno": {
        "name": "Notebook Dell",
        "price": 4500.00,
    }
}
```
---

### 📝 Atualizar Produto
**Endpoint:** `PUT /products/$id`  
**Descrição:** Atualiza os dados de um cliente existente com base no ID.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:**  
```json
{
    "parametros": {
        "name": "Notebook Dell XPS",
        "price": 5000.00
    }
}
```

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Produto atualizado com sucesso"
    },
    "retorno": {
        "name": "Notebook Dell XPS",
        "price": 5000.00,
    }
}
```
---

### 🗑️ Excluir Produto
**Endpoint:** `DELETE /products/$id`  
**Descrição:** Exclui um produto com base no ID.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/products/1` 

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Produto excluído com sucesso"
    },
    "retorno": ""
}
```
---

## 🛍️ Ordens de Compra (orders)
### 🔹 Listar Ordens
**Endpoint:** `GET /orders`  
Descrição:
Retorna uma lista de ordem de compras cadastradas. Pode ser filtradas por ID do cliente e status.

Parâmetros de Consulta (Query Params):
> • customer_id (opcional): Filtra ordens pelo ID do cliente. <br>
> • status (opcional): Filtra ordens pelo status. <br>
> • page (opcional): Controla o número da paginação dos registros.

**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/orders?customer_id=1&status="Pago"&page=2` 

**Exemplo de Resposta (200):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Ordens de Compra encontradas com sucesso!"
    },
    "retorno": [
        {
            "customer_id": 1,
            "status": "Em aberto",
        },
        {
            "customer_id": 2,
            "status": "Pago",
        }
    ]
}
```
---

### 📝 Criar Ordem de Compra
**Endpoint:** `POST /orders`  
**Descrição:** Cria um nova Ordem de Compra, percorre uma lista de produtos que podem ser passados no array products{} para preencher uma tabela intermediária que liga os Produtos a Ordem de Compra.
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:**  
```json
{
    "parametros": {
        "customer_id": 1,
        "status": "Em aberto",
        "products": [
            {
                "product_id": 1,
                "quantity": 2
            },
            {
                "product_id": 2,
                "quantity": 1
            }
        ]
    }
}
```
**Exemplo de Resposta (201):**  
```json
{
    "status": 201,
    "message": "Ação Concluída com Sucesso",
    "retorno": {
        "order": {
            "orderInfo": {
                "id": 1,
                "customer_id": 1,
                "status": "Em aberto",
            },
            "products": [
                {
                    "name": "Notebook Dell",
                    "price": 4500.00,
                    "quantity": 2
                },
                {
                    "name": "Smartphone Samsung",
                    "price": 2500.00,
                    "quantity": 1
                }
            ]
        }
    }
}
```

### 📋 Listar Ordem de Compra
**Endpoint:** `GET /orders/$id`  
**Descrição:** Retorna os detalhes de uma Ordem de Compra específica com base no ID.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/orders/1` 

**Exemplo de Resposta (200 OK):**  
```json
{
    "status": 201,
    "message": "Ação Concluída com Sucesso",
    "retorno": {
        "order": {
            "orderInfo": {
                "id": 1,
                "customer_id": 1,
                "status": "Em aberto",
            },
            "products": [
                {
                    "name": "Notebook Dell",
                    "price": 4500.00,
                    "quantity": 2
                },
                {
                    "name": "Smartphone Samsung",
                    "price": 2500.00,
                    "quantity": 1
                }
            ]
        }
    }
}
```
---

### 📝 Atualizar Ordem de Compra
**Endpoint:** `PUT /orders/$id`  
**Descrição:** Atualiza os dados de uma Ordem de Compra existente com base no ID.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:**  
```json
{
    "parametros": {
        "customer_id": 1,
        "status": "Pago"
    }
}
```

**Exemplo de Resposta (200 OK):**  
```json
{
    "status": 201,
    "message": "Ação Concluída com Sucesso",
    "retorno": {
        "order": {
            "orderInfo": {
                "customer_id": 1,
                "status": "Pago",
            },
            "products": [
                {
                    "name": "Notebook Dell",
                    "price": 4500.00,
                    "quantity": 2
                },
                {
                    "name": "Smartphone Samsung",
                    "price": 2500.00,
                    "quantity": 1
                }
            ]
        }
    }
}
```
---

### 🗑️ Excluir Ordem de Compra
**Endpoint:** `DELETE /orders/$id`  
**Descrição:** Exclui uma Ordem de Compra com base no ID.  
**Headers:**  
`Authorization: Bearer <TOKEN>`  

**Exemplo de Requisição:** `/orders/1` 

**Exemplo de Resposta (200 OK):**  
```json
{
    "cabecalho": {
        "status": 200,
        "mensagem": "Ordem de Compra excluído com sucesso"
    },
    "retorno": ""
}
```
---


