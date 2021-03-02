<?php
declare(strict_types=1);

namespace Game\Controller;

use FreeToGame\Client;
use FreeToGame\Sort\PopularitySort;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        $freeToGame = new Client();
        $popularitySort = new PopularitySort();

        return new ViewModel(['games' => $freeToGame->fetchList(null, $popularitySort)->getData()]);
    }
}
