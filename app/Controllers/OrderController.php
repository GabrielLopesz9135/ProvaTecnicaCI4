<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\JsonResponse;
use App\Helpers\JsonValidator;
use App\Services\OrderService;
use CodeIgniter\HTTP\ResponseInterface;

class OrderController extends BaseController
{
    private $service;

    public function __construct()
    {
        $this->service = new OrderService();
    }

    public function index()
    {
        $filters = $this->request->getGet();

        $result = $this->service->index($filters);
        return $this->response->setJSON($result)->setStatusCode(ResponseInterface::HTTP_OK);
    }

    public function store()
    {
        try {
            $request = $this->request->getJSON(true);
            $requiredFields = ['customer_id', 'products'];
            $validationResult = JsonValidator::validate($request, $requiredFields);

            if (!$validationResult['status']) {
                return $this->response->setJSON($validationResult['response'])->setStatusCode($validationResult['statusCode']);
            }
        
            $result = $this->service->store($request['parametros']);
            return JsonResponse::send($this->response, $result);

    
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'cabecalho' => [
                    'status' => 400,
                    'mensagem' => 'Formato JSON inválido. Verifique a sintaxe.'
                ],
                'retorno' => ''
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        }
        
    }

    public function show($id)
    {
        $result = $this->service->show($id); 
        return JsonResponse::send($this->response, $result);
    }

    public function update($id)
    {
        try{ 
            $request = $this->request->getJSON(true);
            $validationResult = JsonValidator::validate($request, $requiredFields = []);

            if (!$validationResult['status']) {
                return $this->response->setJSON($validationResult['response'])->setStatusCode($validationResult['statusCode']);
            }
        
            $result = $this->service->update($id, $request['parametros']);
            return JsonResponse::send($this->response, $result);

        }catch (\Exception $e) {
            return $this->response->setJSON([
                'cabecalho' => [
                    'status' => 400,
                    'mensagem' => 'Formato JSON inválido. Verifique a sintaxe.'
                ],
                'retorno' => ''
            ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
        } 
    }

    public function delete($id)
    {
        $result = $this->service->delete($id);
        return JsonResponse::send($this->response, $result);
    }
}
