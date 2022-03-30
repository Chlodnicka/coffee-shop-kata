<?php

declare(strict_types=1);

namespace CoffeeShop\SharedKernel;

final class EmailValidator
{
    public function validate(string $email): bool
    {
        //todo: naive first implementation
        return $email === 'valid@email.com';
    }

}
