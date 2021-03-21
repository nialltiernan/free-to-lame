<?php
declare(strict_types=1);

namespace User\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use User\Service\AuthenticationService;

class AuthenticationHelper extends AbstractHelper
{
    private AuthenticationService $service;

    public function __construct(AuthenticationService $service)
    {
        $this->service = $service;
    }

    public function hasIdentity(): bool
    {
        return $this->service->hasIdentity();
    }
}
