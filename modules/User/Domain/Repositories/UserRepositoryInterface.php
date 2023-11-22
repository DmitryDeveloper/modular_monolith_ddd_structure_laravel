<?php

namespace Modules\User\Domain\Repositories;

use Modules\User\Domain\Aggregates\User;

interface UserRepositoryInterface
{
    public function save(User $user): void;
}
