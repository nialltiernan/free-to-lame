<?php

namespace User\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;
use Laminas\Mvc\Plugin\Identity\Identity;

class UserColorPlugin extends AbstractPlugin
{
    public const NAME = 'UserColorPlugin';

    public function getColor(Identity $identity): string
    {
        if ($identity->getAuthenticationService()->hasIdentity()){
            /** @var \User\Model\User $user */
            $user = $identity->getAuthenticationService()->getIdentity();
            return $user->getColor();
        }

        return 'blue';
    }
}