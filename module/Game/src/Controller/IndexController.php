<?php
declare(strict_types=1);

namespace Game\Controller;

use Game\Service\IndexGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        return new ViewModel(['color' => $this->getLoadingColor()]);
    }

    private function getLoadingColor(): string
    {
        /** @var \Laminas\Mvc\Plugin\Identity\Identity $identity */
        $identity = $this->plugin(Identity::class);

        if ($identity->getAuthenticationService()->hasIdentity()){
            /** @var \User\Model\User $user */
            $user = $identity->getAuthenticationService()->getIdentity();
            return $user->getColor();
        }

        return 'blue';
    }

    public function indexJsonAction(): ViewModel
    {
        return (new JsonModel(['data' => IndexGamesRetriever::execute()]))->setTemplate('json/index.phtml');
    }
}
