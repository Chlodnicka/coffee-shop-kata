<?php

declare(strict_types=1);

namespace CoffeeShop\LoyaltyProgram\Application;

use CoffeeShop\LoyaltyProgram\Domain\LoyaltyCustomer;

final class LoyaltyService
{
    public function __construct(
        private LoyaltyRepository $loyaltyRepository,
        private CustomerViewModel $customerViewModel
    ) {
    }

    public function enroll(string $email): void
    {
        if (!$this->customerViewModel->exists($email)) {
            throw new CustomerDoesNotExist($email);
        }
        if ($this->loyaltyRepository->exists($email)) {
            throw new CustomerAlreadyEnrolledToLoyaltyProgram($email);
        }
        $loyaltyCustomer = new LoyaltyCustomer($email);
        $this->loyaltyRepository->save($loyaltyCustomer);
    }

    public function registerPurchase(string $email, int $cupsOfCoffee): void
    {
        $loyaltyCustomer = $this->loyaltyRepository->get($email);
        $loyaltyCustomer->recalculate($cupsOfCoffee);
        $this->loyaltyRepository->save($loyaltyCustomer);
    }

    public function redeemFreeCoffee(string $email, int $requestedFreeCoffeeCups): void
    {
        $loyaltyCustomer = $this->loyaltyRepository->get($email);
        $loyaltyCustomer->redeemFreeCoffees($requestedFreeCoffeeCups);
        $this->loyaltyRepository->save($loyaltyCustomer);
    }

    public function getList(string $email): array
    {
        $loyaltyCustomer = $this->loyaltyRepository->get($email);
        return $loyaltyCustomer->toArray();
    }

}
