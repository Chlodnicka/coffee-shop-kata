<?php

declare(strict_types=1);

namespace CoffeeShop\Tests\LoyaltyProgram\Fixture;

use CoffeeShop\LoyaltyProgram\Application\CustomerViewModel;

final class CustomerInMemoryViewModel implements CustomerViewModel
{
    public function __construct(private array $memory = [])
    {
    }

    public function exists(string $email): bool
    {
        return isset($this->memory[$email]);
    }

}
