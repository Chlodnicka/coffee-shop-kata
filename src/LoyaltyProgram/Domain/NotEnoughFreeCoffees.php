<?php

declare(strict_types=1);

namespace CoffeeShop\LoyaltyProgram\Domain;

final class NotEnoughFreeCoffees extends \Exception
{
    public function __construct(int $availableFreeCoffees, int $requestedFreeCoffeeCups)
    {
        parent::__construct(
            "Not enough free coffees. Requested: $requestedFreeCoffeeCups, available: $availableFreeCoffees"
        );
    }
}
