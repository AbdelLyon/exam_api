<?php

namespace Controllers;

use App\Request;
use App\Response;

abstract class AbstractController
{
   protected object $model;
   protected string $modelName;
   protected object $request;

   public function __construct()
   {
      $this->model = new $this->modelName();
      $this->request = new Request();
   }

   public function post(string $dataType, array $requestBodyParams)
   {
      return Request::post($dataType, $requestBodyParams);
   }

   public function delete(string $dataType, array $requestBodyParams)
   {
      return Request::delete($dataType, $requestBodyParams);
   }

   public function json($response, $methodSpe = null)
   {
      return Response::json($response, $methodSpe);
   }
}
