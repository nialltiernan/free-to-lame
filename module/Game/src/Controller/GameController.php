<?php
declare(strict_types=1);

namespace Game\Controller;

use FreeToGame\Client;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use User\Controller\Plugin\UserColorPlugin;

class GameController extends AbstractActionController
{
    public function detailsAction(): ViewModel
    {
        return new ViewModel([
            'gameId' => $this->params()->fromRoute('id'),
            'color' => $this->getColor()
        ]);
    }

    public function detailsJsonAction(): JsonModel
    {
        $gameId = (int) $this->params()->fromRoute('id');

        $freeToGame = new Client();

        $data = $freeToGame->fetchDetails($gameId)->getData();

        return (new JsonModel(['data' => $data]))->setTemplate('json/index.phtml');
    }

    private function getColor(): string
    {
        /** @var \User\Controller\Plugin\UserColorPlugin $colorPlugin */
        $colorPlugin = $this->plugin(UserColorPlugin::NAME);
        return $colorPlugin->getColor($this->plugin(Identity::class));
    }
}
