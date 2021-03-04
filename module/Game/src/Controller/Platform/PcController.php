<?php
declare(strict_types=1);

namespace Game\Controller\Platform;

use FreeToGame\Filters\Platforms\PersonalComputer;
use FreeToGame\Sort\PopularitySort;
use Game\Controller\GridController;
use Game\Service\PlatformGamesRetriever;
use Laminas\View\Model\ViewModel;

class PcController extends GridController
{
    public function indexAction(): ViewModel
    {
        $sortBy = $this->request->getPost('sort-by', 'popularity');

        $sort = $this->request->isPost() ? $this->getSort($sortBy) : new PopularitySort();

        $games = PlatformGamesRetriever::execute(new PersonalComputer(), $sort);

        return new ViewModel(['games' => $games, 'form' => $this->initSortByForm('pc', $sortBy)]);
    }
}
