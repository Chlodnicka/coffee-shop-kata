<?php

declare(strict_types=1);

namespace CoffeeShop\Customer\Application;

final class CustomerAlreadyExists extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Customer with email $email already exists!");
    }
}
