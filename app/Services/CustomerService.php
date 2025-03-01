<?php

namespace App\Services;

use App\Models\Customer;


class CustomerService
{
    protected $model;

    public function __construct()
    {
        $this->model = new Customer();
    }

    public function index($filters = [])
    {
        $query = $this->model;

        if (!empty($filters['nome_razao_social'])) {
            $query = $query->like('nome_razao_social', $filters['nome_razao_social']);
        }
    
        if (!empty($filters['cpf_cnpj'])) {
            $query = $query->like('cpf_cnpj', $filters['cpf_cnpj']);
        }
    
        return $query->paginate(10);

        if (!$data) {
            return [
                'status' => 404,
                'message' => 'Erro na validação dos filtros.',
                'retorno' => [
                    'errors' => $this->model->errors()
                ]
            ];
        }

        return [
            'status' => 200,
            'message' => 'Clientes encontrados com sucesso!',
            'retorno' => $data
        ];
    }

    public function store($data)
    {
        $result = $this->model->insert($data);
        
        if (!$result) {
            return [
                'status' => 422,
                'message' => 'Erro na validação dos dados.',
                'retorno' => [
                    'errors' => $this->model->errors()
                ]
            ];
        }

        return [
            'status' => 201,
            'message' => 'Cliente registrado com sucesso!',
            'retorno' => [
                'Nome/Razão Social' => $data['nome_razao_social'],
                'CPF/CNPJ' => $data['cpf_cnpj']
            ]
        ]; 
    }

    public function show($id)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return [
                'status' => 404,
                'message' => 'Nenhum registro encontrado no Banco de Dados',
                'retorno' =>  ''
            ];
        }

        return [
            'status' => 200,
            'message' => 'Cliente encontrado com sucesso!',
            'retorno' => [
                'Nome/Razão Social' => $data['nome_razao_social'],
                'CPF/CNPJ' => $data['cpf_cnpj']
            ]
        ];
    }

    public function update($id, $data)
    {
        $existingRecord = $this->model->find($id);
    
        if (!$existingRecord) {
            return [
                'status' => 404,
                'message' => 'Registro não encontrado.',
                'retorno' => 'O item referente ao ID não foi encontrado no Banco de Dados'
            ];
        }

        $result = $this->model->where('id', $id)->set($data)->update();

        if (!$result) {
            return [
                'status' => 404,
                'message' => 'Erro ao atualizar os dados',
                'retorno' => [
                    'errors' => $this->model->errors()
                ] 
            ];
        }

        $newData = $this->model->find($id); 

        return [
            'status' => 200,
            'message' => 'Registro alterado com sucesso!',
            'retorno' => [
                'Nome/Razão Social' => $newData['nome_razao_social'],
                'CPF/CNPJ' => $newData['cpf_cnpj'],
            ]
        ];
    }

    public function delete($id)
    {
        $data = $this->model->find($id);
        
        if (!$data) {
            return [
                'status' => 404,
                'message' => 'Erro ao apagar os dados',
                'retorno' => 'O item referente ao ID não foi encontrado no Banco de Dados' 
            ];
        }

        $result = $this->model->delete($data['id']);

        if (!$result) {
            return [
                'status' => 404,
                'message' => 'Erro ao apagar os dados',
                'retorno' =>  [
                    'errors' => $this->model->errors()
                ] 
            ];
        }

        return [
            'status' => 200,
            'message' => 'Registro apagado com sucesso!',
            'retorno' => ''
        ];
    }
}

