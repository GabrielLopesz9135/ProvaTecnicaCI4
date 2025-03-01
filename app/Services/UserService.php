<?php

namespace App\Services;

use App\Helpers\JwtHelper;
use App\Models\User;
use App\Controllers\BaseController;

class UserService extends BaseController
{
    protected $model;
    protected $validation;

    public function __construct()
    {
        $this->model = new User();
        $this->validation = \Config\Services::validation();
    }

    public function register($data)
    {

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        if (!$this->model->insert($data)) {
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
            'message' => 'Usuário registrado com sucesso!',
            'retorno' => [
                'name' => $data['name'],
                'email' => $data['email']
            ]
        ];
            

    }

    public function login($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        $user = $this->model->where('email', $email)->first();

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'E-mail não encontrado.',
                'retorno' => 'O usuário fornecido não está cadastrado no banco de dados.'
            ];
        }

        if ($email === $user['email']  && password_verify($password, $user['password'])) {
            
            $token = JwtHelper::createToken(['id' => $user['id'], 'email' => $user['email']], 3600);
            return [
                'status' => 200,
                'message' => "Login realizado com sucesso.",
                'retorno' => [ 
                    'token' => $token
                ]
            ];
        }

        return [
            'status' => 401,
            'message' => 'Credenciais inválidas.',
            'retorno' => 'As credenciais fornecidas estão incorretas.'
        ]; 
    }
}

