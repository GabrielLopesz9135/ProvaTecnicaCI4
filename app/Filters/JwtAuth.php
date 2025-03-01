<?php

namespace App\Filters;

use App\Helpers\JwtHelper;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class JwtAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');
        if (!$header) {
            return response()->setJSON([
                'cabecalho' => [
                'status' => 401,
                'mensagem' => 'Token não fornecido'
            ],
            'retorno' => 'Forneça um Token válido para acessar o sistema'])->setStatusCode(401);
        }

        $token = str_replace('Bearer ', '', $header);
        $decoded = JwtHelper::decodeToken($token);

        if (!$decoded) {
            return response()->setJSON([
                'cabecalho' => [
                'status' => 401,
                'mensagem' => 'Token inválido ou expirado'
            ],
            'retorno' => 'Faça Login no sistema para obter um novo Token'])->setStatusCode(401);
        }

        $request->user = $decoded->data;
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {

    }
}
