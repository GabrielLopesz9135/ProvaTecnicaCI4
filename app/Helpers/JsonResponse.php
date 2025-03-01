<?php

namespace App\Helpers;

use CodeIgniter\HTTP\ResponseInterface;

class JsonResponse
{
    public static function send($response, array $result)
    {
        $statusCode = $result['status'] ?? ResponseInterface::HTTP_BAD_REQUEST;

        $data = [
            'cabecalho' => [
                'status' => $statusCode,
                'mensagem' => $result['message'] ?? 'Erro desconhecido.'
            ],
            'retorno' => $result['retorno'] ?? []
        ];

       /*  if (isset($result['errors'])) {
            $data['retorno']['errors'] = $result['errors'];
        } */

        return $response->setJSON($data)->setStatusCode($statusCode);
    }
}
