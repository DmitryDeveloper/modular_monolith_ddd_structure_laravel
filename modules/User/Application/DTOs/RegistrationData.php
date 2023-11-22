<?php

namespace Modules\User\Application\DTOs;

class RegistrationData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    )
    {}
}
