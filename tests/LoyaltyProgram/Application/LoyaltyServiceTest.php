<?php

namespace CoffeeShop\Tests\LoyaltyProgram\Application;

use CoffeeShop\LoyaltyProgram\Application\CustomerAlreadyEnrolledToLoyaltyProgram;
use CoffeeShop\LoyaltyProgram\Application\CustomerDoesNotExist;
use CoffeeShop\LoyaltyProgram\Application\CustomerNotEnrolledToLoyaltyProgram;
use CoffeeShop\LoyaltyProgram\Domain\NotEnoughFreeCoffees;
use CoffeeShop\Tests\LoyaltyProgram\Fixture\LoyaltyServiceFixture;
use PHPUnit\Framework\TestCase;

/**
 * @covers \CoffeeShop\LoyaltyProgram\Application\LoyaltyService
 */
class LoyaltyServiceTest extends TestCase
{
    public function testShouldEnrollCustomerToLoyaltyProgram(): void
    {
        // Given
        $email = 'valid@email.com';
        $service = LoyaltyServiceFixture::create([], [$email => ['email' => $email]]);

        // When
        $service->enroll($email);

        // Then
        self::assertSame(['email' => $email, 'stamps' => 0, 'freeCoffees' => 0], $service->getList($email));
    }

    public function testShouldNotEnrollCustomerBecauseThereIsNone(): void
    {
        // Expect
        $this->expectException(CustomerDoesNotExist::class);

        // Given
        $service = LoyaltyServiceFixture::create([], []);

        // When
        $service->enroll('valid@email.com');
    }

    public function testShouldNotEnrollCustomerBecauseItIsAlreadyEnrolled(): void
    {
        // Expect
        $this->expectException(CustomerAlreadyEnrolledToLoyaltyProgram::class);

        // Given
        $email = 'valid@email.com';
        $service = LoyaltyServiceFixture::create(
            [$email => ['email' => $email, 'stamps' => 0, 'freeCoffees' => 0]],
            [$email => ['email' => $email]]
        );

        // When
        $service->enroll('valid@email.com');
    }

    public function testShouldRegisterPurchaseForExistingCustomer(): void
    {
        // Given
        $email = 'valid@email.com';
        $cupsOfCoffee = 2;
        $service = LoyaltyServiceFixture::create(
            [$email => ['email' => $email, 'stamps' => 0, 'freeCoffees' => 0]],
            []
        );

        // When
        $service->registerPurchase($email, $cupsOfCoffee);

        // Then
        self::assertSame(['email' => $email, 'stamps' => 2, 'freeCoffees' => 0], $service->getList($email));
    }

    public function testShouldNotRegisterPurchaseBecauseCustomerIsNotEnrolledToLoyaltyProgram(): void
    {
        // Expect
        $this->expectException(CustomerNotEnrolledToLoyaltyProgram::class);

        // Given
        $email = 'valid@email.com';
        $cupsOfCoffee = 2;
        $service = LoyaltyServiceFixture::create([], []);

        // When
        $service->registerPurchase($email, $cupsOfCoffee);
    }

    public function testShouldRedeemFreeCoffees(): void
    {
        // Given
        $email = 'valid@email.com';
        $cupsOfCoffee = 2;
        $service = LoyaltyServiceFixture::create(
            [$email => ['email' => $email, 'stamps' => 0, 'freeCoffees' => 3]],
            []
        );

        // When
        $service->redeemFreeCoffee($email, $cupsOfCoffee);

        // Then
        self::assertSame(['email' => $email, 'stamps' => 0, 'freeCoffees' => 1], $service->getList($email));
    }

    public function testShouldNotRedeemFreeCoffeesBecauseThereAreNone(): void
    {
        // Expect
        $this->expectException(NotEnoughFreeCoffees::class);

        // Given
        $email = 'valid@email.com';
        $cupsOfCoffee = 2;
        $service = LoyaltyServiceFixture::create(
            [$email => ['email' => $email, 'stamps' => 0, 'freeCoffees' => 1]],
            []
        );

        // When
        $service->redeemFreeCoffee($email, $cupsOfCoffee);
    }

    public function testShouldNotRedeemFreeCoffeeBecauseCustomerIsNotEnrolledToLoyaltyProgram(): void
    {
        // Expect
        $this->expectException(CustomerNotEnrolledToLoyaltyProgram::class);

        // Given
        $email = 'valid@email.com';
        $cupsOfCoffee = 2;
        $service = LoyaltyServiceFixture::create([], []);

        // When
        $service->redeemFreeCoffee($email, $cupsOfCoffee);
    }
}
