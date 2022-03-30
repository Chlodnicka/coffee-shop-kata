<?php

namespace CoffeeShop\Customer\Application;

interface CustomerRepository
{
    public function get(string $email): ?array;

    public function create(string $email): void;
}
