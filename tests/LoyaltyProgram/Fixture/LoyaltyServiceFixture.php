<?php

declare(strict_types=1);

namespace CoffeeShop\Tests\LoyaltyProgram\Fixture;

use CoffeeShop\LoyaltyProgram\Application\LoyaltyService;

final class LoyaltyServiceFixture
{
    public static function create($loyaltyCustomersPayload, $customersPayload): LoyaltyService
    {
        return new LoyaltyService(
            new LoyaltyInMemoryRepository($loyaltyCustomersPayload),
            new CustomerInMemoryViewModel($customersPayload)
        );
    }
}
