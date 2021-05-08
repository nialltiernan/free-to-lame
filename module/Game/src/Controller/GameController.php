<?php
declare(strict_types=1);

namespace Game\Controller;

use FreeToGame\Client;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class GameController extends AbstractActionController
{
    public function detailsAction(): ViewModel
    {
        return new ViewModel([
            'gameId' => $this->params()->fromRoute('id'),
            'color' => $this->getLoadingColor()
        ]);
    }

    public function detailsJsonAction(): JsonModel
    {
        $gameId = (int) $this->params()->fromRoute('id');

        $freeToGame = new Client();

        $data = $freeToGame->fetchDetails($gameId)->getData();

        return (new JsonModel(['data' => $data]))->setTemplate('json/index.phtml');
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
}
