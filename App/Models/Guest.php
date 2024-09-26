<?php
declare(strict_types=1);

namespace App\Models;

use Phalcon\Mvc\Model;

/**
 * @method static Guest|null findFirstById(int $id)
 */
class Guest extends Model
{
    protected int $id = 0;
    protected string $first_name = '';
    protected string $last_name = '';
    protected string $country = 'ZZ';
    protected string $email = '';
    protected int $phone = 0;

    public function initialize(): void
    {
        $this->setSource('guests');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): void
    {
        $this->phone = $phone;
    }
}