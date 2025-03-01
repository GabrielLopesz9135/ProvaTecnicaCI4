<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\JsonResponse;
use App\Helpers\JsonValidator;
use App\Services\UserService;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    private $service;

    public function __construct()
    {
        $this->service = new UserService;
    }

    public function register()
    {
        $request = $this->request->getJSON(true);

        $requiredFields = ['email', 'password', 'name'];
        $validationResult = JsonValidator::validate($request, $requiredFields);

        if (!$validationResult['status']) {
            return $this->response->setJSON($validationResult['response'])->setStatusCode($validationResult['statusCode']);
        }

        $result = $this->service->register($request['parametros']);
        return JsonResponse::send($this->response, $result);

        
    }

    public function login()
    {
        $request = $this->request->getJSON(true);

        $requiredFields = ['email', 'password'];
        $validationResult = JsonValidator::validate($request, $requiredFields);

        if (!$validationResult['status']) {
            return $this->response->setJSON($validationResult['response'])->setStatusCode($validationResult['statusCode']);
        }
        
        $result = $this->service->login($request['parametros']); 
        return JsonResponse::send($this->response, $result);
    }
}
