<?php
declare(strict_types=1);

namespace User\View\Helper;

use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\View\Helper\AbstractHelper;

class AuthenticationHelper extends AbstractHelper
{
    private AuthenticationServiceInterface $service;

    public function __construct(AuthenticationServiceInterface $service)
    {
        $this->service = $service;
    }

    public function hasIdentity(): bool
    {
        return $this->service->hasIdentity();
    }

    public function getAuthenticatedUserId(): ?int
    {
        if (!$this->service->hasIdentity()) {
            return null;
        }

        return $this->service->getIdentity()->getId();
    }
}
