<?php

declare(strict_types=1);

namespace CoffeeShop\LoyaltyProgram\Application;

final class LoyaltyService
{
    public function __construct(private LoyaltyRepository $loyaltyRepository)
    {
    }


    public function registerPurchase(string $email, int $cupsOfCoffee): void
    {
        $loyaltyCustomer = $this->loyaltyRepository->get($email);
        $loyaltyCustomer->recalculate($cupsOfCoffee);
        $this->loyaltyRepository->save($loyaltyCustomer);
    }

    public function getList(string $email): array
    {
        $loyaltyCustomer = $this->loyaltyRepository->get($email);
        return $loyaltyCustomer->toArray();
    }

    public function redeemFreeCoffee(string $email, int $requestedFreeCoffeeCups): void
    {
        $loyaltyCustomer = $this->loyaltyRepository->get($email);
        $loyaltyCustomer->redeemFreeCoffees($requestedFreeCoffeeCups);
        $this->loyaltyRepository->save($loyaltyCustomer);
    }

}
