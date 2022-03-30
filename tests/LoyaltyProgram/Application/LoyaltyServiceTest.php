<?php

namespace CoffeeShop\Tests\LoyaltyProgram\Application;

use CoffeeShop\LoyaltyProgram\Application\LoyaltyService;
use CoffeeShop\Tests\LoyaltyProgram\Fixture\LoyaltyInMemoryRepository;
use PHPUnit\Framework\TestCase;

/**
 * @covers \CoffeeShop\LoyaltyProgram\Application\LoyaltyService
 */
class LoyaltyServiceTest extends TestCase
{
    public function testShouldRegisterPurchaseForExistingCustomer(): void
    {
        // Given
        $email = 'valid@email.com';
        $cupsOfCoffee = 2;
        $repository =new LoyaltyInMemoryRepository(
            [
                $email => [
                    'email'       => $email,
                    'stamps'      => 0,
                    'freeCoffees' => 0
                ]
            ]
        );
        $loyaltyService = new LoyaltyService($repository);

        // When
        $loyaltyService->registerPurchase($email, $cupsOfCoffee);

        // Then
        self::assertSame(['email' => $email, 'stamps' => 2, 'freeCoffees' => 0], $repository->get($email)->toArray());
    }

    public function testShouldCreateNewCustomerAndRegisterPurchase(): void
    {
        // Expect

        // Given


        // When

        // Then
    }

    public function testShouldRedeemFreeCoffees(): void
    {
        // Expect

        // Given


        // When

        // Then
    }

    public function testShouldNotRedeemFreeCoffeesBecauseThereIsNotEnoughStamps(): void
    {
        // Expect

        // Given


        // When

        // Then
    }
}
