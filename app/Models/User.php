<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'email', 'password'];

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
        'name' => [
            'label' => "Nome",
            'rules' => [
                'required',
                'max_length[255]',
                'string'
            ]
        ],
        'email' => [
            'label' => 'E-mail',
            'rules' => [
                'required',
                'min_length[6]',
                'max_length[255]',
                'valid_email',
                'is_unique[users.email]'
            ]
        ],
        'password' => [
            'label' => 'Senha',
            'rules' => [
                'required',
                'min_length[6]',
                'max_length[255]'
            ]
        ]
    ];
    protected $validationMessages = [
        'name' => [
            'required' => 'O campo nome é obrigatório.',
            'max_length'  => 'O Nome pode ter no máximo {param} caracteres.',
            'string' =>'O Nome deve ser um campo do tipo string'
        ],
        'email' => [
            'required'    => 'O campo e-mail é obrigatório.',
            'min_length'  => 'O e-mail deve ter pelo menos {param} caracteres.',
            'max_length'  => 'O e-mail pode ter no máximo {param} caracteres.',
            'valid_email' => 'Insira um endereço de e-mail válido.',
            'is_unique'   => 'Este e-mail já está cadastrado.',
        ],
        'password' => [
            'required'   => 'O campo senha é obrigatório.',
            'min_length' => 'A senha deve ter no mínimo {param} caracteres.',
            'max_length' => 'A senha pode ter no máximo {param} caracteres.',
        ],
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
