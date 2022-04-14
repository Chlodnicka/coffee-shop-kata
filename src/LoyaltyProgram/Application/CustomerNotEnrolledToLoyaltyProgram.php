<?php

declare(strict_types=1);

namespace CoffeeShop\LoyaltyProgram\Application;

final class CustomerNotEnrolledToLoyaltyProgram extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Customer with email $email is not a member of loyalty program. Enroll first");
    }
}
