<?php

namespace App\Models;

use CodeIgniter\Model;

class Order extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['customer_id', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'customer_id' => [
            'label' => 'Customer ID',
            'rules' => [
                'required', 
                'integer',           
                'is_not_unique[customers.id]'
            ]
        ],
        'status' => [
            'label' => 'Status',
            'rules' => [
                'required',
                'in_list[Em Aberto,Pago,Cancelado]'
            ]
        ]
    ];
    protected $validationMessages = [
        'customer_id' => [
            'required' => 'O campo {field} é obrigatório.',
            'integer' => 'O campo {field} deve ser um número inteiro.',
            'is_not_unique' => 'O {field} fornecido não existe na tabela de clientes.'
        ],
        'status' => [
            'required' => 'O campo {field} é obrigatório.',
            'in_list' => 'O campo {field} deve ser um dos valores: Em Aberto, Pago, Cancelado.'
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

    public function getOrderWithDetails($orderId)
    {
        return $this->select('orders.id, orders.customer_id, orders.status, customers.nome_razao_social, customers.cpf_cnpj')
            ->join('customers', 'customers.id = orders.customer_id')
            ->where('orders.id', $orderId)
            ->first();
    }


}
