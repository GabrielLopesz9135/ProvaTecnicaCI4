<?php

namespace App\Helpers;

use CodeIgniter\HTTP\ResponseInterface;

class JsonValidator
{
    public static function validate(array $request, array $requiredFields)
    {
        if (!isset($request['parametros']) || !is_array($request['parametros'])) {
            return [
                'status' => false,
                'response' => [
                    'cabecalho' => [
                        'status' => 400,
                        'mensagem' => 'Formato JSON inválido.'
                    ],
                    'retorno' => ''
                ],
                'statusCode' => ResponseInterface::HTTP_BAD_REQUEST
            ];
        }

        foreach ($requiredFields as $field) {
            if (!isset($request['parametros'][$field])) {
                return [
                    'status' => false,
                    'response' => [
                        'cabecalho' => [
                            'status' => 400,
                            'mensagem' => "Erro na validação dos dados."
                        ],
                        'retorno' => "Campo obrigatório '{$field}' está ausente."
                    ],
                    'statusCode' => ResponseInterface::HTTP_BAD_REQUEST
                ];
            }
        }

        return ['status' => true]; 
    }
}
