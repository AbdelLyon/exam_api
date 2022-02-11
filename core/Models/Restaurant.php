<?php

namespace Models;

class Restaurant extends AbstractModel implements \JsonSerializable
{
   protected string $table = "restaurant";

   private int $id;
   private string $name;
   private string $adresse;
   private string $city;

   public function getId()
   {
      return $this->id;
   }

   public function setName($name)
   {
      $this->name = $name;
   }

   public function getAdresse()
   {
      return $this->adresse;
   }

   public function setAdresse($adresse)
   {
      $this->adresse = $adresse;
   }
   public function getCity()
   {
      return $this->city;
   }

   public function setCity($city)
   {
      $this->city = $city;
   }



   public function save(Restaurant $restaurant)
   {
      $sql = $this->pdo->prepare("INSERT INTO {$this->table}  VALUES (DEFAULT, :name, :adresse, :city)");
      $sql->execute([
         'name' => $restaurant->name,
         'adresse' => $restaurant->adresse,
         'city' => $restaurant->city
      ]);
   }



   public function getPlat()
   {
      $modelPlat = new Plat();
      return $modelPlat->findAllByRestaurant($this);
   }


   public function jsonSerialize()
   {
      return [
         "id" => $this->id,
         "name" => $this->name,
         "adresse" => $this->adresse,
         "city" => $this->city,
         'plats' => $this->getPlat()
      ];
   }
}
