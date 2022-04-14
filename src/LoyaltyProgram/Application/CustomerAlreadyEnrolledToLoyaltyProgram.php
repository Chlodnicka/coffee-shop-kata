<?php

declare(strict_types=1);

namespace CoffeeShop\LoyaltyProgram\Application;

final class CustomerAlreadyEnrolledToLoyaltyProgram extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Customer with email $email already enrolled to loyalty program!");
    }
}
