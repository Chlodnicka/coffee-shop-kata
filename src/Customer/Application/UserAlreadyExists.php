<?php

declare(strict_types=1);

namespace CoffeeShop\Customer\Application;

final class UserAlreadyExists extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("User with email $email already exists!");
    }
}
