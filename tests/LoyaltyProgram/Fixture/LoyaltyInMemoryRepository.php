<?php

declare(strict_types=1);

namespace CoffeeShop\Tests\LoyaltyProgram\Fixture;

use CoffeeShop\LoyaltyProgram\Application\CustomerNotEnrolledToLoyaltyProgram;
use CoffeeShop\LoyaltyProgram\Application\LoyaltyRepository;
use CoffeeShop\LoyaltyProgram\Domain\LoyaltyCustomer;

final class LoyaltyInMemoryRepository implements LoyaltyRepository
{

    public function __construct(private array $memory = [])
    {
    }

    public function exists(string $email): bool
    {
        return isset($this->memory[$email]);
    }

    public function get(string $email): LoyaltyCustomer
    {
        if (!isset($this->memory[$email])) {
            throw new CustomerNotEnrolledToLoyaltyProgram($email);
        }
        return new LoyaltyCustomer($email, $this->memory[$email]['stamps'], $this->memory[$email]['freeCoffees']);
    }

    public function save(LoyaltyCustomer $loyaltyCustomer): void
    {
        $this->memory[$loyaltyCustomer->getEmail()] = $loyaltyCustomer->toArray();
    }

}
