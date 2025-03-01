<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderProduct extends Model
{
    protected $table            = 'order_product';
    protected $primaryKey       = 'order_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'order_id', 'quantity'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'order_id' => [
            'label' => 'Ordem ID',
            'rules' => [
                'required',         
                'integer',           
                'is_not_unique[orders.id]' 
            ]
        ],
        'product_id' => [
            'label' => 'Product ID',
            'rules' => [
                'required', 
                'integer', 
                'is_not_unique[products.id]' 
            ]
        ],
        'quantity' => [
            'label' => 'Quantidade',
            'rules' => [
                'required', 
                'integer',
                'greater_than_equal_to[1]'
            ]
        ]
    ];
    protected $validationMessages = [
        'order_id' => [
            'required' => 'O campo {field} é obrigatório.',
            'integer' => 'O campo {field} deve ser um número inteiro.',
            'is_not_unique' => 'O {field} fornecido não existe na tabela de pedidos.'
        ],
        'product_id' => [
            'required' => 'O campo {field} é obrigatório.',
            'integer' => 'O campo {field} deve ser um número inteiro.',
            'is_not_unique' => 'O {field} fornecido não existe na tabela de produtos.'
        ],
        'quantity' => [
            'required' => 'O campo {field} é obrigatório.',
            'integer' => 'O campo {field} deve ser um número inteiro.',
            'greater_than_equal_to' => 'O campo {field} deve ser maior ou igual a 1.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getProductsByOrder($orderId)
    {
        return $this->select('products.*')
            ->join('products', 'products.id = order_product.product_id')
            ->where('order_product.order_id', $orderId)
            ->findAll();
    }

}
