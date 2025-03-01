<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;

class OrderService
{
    protected $orderModel;
    protected $orderProductModel;

    public function __construct()
    {
        $this->orderModel = new Order();
        $this->orderProductModel = new OrderProduct();
    }

    public function index($filters = [])
    {
        $query = $this->orderModel;

        if (!empty($filters['customer_id'])) {
            $query = $query->like('customer_id', $filters['customer_id']);
        }
    
        if (!empty($filters['status'])) {
            $query = $query->like('status', $filters['status']);
        }
    
        return $query->paginate(10);

        if (!$data) {
            return [
                'status' => 404,
                'message' => 'Erro na validação dos filtros.',
                'retorno' => [
                    'errors' => $this->orderModel->errors()
                ]
            ];
        }

        return [
            'status' => 200,
            'message' => 'Ordens de Compra encontradas com sucesso!',
            'retorno' => $data
        ];
    }

    public function store($data)
    {
        $orderData = [
            'customer_id' => $data['customer_id'],
            'status' => 'Em Aberto',
        ];

        $orderId = $this->orderModel->insert($orderData);

        if (!$orderId) {
            return [
                'status' => 422,
                'message' => 'Erro na validação dos dados.',
                'retorno' => [
                    'errors' => $this->orderModel->errors()
                ]
            ];
        }

        foreach ($data['products'] as $product) {

           $result = $this->orderProductModel->insert([
                'order_id' => $orderId,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);

            if (!$result) {
                return [
                    'status' => 422,
                    'message' => 'Erro na validação dos dados.',
                    'retorno' => [
                        'errors' => $this->orderProductModel->errors(),
                    ]
                ];
            }
        }

        return $this->getOrderDetails($orderId);
    }

    public function show($id)
    {
        $data = $this->orderModel->find($id);

        if (!$data) {
            return [
                'status' => 404,
                'message' => 'Nenhum registro encontrado no Banco de Dados',
                'retorno' =>  'Ola'
            ];
        }

        return $this->getOrderDetails($id);
    }

    public function update($id, $data)
    {
        $result = $this->orderModel->where('id', $id)->set($data)->update();

        if (!$result) {
            return [
                'status' => 404,
                'message' => 'Erro ao atualizar os dados',
                'retorno' => [
                    'errors' => $this->orderModel->errors()
                ] 
            ];
        }

        return $this->getOrderDetails($id);
    }

    public function delete($id)
    {
        $data = $this->orderModel->find($id);
        
        if (!$data) {
            return [
                'status' => 404,
                'message' => 'Erro ao apagar os dados',
                'retorno' => 'O item referente ao ID não foi encontrado no Banco de Dados' 
            ];
        }

        $result = $this->orderModel->delete($data['id']);

        if (!$result) {
            return [
                'status' => 404,
                'message' => 'Erro ao apagar os dados',
                'retorno' =>  [
                    'errors' => $this->orderModel->errors()
                ] 
            ];
        }

        return [
            'status' => 200,
            'message' => 'Registro apagado com sucesso!',
            'retorno' => ''
        ];
    }

    public function getOrderDetails($orderId)
    {
        $order = $this->orderModel->getOrderWithDetails($orderId);

        if (!$order) {
            return [
                'status' => 404,
                'message' => 'Pedido não encontrado',
                'retorno' => ''
            ];
        }

        $products = $this->orderProductModel->getProductsByOrder($orderId);

        return [
            'status' => 200,
            'message' => 'Ação Concluida com Sucesso',
            'retorno' => [
                'order' => [
                    'orderInfo' => $order,
                    'products' => $products
                ]
                
            ]
        ];
    }

}

