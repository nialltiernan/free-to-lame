<?php
declare(strict_types=1);

namespace Game\Controller\Platform;

use FreeToGame\Filters\Platforms\Browser;
use FreeToGame\Sort\PopularitySort;
use Game\Controller\GridController;
use Game\Service\PlatformGamesRetriever;
use Laminas\View\Model\ViewModel;

class BrowserController extends GridController
{
    public function indexAction(): ViewModel
    {
        $sortBy = $this->request->getPost('sort-by', 'popularity');

        $sort = $this->request->isPost() ? $this->getSort($sortBy) : new PopularitySort();

        $games = PlatformGamesRetriever::execute(new Browser(), $sort);

        return new ViewModel(['games' => $games, 'form' => $this->initSortByForm('browser', $sortBy)]);
    }
}
