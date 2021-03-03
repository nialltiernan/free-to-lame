<?php
declare(strict_types=1);

namespace Game\Controller;

use FreeToGame\Client;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class GameController extends AbstractActionController
{
    public function detailsAction(): ViewModel
    {
        $gameId = (int) $this->params()->fromRoute('id');

        $freeToGame = new Client();

        $game = $freeToGame->fetchDetails($gameId)->getData();

        return new ViewModel(['game' => $game, 'hasSystemRequirements' => $this->hasSystemRequirements($game)]);
    }

    private function hasSystemRequirements(array $game): bool
    {
        $requirements = $game['minimum_system_requirements'];

        return $requirements['os'] ||
            $requirements['processor'] ||
            $requirements['memory'] ||
            $requirements['graphics'] ||
            $requirements['storage'];
    }
}
