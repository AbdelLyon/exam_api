<?php

namespace Controllers;

use Models\Home as ModelsHome;

class Home extends AbstractController
{
   protected string $modelName = ModelsHome::class;

   public function index()
   {
      return $this->json($this->model->findAll());
   }
}
