<?php
declare(strict_types=1);

namespace App\Model\Person;

use DateTime;
use JsonSerializable;

class Person implements JsonSerializable
{
   private int $id;
   private string $firstName;
   private string $lastName;
   private string $email;
   private DateTime $birthDate;

   public function __construct(string $email, string $firstName, string $lastName)
   {
      $this->email = $email;
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->birthDate = DateTime::createFromFormat('Y-m-d', '1970-01-01');
   }

   public function getId(): int
   {
      return $this->id;
   }

   public function getFirstName(): string
   {
      return $this->firstName;
   }

   public function getLastName(): string
   {
      return $this->lastName;
   }

   public function getEmail(): string
   {
      return $this->email;
   }

   public function getBirthDate(): DateTime
   {
      return $this->birthDate;
   }

   public function setEmail(string $email): void
   {
      $this->email = $email;
   }

   public function setBirthDate(int $day, int $month, int $year): void
   {
      $this->birthDate = DateTime::createFromFormat('Y-m-d', $year . '-' . $month . '-' . $day);
   }

   public function setId(int $id): void
   {
      $this->id = $id;
   }

   public function __toString(): string
   {
      return $this->firstName . ' ' . $this->lastName;
   }

   #[\ReturnTypeWillChange]
   public function jsonSerialize(): array
   {
       return [
           'id' => $this->id,
           'email' => $this->email,
           'first_name' => $this->firstName,
           'last_name' => $this->lastName,
           'birth_date' => $this->birthDate->format('Y-m-d'),
       ];
   }
}
