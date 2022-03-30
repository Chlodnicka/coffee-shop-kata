<?php

declare(strict_types=1);

namespace CoffeeShop\LoyaltyProgram\Domain;

final class LoyaltyCustomer
{
    private const FREE_COFFEE_FOR_STAMPS_AMOUNT = 6;

    public function __construct(private string $email, private int $stamps = 0, private int $freeCoffees = 0)
    {
    }

    public function recalculate(int $cupsOfCoffee): void
    {
        $allStamps = $this->stamps + $cupsOfCoffee;
        $this->freeCoffees += (int)($allStamps / self::FREE_COFFEE_FOR_STAMPS_AMOUNT);
        $this->stamps = $allStamps % self::FREE_COFFEE_FOR_STAMPS_AMOUNT;
    }

    public function redeemFreeCoffees(int $requestedFreeCoffeeCups): void
    {
        if ($requestedFreeCoffeeCups > $this->freeCoffees) {
            throw new NotEnoughFreeCoffees($this->freeCoffees, $requestedFreeCoffeeCups);
        }
        $this->freeCoffees -= $requestedFreeCoffeeCups;
    }

    public function toArray(): array
    {
        return ['email' => $this->email, 'stamps' => $this->stamps, 'freeCoffees' => $this->freeCoffees];
    }

    public function getEmail(): string
    {
        return $this->email;
    }

}
