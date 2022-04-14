<?php

namespace CoffeeShop\LoyaltyProgram\Application;

use CoffeeShop\LoyaltyProgram\Domain\LoyaltyCustomer;

interface LoyaltyRepository
{
    public function exists(string $email): bool;

    public function get(string $email): LoyaltyCustomer;

    public function save(LoyaltyCustomer $loyaltyCustomer): void;
}
