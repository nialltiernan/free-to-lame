<?php
declare(strict_types=1);

namespace Game\Controller;

use FreeToGame\Client;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        $freeToGame = new Client();
        return new ViewModel(['games' => $freeToGame->fetchList()->getData()]);
    }
}
