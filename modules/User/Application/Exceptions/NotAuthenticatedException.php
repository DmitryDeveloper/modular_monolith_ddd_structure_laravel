<?php

namespace Modules\User\Application\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NotAuthenticatedException extends Exception
{
    public function __construct()
    {
        parent::__construct('Not authenticated', Response::HTTP_FORBIDDEN);
    }
}
