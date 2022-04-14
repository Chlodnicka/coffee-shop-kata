<?php

declare(strict_types=1);

namespace CoffeeShop\Tests\Customer\Fixture;

use CoffeeShop\Customer\Application\CustomerRepository;

final class CustomerInMemoryRepository implements CustomerRepository
{
    public function __construct(private array $memory = [])
    {
    }

    public function create(string $email): void
    {
        $this->memory[$email] = ['email' => $email];
    }

    public function get(string $email): ?array
    {
        return $this->memory[$email] ?? null;
    }
}
