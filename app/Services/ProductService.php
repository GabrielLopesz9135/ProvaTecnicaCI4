<?php

namespace App\Services;

use App\Models\Product;


class ProductService
{
    protected $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function index($filters = [])
    {
        $query = $this->model;

        if (!empty($filters['name'])) {
            $query = $query->like('name', $filters['name']);
        }
    
        if (!empty($filters['price'])) {
            $query = $query->like('price', $filters['price']);
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
            'message' => 'Produtos encontrados com sucesso!',
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
            'message' => 'Produto registrado com sucesso!',
            'retorno' => [
                'Nome' => $data['name'],
                'Preço' => $data['price']
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
            'message' => 'Produto encontrado com sucesso!',
            'retorno' => [
                'Nome' => $data['name'],
                'Preço' => $data['price']
            ]
        ];
    }

    public function update($id, $data)
    {
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
                'Nome' => $newData['name'],
                'Preço' => $newData['price'],
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

