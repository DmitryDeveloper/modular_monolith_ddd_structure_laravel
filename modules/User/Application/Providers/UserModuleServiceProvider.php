<?php

declare(strict_types=1);

namespace Modules\User\Application\Providers;

use Modules\Shared\Application\Providers\AbstractModuleServiceProvider;

class UserModuleServiceProvider extends AbstractModuleServiceProvider
{
    protected function getModuleNamespace(): string
    {
        return '\Modules\User';
    }

    protected function getModulePath(): string
    {
        return 'modules/User';
    }

    protected function getProvidersStack(): array
    {
        return [
            // put module providers here
            UserServiceProvider::class
        ];
    }
}
