<?php
declare(strict_types=1);

namespace Game\Controller\Category;

use FreeToGame\Filters\SearchTerms\TurnBased;
use FreeToGame\Sort\PopularitySort;
use Game\Factory\SortFactory;
use Game\Form\SortByForm;
use Game\Service\CategoryGamesRetriever;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class TurnBasedController extends AbstractActionController
{
    public function indexAction(): ViewModel
    {
        $sortBy = $this->request->getPost('sort-by', 'popularity');

        $sort = $this->request->isPost() ? SortFactory::getSort($sortBy) : new PopularitySort();

        $games = CategoryGamesRetriever::execute(new TurnBased(), $sort);

        $form = new SortByForm('grid-sort-by', ['action' => 'turn-based', 'sort-by' => $sortBy]);

        return new ViewModel(['games' => $games, 'form' => $form]);
    }
}
