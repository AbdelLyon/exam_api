<?php

namespace Controllers;

use Models\Plats;
use Models\Restaurant as ModelsRestaurant;

class Restaurant extends AbstractController
{
   protected string $modelName = ModelsRestaurant::class;

   public function index()
   {
      return $this->json($this->model->findAll());
   }

   public function new()
   {
      $request = $this->post('json', ['name' => 'text', 'adresse' => 'text', 'city' => 'text']);

      if (!$request) return $this->json('Failed request');

      $restaurant = new ModelsRestaurant();

      $restaurant->setName($request['name']);
      $restaurant->setAdresse($request['adresse']);
      $restaurant->setCity($request['city']);

      $this->model->save($restaurant);

      return $this->json('Successful request');
   }


   public function suppr()
   {
      $request = $this->delete('json', ['id' => 'number']);
      if (!$request) return $this->json('Failed request', 'delete');

      $restaurant = $this->model->findById($request['id']);
      if (!$restaurant) return $this->json('Car does not exist', 'delete');

      $this->model->remove($restaurant);
      return $this->json('Successful request', 'delete');
   }
}
