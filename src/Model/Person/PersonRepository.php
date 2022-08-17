<?php
declare(strict_types=1);

namespace App\Model\Person;

class PersonRepository {
   static PersonRepository $instance;

   private int $nextId = 1;
   private array $persons = [];

   private function __construct() {
      $this->persons = [];
      $this->nextId = 1;
   }

   public static function getInstance(): PersonRepository {
      if (!isset(self::$instance)) {
         self::$instance = new PersonRepository();
      }
      return self::$instance;
   }

   public function create(string $email, string $firstName, string $lastName): Person {
      $person = new Person($email, $firstName, $lastName);
      $person->setId($this->nextId++);
      $this->persons[$person->getId()] = $person;
      return $person;
   }

   public function find(int $id): ?Person {
      return $this->persons[$id] ?? null;
   }

   public function findAll(): array {
      return $this->persons;
   }
}