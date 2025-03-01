<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['cpf_cnpj', 'nome_razao_social'];

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
        'cpf_cnpj' => [
            'label' => 'CPF/CNPJ',
            'rules' => [
                'required', 
                'max_length[14]',  
                'min_length[11]',   
                'numeric',         
                'is_unique[customers.cpf_cnpj]'
            ]
        ],
        'nome_razao_social' => [
            'label' => 'Nome/Razão Social', 
            'rules' => [
                'required',
                'max_length[255]', 
                'string'           
            ]
        ]
    ];
    protected $validationMessages = [
        'cpf_cnpj' => [
            'required' => 'O campo {field} é obrigatório.',
            'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
            'min_length' => 'O campo {field} deve ter no mínimo {param} caracteres.',
            'numeric' => 'O campo {field} deve conter apenas números.',
            'is_unique' => 'Este {field} já está cadastrado.'
        ],
        'nome_razao_social' => [
            'required' => 'O campo {field} é obrigatório.',
            'max_length' => 'O campo {field} deve ter no máximo {param} caracteres.',
            'string' => 'O campo {field} deve ser uma string válida.'
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
}
