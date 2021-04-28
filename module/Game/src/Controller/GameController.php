<?php
declare(strict_types=1);

namespace Game\Controller;

use FreeToGame\Client;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class GameController extends AbstractActionController
{
    public function detailsAction(): ViewModel
    {
        return new ViewModel(['gameId' => $this->params()->fromRoute('id')]);
    }

    public function detailsJsonAction(): JsonModel
    {
        $gameId = (int) $this->params()->fromRoute('id');

        $freeToGame = new Client();

        $data = $freeToGame->fetchDetails($gameId)->getData();

        return new JsonModel(['data' => $data]);
    }
}
