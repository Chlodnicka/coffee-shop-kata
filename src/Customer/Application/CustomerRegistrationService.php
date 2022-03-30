<?php

declare(strict_types=1);

namespace CoffeeShop\Customer\Application;

use CoffeeShop\SharedKernel\EmailValidator;

final class CustomerRegistrationService
{
    public function __construct(private EmailValidator $emailValidator, private CustomerRepository $customerRepository)
    {
    }

    public function create(string $email): void
    {
        $this->validateEmail($email);
        $this->checkIfCustomerDoesNotExist($email);
        $this->customerRepository->create($email);
    }

    private function validateEmail(string $email): void
    {
        if (!$this->emailValidator->validate($email)) {
            throw new InvalidCustomerEmail($email);
        }
    }

    private function checkIfCustomerDoesNotExist(string $email): void
    {
        if ($this->customerRepository->get($email)) {
            throw new UserAlreadyExists($email);
        }
    }
}
