<?php
declare(strict_types=1);

namespace Game\Controller\Platform;

use FreeToGame\Filters\Platforms\PersonalComputer;
use FreeToGame\Sort\PopularitySort;
use Game\Factory\SortFactory;
use Game\Form\SortByForm;
use Game\Service\PlatformGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class PcController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        $sortBy = $this->getRequest()->getPost('sort-by', 'popularity');

        $sort = $this->getRequest()->isPost() ? SortFactory::getSort($sortBy) : new PopularitySort();

        $games = PlatformGamesRetriever::execute(new PersonalComputer(), $sort);

        $form = new SortByForm('grid-sort-by', ['action' => 'pc', 'sort-by' => $sortBy]);

        return new ViewModel(['games' => $games, 'form' => $form]);
    }
}
