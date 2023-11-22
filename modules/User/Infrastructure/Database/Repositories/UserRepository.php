<?php

namespace Modules\User\Infrastructure\Database\Repositories;

use Modules\User\Domain\Aggregates\User;
use Modules\User\Domain\Repositories\UserRepositoryInterface;
use Modules\User\Infrastructure\Database\Models\User as UserModel;

class UserRepository implements UserRepositoryInterface
{
    protected UserModel $model;

    public function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    public function save(User $user): void
    {
        $this->model->create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ]);
    }
}
