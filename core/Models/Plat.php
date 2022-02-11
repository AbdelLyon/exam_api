<?php

namespace Models;

class Plat extends AbstractModel implements \JsonSerializable
{
   protected string $table = "plats";

   private int $id;
   private string $description;
   private string $price;
   private int $restaurant_id;

   public function getId()
   {
      return $this->id;
   }

   public function setDescription($description)
   {
      $this->description = $description;
   }

   public function getPrice()
   {
      return $this->price;
   }

   public function setPrice($price)
   {
      $this->price = $price;
   }

   public function getrestaurantId(): ?int
   {
      return $this->restaurant_id;
   }

   public function setrestaurantId(int $restaurant_id): void
   {
      $this->restaurant_id = $restaurant_id;
   }

   public function findAllByRestaurant(Restaurant $restaurant)
   {
      $sql = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE restaurant_id = :restaurant_id");
      $sql->execute(['restaurant_id' => $restaurant->getId()]);
      $plats = $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));
      return $plats;
   }


   public function jsonSerialize()
   {
      return [
         "id" => $this->id,
         "description" => $this->description,
         "price" => $this->price,
      ];
   }
}
