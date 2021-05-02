<?php
declare(strict_types=1);

namespace Game\Controller;

use FreeToGame\Filters\Platforms\Browser;
use FreeToGame\Filters\Platforms\PersonalComputer;
use Game\Factory\SortFactory;
use Game\Service\PlatformGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;

class PlatformController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        return new ViewModel(['platform' => $this->params()->fromRoute('platform')]);
    }

    public function indexJsonAction(): JsonModel
    {
        $sortBy = $this->getRequest()->getQuery('sort-by', 'popularity');

        $sort = SortFactory::getSort($sortBy);

        $platform = $this->params()->fromRoute('platform') === 'pc' ? new PersonalComputer() : new Browser();

        $games = PlatformGamesRetriever::execute($platform, $sort);

        return (new JsonModel(['data' => $games]))->setTemplate('json/index.phtml');
    }

    public function listAction(): ViewModel
    {
        return new ViewModel();
    }
}
