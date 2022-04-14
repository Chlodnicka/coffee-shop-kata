<?php

declare(strict_types=1);

namespace CoffeeShop\LoyaltyProgram\Application;

interface CustomerViewModel
{
    public function exists(string $email): bool;
}
