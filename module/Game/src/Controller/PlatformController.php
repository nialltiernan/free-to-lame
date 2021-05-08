<?php
declare(strict_types=1);

namespace Game\Controller;

use FreeToGame\Filters\Platforms\Browser;
use FreeToGame\Filters\Platforms\PersonalComputer;
use Game\Factory\SortFactory;
use Game\Service\PlatformGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use User\Controller\Plugin\UserColorPlugin;

class PlatformController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        return new ViewModel([
            'platform' => $this->params()->fromRoute('platform'),
            'color' => $this->getColor()
        ]);
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

    private function getColor(): string
    {
        /** @var \User\Controller\Plugin\UserColorPlugin $colorPlugin */
        $colorPlugin = $this->plugin(UserColorPlugin::NAME);
        return $colorPlugin->getColor($this->plugin(Identity::class));
    }
}
