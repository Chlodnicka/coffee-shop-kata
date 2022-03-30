<?php

namespace CoffeeShop\Tests\Customer\Application;

use CoffeeShop\Customer\Application\CustomerRegistrationService;
use CoffeeShop\Customer\Application\InvalidCustomerEmail;
use CoffeeShop\Customer\Application\UserAlreadyExists;
use CoffeeShop\SharedKernel\EmailValidator;
use CoffeeShop\Tests\Customer\Fixture\CustomerInMemoryRepository;
use PHPUnit\Framework\TestCase;

/**
 * @covers \CoffeeShop\Customer\Application\CustomerRegistrationService
 */
class CustomerRegistrationServiceTest extends TestCase
{
    public function testShouldCreateNewCustomer(): void
    {
        // Given
        $email = 'valid@email.com';
        $customerRepository = new CustomerInMemoryRepository();
        $customerService = new CustomerRegistrationService(new EmailValidator(), $customerRepository);

        // When
        $customerService->create($email);

        // Then
        self::assertNotNull($customerRepository);
    }

    public function testShouldNotCreateCustomerBecauseHeAlreadyExists(): void
    {
        // Expect
        $this->expectException(UserAlreadyExists::class);

        // Given
        $email = 'valid@email.com';
        $customerRepository = new CustomerInMemoryRepository(
            [
                $email => [
                    'points' => 0,
                    'freeCoffee' => 0
                ]
            ]
        );
        $customerService = new CustomerRegistrationService(new EmailValidator(), $customerRepository);

        // When
        $customerService->create($email);
    }

    public function testShouldNotCreateUserBecauseEmailIsNotValid(): void
    {
        // Expect
        $this->expectException(InvalidCustomerEmail::class);

        // Given
        $email = 'someinvalidemail.com';
        $customerService = new CustomerRegistrationService(new EmailValidator(), new CustomerInMemoryRepository());

        // When
        $customerService->create($email);
    }
}
