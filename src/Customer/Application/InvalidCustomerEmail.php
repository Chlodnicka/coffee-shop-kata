<?php

declare(strict_types=1);

namespace CoffeeShop\Customer\Application;

final class InvalidCustomerEmail extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Email $email is not valid!");
    }
}
